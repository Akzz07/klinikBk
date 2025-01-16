<?php
require_once '../layout/_pastop.php';
require_once '../helper/connect.php';

// Pastikan ada ID daftar yang dikirim via GET
if (!isset($_GET['id_daftar'])) {
    die("Error: ID tidak ditemukan.");
}

$id_daftar = $_GET['id_daftar'];

// Ambil detail pendaftaran
$query_detail = "SELECT dp.*, p.nama_poli, d.nama AS dokter_nama, j.hari, j.jam_mulai, j.jam_selesai, dp.keluhan, dp.status, dp.no_antrian
                 FROM daftar_poli dp 
                 JOIN jadwal_periksa j ON dp.id_jadwal = j.id 
                 JOIN dokter d ON j.id_dokter = d.id 
                 JOIN poli p ON d.id_poli = p.id 
                 WHERE dp.id = ?";
$stmt_detail = $connect->prepare($query_detail);
$stmt_detail->bind_param("i", $id_daftar);
$stmt_detail->execute();
$result_detail = $stmt_detail->get_result();

if ($result_detail->num_rows === 0) {
    die("Detail tidak ditemukan.");
}

$detail = $result_detail->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detail Riwayat Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-primary text-white text-center">
            <h4>Detail Riwayat Pendaftaran</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Nama Poli</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext"><?php echo htmlspecialchars($detail['nama_poli']); ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Nama Dokter</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext"><?php echo htmlspecialchars($detail['dokter_nama']); ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Hari</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext"><?php echo htmlspecialchars($detail['hari']); ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Mulai</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext"><?php echo htmlspecialchars($detail['jam_mulai']); ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Selesai</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext"><?php echo htmlspecialchars($detail['jam_selesai']); ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Nomor Antrian</label>
                <div class="col-sm-8">
                    <span class="badge bg-success"><?php echo htmlspecialchars($detail['no_antrian']); ?></span>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Keluhan</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext"><?php echo htmlspecialchars($detail['keluhan']); ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Status</label>
                <div class="col-sm-8">
                    <?php if ($detail['status'] === 'belum'): ?>
                        <span class="badge bg-danger">Belum</span>
                    <?php else: ?>
                        <span class="badge bg-success">Selesai</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
</body>
</html>
