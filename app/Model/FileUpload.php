<?php

class FileUpload extends AppModel {
  /**
   * @param $filename
   * @throws Exception
   */
  public function insertCsvData($filename)
  {
    try {
      $insertData = [];
      if (($h = fopen($filename['tmp_name'], "r")) !== FALSE) {
        while (($data = fgetcsv($h, 1000, "\r")) !== FALSE) {
            foreach ($data as $key => $value) {
                if ($key == 0) {
                    continue;
                }
                list($name, $emailAddress) = explode(',', $value);
                $insertData[] = compact('name', 'emailAddress');
            }
        }
        fclose($h);
      }
      $this->saveAll($insertData);
    } catch (Exception $exception) {
        throw new Exception($exception->getMessage());
    }
  }
}