<?php
require_once '../layout/_top.php';
require_once '../helper/connect.php';

$id = $_GET['id'];
$query = mysqli_query($connect, "SELECT * FROM obat WHERE id='$id'");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Ubah Data Obat</h1>
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
                  <td>Nama Obat</td>
                  <td><input class="form-control" type="text" name="nama_obat" required value="<?= $row['nama_obat'] ?>"></td>
                </tr>                
                <tr>
                  <td>Kemasan</td>
                  <td colspan="3"><textarea class="form-control" name="kemasan" id="kemasan" required><?= $row['kemasan'] ?></textarea></td>
                </tr>
                <tr>
                  <td>Harga</td>
                  <td><input class="form-control" name="harga" id="harga" required value="<?= $row['harga'] ?>" ></td>          
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