-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 11:30 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id_penjualan` char(4) NOT NULL,
  `id_barang` char(4) NOT NULL,
  `jumlah` int(9) NOT NULL,
  `total` int(9) NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `kasir`
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
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(3) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `level` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `user`, `pass`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'petugas', 'ee11cbb19052e40b07aac0ca060c23ee', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `NIK` char(16) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Jenkel` enum('Laki-laki','Perempuan') NOT NULL,
  `Alamat` text NOT NULL,
  `Telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id_nota` char(4) NOT NULL,
  `id_barang` char(4) NOT NULL,
  `jumlah` int(9) NOT NULL,
  `total` int(9) NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id_nota`, `id_barang`, `jumlah`, `total`, `tgl_input`) VALUES
('N001', 'B001', 5, 40000, '2024-02-12'),
('N002', 'B004', 5, 15000, '2024-02-12'),
('N003', 'B006', 2, 8000, '2024-02-13'),
('N004', 'B001', 2, 16000, '2024-02-13');

--
-- Triggers `nota`
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
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_barang` char(4) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `stok` int(4) NOT NULL,
  `harga_jual` varchar(9) NOT NULL,
  `harga_beli` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_barang`, `nama_barang`, `stok`, `harga_jual`, `harga_beli`) VALUES
('B001', 'Mie Ayam', 23, '8000', '6000'),
('B002', 'Bakso', 30, '10000', '8000'),
('B003', 'Mie Ayam Bakso', 30, '12000', '10000'),
('B004', 'Es Teh', 25, '3000', '2000'),
('B005', 'Es Jeruk', 30, '3500', '2500'),
('B006', 'Es Kopi', 18, '4000', '2500');

--
-- Triggers `produk`
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
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`NIK`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kasir`
--
ALTER TABLE `kasir`
  ADD CONSTRAINT `kasir_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
