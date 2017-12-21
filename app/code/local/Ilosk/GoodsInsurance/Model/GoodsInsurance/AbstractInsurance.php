<?php

abstract class Ilosk_GoodsInsurance_Model_GoodsInsurance_AbstractInsurance implements Ilosk_GoodsInsurance_Model_GoodsInsurance_InsuranceInterface
{
    protected $value;

    /**
     * Ilosk_GoodsInsuranceModel_Insurance_AbstractInsurance constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @param $carrier
     * @return static
     */
    public static function createFromCarrier(array $carrier)
    {
        return new static($carrier['goodsinsurance_value']);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param null $amount
     * @return mixed
     */
    abstract public function getAmount($amount = null);
}
