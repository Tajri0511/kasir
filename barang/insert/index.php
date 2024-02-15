<?php

// cek apakah tombol submit sudah ditekan
if (isset($_POST['submit'])) {
    // cek apakah gambar sudah diupload
    if (add_produk($_POST) > 0) {
        echo "<script>
        alert('Berhasil menambahkan produk!');
        window.location.href = 'index.php?page=barang';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambahkan produk!');
        window.location.href = 'index.php?page=barang';
        </script>";
    }
}

?>

<a href="index.php?page=barang" class="btn btn-success mb-3"><i class="bi bi-chevron-left"></i> Kembali</a>
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <h2>Tambah Barang</h2>
            <form action="" method="POST">
                <tr>
                    <td><label for="nama_barang">Nama Barang:</label></td>
                    <td><input type="text" name="nama_barang" class="form-control" autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="stok">Stok:</label></td>
                    <td><input type="text" name="stok" class="form-control" autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="harga_jual">Harga Jual:</label></td>
                    <td><input type="text" name="harga_jual" class="form-control" autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="harga_beli">Harga Beli:</label></td>
                    <td><input type="text" name="harga_beli" class="form-control" autocomplete="off"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name='submit' value="Tambah" class="btn btn-success"></td>
                </tr>
            </form>
        </table>
    </div>
</div>