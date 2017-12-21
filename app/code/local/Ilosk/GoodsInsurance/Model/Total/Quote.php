<?php

/**
 * Class Ilosk_GoodsInsurance_Model_Total_Quote
 */
class Ilosk_GoodsInsurance_Model_Total_Quote extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    protected $_code = 'goodsinsurance';

    /**
     * @param Mage_Sales_Model_Quote_Address $address
     * @return bool
     */
    protected function isShippingAddress(Mage_Sales_Model_Quote_Address $address) {
        return $address->getAddressType() == $address::TYPE_SHIPPING;
    }

    /**
     * @param Mage_Sales_Model_Quote_Address $address
     * @return $this|Mage_Sales_Model_Quote_Address_Total_Abstract
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);

        if (isset($_POST['is_shipping']) && $_POST['is_shipping'] == 1) {
            $amount = Mage::helper('goodsinsurance/Total')->getInsuranceAmount($address);

            $address->getQuote()->setInsuranceAmount($amount);
        } elseif ($this->isShippingAddress($address)) {
            $amount = $address->getQuote()->getInsuranceAmount();

            $this->_addAmount($amount);
            $this->_addBaseAmount($amount);

            $address->setGrandTotal($address->getGrandTotal() + $amount);
            $address->setBaseGrandTotal($address->getBaseGrandTotal() + $amount);
        }

        return $this;
    }

    /**
     * @param Mage_Sales_Model_Quote_Address $address
     * @return $this|array
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        if ($this->isShippingAddress($address)) {
            Mage::helper('goodsinsurance/Total')->addToAddress($address);
        }

        return $this;
    }
}