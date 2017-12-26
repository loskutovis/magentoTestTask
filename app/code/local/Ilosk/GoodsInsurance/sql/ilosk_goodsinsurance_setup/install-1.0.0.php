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

$tables = [
    $this->getTable('sales/quote_address'),
    $this->getTable('sales/order')
];

foreach ($tables as $table) {
    if (!$connection->tableColumnExists($table, 'insurance_amount')) {
        $connection->addColumn($table, 'insurance_amount', $insuranceField);
    }
}

$this->endSetup();