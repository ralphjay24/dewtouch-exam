<div class="row-fluid">
<?php
  echo $this->Form->create(false, ['type' => 'file', 'url' => ['controller' => 'Migration', 'action' => 'upload']]);
  echo $this->Form->input('spreadsheet', ['label' => 'Upload a spreadsheet(XLSX, CSV, ODT, etc..)', 'type' => 'file', 'style' => 'display: flex;']);

  echo $this->Form->submit('Upload Spreadsheet', ['class' => 'btn green']);
  echo $this->Form->end();
?>
</div>