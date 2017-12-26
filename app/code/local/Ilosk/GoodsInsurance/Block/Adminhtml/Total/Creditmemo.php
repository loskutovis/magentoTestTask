<?php

class Ilosk_GoodsInsurance_Block_Adminhtml_Total_Creditmemo extends Mage_Adminhtml_Block_Sales_Order_Creditmemo_Totals
{
    protected function _initTotals()
    {
        parent::_initTotals();

        return Mage::helper('goodsinsurance/Total')->addToTotal($this);
    }
}
