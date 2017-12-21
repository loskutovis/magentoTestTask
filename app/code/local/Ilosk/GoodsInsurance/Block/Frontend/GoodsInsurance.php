<?php

/**
 * Class Ilosk_GoodsInsurance_Block_Frontend_GoodsInsurance
 */
class Ilosk_GoodsInsurance_Block_Frontend_GoodsInsurance extends Mage_Core_Block_Template
{
    /**
     * @return string
     */
    protected function getAvailableMethods()
    {
        $insuranceMethods = [];
        $shippingMethods = Mage::getSingleton('shipping/config')->getActiveCarriers();

        $total = Mage::getModel('checkout/session')->getQuote()->getBaseSubtotal();

        foreach ($shippingMethods as $code => $method) {
            if($method->getConfigData('goodsinsurance_active')) {
                $insurance = Mage::helper('goodsinsurance/Factory')->getInsuranceByMethod($code);

                $amount = $insurance->getAmount($total);

                $insuranceMethods[$code] = Mage::helper('core')->currency($amount, true, false);
            }
        }

        return json_encode($insuranceMethods);
    }
}