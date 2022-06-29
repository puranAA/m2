<?php
namespace Ktpl\CustomerCredit\Controller\Adminhtml\Creditlimit;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Ktpl\CustomerCredit\Controller\Adminhtml\Creditlimit
{
        
        public function execute()
        {  
            $resultPage = $this->_initAction();
            $resultPage->getConfig()->getTitle()->prepend(__('Credit Limits Usage'));
            return $resultPage;
        }

        protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ktpl_CustomerCredit::grid_list');
    }
}