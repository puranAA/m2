<?php
/**
 * @category   Ktpl
 * @package    Ktpl_CustomerCredit
 */

namespace Ktpl\CustomerCredit\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Item status functionality model
 */
class OrderStatus extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    /**#@+
     * Item Status values
     */
    const STATUS_ENABLED = 'order_placed_by_credit_limit';

    /**#@-*/

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return [self::STATUS_ENABLED => __('Order Placed By Credit Limit')];
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }
}