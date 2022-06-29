<?php
/**
 * @category   Ktpl
 * @package    Ktpl_RequestForQuote
 */

namespace Ktpl\RequestForQuote\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
