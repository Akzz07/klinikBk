<?php
session_start();
require_once '../helper/connect.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat']; // Kolom 'alamat' berfungsi sebagai password
$no_hp = $_POST['no_hp'];
$id_poli = $_POST['id_poli'];

$query = mysqli_query($connect, "UPDATE dokter SET nama = '$nama', alamat = '$alamat', no_hp = '$no_hp', id_poli = '$id_poli'  WHERE id = '$id'");
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
