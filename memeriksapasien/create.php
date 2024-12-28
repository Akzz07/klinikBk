<?php
require_once '../layout/_doktop.php';
require_once '../helper/connect.php';

$periksa = mysqli_query($connect, "SELECT * FROM periksa");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Periksa Pasien</h1>
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
                <td>Nama Pasien</td>
                <td><input class="form-control" type="text" name="nama"></td>
              </tr>              
              
              <tr>
                <td>Tanggal Periksa</td>
                <td><input class="form-control" type="datetime-local" name="tgl_periksa"></td>
              </tr>
              <tr>
                <td>Catatan</td>
                <td><input class="form-control" type="text" name="catatan"></td>
              </tr>
              <tr>
                <td>Obat</td>
                <td colspan="3">
                  <select class="form-control" name="id_obat" id="id_obat" required>
                    <option value="">Pilih obat</option>
                    <?php while ($row = $resultObat->fetch_assoc()) { ?>
                      <option value="<?= $row['id'] ?>"><?= $row['nama_obat'] ?></option>
                    <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Harga</td>
                <td><input class="form-control" type="number" name="harga"></td>
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