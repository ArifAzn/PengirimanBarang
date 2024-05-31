-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 12:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kirimbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `jenis_pengiriman` varchar(15) NOT NULL,
  `id_kategori` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `satuan`, `jenis_pengiriman`, `id_kategori`) VALUES
(2013, 'Dokumen', '1kg', 'Bag', '114'),
(2014, 'Dokumen', '1kg', 'Bag', '114'),
(2015, 'Dok', '1kg', 'Box', '114');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengiriman`
--

CREATE TABLE `detail_pengiriman` (
  `id_detail` int(4) NOT NULL,
  `id_pengiriman` varchar(14) NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `qty` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`, `keterangan`) VALUES
(113, 'Super Speed (SPS)', 'Pengiriman Dokumen'),
(114, 'Ongkos Kirim Ekonomis (OKE)', 'Pengirima Surat\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `nama`, `jenis_kelamin`, `telepon`, `alamat`) VALUES
(41420, 'Eka Sari', 'Laki-laki', '0812-3456-7890', 'Jl. Pondok Cabe Raya No. 12, Pondok Cabe, Tangerang Selatan'),
(41421, 'Bagus Bayu', 'Laki-laki', '0822-3456-7890', 'Jl. Cirendeu Permai No. 23, Cirendeu, Tangerang Selatan'),
(41422, 'Dimas ', 'Laki-laki', '0859-8765-4321', 'Jl. Pamulang Raya, Pamulang, Tangerang Selatan'),
(41423, 'Wijaya', 'Laki-laki', '0814-4567-8901', 'Jl. Cinere Raya No. 12, Cinere, Depok');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `telepon`, `alamat`) VALUES
(9, 'Arif', '0896', 'Kubus'),
(10, 'Panjul', '0899', 'Jl. Legoso\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pelanggan` varchar(7) NOT NULL,
  `id_kurir` varchar(5) NOT NULL,
  `Penerima` varchar(30) NOT NULL,
  `AlamatTujuan` varchar(50) NOT NULL,
  `BeratBarang` varchar(20) NOT NULL,
  `JenisPengiriman` varchar(30) NOT NULL,
  `TotalHarga` varchar(50) NOT NULL,
  `KategoriPengiriman` varchar(30) NOT NULL,
  `Barang` varchar(50) NOT NULL,
  `no_kendaraan` varchar(8) NOT NULL,
  `Status` varchar(50) DEFAULT 'terkirim'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `tanggal`, `id_pelanggan`, `id_kurir`, `Penerima`, `AlamatTujuan`, `BeratBarang`, `JenisPengiriman`, `TotalHarga`, `KategoriPengiriman`, `Barang`, `no_kendaraan`, `Status`) VALUES
(120040042107045, '2024-05-31', '1200400', '12004', 'arif', 'kambing', '5', 'International', '250000', 'Parcel', 'Doku', '111111', 'terkirim');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(5) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`) VALUES
('', 'arif@gmail.com', 'arif123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2017;

--
-- AUTO_INCREMENT for table `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  MODIFY `id_detail` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41424;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120040042107047;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
