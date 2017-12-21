<?php

class Ilosk_GoodsInsurance_Block_Frontend_Total_Creditmemo extends Mage_Sales_Block_Order_Creditmemo_Totals
{
    protected function _initTotals()
    {
        parent::_initTotals();

        return Mage::helper('goodsinsurance/Total')->addToTotal($this);
    }
}
