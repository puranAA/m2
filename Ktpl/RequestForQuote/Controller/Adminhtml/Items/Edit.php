<?php
/**
 * @category   Ktpl
 * @package    Ktpl_RequestForQuote
 */

namespace Ktpl\RequestForQuote\Controller\Adminhtml\Items;

class Edit extends \Ktpl\RequestForQuote\Controller\Adminhtml\Items
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        
        $model = $this->_objectManager->create('Ktpl\RequestForQuote\Model\RequestForQuote');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This quote no longer exists.'));
                $this->_redirect('ktpl_requestforquote/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->_coreRegistry->register('current_ktpl_requestforquote_items', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('items_items_edit');
        $this->_view->renderLayout();
    }
}
