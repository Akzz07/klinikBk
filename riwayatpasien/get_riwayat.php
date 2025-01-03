<?php
require_once '../helper/connect.php';

if (!isset($_GET['id'])) {
    exit('ID tidak valid');
}

$id_pasien = filter_var($_GET['id'], FILTER_VALIDATE_INT);
if (!$id_pasien) {
    exit('ID tidak valid');
}

$query = "SELECT 
    periksa.tgl_periksa,
    dokter.nama AS nama_dokter,
    daftar_poli.keluhan,
    periksa.catatan,
    GROUP_CONCAT(obat.nama_obat SEPARATOR ', ') AS obat,
    periksa.biaya_periksa
FROM periksa
JOIN daftar_poli ON periksa.id_daftar_poli = daftar_poli.id
JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id
JOIN dokter ON jadwal_periksa.id_dokter = dokter.id
LEFT JOIN detail_periksa ON periksa.id = detail_periksa.id_periksa
LEFT JOIN obat ON detail_periksa.id_obat = obat.id
WHERE daftar_poli.id_pasien = ?
GROUP BY periksa.id
ORDER BY periksa.tgl_periksa DESC";

$stmt = $connect->prepare($query);
$stmt->bind_param("i", $id_pasien);
$stmt->execute();
$result = $stmt->get_result();

$no = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>$no</td>
        <td>" . htmlspecialchars($row['tgl_periksa']) . "</td>
        <td>" . htmlspecialchars($row['nama_dokter']) . "</td>
        <td>" . htmlspecialchars($row['keluhan']) . "</td>
        <td>" . htmlspecialchars($row['catatan']) . "</td>
        <td>" . htmlspecialchars($row['obat'] ?: '-') . "</td>
        <td>Rp" . number_format($row['biaya_periksa'], 0, ',', '.') . "</td>
    </tr>";
    $no++;
}

if ($result->num_rows === 0) {
    echo "<tr><td colspan='7' class='text-center'>Tidak ada riwayat periksa</td></tr>";
}

$stmt->close();
$connect->close();
?>