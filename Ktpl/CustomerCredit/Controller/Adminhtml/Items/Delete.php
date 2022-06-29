<?php
/**
 * @category   Ktpl
 * @package    Ktpl_CustomerCredit
 */

namespace Ktpl\CustomerCredit\Controller\Adminhtml\Items;

class Delete extends \Ktpl\CustomerCredit\Controller\Adminhtml\Items
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->_objectManager->create('Ktpl\CustomerCredit\Model\CustomerCredit');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('You deleted the credit limit.'));
                $this->_redirect('ktpl_customercredit/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('We can\'t delete credit limit right now. Please review the log and try again.')
                );
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_redirect('ktpl_customercredit/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->messageManager->addError(__('We can\'t find a credit limit to delete.'));
        $this->_redirect('ktpl_customercredit/*/');
    }
}
