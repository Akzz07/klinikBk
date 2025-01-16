<?php
require_once '../layout/_pastop.php';
require_once '../helper/connect.php';

$queryPoli = "SELECT id, nama_poli FROM poli";
$resultPoli = $connect->query($queryPoli);
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Daftar Poli</h1>
    <a href="./index.php" class="btn btn-light">Kembali</a>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- // Form -->
          <form action="./store.php" method="POST">
            <table cellpadding="8" class="w-100">
            
                            <h2>MERASA GAK ENAK BADAN???</h2>

              <tr>
                <td>
                  <a href="../daftarpoli/index.php"><input class="btn btn-primary" type="daftar" name="daftar"></a>
                  <!-- <input class="btn btn-danger" type="reset" name="batal" value="Bersihkan"></td> -->
              </tr>

            </table>
          </form>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>