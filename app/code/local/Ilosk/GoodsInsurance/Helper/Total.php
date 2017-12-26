<?php

/**
 * Class Ilosk_GoodsInsurance_Helper_Total
 */
class Ilosk_GoodsInsurance_Helper_Total
{
    /**
     * @param $address
     * @return int
     */
    public function getInsuranceAmount($address)
    {
        $amount = 0;

        if ($_POST['add_insurance']) {
            try {
                $amount = Mage::getModel('checkout/session')->getQuote()->getBaseSubtotal();

                $insurance = Mage::helper('goodsinsurance/InsuranceFactory')->getInsuranceByAddress($address);
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
     * @param $total
     * @return mixed
     */
    public function getQuote($total)
    {
        $order = $total->getOrder();

        $quote = $this->getQuoteByOrder($order);

        return $quote;
    }

    /**
     * @param $order
     * @return mixed
     */
    public function getQuoteByOrder($order)
    {
        $store = Mage::getSingleton('core/store')->load($order->getStoreId());

        $quote = Mage::getModel('sales/quote')->setStore($store)->load($order->getQuoteId());

        return $quote;
    }

    /**
     * @param $total
     * @return mixed
     */
    public function getGrandTotal($total)
    {
        $order = $total->getOrder();

        return $order->getGrandTotal();
    }

    /**
     * @param $total
     * @return Varien_Object
     */
    public function getGrandTotalObject($total)
    {
        $grandTotal = $this->getGrandTotal($total);

        return new Varien_Object([
            'code'      => 'grand_total',
            'strong'    => true,
            'value'     => $grandTotal,
            'base_value'=> $grandTotal,
            'label'     => $total->helper('sales')->__('Grand Total'),
            'area'      => 'footer'
        ]);
    }

    /**
     * @param Mage_Sales_Block_Order_Totals $total
     * @return Mage_Sales_Block_Order_Totals
     */
    public function addToTotal(Mage_Sales_Block_Order_Totals $total)
    {
        $order = $total->getOrder();

        $amount = $order->getInsuranceAmount();

        if ((int) $amount) {
            $total->addTotal(new Varien_Object([
                'code'      => 'goodsinsurance',
                'value'     => $amount,
                'label'     => 'Goods Insurance',
            ]), ['shipping']);
        }

        return $total;
    }

    /**
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Mage_Sales_Model_Quote_Address
     */
    public function addToAddress(Mage_Sales_Model_Quote_Address $address)
    {
        $amount = $address->getInsuranceAmount();

        if ((int) $amount) {
            $address->addTotal([
                'code'      => 'goodsinsurance',
                'value'     => $amount,
                'title'     => 'Goods Insurance',
            ], ['shipping']);
        }

        return $address;
    }
}
