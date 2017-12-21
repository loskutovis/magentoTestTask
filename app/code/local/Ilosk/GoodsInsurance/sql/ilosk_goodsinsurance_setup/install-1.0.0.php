<?php
$this->startSetup();

$connection = $this->getConnection();

$insuranceField = [
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale' => 4,
    'precision' => 12,
    'nullable' => false,
    'default' => '0.00',
    'comment' => 'Insurance value',
];

$quoteTable = $this->getTable('sales_flat_quote');

if(!$connection->tableColumnExists($quoteTable, 'insurance_amount')) {
    $connection->addColumn($quoteTable, 'insurance_amount', $insuranceField);
}

$this->endSetup();