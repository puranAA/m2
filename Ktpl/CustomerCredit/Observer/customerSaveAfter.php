<?php
namespace Ktpl\CustomerCredit\Observer;
 
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Exception\LocalizedException;

//use Ktpl\CustomerCredit\Logger\Logger;
use Ktpl\CustomerCredit\Helper\Data;


 
class customerSaveAfter implements ObserverInterface
{
    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;
    //protected $_logger;
    protected $date;
    protected $_helper;
 
    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        DateTime $date, Data $helper
    ) {
        $this->_objectManager = $objectManager;
        //$this->_logger = $logger;
        $this->date = $date;
        $this->_helper=$helper;
    }
 
    /**
     * customer register event handler
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        
        try {

            $event = $observer->getEvent();
            $customer = $event->getCustomer();
            $id = $customer->getId();
            $email = $customer->getEmail();
            $limit = $this->_helper->getCreditLimit();
            
            $model = \Magento\Framework\App\ObjectManager::getInstance();       
            $question = $model->create('Ktpl\CustomerCredit\Model\Creditlimit');
            $question->setCustomerId($id);
            $question->setCustomerEmail($email);
            $question->setCreditLimit($limit);
            $question->setCreatedAt($this->date->gmtDate());
            $question->save();

        } catch(LocalizedException $e) {
             $this->messageManager->addError(__($e->getMessage()));
             $resultRedirect = $this->resultRedirectFactory->create();
             $resultRedirect->setRefererOrBaseUrl();
             return $resultRedirect;
        }
        
    }
}