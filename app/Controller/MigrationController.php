<?php
	App::import('Vendor', 'excel-reader2');
	App::import('Vendor', 'SpreadsheetReader_XLSX');

	class MigrationController extends AppController{

		public function q1(){

			$this->setFlash('Question: Migration of data to multiple DB table');


// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}

		public function q1_instruction(){

			$this->setFlash('Question: Migration of data to multiple DB table');



// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}

		public function upload() {
			if ($this->request->is('post')) {
				if ($this->request->data['spreadsheet']['error'] === 0) {
					$filePath = WWW_ROOT . 'files' . DS;
					$fileName = $this->request->data['spreadsheet']['name'];
					move_uploaded_file($this->data['spreadsheet']['tmp_name'], $filePath . $fileName);

					try {
						$sheet = new SpreadsheetReader_XLSX($filePath . $fileName);
						foreach ($sheet as $row) {
							debug($row);
						}
					} catch (\Throwable $th) {
						debug($th);
					}

				}
			}
		}

	}