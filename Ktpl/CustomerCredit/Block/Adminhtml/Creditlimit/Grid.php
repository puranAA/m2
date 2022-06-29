<?php

namespace Ktpl\CustomerCredit\Block\Adminhtml\Creditlimit;

class Grid extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Ktpl_CustomerCredit';
        $this->_controller = 'adminhtml_creditlimit';
        $this->_headerText = __('Creditlimit');
        parent::_construct();
        $this->setDefaultSort('id');
        $this->setUseAjax(true);
        
    }


   
}