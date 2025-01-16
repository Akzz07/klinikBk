<?php
require_once '../layout/_top.php';
require_once '../helper/connect.php';

// Ambil data riwayat pendaftaran
$query = "SELECT 
            dp.id, 
            poli.nama AS nama_poli, 
            dokter.nama AS nama_dokter, 
            jadwal.hari, 
            jadwal.jam_mulai, 
            jadwal.jam_selesai, 
            dp.no_antrian AS antrian, 
            dp.status, 
            dp.keluhan
          FROM daftar_poli dp
          JOIN jadwal ON dp.id_jadwal = jadwal.id
          JOIN poli ON jadwal.poli_id = poli.id
          JOIN dokter ON jadwal.dokter_id = dokter.id";
$result = mysqli_query($connect);
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Daftar Poli</h1>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4>Daftar Poli</h4>
        </div>
        <div class="card-body">
          <form action="./store.php" method="POST">
            <div class="form-group">
              <label>Nomor Rekam Medis</label>
              <input type="text" name="no_rm" class="form-control" value="202412-040" readonly>
            </div>
            <div class="form-group">
              <label>Pilih Poli</label>
              <select name="id_poli" class="form-control" required>
                <option value="">Open this select menu</option>
                <?php
                $poli = mysqli_query($connect, "SELECT * FROM poli");
                while ($row = mysqli_fetch_assoc($poli)) {
                  echo "<option value='{$row['id']}'>{$row['nama']}</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Pilih Jadwal</label>
              <select name="id_jadwal" class="form-control" required>
                <option value="">Open this select menu</option>
                <?php
                $jadwal = mysqli_query($connect, "SELECT jadwal.id, jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai, poli.nama AS nama_poli, dokter.nama AS nama_dokter
                                                  FROM jadwal
                                                  JOIN poli ON jadwal.poli_id = poli.id
                                                  JOIN dokter ON jadwal.dokter_id = dokter.id");
                while ($row = mysqli_fetch_assoc($jadwal)) {
                  echo "<option value='{$row['id']}'>Poli: {$row['nama_poli']} | Dokter: {$row['nama_dokter']} | Hari: {$row['hari']} | Jam: {$row['jam_mulai']} - {$row['jam_selesai']}</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Keluhan</label>
              <textarea name="keluhan" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4>Riwayat daftar poli</h4>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Poli</th>
                <th>Dokter</th>
                <th>Hari</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Antrian</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama_poli']}</td>
                        <td>{$row['nama_dokter']}</td>
                        <td>{$row['hari']}</td>
                        <td>{$row['jam_mulai']}</td>
                        <td>{$row['jam_selesai']}</td>
                        <td>{$row['antrian']}</td>
                        <td><span class='badge badge-".($row['status'] === 'Belum diperiksa' ? 'danger' : 'success')."'>{$row['status']}</span></td>
                        <td><a href='./detail.php?id={$row['id']}' class='btn btn-info'>Detail</a></td>
                      </tr>";
                $no++;
              }
              ?>
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
