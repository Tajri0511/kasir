<?php
require 'function.php';

session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/content.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <title>Kasir</title>

</head>

<body>
    <div>
        <div class="sidebar p-4 bg-dark" id="sidebar">
            <h4 class="mt-3 text-primary position-absolute top-5 start-50 translate-middle">Kasir</h4>
            <li>
                <!-- dashboard, produk, kategori, report, kasir -->
                <a class="btn text-primary mt-4" href="index.php">
                    <i class="bi bi-house mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a class="btn text-primary" href="index.php?page=barang">
                    <i class="bi bi-basket2-fill mr-2"></i>
                    Barang
                </a>
            </li>
            <li>
                <a class="btn text-primary" href="index.php?page=kasir">
                    <i class="bi bi-shop mr-2"></i>
                    Penjualan
                </a>
            </li>
			<li>
                <a class="btn text-primary" href="index.php?page=member">
                   <i class="bi bi-people-fill mr-2"></i>
                    Member
                </a>
            </li>
            <li>
                <a class="btn text-primary" href="index.php?page=nota">
                    <i class="bi bi-newspaper mr-2"></i>
                    Laporan
                </a>
            </li>
            <li>
           		 <a class="btn text-primary" href="logout.php">
            		<i class="bi bi-door-closed mr-2"></i>
                    Logout
                 </a>
            </li>
		</div>
    </div>