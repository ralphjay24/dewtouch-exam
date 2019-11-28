<?php
	class Transaction extends AppModel {

    public function insertDataFromCsv($data, $memberId)
    {
      return $this->save([
        'member_id'       => (int) $memberId,
        'member_name'     => $data[2],
        'member_paytype'  => $data[4],
        'member_company'  => empty($data[5]) ? null : $data[5],
        'date'            => date('Y-m-d', strtotime($data[0])),
        'year'            => (int) date('Y', strtotime($data[0])),
        'month'           => (int) date('m', strtotime($data[0])),
        'ref_no'          => $data[1],
        'receipt_no'      => $data[8],
        'payment_method'  => $data[6],
        'batch_no'        => empty($data[7]) ? null : $data[7],
        'cheque_no'       => empty($data[9]) ? null : $data[9],
        'payment_type'    => $data[10],
        'renewal_year'    => (int) $data[11],
        'subtotal'        => floatval($data[12]),
        'tax'             => floatval($data[13]),
        'total'           => floatval($data[14]),
        'valid'           => 1
      ]);
    }

	}