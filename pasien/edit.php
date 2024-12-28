<?php
require_once '../layout/_top.php';
require_once '../helper/connect.php';

$id = $_GET['id'];
$query = mysqli_query($connect, "SELECT * FROM pasien WHERE id='$id'");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Ubah Data Pasien</h1>
    <a href="./index.php" class="btn btn-light">Kembali</a>
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
                  <td><input class="form-control" required value="<?= $row['id'] ?>" disabled></td>
                </tr>
                <tr>
                  <td>Nama Pasien</td>
                  <td><input class="form-control" type="text" name="nama" required value="<?= $row['nama'] ?>"></td>
                </tr>                
                <tr>
                  <td>Alamat</td>
                  <td colspan="3"><textarea class="form-control" name="alamat" id="alamat" required><?= $row['alamat'] ?></textarea></td>
                </tr>
                <tr>
                  <td>NO KTP</td>
                  <td><input class="form-control" name="no_ktp" required value="<?= $row['no_ktp'] ?>" ></td>
                </tr><tr>
                  <td>NO HP</td>
                  <td><input class="form-control" name="no_hp" required value="<?= $row['no_hp'] ?>" ></td>
                </tr><tr>
                  <td>NO RM</td>
                  <td><input class="form-control" name="no_rm" required value="<?= $row['no_rm'] ?>" disabled></td>
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