<?php
/**
 * @category   Ktpl
 * @package    Ktpl_CustomerCredit
 */

namespace Ktpl\CustomerCredit\Controller\Adminhtml\Items;

class Index extends \Ktpl\CustomerCredit\Controller\Adminhtml\Items
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ktpl_CustomerCredit::testc');
        $resultPage->getConfig()->getTitle()->prepend(__('Credit Limit'));
        $resultPage->addBreadcrumb(__('Credit Limit'), __('Credit Limit'));
        $resultPage->addBreadcrumb(__('Credit Limit'), __('Credit Limit'));
        return $resultPage;
    }
}