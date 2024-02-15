<?php 
require_once __DIR__ .'/mpdf_v8.0.3-master/vendor/autoload.php';

    $koneksi = mysqli_connect("localhost","root","","kasir");
    $totalkeuntungan = 0;
      function getProdukById($id_barang){
      global $koneksi;

      $query = "SELECT * FROM produk WHERE id_barang = '$id_barang'";
      $result = mysqli_query($koneksi, $query);
      $row = mysqli_fetch_assoc($result);

      return $row;
    }


    $html = '
    
<div class="card mt-5">
    <div class="card-header">
        <h2>Tabel Nota</h2>';



 

$html .='
<div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
<table border="1" class="table dataTable my-0" id="dataTable1">
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
 <tbody>';


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

$html .='
<tr>                        
  <td>'.$no++.'</td>
  <td>'.getProdukById($tampil['id_barang'])['nama_barang'].'</td>
  <td>'.$tampil['tgl_input'].'</td>
  <td>'.$tampil['jumlah'].'</td>
  <td>'.$tampil['total'].'</td>
  <td>'.$totalkeuntungan.'</td>
</tr>';


}
$html .='
 </tbody>
 </table>
</div>';


$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('Laporan-penjualan.pdf', 'I');
 ?>