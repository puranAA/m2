<?php

namespace Ktpl\CustomerCredit\Setup;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Sales\Model\Order\StatusFactory;
use Magento\Sales\Model\ResourceModel\Order\StatusFactory as StatusResourceFactory;

class InstallData implements InstallDataInterface
{
    /* 
        CUSTOM_STATUS_CODE,CUSTOM_STATE_CODE and CUSTOM_STATUS_LABEL
    */

    const CUSTOM_STATUS_CODE = 'order_placed_by_credit_limit';
    const CUSTOM_STATE_CODE = 'order_placed_by_credit_limit';
    const CUSTOM_STATUS_LABEL = 'Order Placed By Credit Limit';

    protected $statusFactory;
    protected $statusResourceFactory;

    public function __construct(
        StatusFactory $statusFactory,
        StatusResourceFactory $statusResourceFactory
    ) {
        $this->statusFactory = $statusFactory;
        $this->statusResourceFactory = $statusResourceFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->addCustomOrderStatus();
    }

    protected function addCustomOrderStatus()
    {
        $statusResource = $this->statusResourceFactory->create();
        $status = $this->statusFactory->create();
        $status->setData([
            'status' => self::CUSTOM_STATUS_CODE,
            'label' => self::CUSTOM_STATUS_LABEL,
        ]);
        try {
            $statusResource->save($status);
        } catch (AlreadyExistsException $exception) {
            return;
        }
        $status->assignState(self::CUSTOM_STATE_CODE, true, true);
    }
}