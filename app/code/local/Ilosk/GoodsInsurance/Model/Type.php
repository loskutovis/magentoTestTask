<?php

/**
 * Class Ilosk_GoodsInsurance_Model_Type
 */
class Ilosk_GoodsInsurance_Model_Type
{
    /**
     * Provide available options as a value/label array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $config = Mage::getConfig()
            ->getNode('global/settings/goodsinsurance/goodsinsurance')
            ->asArray();

        $result = [];

        foreach ($config as $key => $value) {
            $result[] = [
                'value' => $key,
                'label' => $value['label']
            ];
        }

        return $result;
    }
}
