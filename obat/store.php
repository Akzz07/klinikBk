<?php
session_start();
require_once '../helper/connect.php';

$id = $_POST['id'];
$nama_obat = $_POST['nama_obat'];
$kemasan = $_POST['kemasan'];
$harga = $_POST['harga'];

$query = mysqli_query($connect, "insert into obat (id, nama_obat, kemasan, harga) values('$id', '$nama_obat', '$kemasan', '$harga')");
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
