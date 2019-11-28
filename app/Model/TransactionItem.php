<?php
	class TransactionItem extends AppModel {

    public function insertDataFromCsv($data, $transactionId, $tableName, $tableId)
    {
      return $this->save([
        'transaction_id' => (int) $transactionId,
        'description'    => "Being Payment for : " . $data[10] . ' : ' . $data[11],
        'quantity'       => 1.00,
        'unit_price'     => floatval($data[12]),
        'sum'            => (int) $data[14],
        'valid'          => 1,
        'table'          => $tableName,
        'table_id'       => $tableId,
      ]);
    }

	}