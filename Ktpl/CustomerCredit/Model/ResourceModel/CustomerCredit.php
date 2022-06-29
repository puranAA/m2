<?php
/**
 * @category   Ktpl
 * @package    Ktpl_CustomerCredit
 */

namespace Ktpl\CustomerCredit\Model\ResourceModel;

class CustomerCredit extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('credit_limit', 'enitity_id');   //here "ktpl_customercredit" is table name and "customercredit_id" is the primary key of custom table
    }
}