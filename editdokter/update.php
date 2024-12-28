<?php
// Mulai sesi dan masukkan koneksi
session_start();
require_once '../helper/connect.php';

// Ambil data dari form
$id = $_POST['id']; // ID dokter
$nama = mysqli_real_escape_string($connect, $_POST['nama']);
$alamat = mysqli_real_escape_string($connect, $_POST['alamat']);
$no_hp = mysqli_real_escape_string($connect, $_POST['no_hp']);

// Update data dokter di database
$query = "UPDATE dokter SET nama='$nama', alamat='$alamat', no_hp='$no_hp' WHERE id='$id'";
$result = mysqli_query($connect, $query);

if ($result) {
    // Jika berhasil, perbarui sesi dan redirect dengan pesan sukses
    $_SESSION['login']['nama'] = $nama; // Update nama di sesi
    $_SESSION['info'] = [
        'status' => 'success',
        'message' => 'Data berhasil diupdate'
    ];
    header('Location: ./index.php');
} else {
    // Jika gagal, redirect dengan pesan error
    $_SESSION['info'] = [
        'status' => 'failed',
        'message' => 'Gagal mengupdate data: ' . mysqli_error($connect)
    ];
    header('Location: ./edit.php');
}
exit;
?>
