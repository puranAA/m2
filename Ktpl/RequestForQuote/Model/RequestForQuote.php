<?php
/**
 * @category   Ktpl
 * @package    Ktpl_RequestForQuote
 */

namespace Ktpl\RequestForQuote\Model;

use Magento\Framework\Model\AbstractModel;

class RequestForQuote extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Ktpl\RequestForQuote\Model\ResourceModel\RequestForQuote');
    }
}