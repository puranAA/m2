<?php
/**
 * @category   Ktpl
 * @package    Ktpl_CustomerCredit
 */

namespace Ktpl\CustomerCredit\Model;

use Magento\Framework\Model\AbstractModel;

class CustomerCredit extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Ktpl\CustomerCredit\Model\ResourceModel\CustomerCredit');
    }
}