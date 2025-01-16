<?php
session_start();
require_once '../helper/connect.php';

$id = $_GET['id'];

$result = mysqli_query($connect, "DELETE FROM dokter WHERE id='$id'");

if (mysqli_affected_rows($connect) > 0) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil menghapus data'
  ];
  header('Location: ./index.php');
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($connect)
  ];
  header('Location: ./dashboard/index.php');
}
