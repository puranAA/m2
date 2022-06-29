<?php
/**
 * @category   Ktpl
 * @package    Ktpl_RequestForQuote
 */

namespace Ktpl\RequestForQuote\Block\Adminhtml\Items\Edit\Tab;

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
        return __('Quote Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Quote Information');
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
        $model = $this->_coreRegistry->registry('current_ktpl_requestforquote_items');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Quote Information')]);
        if ($model->getId()) {
            $fieldset->addField('requestforquote_id', 'hidden', ['name' => 'requestforquote_id']);
        }
        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Name'), 'title' => __('Name'), 'required' => true]
        );
        $fieldset->addField(
            'email',
            'text',
            ['name' => 'email', 'label' => __('Email'), 'title' => __('Email'), 'required' => true]
        );
		$fieldset->addField(
            'contact',
            'text',
            ['name' => 'contact', 'label' => __('Contact'), 'title' => __('Contact'), 'required' => true]
        );
        $fieldset->addField(
            'notes',
            'editor',
            [
                'name' => 'notes',
                'label' => __('Notes'),
                'title' => __('Notes'),
                'style' => 'height:26em;',
                'required' => true,
                'config'    => $this->_wysiwygConfig->getConfig(),
                'wysiwyg' => true
            ]
        );
		$fieldset->addField(
            'price',
            'text',
            ['name' => 'price', 'label' => __('Price'), 'title' => __('Price'), 'required' => true]
        );
		$fieldset->addField(
            'qty',
            'text',
            ['name' => 'qty', 'label' => __('QTY'), 'title' => __('QTY'), 'required' => true]
        );
		$fieldset->addField(
            'product_name',
            'text',
            ['name' => 'product_name', 'label' => __('Product Name'), 'title' => __('Product Name'), 'required' => true]
        );
        
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
