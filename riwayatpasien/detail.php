<?php
require_once '../helper/connect.php';

// Pastikan parameter ID diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan detail riwayat periksa
    $query = "SELECT pr.tanggal_periksa, p.nama AS nama_pasien, d.nama AS nama_dokter, dp.keluhan, pr.catatan, 
                     GROUP_CONCAT(o.nama_obat SEPARATOR ', ') AS obat, pr.biaya_periksa
              FROM periksa pr
              JOIN daftar_poli dp ON pr.id_daftar_poli = dp.id
              JOIN pasien p ON dp.id_pasien = p.id
              JOIN dokter d ON dp.id_dokter = d.id
              LEFT JOIN detail_periksa dp_obat ON pr.id = dp_obat.id_periksa
              LEFT JOIN obat o ON dp_obat.id_obat = o.id
              WHERE pr.id_daftar_poli = ?
              GROUP BY pr.id";

    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['tanggal_periksa']}</td>
                    <td>{$row['nama_pasien']}</td>
                    <td>{$row['nama_dokter']}</td>
                    <td>{$row['keluhan']}</td>
                    <td>{$row['catatan']}</td>
                    <td>{$row['obat']}</td>
                    <td>Rp" . number_format($row['biaya_periksa'], 0, ',', '.') . "</td>
                  </tr>";
            $no++;
        }
    } else {
        echo "<tr><td colspan='8'>Tidak ada data ditemukan</td></tr>";
    }
} else {
    echo "ID tidak valid!";
}
?>
