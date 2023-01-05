-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 04:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualanimk`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventoribarang`
--

CREATE TABLE `inventoribarang` (
  `idbarang` varchar(12) NOT NULL,
  `namabarang` varchar(30) DEFAULT NULL,
  `stok` int(12) DEFAULT NULL,
  `harga` int(30) DEFAULT NULL,
  `idpegawai` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventoribarang`
--

INSERT INTO `inventoribarang` (`idbarang`, `namabarang`, `stok`, `harga`, `idpegawai`) VALUES
('R001', 'Rinso', 23, 9000, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `idkonsumen` int(12) NOT NULL,
  `namakonsumen` varchar(30) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`idkonsumen`, `namakonsumen`, `nohp`) VALUES
(1, 'Ujang Asep', '0000000'),
(2, 'Yeni Indriani', '0432828'),
(3, 'Tessia Eralith', '098777'),
(4, 'Reni Sugwerni', '08777');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idpegawai` varchar(12) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `namapegawai` varchar(30) DEFAULT NULL,
  `role` enum('admin','owner','kasir','pegawai') DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idpegawai`, `pass`, `namapegawai`, `role`, `alamat`, `nohp`) VALUES
('admin', '$2a$12$7HyR8oUo9wW/z1Vj3L2iLOtInSgd2r7hfjMB2nQ6LT/O73qCPBVSe', 'admin', 'owner', 'admin', 'admin'),
('ari', '$2y$10$hWkcX0sxe0nJZApV8oAOkuTQVqk9snxAI1F0It9j09xpW9Asq3wQ.', 'ari', 'pegawai', 'ari', '098777'),
('tes', '$2y$10$nrWFISNtER2rqFKteNtvXOCSTs5g7EJo0bY6Bhs0QPJgOYTeyGnvW', 'tes', 'owner', 'tes', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `idpembelian` int(8) NOT NULL,
  `waktu` timestamp NULL DEFAULT current_timestamp(),
  `jumlahbeli` int(12) DEFAULT NULL,
  `idbarang` varchar(12) DEFAULT NULL,
  `idkonsumen` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`idpembelian`, `waktu`, `jumlahbeli`, `idbarang`, `idkonsumen`) VALUES
(2, '2022-12-29 14:08:18', 2, 'R001', 1),
(5, '2022-12-29 14:08:39', 4, 'R001', 2),
(6, '2022-07-13 14:23:26', 3, 'R001', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventoribarang`
--
ALTER TABLE `inventoribarang`
  ADD PRIMARY KEY (`idbarang`),
  ADD KEY `idpegawai` (`idpegawai`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`idkonsumen`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idpegawai`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`idpembelian`),
  ADD KEY `idkonsumen` (`idkonsumen`),
  ADD KEY `idbarang` (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `idkonsumen` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `idpembelian` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventoribarang`
--
ALTER TABLE `inventoribarang`
  ADD CONSTRAINT `inventoribarang_ibfk_1` FOREIGN KEY (`idpegawai`) REFERENCES `pegawai` (`idpegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`idkonsumen`) REFERENCES `konsumen` (`idkonsumen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`idbarang`) REFERENCES `inventoribarang` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
