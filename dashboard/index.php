<?php
require_once '../layout/_top.php';
require_once '../helper/connect.php'; 

// Ambil data total dari tabel dokter, pasien, dan poli
$dokter = mysqli_query($connect, "SELECT COUNT(*) AS total FROM dokter");
$pasien = mysqli_query($connect, "SELECT COUNT(*) AS total FROM pasien");
$poli = mysqli_query($connect, "SELECT COUNT(*) AS total FROM poli");
$obat = mysqli_query($connect, "SELECT COUNT(*) AS total FROM obat");

// Ambil nilai dari hasil query
$total_dokter = mysqli_fetch_assoc($dokter)['total'];
$total_pasien = mysqli_fetch_assoc($pasien)['total'];
$total_poli = mysqli_fetch_assoc($poli)['total'];
$total_obat = mysqli_fetch_assoc($obat)['total'];
?>

<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
  <div class="column">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Dokter</h4>
            </div>
            <div class="card-body">
              <?= $total_dokter ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Pasien</h4>
            </div>
            <div class="card-body">
              <?= $total_pasien ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Poli</h4>
            </div>
            <div class="card-body">
              <?= $total_poli ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Obat</h4>
            </div>
            <div class="card-body">
              <?= $total_obat ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>
