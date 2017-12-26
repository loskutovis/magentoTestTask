<?php

/**
 * Class Ilosk_GoodsInsurance_Model_GoodsInsurance_Percent
 */
class Ilosk_GoodsInsurance_Model_GoodsInsurance_Percent extends Ilosk_GoodsInsurance_Model_GoodsInsurance_AbstractInsurance
{
    public function getAmount($amount = null)
    {
        return $amount * $this->getValue() / 100;
    }
}
