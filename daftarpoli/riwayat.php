<?php
require_once '../layout/_pastop.php';
require_once '../helper/connect.php';

// Pastikan sesi login ada
if (!isset($_SESSION['id'])) {
    die("Error: Anda harus login terlebih dahulu!");
}

$id_pasien = $_SESSION['id'];

// Ambil riwayat pendaftaran pasien
$query_riwayat = "SELECT dp.*, p.nama_poli, d.nama AS dokter_nama, j.hari, j.jam_mulai, j.jam_selesai 
                  FROM daftar_poli dp 
                  JOIN jadwal_periksa j ON dp.id_jadwal = j.id 
                  JOIN dokter d ON j.id_dokter = d.id 
                  JOIN poli p ON d.id_poli = p.id 
                  WHERE dp.id_pasien = ?";
$stmt_riwayat = $connect->prepare($query_riwayat);
$stmt_riwayat->bind_param("i", $id_pasien);
$stmt_riwayat->execute();
$result_riwayat = $stmt_riwayat->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Riwayat Pendaftaran</title>
</head>
<body>
<div class="container">
    <h1>Riwayat Pendaftaran</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Poli</th>
                <th>Dokter</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Antrian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result_riwayat->num_rows > 0): ?>
                <?php $no = 1; while ($row = $result_riwayat->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_poli']); ?></td>
                        <td><?php echo htmlspecialchars($row['dokter_nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['hari']); ?></td>
                        <td><?php echo htmlspecialchars($row['jam_mulai'] . ' - ' . $row['jam_selesai']); ?></td>
                        <td><?php echo htmlspecialchars($row['no_antrian']); ?></td>
                        <td>
                            <?php echo $row['status'] === 'belum' 
                                ? '<span class="badge bg-danger">Belum</span>' 
                                : '<span class="badge bg-success">Selesai</span>'; ?>
                        </td>
                        <td>
                            <?php if ($row['status'] === 'belum'): ?>
                                <!-- Tombol Detail jika status belum selesai -->
                                <a href="detail.php?id_daftar=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Detail</a>
                            <?php else: ?>
                                <!-- Tombol Riwayat jika status selesai -->
                                <a href="riwayat_detail.php?id_daftar=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Riwayat</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Tidak ada riwayat</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
