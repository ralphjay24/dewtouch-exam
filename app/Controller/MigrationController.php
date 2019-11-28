<?php
	App::import('Vendor', 'excel-reader2');
	App::import('Vendor', 'SpreadsheetReader');

	class MigrationController extends AppController{
		public $uses = ['Member', 'Transaction', 'TransactionItem'];

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
						// member is the parent table of all the transactions
						$this->Member->begin(); // begin transaction

						$sheet = new SpreadsheetReader($filePath . $fileName);
						foreach ($sheet as $row) {
							// member insertion
							$member = $this->Member->insertDataFromCsv($row);

							// transaction insertion
							$transaction = $this->Transaction->insertDataFromCsv($row, $member['id']);

							// transaction item insertion
							$item = $this->TransactionItem->insertDataFromCsv($row, $transaction['id'], $this->Member->class, $member['id']);
						}

						$this->Member->commit();
						$this->setFlash('Migration is successful.');
					} catch (Exception $e) {
						$this->Member->rollback();
						$this->setFlash('Something went wrong.');
						throw new Exception($e->getMessage());
					}
				}
			}
		}

	}