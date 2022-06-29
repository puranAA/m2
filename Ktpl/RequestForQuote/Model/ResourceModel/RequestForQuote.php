<?php
/**
 * @category   Ktpl
 * @package    Ktpl_RequestForQuote
 */

namespace Ktpl\RequestForQuote\Model\ResourceModel;

class RequestForQuote extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('ktpl_requestforquote', 'requestforquote_id');   //here "ktpl_requestforquote" is table name and "requestforquote_id" is the primary key of custom table
    }
}