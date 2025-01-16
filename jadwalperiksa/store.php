<?php
session_start();
require_once '../helper/connect.php';

// Pastikan sesi login memiliki data dokter
if (!isset($_SESSION['id'])) {
  die("Error: Anda harus login terlebih dahulu!");
}

// Ambil id_dokter dari sesi login
$id_dokter = $_SESSION['id'];

// Ambil data dari form POST
$hari = mysqli_real_escape_string($connect, $_POST['hari']);
$jam_mulai = mysqli_real_escape_string($connect, $_POST['jam_mulai']);
$jam_selesai = mysqli_real_escape_string($connect, $_POST['jam_selesai']);

// Cek apakah jadwal untuk hari tersebut sudah ada
$cek_query = "SELECT * FROM jadwal_periksa WHERE id_dokter = '$id_dokter' AND hari = '$hari'";
$cek_result = mysqli_query($connect, $cek_query);

if (mysqli_num_rows($cek_result) > 0) {
  // Jika sudah ada, tampilkan pesan error
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => 'Gagal menambah data: Jadwal untuk hari ini sudah ada'
  ];
  header('Location: ../jadwalperiksa/index.php'); // Arahkan ke halaman tambah jadwal
  exit;
}

// Jika tidak ada duplikasi, masukkan data ke database
$query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) 
          VALUES ('$id_dokter', '$hari', '$jam_mulai', '$jam_selesai')";

if (mysqli_query($connect, $query)) {
  // Jika berhasil, set sesi info dan arahkan ke dashboard
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil menambah data'
  ];
  header('Location: ../jadwalperiksa/index.php');
} else {
  // Jika gagal, set sesi info dengan pesan error dan arahkan ke halaman sebelumnya
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => 'Error: ' . mysqli_error($connect)
  ];
  header('Location: ../jadwalperiksa/index.php');
}
exit;
?>
