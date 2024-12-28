<?php
require_once '../layout/_top.php';
require_once '../helper/connect.php';

$queryPoli = "SELECT id, nama_poli FROM poli";
$resultPoli = $connect->query($queryPoli);
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Dokter</h1>
    <a href="./index.php" class="btn btn-light">Kembali</a>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- // Form -->
          <form action="./store.php" method="POST">
            <table cellpadding="8" class="w-100">

              <tr>
                <td>ID</td>
                <td><input class="form-control" type="number" name="id" size="20" required></td>
              </tr>

              <tr>
                <td>Nama Dokter</td>
                <td><input class="form-control" type="text" name="nama" size="20" required></td>
              </tr>

              <tr>
                <td>Alamat</td>
                <td colspan="3"><textarea class="form-control" name="alamat" id="alamat" required></textarea></td>
              </tr>

              <tr>
                <td>No Hp</td>
                <td colspan="3"><input class="form-control" type="number" name="no_hp" id="no_hp" required></textarea></td>
              </tr>
              
              <tr>
                <td>Poli</td>
                <td colspan="3">
                  <select class="form-control" name="id_poli" id="id_poli" required>
                    <option value="">Pilih Poli</option>
                    <?php while ($row = $resultPoli->fetch_assoc()) { ?>
                      <option value="<?= $row['id'] ?>"><?= $row['nama_poli'] ?></option>
                    <?php } ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td>
                  <input class="btn btn-primary" type="submit" name="proses" value="Simpan">
                  <input class="btn btn-danger" type="reset" name="batal" value="Bersihkan"></td>
              </tr>

            </table>
          </form>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>