<?php
/**
 * @category   Ktpl
 * @package    Ktpl_CustomerCredit
 */

namespace Ktpl\CustomerCredit\Controller\Adminhtml\Items;

class NewAction extends \Ktpl\CustomerCredit\Controller\Adminhtml\Items
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
