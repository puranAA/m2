<?php
/**
 * @category   Ktpl
 * @package    Ktpl_RequestForQuote

 */

namespace Ktpl\RequestForQuote\Controller\Adminhtml\Items;

class NewAction extends \Ktpl\RequestForQuote\Controller\Adminhtml\Items
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
