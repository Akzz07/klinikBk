<?php
require_once '../layout/_top.php';
require_once '../helper/connect.php';
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Poli</h1>
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
                <td>ID Poli</td>
                <td><input class="form-control" type="number" name="id"></td>
              </tr>
              <tr>
                <td>Nama Poli</td>
                <td><input class="form-control" type="text" name="nama_poli"></td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td><input class="form-control" type="text"  name="keterangan"></td>
              </tr>
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