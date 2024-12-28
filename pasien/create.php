<?php
require_once '../layout/_top.php';
require_once '../helper/connect.php';

$pasien = mysqli_query($connect, "SELECT * FROM pasien");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Pasien</h1>
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
                <td><input class="form-control" type="number" name="id"></td>
              </tr>
              <tr>
                <td>Nama Pasien</td>
                <td><input class="form-control" type="text" name="nama"></td>
              </tr>              
              <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" class="form-control"></textarea></td>
              </tr>
              <tr>
                <td>No KTP</td>
                <td><input class="form-control" type="number" name="no_ktp"></td>
              </tr>
              <tr>
                <td>No Hp</td>
                <td><input class="form-control" type="number" name="no_hp"></td>
              </tr>
              
              <!-- <tr>
                <td>No RM</td>
                <td><input class="form-control" type="char" name="no_rm"></td>
              </tr> -->
              <tr>
                <td>
                  <input class="btn btn-primary" type="submit" name="proses" value="Simpan">
                  <input class="btn btn-danger" type="reset" name="batal" value="Bersihkan">
                </td>
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