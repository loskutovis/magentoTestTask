<?php

class Ilosk_GoodsInsurance_Block_Adminhtml_Total_Invoice extends Mage_Adminhtml_Block_Sales_Order_Invoice_Totals
{
    protected function _initTotals()
    {
        parent::_initTotals();

        return Mage::helper('goodsinsurance/Total')
            ->addToTotal($this);
    }
}