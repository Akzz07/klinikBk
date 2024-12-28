<?php
require_once '../helper/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_daftar_poli = $_POST['id_daftar_poli'];
    $catatan = $_POST['catatan'];
    $biaya_periksa = $_POST['biaya_periksa'];
    $obat = $_POST['obat'];

    // Start a transaction
    $connect->begin_transaction();

    try {
        // Update catatan dan biaya_periksa di tabel 'periksa'
        $query_update_periksa = "UPDATE periksa SET catatan = ?, biaya_periksa = ? WHERE id_daftar_poli = ?";
        $stmt_update_periksa = $connect->prepare($query_update_periksa);
        $stmt_update_periksa->bind_param("sii", $catatan, $biaya_periksa, $id_daftar_poli);
        $stmt_update_periksa->execute();

        // Ambil ID pemeriksaan dari tabel 'periksa'
        $query_get_periksa = "SELECT id FROM periksa WHERE id_daftar_poli = ?";
        $stmt_get_periksa = $connect->prepare($query_get_periksa);
        $stmt_get_periksa->bind_param("i", $id_daftar_poli);
        $stmt_get_periksa->execute();
        $result_periksa = $stmt_get_periksa->get_result();
        $data_periksa = $result_periksa->fetch_assoc();

        if (!$data_periksa) {
            throw new Exception("Data pemeriksaan tidak ditemukan.");
        }

        $id_periksa = $data_periksa['id'];

        // Hapus data obat lama dari tabel 'detail_periksa'
        $query_delete_obat = "DELETE FROM detail_periksa WHERE id_periksa = ?";
        $stmt_delete_obat = $connect->prepare($query_delete_obat);
        $stmt_delete_obat->bind_param("i", $id_periksa);
        $stmt_delete_obat->execute();

        // Masukkan data obat baru ke tabel 'detail_periksa'
        $query_insert_obat = "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES (?, ?)";
        $stmt_insert_obat = $connect->prepare($query_insert_obat);

        foreach ($obat as $id_obat) {
            $stmt_insert_obat->bind_param("ii", $id_periksa, $id_obat);
            $stmt_insert_obat->execute();
        }

        // Commit the transaction
        $connect->commit();

        // Redirect ke halaman index dengan pesan sukses
        session_start();
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Data berhasil diperbarui.'
        ];
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction jika ada kesalahan
        $connect->rollback();

        // Handle error
        session_start();
        $_SESSION['info'] = [
            'status' => 'error',
            'message' => "Terjadi kesalahan: " . $e->getMessage()
        ];
        header("Location: index.php");
        exit();
    }
} else {
    echo "Invalid request method!";
}
?>
