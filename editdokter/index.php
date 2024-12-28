<?php
// Mulai sesi dan masukkan file koneksi
require_once '../layout/_doktop.php';
require_once '../helper/connect.php';

// Ambil ID dokter dari sesi login
$id = $_SESSION['id'];

// Query untuk mendapatkan data dokter berdasarkan ID dari sesi
$query = mysqli_query($connect, "SELECT * FROM dokter WHERE id='$id'");

// Jika data tidak ditemukan, redirect dengan pesan error
if (mysqli_num_rows($query) === 0) {
    $_SESSION['info'] = [
        'status' => 'failed',
        'message' => 'Data dokter tidak ditemukan!'
    ];
    header('Location: ./index.php');
    exit;
}
$row = mysqli_fetch_assoc($query); // Ambil data dokter
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Ubah Data Diri</h1>
    <a href="./index.php" class="btn btn-light">Kembali</a>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- Form untuk update data -->
          <form action="./update.php" method="post">
            <!-- Input tersembunyi untuk ID dokter -->
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <table cellpadding="8" class="w-100">
              <tr>
                <td>Nama Dokter</td>
                <td><input class="form-control" type="text" name="nama" required value="<?= htmlspecialchars($row['nama']) ?>"></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td colspan="3"><textarea class="form-control" name="alamat" required><?= htmlspecialchars($row['alamat']) ?></textarea></td>
              </tr>
              <tr>
                <td>No HP</td>
                <td><input class="form-control" type="number" name="no_hp" required value="<?= htmlspecialchars($row['no_hp']) ?>"></td>
              </tr>
              <tr>
                <td>
                  <input class="btn btn-primary d-inline" type="submit" name="proses" value="Ubah">
                  <a href="./index.php" class="btn btn-danger ml-1">Batal</a>
                <td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>
