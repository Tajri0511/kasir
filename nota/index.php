<?php 
    $koneksi = mysqli_connect("localhost","root","","kasir");
    if (mysqli_connect_error()) {
        echo "Koneksi database gagal";
    }
    $totalkeuntungan = 0;
?>
<div class="card mt-5">
    <div class="card-header">
        <h2>Tabel Laporan</h2>

    </div>
    <div class="card-body">
        <p>Cari laporan berdasarkan tanggal input:</p>
        <!-- Form input tanggal -->
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form10" target="_self" action="">                                                           
<div class="row">
  <div class="col-lg-3">
    <input name="dari_tgl" type="date" class="form-control" size="10" /> 
  </div>
  <div class="col-lg-3">
   <input name="sampai_tgl" type="date" class="form-control" size="10" />
  </div>

  <div class="col-lg-3">            
  <input name="filter" class="btn btn-danger" type="submit" value="Tampilkan" />
  </div>      
</div>
</form>
<br>
<?php 
    if (isset($_POST['filter'])) {
    $dari_tgl = mysqli_real_escape_string($koneksi, $_POST['dari_tgl']);
    $sampai_tgl = mysqli_real_escape_string($koneksi, $_POST['sampai_tgl']);
   
    }
 ?>
<div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
<table class="table dataTable my-0" id="dataTable1">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Tanggal Input</th>
      <th>Jumlah</th>
      <th>Total</th>
      <th>Total Keuntungan</th>
     </tr>
   </thead>
 <tbody>

<?php 
$no = 1;

if (isset($_POST['filter'])) {
    $dari_tgl = mysqli_real_escape_string($koneksi, $_POST['dari_tgl']);
    $sampai_tgl = mysqli_real_escape_string($koneksi, $_POST['sampai_tgl']);
    $data_brg = mysqli_query($koneksi, "SELECT * FROM nota WHERE tgl_input BETWEEN '$dari_tgl' AND '$sampai_tgl'");


}else{

$data_brg = mysqli_query($koneksi, "SELECT * FROM nota");
}
while ($tampil = mysqli_fetch_array($data_brg)) {
    $totalkeuntungan += $tampil['total'];

 ?>
<tr>                        
  <td><?= $no++;?></td>
  <td><?= getProdukById($tampil['id_barang'])['nama_barang'];?></td>
  <td><?= $tampil['tgl_input'];?></td>
  <td><?= $tampil['jumlah'] ?></td>
  <td><?= $tampil['total'];?></td>
  <td><?= $totalkeuntungan ?></td>                                      
</tr>

<?php
}
?>
 </tbody>
 </table>
</div>
<div class="row">
  <div class="col-lg-3">
    <a href="./module/nota/pdf.php" target="_blank" class="btn btn-danger"><i class="bi bi-filetype-pdf mr-2"></i>  Cetak Laporan PDF</a>
   </div>
</div>
<div class="row mt-3">
  <div class="col-lg-12">
    <a href="./module/nota/export_excel.php" target="_blank" class="btn btn-danger"><i class="bi bi-file-earmark-excel mr-2"></i>  Cetak Laporan EXCEL</a>
   </div>
</div>                