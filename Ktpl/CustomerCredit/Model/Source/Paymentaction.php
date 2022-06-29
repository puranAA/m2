<?php
namespace Ktpl\CustomerCredit\Model\Source;
 /** * Order Status source model */
class Paymentaction 
{
    /**
     * @var string[] 
     */      public function toOptionArray(){
       return [ ['value' => 'order_placed_by_credit_limit', 'label' => __('Order Placed By Credit Limit')] ];
     }
}