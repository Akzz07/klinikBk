<?php
include './helper/connect.php';
session_start(); // Memulai sesi untuk login

if (isset($_POST['signUp'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat']; // Kolom 'alamat' berfungsi sebagai password
    $no_ktp = $_POST['no_ktp'];
    $no_hp = $_POST['no_hp'];
    $query = "SELECT COUNT(*) AS total_patients FROM `pasien`";
$result = $connect->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $n_patients = $row['total_patients'];
 }
    $date = date("Ymd");
    $no_rm = $date . str_pad($n_patients + 1, 3, "0", STR_PAD_LEFT);

    // Periksa apakah ID sudah ada di database
    $checkIdQuery = "SELECT * FROM pasien WHERE id='$id'";
    $result = $connect->query($checkIdQuery);
    if ($result->num_rows > 0) {
        echo "Pasien sudah terdaftar!";
    } else {
        // Masukkan data pasien baru ke database
        $insertQuery = "INSERT INTO pasien(id, nama, alamat, no_ktp, no_hp, no_rm)
                        VALUES ('$id', '$nama', '$alamat', '$no_ktp', '$no_hp','$no_rm' )";
        if ($connect->query($insertQuery) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $connect->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    $id = $_POST['id'];
    $alamat = $_POST['password']; // Password menggunakan kolom 'alamat'

    // Hardcoded admin login credentials
    $adminUsername = 'admin';
    $adminPassword = 'admin';

    if ($id === $adminUsername && $alamat === $adminPassword) {
        // Jika login sebagai admin
        $_SESSION['username'] = $adminUsername; // Simpan informasi admin
        $_SESSION['role'] = 'admin'; // Tandai sebagai admin
        $_SESSION['login'] = TRUE;
        header("Location: dashboard/index.php"); // Arahkan ke dashboard admin
        exit();
    } else {
        // Login untuk user biasa
        // INCORRECT EXAMPLE. COMPARE nama AND alamat in PHP instead of in mysql
        // $sql = "SELECT * FROM dokter WHERE id='$id' AND alamat='$alamat'";
        // echo $sql;
        // die();
        // $result = $conn->query($sql);
        // if ($result->num_rows > 0) {
        //     $row = $result->fetch_assoc();
        //     $_SESSION['id'] = $row['id']; // Simpan ID user di sesi
        //     $_SESSION['role'] = 'user'; // Tandai sebagai user biasa
        //     header("Location: homepage.php"); // Arahkan ke homepage user
        //     exit();
        // } else {
        //     echo "ID atau Password salah!";
        // }

        // CORRECT EXAMPLE
        $sql = "SELECT * FROM pasien WHERE id='$id'";
        echo $sql;
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($alamat === $row['alamat']) {
                $_SESSION['id'] = $row['id']; // Simpan ID user di sesi
                $_SESSION['role'] = 'user'; // Tandai sebagai user biasa
                header("Location: dashboard/pasien.php"); // Arahkan ke homepage user
                exit();
            } else {
                echo "Password salah!";
            }
        } else {
            echo "ID tidak ditemukan!";
        }
    }
}
?>
