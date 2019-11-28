<?php
	class Member extends AppModel {

    public function insertDataFromCsv($data)
    {
      list($type, $no) = explode(' ', $data[3]);
      $member = [
        'type'    => $type,
        'no'      => (int) $no,
        'name'    => $data[2],
        'company' => empty($data[5]) ? null : $data[5],
        'valid'   => 1,
      ];

      return $this->save($member);
    }

	}