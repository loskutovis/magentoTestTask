<?php

/**
 * Class Ilosk_GoodsInsurance_Observer_Insurance
 */
class Ilosk_GoodsInsurance_Observer_Insurance
{
    /**
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function setQuoteAddressInsurance(Varien_Event_Observer $observer)
    {
        $quote = $observer->getEvent()->getQuote();
        $address = $quote->getShippingAddress();

        $amount = Mage::helper('goodsinsurance/Total')->getInsuranceAmount($address);

        $address->setInsuranceAmount($amount);
        $quote->setInsuranceAmount($amount);

        return $this;
    }

    /**
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function setOrderInsurance(Varien_Event_Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        $quote = Mage::helper('goodsinsurance/Total')->getQuoteByOrder($order);

        $order->setInsuranceAmount($quote->getShippingAddress()->getInsuranceAmount());

        return $this;
    }
}