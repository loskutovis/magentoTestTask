<?php

/**
 * Class Ilosk_GoodsInsurance_Observer_Config
 */
class Ilosk_GoodsInsurance_Observer_Config
{
    public function extendCarrier(Varien_Event_Observer $observer)
    {
        $config = $observer->getConfig();

        $shippingMethods = $config->getNode('sections/carriers/groups');

        if ($shippingMethods) {
            $insurance = Mage::getConfig()->getNode('global/settings/goodsinsurance/carrier');

            foreach ($shippingMethods->children() as $method) {
                $method->extend($insurance);
            }
        }

       return $this;
    }
}
