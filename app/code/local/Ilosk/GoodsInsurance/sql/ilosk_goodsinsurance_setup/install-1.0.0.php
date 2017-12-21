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

$orderTable = $this->getTable('sales_flat_order');
$quoteTable = $this->getTable('sales_flat_quote');

if(!$connection->tableColumnExists($orderTable, 'insurance_value')) {
    $connection->addColumn($orderTable, 'insurance_value', $insuranceField);
}

if(!$connection->tableColumnExists($quoteTable, 'insurance_value')) {
    $connection->addColumn($quoteTable, 'insurance_value', $insuranceField);
}

$this->endSetup();