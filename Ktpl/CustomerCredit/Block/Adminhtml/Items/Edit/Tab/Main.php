<?php
/**
 * @category   Ktpl
 * @package    Ktpl_CustomerCredit
 */

namespace Ktpl\CustomerCredit\Block\Adminhtml\Items\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Main extends Generic implements TabInterface
{
    protected $_wysiwygConfig;
 
    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        \Magento\Framework\Registry $registry, 
        \Magento\Framework\Data\FormFactory $formFactory,  
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig, 
        array $data = []
    ) 
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Credit Limit Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Credit Limit Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_ktpl_customercredit_items');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Credit Limit Information')]);
        if ($model->getId()) {
            $fieldset->addField('enitity_id', 'hidden', ['name' => 'enitity_id']);
        }
        $fieldset->addField(
            'customer_id',
            'text',
            ['name' => 'customer_id', 'label' => __('Customer Id'), 'title' => __('Customer Id'), 'required' => true]
        );
        $fieldset->addField(
            'customer_email',
            'text',
            ['name' => 'customer_email', 'label' => __('Customer Email'), 'title' => __('Customer Email'), 'required' => true]
        );
         $fieldset->addField(
            'credit_limit',
            'text',
            ['name' => 'credit_limit', 'label' => __('Credit Limit'), 'title' => __('Credit Limit'), 'required' => true]
        );
        
        
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
