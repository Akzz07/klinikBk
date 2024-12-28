<?php
require_once '../helper/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_daftar_poli = $_POST['id_daftar_poli'];
    $catatan = $_POST['catatan'];
    $biaya_periksa = $_POST['biaya_periksa'];
    $obat = $_POST['obat'];

    // Ambil tanggal hari ini (format: YYYY-MM-DD)
    $tgl_periksa = date('Y-m-d');

    // Start a transaction
    $connect->begin_transaction();

    try {
        // Insert data into 'periksa' table, including 'tgl_periksa'
        $query_periksa = "INSERT INTO periksa (id_daftar_poli, catatan, biaya_periksa, tgl_periksa) VALUES (?, ?, ?, ?)";
        $stmt = $connect->prepare($query_periksa);
        $stmt->bind_param("isis", $id_daftar_poli, $catatan, $biaya_periksa, $tgl_periksa);
        $stmt->execute();

        // Get the inserted pemeriksaan ID
        $id_pemeriksaan = $stmt->insert_id;

        // Insert obat for the pemeriksaan
        $query_obat = "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES (?, ?)";
        $stmt_obat = $connect->prepare($query_obat);

        foreach ($obat as $id_obat) {
            $stmt_obat->bind_param("ii", $id_pemeriksaan, $id_obat);
            $stmt_obat->execute();
        }

        // Update status in 'daftar_poli' table to 'selesai'
        $query_update_status = "UPDATE daftar_poli SET status = 'selesai' WHERE id = ?";
        $stmt_status = $connect->prepare($query_update_status);
        $stmt_status->bind_param("i", $id_daftar_poli);
        $stmt_status->execute();

        // Commit the transaction
        $connect->commit();

        // Redirect or display success message
        header("Location: ../dashboard/dokter.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if something goes wrong
        $connect->rollback();

        // Handle the error
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
} else {
    echo "Invalid request method!";
}
