<?php
/**
 * @category   Ktpl
 * @package    Ktpl_CustomerCredit
 */

namespace Ktpl\CustomerCredit\Model\ResourceModel\CustomerCredit;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'enitity_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Ktpl\CustomerCredit\Model\CustomerCredit',
            'Ktpl\CustomerCredit\Model\ResourceModel\CustomerCredit'
        );
    }
}