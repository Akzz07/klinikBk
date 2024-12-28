<?php
require_once '../layout/_doktop.php';
require_once '../helper/connect.php';

// Ambil data dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data pasien berdasarkan ID
    $query = "SELECT dp.id, dp.no_antrian, p.nama AS nama_pasien, dp.keluhan, dp.status, pr.catatan, pr.biaya_periksa 
              FROM daftar_poli dp
              JOIN pasien p ON dp.id_pasien = p.id
              LEFT JOIN periksa pr ON dp.id = pr.id_daftar_poli
              WHERE dp.id = ?";
              
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "Data tidak ditemukan!";
        exit;
    }

    // Query untuk mendapatkan daftar obat
    $query_obat = "SELECT * FROM obat";
    $result_obat = mysqli_query($connect, $query_obat);

    // Query untuk mendapatkan obat yang sudah dipilih
    $query_selected_obat = "SELECT id_obat FROM detail_periksa WHERE id_periksa = (SELECT id FROM periksa WHERE id_daftar_poli = ?)";
    $stmt_selected_obat = $connect->prepare($query_selected_obat);
    $stmt_selected_obat->bind_param("i", $id);
    $stmt_selected_obat->execute();
    $result_selected_obat = $stmt_selected_obat->get_result();

    $selected_obat = [];
    while ($row = $result_selected_obat->fetch_assoc()) {
        $selected_obat[] = $row['id_obat'];
    }
} else {
    echo "ID tidak valid!";
    exit;
}
?>

<section class="section">
    <div class="section-header">
        <h1>Edit Data Periksa</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="id_daftar_poli" value="<?= $data['id'] ?>">

                        <div class="form-group">
                            <label>No Antrian</label>
                            <input type="text" class="form-control" value="<?= $data['no_antrian'] ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" class="form-control" value="<?= $data['nama_pasien'] ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keluhan</label>
                            <textarea class="form-control" readonly><?= $data['keluhan'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control" required><?= $data['catatan'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Obat</label>
                            <select name="obat[]" id="obat" class="form-control select2" multiple required>
                                <?php while ($obat = mysqli_fetch_array($result_obat)) : ?>
                                    <option value="<?= $obat['id'] ?>" harga="<?= $obat['harga'] ?>" <?= in_array($obat['id'], $selected_obat) ? 'selected' : '' ?>>
                                        <?= $obat['nama_obat'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Biaya Periksa</label>
                            <input type="number" name="biaya_periksa" id="biaya_periksa" class="form-control" value="<?= $data['biaya_periksa'] ?>" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../layout/_bottom.php'; ?>
<script>
$(document).ready(function() {
    $('.select2').select2();

    // Logika untuk menghitung biaya periksa
    $('#obat').on('change', function() {
        let totalHarga = 0;

        // Iterasi setiap obat yang dipilih
        $('#obat option:selected').each(function() {
            const harga = parseFloat($(this).data('harga')) || 0;
            totalHarga += hargaObat;
        });

        // Hitung total biaya periksa
        const biayaPeriksa = 150000 + <?= $obat['harga'] ?>;
        $('#biaya_periksa').val(biayaPeriksa); // Update nilai input biaya periksa
    });
});
</script>
