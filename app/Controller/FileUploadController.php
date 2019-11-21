<?php

class FileUploadController extends AppController {
	public function index() {
		$this->set('title', __('File Upload Answer'));

		$file_uploads = $this->FileUpload->find('all');
		$this->set(compact('file_uploads'));
	}

	public function importCsv() {
		if ($this->request->is('post')) {
			$file = $this->request->data['file'];

			if (empty($file['name'])) {
				$this->set('errorMsg', 'File is required.');
			} else if ($file['type'] != 'text/csv') {
				$this->set('errorMsg', 'Only .csv file extension is allowed.');
			} else {
				$this->FileUpload->insertCsvData($file);
			}
		}
		$this->redirect('index');
	}
}