<?php

/**
 * Class Ilosk_GoodsInsurance_Helper_Total
 */
class Ilosk_GoodsInsurance_Helper_Total
{
    /**
     * @return int
     */
    public function getInsuranceAmount($address)
    {
        $amount = 0;

        $request = Mage::app()->getRequest();

        if ($request->getPost('add_insurance')) {
            try {
                $amount = Mage::getModel('checkout/session')->getQuote()->getBaseSubtotal();

                $insurance = Mage::helper('goodsinsurance/Factory')->getInsuranceByAddress($address);
                $amount = $insurance->getAmount($amount);
            } catch (Exception $e) {
                //
            } catch (Error $e) {
                //
            }
        }

        return $amount;
    }

    /**
     * @param Mage_Sales_Block_Order_Totals $total
     * @return Mage_Sales_Block_Order_Totals
     */
    public function addToTotal(Mage_Sales_Block_Order_Totals $total)
    {
        $order = $total->getOrder();

        $amount = $order->getGoodsInsuranceAmount();

        if ((int) $amount) {
            $total->addTotal(new Varien_Object(array(
                'code'      => 'goodsinsurance',
                'value'     => $amount,
                'label'     => 'Goods Insurance',
            )), array('shipping'));
        }

        return $total;
    }

    /**
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Mage_Sales_Model_Quote_Address
     */
    public function addToAddress(Mage_Sales_Model_Quote_Address $address)
    {
        $amount = $this->getInsuranceAmount($address);

        if ((int) $amount) {
            $address->addTotal(array(
                'code'      => 'goodsinsurance',
                'value'     => $amount,
                'title'     => 'Goods Insurance',
            ), array('shipping'));
        }

        return $address;
    }
}