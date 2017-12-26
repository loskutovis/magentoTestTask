<?php

class Ilosk_GoodsInsurance_Block_Frontend_Total_Invoice extends Mage_Sales_Block_Order_Invoice_Totals
{
    protected function _initTotals()
    {
        parent::_initTotals();

        $total = Mage::helper('goodsinsurance/Total')->addToTotal($this);
        $total->_totals['grand_total'] = Mage::helper('goodsinsurance/Total')->getGrandTotalObject($total);

        return $total;
    }
}
