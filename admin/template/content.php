<?php
// query kategori

// query produk
$sqlStok = "SELECT SUM(stok) AS total_stok FROM produk";
$resultStok = $conn->query($sqlStok);

// query nota
$sqlNota = "SELECT SUM(total) AS total_nota FROM nota";
$resultNota = $conn->query($sqlNota);

// query kasir
$sqlKasir = "SELECT COUNT(*) AS sum_nota FROM nota";
$resultKasir = $conn->query($sqlKasir);
?>
<div class="badan">
    <h2>Dashboard</h2>
    <br>
    <?php if ( $resultStok && $resultKasir && $resultNota) {

        // Ambil nilai total stok produk
        $rowStok = $resultStok->fetch_assoc();
        $totalStok = $rowStok['total_stok'];

        // Ambil nilai banyaknya query kasir
        $rowKasir = $resultKasir->fetch_assoc();
        $totalKasir = $rowKasir['sum_nota'];

        // Ambil nilai total nota
        $rowNota = $resultNota->fetch_assoc();
        $totalNota = $rowNota['total_nota'];
        ?>
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h6 class="pt-2"><i class="bi bi-basket2-fill mr-2"></i> Stok Barang</h6>
                    </div>
                    <div class="card-body">
                        <center>
                            <h1>
                                <?= $totalStok ?>
                            </h1>
                        </center>
                    </div>
                    <div class="card-footer">
                        <a href='index.php?page=barang'>Tabel
                            Barang </a>
                    </div>
                </div>
                <!--/grey-card -->
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h6 class="pt-2"><i class="bi bi-shop mr-2"></i> Penjualan</h6>
                    </div>
                    <div class="card-body">
                        <center>
                            <h1>
                                <?= $totalKasir ?>
                            </h1>
                        </center>
                    </div>
                    <div class="card-footer">
                        <a href='index.php?page=kasir'>Kasir </a>
                    </div>
                </div>
                <!--/grey-card -->
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h6 class="pt-2"><i class="bi bi-cash-stack mr-2"></i> Pendapatan</h6>
                    </div>
                    <div class="card-body">
                        <center>
                            <h1>
                                <?= "Rp.", number_format($totalNota, 2, ",", ".") ?>
                            </h1>
                        </center>
                    </div>
                    <div class="card-footer">
                        <a href='index.php?page=nota'>Tabel
                            Nota</a>
                    </div>
                </div>
                <!--/grey-card -->
            </div>
        </div>
    <?php } ?>
</div>