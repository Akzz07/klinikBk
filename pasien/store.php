<?php
session_start();
require_once '../helper/connect.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_ktp = $_POST['no_ktp'];
$no_hp = $_POST['no_hp'];
$query = "SELECT COUNT(*) AS total_patients FROM `pasien`";
$result = $connect->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $n_patients = $row['total_patients'];
} else {
    $n_patients = 0;
}

// Generate no_rm (format: YYYYMMDDXXX)
$date = date("Ymd");
$no_rm = $date . str_pad($n_patients + 1, 2, "0", STR_PAD_LEFT);


$query = mysqli_query($connect, "insert into pasien (id, nama, alamat, no_ktp, no_hp, no_rm) values('$id', '$nama', '$alamat', '$no_ktp', '$no_hp', '$no_rm')");
if ($query) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil menambah data'
  ];
  header('Location: ./index.php');
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($connect)
  ];
  header('Location: ./index.php');
}
