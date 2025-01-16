<?php
require_once '../helper/connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pasien = $_POST['id_pasien'];
    $id_jadwal = $_POST['id_jadwal'];
    $keluhan = $_POST['keluhan'];

    $query_antrian = "SELECT MAX(no_antrian) AS max_antrian FROM daftar_poli WHERE id_jadwal = ?";
    $stmt_antrian = $connect->prepare($query_antrian);
    $stmt_antrian->bind_param("i", $id_jadwal);
    $stmt_antrian->execute();
    $result_antrian = $stmt_antrian->get_result();
    $row_antrian = $result_antrian->fetch_assoc();
    $no_antrian = $row_antrian['max_antrian'] ? $row_antrian['max_antrian'] + 1 : 1;

    $query_insert = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian) VALUES (?, ?, ?, ?)";
    $stmt_insert = $connect->prepare($query_insert);
    $stmt_insert->bind_param("iisi", $id_pasien, $id_jadwal, $keluhan, $no_antrian);

    if ($stmt_insert->execute()) {
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Pendaftaran berhasil.'];
    } else {
        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Pendaftaran gagal: ' . $stmt_insert->error];
    }
    header('Location: ../dashboard/pasien.php');
    exit;
}
?>
