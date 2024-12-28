<?php
session_start();
require_once '../helper/connect.php';

$id = $_POST['id'];
$nama_poli = $_POST['nama_poli'];
$keterangan = $_POST['keterangan'];

$query = mysqli_query($connect, "UPDATE poli SET nama_poli = '$nama_poli', keterangan = '$keterangan' WHERE id = '$id'");
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
