<?php

/**
 * Class Ilosk_GoodsInsurance_Model_GoodsInsurance_Fixed
 */
class Ilosk_GoodsInsurance_Model_GoodsInsurance_Fixed extends Ilosk_GoodsInsurance_Model_GoodsInsurance_AbstractInsurance
{
    /**
     * @param null $amount
     * @return mixed
     */
    public function getAmount($amount = null)
    {
        return $this->value;
    }
}
