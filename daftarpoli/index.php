<?php
require_once '../layout/_pastop.php';
require_once '../helper/connect.php';

// Pastikan sesi login ada
if (!isset($_SESSION['id'])) {
    die("Error: Anda harus login terlebih dahulu!");
}

$id_pasien = $_SESSION['id'];

// Ambil data pasien
$query_pasien = "SELECT * FROM pasien WHERE id = ?";
$stmt_pasien = $connect->prepare($query_pasien);
$stmt_pasien->bind_param("i", $id_pasien);
$stmt_pasien->execute();
$result_pasien = $stmt_pasien->get_result();
$row_pasien = $result_pasien->fetch_assoc();

if (!$row_pasien) {
    die("Error: Data pasien tidak ditemukan.");
}

// Ambil data poli
$query_poli = "SELECT * FROM poli";
$result_poli = $connect->query($query_poli);

// Ambil semua jadwal
$query_jadwal = "SELECT j.*, d.id_poli 
                 FROM jadwal_periksa j 
                 JOIN dokter d ON j.id_dokter = d.id";
$result_jadwal = $connect->query($query_jadwal);

$jadwal_list = [];
while ($row_jadwal = $result_jadwal->fetch_assoc()) {
    $jadwal_list[] = $row_jadwal;
}
?>

<script>
    var jadwalList = <?php echo json_encode($jadwal_list); ?>;

    function updateJadwal() {
        var poliId = document.getElementById("inputPoli").value;
        var jadwalSelect = document.getElementById("inputJadwal");
        jadwalSelect.innerHTML = '<option value="">Pilih jadwal</option>';
        
        jadwalList.forEach(function(jadwal) {
            if (jadwal.id_poli == poliId) {
                var option = document.createElement("option");
                option.value = jadwal.id;
                option.text = jadwal.hari + ' (' + jadwal.jam_mulai + '-' + jadwal.jam_selesai + ')';
                jadwalSelect.appendChild(option);
            }
        });
    }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Poli</title>
</head>
<body>
<div class="container">
    <h1>Daftar Poli</h1>
    <div class="row">
        <div class="col-md-6">
            <form action="store.php" method="POST">
                <input type="hidden" name="id_pasien" value="<?php echo htmlspecialchars($row_pasien['id']); ?>">
                
                <div class="form-group">
                    <label>Nomor Rekam Medis</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($row_pasien['no_rm']); ?>" disabled>
                </div>
                
                <div class="form-group">
                    <label>Pilih Poli</label>
                    <select id="inputPoli" class="form-control" name="id_poli" onchange="updateJadwal()" required>
                        <option value="">Pilih poli</option>
                        <?php while ($row_poli = $result_poli->fetch_assoc()): ?>
                            <option value="<?php echo $row_poli['id']; ?>"><?php echo htmlspecialchars($row_poli['nama_poli']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Pilih Jadwal</label>
                    <select id="inputJadwal" class="form-control" name="id_jadwal" required>
                        <option value="">Pilih jadwal</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Keluhan</label>
                    <textarea class="form-control" name="keluhan" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Daftar</button>
            </form>
        </div>
        
        <!-- Tambahkan link ke halaman riwayat -->
        <div class="col-md-6">
            <h3>Riwayat Pendaftaran</h3>
            <a href="riwayat.php" class="btn btn-secondary">Lihat Riwayat Pendaftaran</a>
        </div>
    </div>
</div>
</body>
</html>
