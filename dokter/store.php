<?php
session_start();
require_once '../helper/connect.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat']; // Kolom 'alamat' berfungsi sebagai password
$no_hp = $_POST['no_hp'];
$id_poli = $_POST['id_poli'];

$query = mysqli_query($connect, "insert into dokter(id, nama, alamat, no_hp, id_poli)
                        VALUES ('$id', '$nama', '$alamat', '$no_hp', '$id_poli')");
if ($query) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil menambah data'
  ];
  header('Location: ../dashboard/index.php');
                                            } else {
                                              $_SESSION['info'] = [
                                                'status' => 'failed',
                                                'message' => mysqli_error($connect)
                                              ];
                                              header('Location: ../dashboard/index.php');
                                            }
