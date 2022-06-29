<?php
namespace Ktpl\CustomerCredit\Model\ResourceModel;
 
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
class Creditlimitreport extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('credit_limit_report', 'report_id');
    }

    
}