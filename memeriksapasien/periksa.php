<?php
require_once '../layout/_doktop.php';
require_once '../helper/connect.php';

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $query = "SELECT dp.*, p.nama AS nama_pasien 
             FROM daftar_poli dp
             JOIN pasien p ON dp.id_pasien = p.id 
             WHERE dp.id = ?";
             
   $stmt = $connect->prepare($query);
   $stmt->bind_param("i", $id);
   $stmt->execute();
   $result = $stmt->get_result();
   $data = $result->fetch_assoc();
}
?>

<head>
    <!-- Existing head content -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<section class="section">
   <div class="section-header">
       <h1>Periksa Pasien</h1>
   </div>
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                   <form action="store.php" method="POST">
                       <input type="hidden" name="id_daftar_poli" value="<?= $data['id'] ?>">
                       
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
                           <textarea name="catatan" class="form-control" required></textarea>
                       </div>

                       <div class="form-group">
                            <label>Obat</label>
                            <select name="obat[]" id="obat" class="form-control select2" multiple required>
                                <?php
                                // PHP code untuk dropdown
                                $query_obat = "SELECT id, nama_obat, harga FROM obat";
                                $result_obat = mysqli_query($connect, $query_obat);

                                while ($obat = mysqli_fetch_array($result_obat)) {
                                    echo "<option value='" . $obat['id'] . "' data-harga='" . $obat['harga'] . "'>" 
                                         . $obat['nama_obat'] . " (Rp " . number_format($obat['harga'],0,',','.') . ")</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Biaya Periksa</label>
                            <input type="number" name="biaya_periksa" id="biaya_periksa" class="form-control" value="150000" readonly>
                        </div>


                       <button type="submit" class="btn btn-primary">Simpan</button>
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
   console.log('Select2 initialized'); // Debug initialization

   $('#obat').on('change', function() {
       console.log('Change event triggered'); // Debug event trigger
       
       let totalHargaObat = 0;
       let biayaDasar = 150000;

       let selectedOptions = $(this).find('option:selected');
       console.log('Selected options:', selectedOptions.length); // Debug selected options

       selectedOptions.each(function() {
           let harga = $(this).attr('data-harga');
           console.log('Raw harga:', harga); // Debug raw harga value
           
           let hargaObat = Number(harga) || 0;
           console.log('Converted harga:', hargaObat); // Debug converted harga
           
           totalHargaObat += hargaObat;
           console.log('Running total:', totalHargaObat); // Debug running total
       });

       let finalTotal = biayaDasar + totalHargaObat;
       console.log('Final total:', finalTotal); // Debug final total
       
       $('#biaya_periksa').val(finalTotal);
   });
});
</script>