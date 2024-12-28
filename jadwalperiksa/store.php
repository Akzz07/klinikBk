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

// Query untuk insert data jadwal periksa
$query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) 
          VALUES ('$id_dokter', '$hari', '$jam_mulai', '$jam_selesai')";

if (mysqli_query($connect, $query)) {
  // Jika berhasil, set sesi info dan arahkan ke dashboard
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil menambah data'
  ];
  header('Location: ../dashboard/dokter.php');
} else {
  // Jika gagal, set sesi info dengan pesan error dan arahkan ke halaman sebelumnya
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => 'Error: ' . mysqli_error($connect)
  ];
  header('Location: ../dashboard/dokter.php');
}
