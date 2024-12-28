<?php
require_once '../layout/_top.php';
require_once '../helper/connect.php';

$id = $_GET['id'];
$query = mysqli_query($connect, "SELECT * FROM dokter WHERE id='$id'");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Ubah Data Dokter</h1>
    <a href="./dashboard/index.php" class="btn btn-light">Kembali</a>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- // Form -->
          <form action="./update.php" method="post">
            <?php
            while ($row = mysqli_fetch_array($query)) {
            ?>
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <table cellpadding="8" class="w-100">
                <tr>
                  <td>ID</td>
                  <td><input class="form-control" type="number" name="nidn" size="20" required value="<?= $row['id'] ?>" disabled></td>
                </tr>
                <tr>
                  <td>Nama Dokter</td>
                  <td><input class="form-control" type="text" name="nama" size="20" required value="<?= $row['nama'] ?>"></td>
                </tr>
                
                <tr>
                  <td>Alamat</td>
                  <td colspan="3"><textarea class="form-control" name="alamat" id="alamat" required><?= $row['alamat'] ?></textarea></td>
                </tr>
                <tr>
                  <td>No Hp</td>
                  <td><input class="form-control" type="number" name="no_hp" size="20" required value="<?= $row['no_hp'] ?>" ></td>
                </tr>
                <tr>
                  <td>ID Poli</td>
                  <td><input class="form-control" type="number" name="id_poli" size="20" required value="<?= $row['id_poli'] ?>" ></td>
                </tr>
                <tr>
                  <td>
                    <input class="btn btn-primary d-inline" type="submit" name="proses" value="Ubah">
                    <a href="./index.php" class="btn btn-danger ml-1">Batal</a>
                  <td>
                </tr>
              </table>

            <?php } ?>
          </form>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>