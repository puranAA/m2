<?php
/**
 * @category   Ktpl
 * @package    Ktpl_RequestForQuote
 */

namespace Ktpl\RequestForQuote\Controller\Adminhtml\Items;

class Delete extends \Ktpl\RequestForQuote\Controller\Adminhtml\Items
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->_objectManager->create('Ktpl\RequestForQuote\Model\RequestForQuote');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('You deleted the quote.'));
                $this->_redirect('ktpl_requestforquote/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('We can\'t delete quote right now. Please review the log and try again.')
                );
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_redirect('ktpl_requestforquote/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->messageManager->addError(__('We can\'t find a item to delete.'));
        $this->_redirect('ktpl_requestforquote/*/');
    }
}
