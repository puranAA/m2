<?php
/**
 * @category   Ktpl
 * @package    Ktpl_RequestForQuote
 */

namespace Ktpl\RequestForQuote\Controller\Index;

use Magento\Framework\App\Action\Context;
use Ktpl\RequestForQuote\Model\RequestForQuoteFactory;

use Zend\Log\Filter\Timestamp;
use Magento\Store\Model\StoreManagerInterface;

class Save extends \Magento\Framework\App\Action\Action
{
	/**
     * @var RequestForQuote
     */
    protected $_requestforquote;
     
    protected $_inlineTranslation;
    protected $_transportBuilder;
    protected $_scopeConfig;
    protected $_logLoggerInterface;
    protected $storeManager;

    public function __construct(
		Context $context,
        RequestForQuoteFactory $requestforquote,
		\Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Psr\Log\LoggerInterface $loggerInterface,
        StoreManagerInterface $storeManager,
		array $data = []
    ) {
        $this->_requestforquote = $requestforquote;
		$this->_inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->_scopeConfig = $scopeConfig;
        $this->_logLoggerInterface = $loggerInterface;
        $this->messageManager = $context->getMessageManager();
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }
	public function execute()
    {
        $data = $this->getRequest()->getParams();
    	$requestforquote = $this->_requestforquote->create();
        $requestforquote->setData($data);
        if($requestforquote->save()){
            $this->messageManager->addSuccessMessage(__('Your request has saved successfully.'));
			
				try
				{
					// Send Mail
					$this->_inlineTranslation->suspend();
								 
					$sender = [
						'name' => $data['name'],
						'email' => $data['email']
					];
					 
					$sentToEmail = $this->_scopeConfig ->getValue('ktpl_config/advance/sender_email',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
					 
					$sentToName = $this->_scopeConfig ->getValue('ktpl_config/advance/sender_name',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
					 
					 
					$transport = $this->_transportBuilder
					->setTemplateIdentifier('customemail_email_template')
					->setTemplateOptions(
						[
							'area' => 'frontend',
							'store' => $this->storeManager->getStore()->getId()
						]
						)
						->setTemplateVars([
							'name'  => $data['name'],
							'email'  => $data['email'],
							'contact'  => $data['contact'],
							'notes'  => $data['notes'],
							'price'  => $data['price'],
							'qty'  => $data['qty'],
							'product_name'  => $data['product_name']
						])
						->setFromByScope($sender)
						->addTo($sentToEmail,$sentToName)
						//->addTo('owner@example.com','owner')
						->getTransport();
						 
						$transport->sendMessage();
						 
						$this->_inlineTranslation->resume();
						 
				} catch(\Exception $e){
					$this->messageManager->addError($e->getMessage());
					$this->_logLoggerInterface->debug($e->getMessage());
					//exit;
			}
        }else{
            $this->messageManager->addErrorMessage(__('Request was not saved.'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
		$resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
