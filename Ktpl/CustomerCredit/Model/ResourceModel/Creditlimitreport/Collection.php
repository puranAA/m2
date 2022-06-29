<?php
namespace Ktpl\CustomerCredit\Model\ResourceModel\Creditlimitreport;
 
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected $_idFieldName = 'report_id'; 

    protected function _construct()
    {
        $this->_init(
            'Ktpl\CustomerCredit\Model\Creditlimitreport',
            'Ktpl\CustomerCredit\Model\ResourceModel\Creditlimitreport'
        );
    }
}