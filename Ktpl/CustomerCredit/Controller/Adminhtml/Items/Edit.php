<?php
/**
 * @category   Ktpl
 * @package    Ktpl_CustomerCredit
 */

namespace Ktpl\CustomerCredit\Controller\Adminhtml\Items;

class Edit extends \Ktpl\CustomerCredit\Controller\Adminhtml\Items
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        
        $model = $this->_objectManager->create('Ktpl\CustomerCredit\Model\CustomerCredit');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('ktpl_customercredit/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->_coreRegistry->register('current_ktpl_customercredit_items', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('items_items_edit');
        $this->_view->renderLayout();
    }
}
