define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'payonaccount',
                component: 'Ktpl_CustomerCredit/js/view/payment/method-renderer/payonaccount'
            }
        );
        return Component.extend({});
    }
);