<?php
/**
 * @category   Ktpl
 * @package    Ktpl_RequestForQuote
 */

namespace Ktpl\RequestForQuote\Model\ResourceModel\RequestForQuote;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'requestforquote_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Ktpl\RequestForQuote\Model\RequestForQuote',
            'Ktpl\RequestForQuote\Model\ResourceModel\RequestForQuote'
        );
    }
}