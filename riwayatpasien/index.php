<?php
require_once '../layout/_doktop.php';
require_once '../helper/connect.php';

// Query untuk mengambil data pasien beserta informasi riwayat medisnya
$query = "SELECT p.id, p.nama, p.alamat, p.no_ktp, p.no_hp, p.no_rm
          FROM pasien p";

$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Riwayat Pasien</title>
    <!-- Include CSS framework (Bootstrap or your choice) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Daftar Riwayat Pasien</h2>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th>No. KTP</th>
                        <th>No. Telepon</th>
                        <th>No. RM</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['alamat']; ?></td>
                            <td><?= $data['no_ktp']; ?></td>
                            <td><?= $data['no_hp']; ?></td>
                            <td><?= $data['no_rm']; ?></td>
                            <td>
                            <a href="#" class="btn btn-info btn-sm view-detail" data-id="<?= $data['id']; ?>" data-toggle="modal" data-target="#detailModal">
                                <i class="fas fa-eye"></i> Detail Riwayat Periksa
                            </a>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require_once '../layout/_bottom.php'; ?>

    <!-- Include JS framework (Bootstrap or your choice) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Riwayat Periksa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Periksa</th>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Keluhan</th>
                            <th>Catatan</th>
                            <th>Obat</th>
                            <th>Biaya Periksa</th>
                        </tr>
                    </thead>
                    <tbody id="detail-data">
                        <!-- Data akan dimuat menggunakan AJAX -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<script>
$(document).on('click', '.view-detail', function() {
    const id = $(this).data('id');
    
    // Bersihkan isi modal sebelum request
    $('#detail-data').html('');

    // AJAX Request untuk mengambil detail data
    $.ajax({
        url: 'detail.php',
        method: 'GET',
        data: { id: id },
        success: function(response) {
            // Masukkan data ke dalam modal
            $('#detail-data').html(response);
        },
        error: function() {
            alert('Gagal memuat data. Silakan coba lagi.');
        }
    });
});
</script>


<script src="../assets/js/page/modules-datatables.js"></script>