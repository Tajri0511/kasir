<div class="card mt-5">
    <div class="card-header">
        <h2>Tabel Barang</h2>
        <a class="btn btn-danger mb-2" href="index.php?page=barang/insert"><i class="bi bi-bag-plus-fill"></i>
            Tambah produk</a>
    </div>

    <div class="card-body">
        <table class="table table-striped table-hover" id="example">
            <thead>
                <tr>
                    <th scope="col">ID Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Harga Beli</th>
					<th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM produk";
                $result = $conn->query($sql);
                ?>
                <?php if ($result) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>

                            <td>
                                <?= $row['id_barang'] ?>
                            </td>
                            <td>
                                <?= $row['nama_barang'] ?>
                            </td>
                            <td>
                                <?= $row['stok'] ?>
                            </td>
                            <td>
                                <?= $row['harga_jual'] ?>
                            </td>
                            <td>
                                <?= $row['harga_beli'] ?>
                            </td>
                       </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
