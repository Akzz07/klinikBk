<?php
require_once '../helper/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_ktp = $_POST['no_ktp'];
    $no_hp = $_POST['no_hp'];
    $no_rm = $_POST['no_rm'];

    // Query untuk menyimpan data pasien ke dalam database
    $query = "INSERT INTO pasien (nama, alamat, no_ktp, no_hp, no_rm) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("sssss", $nama, $alamat, $no_ktp, $no_hp, $no_rm);

    if ($stmt->execute()) {
        // Jika berhasil, redirect ke halaman index
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Data pasien berhasil disimpan.'
        ];
        header('Location: index.php');
        exit();
    } else {
        // Jika gagal, tampilkan pesan kesalahan
        $_SESSION['info'] = [
            'status' => 'error',
            'message' => 'Data pasien gagal disimpan.'
        ];
    }
} else {
    echo "Invalid request method!";
}
?>
