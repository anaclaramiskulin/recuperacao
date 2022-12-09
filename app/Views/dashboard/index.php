<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('dashboard') ?>

<?php
$result = $inputAll[0]["value"] - $outputAll[0]["value"];

?>
<?php
if (!empty(session()->getFlashdata('success'))) {
?>
<div class="alert alert-success">
  <?=        session()->getFlashdata('success'); ?>
</div>
<?php
} else if (!empty(session()->getFlashdata('fail'))) {
?>
<div class="alert alert-danger">
  <?=
    session()->getFlashdata('fail'); ?>
</div>
<?php
}
?>
<div class="wrap">
  <h1>Dashboard</h1>
  <div class="row" style="margin-right: 0vw; margin-left: 34vw">
    <div class="col-sm-2">
      <div class="card">
        <div class="card-body">
          <h4>Input:</h4>
          <h5 class="card-title">
            <?= number_format($inputAll[0]["value"], 2, '.', '') ?>
          </h5>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="card">
        <div class="card-body">
          <h4>Output:</h4>
          <h5 class="card-title">
            <?= number_format($outputAll[0]["value"], 2, '.', '') ?>
          </h5>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="card">
        <div class="card-body">
          <h4>Saldo:</h4>
          <h5 class="card-title">
            <?= number_format($result, 2, '.', '') ?>
          </h5>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    var moviments = JSON.parse('<?= json_encode($fullArray); ?>');
    var inputArray = JSON.parse('<?= json_encode($inputArray); ?>');
    var outputArray = JSON.parse('<?= json_encode($outputArray); ?>'); 
  </script>
  <script src="<?php echo base_url() ?>/app/Views/dashboard/script.js"></script>
  <div id="curve_chart" style="width: 97vw; height: 30vw"></div>
</div>
<?= $this->endSection() ?>