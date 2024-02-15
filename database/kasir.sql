-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Feb 2024 pada 02.45
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webkasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE `kasir` (
  `id_penjualan` char(4) NOT NULL,
  `id_barang` char(4) NOT NULL,
  `jumlah` int(9) NOT NULL,
  `total` int(9) NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `kasir`
--
DELIMITER $$
CREATE TRIGGER `trg_before_insert_kasir` BEFORE INSERT ON `kasir` FOR EACH ROW BEGIN
  DECLARE max_id INT(3);
  SET max_id = (SELECT MAX(CAST(SUBSTRING(`id_penjualan`, 2) AS UNSIGNED)) FROM `kasir`);
  SET NEW.`id_penjualan` = CONCAT('K', LPAD(COALESCE(max_id + 1, 1), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_login` int(3) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `level` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_login`, `user`, `pass`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE `nota` (
  `id_nota` char(4) NOT NULL,
  `id_barang` char(4) NOT NULL,
  `jumlah` int(9) NOT NULL,
  `total` int(9) NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`id_nota`, `id_barang`, `jumlah`, `total`, `tgl_input`) VALUES
('N001', 'B006', 2, 20000, '2023-06-20'),
('N002', 'B007', 1, 5000, '2023-06-20'),
('N003', 'B001', 2, 6000, '2023-06-20'),
('N004', 'B005', 2, 6000, '2023-07-06'),
('N005', 'B006', 1, 10000, '2023-07-10'),
('N006', 'B004', 1, 1000, '2023-07-14'),
('N007', 'B003', 1, 2000, '2023-07-14'),
('N008', 'B001', 1, 3000, '2024-01-11'),
('N009', 'B005', 2, 6000, '2024-01-11'),
('N010', 'B004', 10, 10000, '2024-01-11'),
('N011', 'B001', 2, 6000, '2024-01-25'),
('N012', 'B007', 2, 10000, '2024-01-25'),
('N013', 'B005', 2, 6000, '2024-01-25'),
('N014', 'B001', 5, 15000, '2024-01-25'),
('N015', 'B001', 2, 6000, '2024-01-29'),
('N016', 'B012', 5, 40000, '2024-02-02');

--
-- Trigger `nota`
--
DELIMITER $$
CREATE TRIGGER `trg_before_insert_nota` BEFORE INSERT ON `nota` FOR EACH ROW BEGIN
  DECLARE max_id INT(3);
  SET max_id = (SELECT MAX(CAST(SUBSTRING(`id_nota`, 2) AS UNSIGNED)) FROM `nota`);
  SET NEW.`id_nota` = CONCAT('N', LPAD(COALESCE(max_id + 1, 1), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_barang` char(4) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `stok` int(4) NOT NULL,
  `harga_jual` varchar(9) NOT NULL,
  `harga_beli` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_barang`, `nama_barang`, `stok`, `harga_jual`, `harga_beli`) VALUES
('B001', 'Pensil', 8, '3000', '1500'),
('B003', 'Roti', 19, '2000', '1500'),
('B004', 'Pilus', 10, '1000', '500'),
('B005', 'Mie', 11, '3000', '5000'),
('B006', 'Nasi Kuning', 12, '10000', '8000'),
('B007', 'Air Putih', 17, '5000', '3000'),
('B008', 'Kopi', 20, '3000', '2000'),
('B010', 'Susu', 20, '3000', '2000'),
('B012', 'Bakso', 60, '8000', '6500'),
('B013', 'Soda', 60, '5000', '4000');

--
-- Trigger `produk`
--
DELIMITER $$
CREATE TRIGGER `trg_before_insert_produk` BEFORE INSERT ON `produk` FOR EACH ROW BEGIN
  DECLARE max_id INT(3);
  SET max_id = (SELECT MAX(CAST(SUBSTRING(`id_barang`, 2) AS UNSIGNED)) FROM `produk`);
  SET NEW.`id_barang` = CONCAT('B', LPAD(COALESCE(max_id + 1, 1), 3, '0'));
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kasir`
--
ALTER TABLE `kasir`
  ADD CONSTRAINT `kasir_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
