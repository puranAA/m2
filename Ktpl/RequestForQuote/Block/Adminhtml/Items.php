<?php
/**
 * @category   Ktpl
 * @package    Ktpl_RequestForQuote
 */


namespace Ktpl\RequestForQuote\Block\Adminhtml;

class Items extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'items';
        $this->_headerText = __('Quotes');
        $this->_addButtonLabel = __('Add New Quote');
        parent::_construct();
		
    }
}
