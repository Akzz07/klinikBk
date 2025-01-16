<?php
require_once '../layout/_doktop.php';
require_once '../helper/connect.php';

$jadwal_periksa = mysqli_query($connect, "SELECT * FROM jadwal_periksa");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Jadwal</h1>
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
                <td>Hari</td>
                <td colspan="3">
                  <select class="form-control" type="text" name="hari" id="hari" required>
                    <option value="">Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                  </select>
                </td>
              </tr>

              <tr>
                <td>Jam Mulai</td>
                <td><input class="form-control" type="time" name="jam_mulai" id="jam_mulai" required></td>
            </tr>
            <tr>
                <td>Jam Selesai</td>
                <td><input class="form-control" type="time" name="jam_selesai" id="jam_selesai" required></td>
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