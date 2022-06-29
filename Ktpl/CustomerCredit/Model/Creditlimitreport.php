<?php
namespace Ktpl\CustomerCredit\Model;
 
use Magento\Framework\Model\AbstractModel;
 
class Creditlimitreport extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Ktpl\CustomerCredit\Model\ResourceModel\Creditlimitreport');
    }
}