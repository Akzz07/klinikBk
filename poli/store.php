<?php
session_start();
require_once '../helper/connect.php';

$id = $_POST['id'];
$nama_poli = $_POST['nama_poli'];
$keterangan = $_POST['keterangan'];
$query = mysqli_query($connect, "insert into poli (id, nama_poli, keterangan) values ('$id', '$nama_poli', '$keterangan')");

if ($query) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil menambah data'
  ];
  header('Location: ./index.php');
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($connection)
  ];
  header('Location: ./index.php');
}
