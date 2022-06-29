<?php
namespace Ktpl\CustomerCredit\Block;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Customer\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use \Magento\Sales\Api\Data\OrderInterface;
use Ktpl\CustomerCredit\Model\CustomerCreditFactory;
use Ktpl\CustomerCredit\Model\CreditlimitreportFactory;
use Ktpl\CustomerCredit\Helper\Data;



class Creditlimit extends \Magento\Framework\View\Element\Template
{
   
	protected $_customerSession;
	protected $_requestModel;
	protected $_helper;
	protected $_reportCollection;
	protected $_order;

	public function __construct(Context $context,
				    Session $customerSession,CustomerCreditFactory $requestModel,
				    Data $helper,
				    CreditlimitreportFactory $reportCollection,
				    OrderInterface $order,
				    array $data = []
	)
	{        
	  $this->_requestModel = $requestModel;
	  $this->_customerSession = $customerSession;
	  $this->_helper = $helper;
	  $this->_order = $order;
	  $this->_reportCollection = $reportCollection;
	  parent::__construct($context, $data);
	}

	public function getCustomerSession() {
		return $this->_customerSession; 
		//$customer = $this->_customerSession->getCustomer();
		//return $customerName = $customer->getName();
	}

	public function getAvailableLimits($cid) {

		
		$model =  $this->_requestModel->create();
		$collection = $model->getCollection()
					  ->addFieldToFilter('customer_id',array('eq' =>$cid));
		return $collection;

	}
	
	
    public function updateCreditLimit($cid,$amount) {

        try {
        
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
            $connection = $resource->getConnection();
            $tableName = $resource->getTableName('credit_limit');
            $sql = "UPDATE $tableName SET credit_limit ='$amount' WHERE customer_id = '$cid'";
            $connection->query($sql);
            return 'success';
        
        } catch(LocalizedException $e) {

            return $e->getMessage();
        }

    }

	public function checkCustomerUrl() {
		return $this->_helper->getBaseUrl().'creditlimit/index/checkcustomer';
	} 

	public function getReportCollection() {
		$model = $this->_reportCollection->create();
		$collection = $model->getCollection();
		$collection->addFieldToFilter('customer_id',array('eq' => $this->_customerSession->getCustomer()->getId()));
		return $collection->setOrder('order_id','desc');
	}

	public function getOrderRealId($increment_id) {
		$order = $this->_order->loadByIncrementId($increment_id);
		return $order->getId();
	} 

}
