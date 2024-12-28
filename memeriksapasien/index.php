<?php
require_once '../layout/_doktop.php';
require_once '../helper/connect.php';

// Query untuk mengambil data pasien dan statusnya
$query = "SELECT dp.id, dp.no_antrian, p.nama AS nama_pasien, dp.keluhan, dp.status 
          FROM daftar_poli dp
          JOIN pasien p ON dp.id_pasien = p.id";

$result = mysqli_query($connect, $query);
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Jadwal Dokter</h1>
    <a href="./create.php" class="btn btn-primary">Tambah Data</a>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-striped w-100" id="table-1">
            <thead>
              <tr>
                <th>No Antrian</th>
                <th>Nama Pasien</th>
                <th>Keluhan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($data = mysqli_fetch_array($result)) : ?>
                <tr>
                  <td><?= $data['no_antrian'] ?></td>
                  <td><?= $data['nama_pasien'] ?></td>
                  <td><?= $data['keluhan'] ?></td>
                  <td>
                    <span class="badge <?= $data['status'] === 'selesai' ? 'badge-success' : 'badge-warning' ?>">
                      <?= ucfirst($data['status']) ?>
                    </span>
                  </td>
                  <td>
                    <?php if ($data['status'] === 'belum') : ?>
                      <a class="btn btn-sm btn-info" href="periksa.php?id=<?= $data['id'] ?>">
                        <i class="fas fa-stethoscope fa-fw"></i> Periksa
                      </a>
                    <?php else : ?>
                      <a class="btn btn-sm btn-warning" href="edit.php?id=<?= $data['id'] ?>">
                        <i class="fas fa-edit fa-fw"></i> Edit
                      </a>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>
<!-- Page Specific JS File -->
<?php
if (isset($_SESSION['info'])) :
  if ($_SESSION['info']['status'] == 'success') {
?>
    <script>
      iziToast.success({
        title: 'Sukses',
        message: `<?= $_SESSION['info']['message'] ?>`,
        position: 'topCenter',
        timeout: 5000
      });
    </script>
  <?php
  } else {
  ?>
    <script>
      iziToast.error({
        title: 'Gagal',
        message: `<?= $_SESSION['info']['message'] ?>`,
        timeout: 5000,
        position: 'topCenter'
      });
    </script>
<?php
  }

  unset($_SESSION['info']);
  $_SESSION['info'] = null;
endif;
?>
<script src="../assets/js/page/modules-datatables.js"></script>
