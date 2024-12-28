<?php
session_start();
require_once '../helper/connect.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_ktp = is_numeric($_POST['no_ktp']) ? $_POST['no_ktp'] : 0;
$no_hp = is_numeric($_POST['no_hp']) ? $_POST['no_hp'] : 0;

$query = mysqli_query($connect, "UPDATE pasien SET nama = '$nama', alamat = '$alamat', no_ktp = '$no_ktp', no_hp = '$no_hp' WHERE id = '$id'");
if ($query) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil mengubah data'
  ];
  header('Location: ./index.php');
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($connect)
  ];
  header('Location: ./index.php');
}
