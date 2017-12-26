<?php

/**
 * Class Ilosk_GoodsInsurance_Helper_InsuranceFactory
 */
class Ilosk_GoodsInsurance_Helper_InsuranceFactory
{
    /**
     * @param String $address
     * @return mixed
     */
    public function getShippingMethodByAddress(String $address)
    {
        $method = explode('_', $address);

        return $method[0];
    }

    /**
     * @param $method
     * @return mixed
     * @throws Exception
     */
    public function getShippingMethodConfig($method)
    {
        if ($config = Mage::getStoreConfig('carriers/' . $method)) {
            return $config;
        }

        return null;
    }

    /**
     * @param $carrier
     * @return mixed
     */
    public function createInsuranceFromCarrierConfig($carrier)
    {
        $type = $carrier['goodsinsurance_type'];

        $node = Mage::getConfig()->getNode('global/settings/goodsinsurance/goodsinsurance/' . $type);

        if ($type && $node){
            $config = $node->asArray();

            return $config['class']::createFromCarrier($carrier);
        }

        return null;
    }

    /**
     * @param $method
     * @return mixed
     * @throws Exception
     */
    public function getInsuranceByMethod($method)
    {
        return $this->createInsuranceFromCarrierConfig($this->getShippingMethodConfig($method));
    }

    /**
     * @param Mage_Sales_Model_Quote_Address $address
     * @return mixed
     * @throws Exception
     */
    public function getInsuranceByAddress(Mage_Sales_Model_Quote_Address $address)
    {
        $method = $address->getShippingMethod();

        $method = $this->getShippingMethodByAddress($method);

        return $this->getInsuranceByMethod($method);
    }
}
