<?php

/**
 * Class Ilosk_GoodsInsurance_Block_Adminhtml_Total_Invoice
 */
class Ilosk_GoodsInsurance_Block_Adminhtml_Total_Invoice extends Mage_Adminhtml_Block_Sales_Order_Invoice_Totals
{
    /**
     * @return Mage_Sales_Block_Order_Totals
     */
    protected function _initTotals()
    {
        parent::_initTotals();

        $total = Mage::helper('goodsinsurance/Total')->addToTotal($this);
        $total->_totals['grand_total'] = Mage::helper('goodsinsurance/Total')->getGrandTotalObject($total);

        return $total;
    }
}
