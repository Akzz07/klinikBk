<?php
require_once '../layout/_doktop.php';
require_once '../helper/connect.php';

$query = "SELECT p.id, p.nama, p.alamat, p.no_ktp, p.no_hp, p.no_rm FROM pasien p";
$result = mysqli_query($connect, $query);
?>

<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-hover table-striped" id="table-1">
            <thead>
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
                    echo "<tr>
                        <td>$no</td>
                        <td>" . htmlspecialchars($data['nama']) . "</td>
                        <td>" . htmlspecialchars($data['alamat']) . "</td>
                        <td>" . htmlspecialchars($data['no_ktp']) . "</td>
                        <td>" . htmlspecialchars($data['no_hp']) . "</td>
                        <td>" . htmlspecialchars($data['no_rm']) . "</td>
                        <td>
                            <button class='btn btn-info btn-sm view-detail' data-id='" . $data['id'] . "'>
                                Detail Riwayat
                            </button>
                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Riwayat Periksa</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Dokter</th>
                                <th>Keluhan</th>
                                <th>Catatan</th>
                                <th>Obat</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody id="detail-data"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../layout/_bottom.php'; ?>

<script>
$(document).ready(function() {
    $('.view-detail').click(function() {
        const id = $(this).data('id');
        $('#detail-data').empty();
        $('#detailModal').modal('show');
        
        $.ajax({
            url: 'get_riwayat.php',
            method: 'GET',
            data: { id: id },
            success: function(response) {
                $('#detail-data').html(response);
            },
            error: function() {
                $('#detail-data').html('<tr><td colspan="7" class="text-center">Gagal memuat data</td></tr>');
            }
        });
    });
});
</script>