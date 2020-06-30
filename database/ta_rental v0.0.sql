-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2020 at 12:28 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_rental_`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_sewa` int(11) DEFAULT NULL,
  `deskripsi` mediumtext,
  `gambar_barang` mediumtext,
  `stok` int(11) DEFAULT NULL,
  `ukuran` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id_barang`, `nama_barang`, `harga_sewa`, `deskripsi`, `gambar_barang`, `stok`, `ukuran`) VALUES
(0, 'a', 2222, 'aaaa', 'df9838f0c949e530626d14e540face2a.jpg', 11, 'besar');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transactions`
--

CREATE TABLE `detail_transactions` (
  `id_detail` int(11) NOT NULL,
  `id_transaction` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_pengembalian` int(11) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idbayar` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_transaction` int(11) DEFAULT NULL,
  `tanggalbayar` date DEFAULT NULL,
  `asalbank` varchar(100) DEFAULT NULL,
  `namapengirim` varchar(100) DEFAULT NULL,
  `buktibayar` mediumtext CHARACTER SET latin1 COLLATE latin1_bin
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `idpengembalian` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggalkembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int(11) NOT NULL,
  `idpengembalian` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `idbayar` int(11) DEFAULT NULL,
  `jumlahsewa` int(11) DEFAULT NULL,
  `tujuansewa` varchar(100) DEFAULT NULL,
  `tanggal_pemesanan` timestamp NULL DEFAULT NULL,
  `tanggalsewa` date DEFAULT NULL,
  `tanggalselesai` date DEFAULT NULL,
  `jarak` int(11) DEFAULT NULL,
  `metodepengembalian` varchar(100) DEFAULT NULL,
  `biayapengiriman` int(11) DEFAULT NULL,
  `alamatpengiriman` varchar(100) DEFAULT NULL,
  `total_sewa` int(11) DEFAULT NULL,
  `jaminan` varchar(100) DEFAULT NULL,
  `noidentitas` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tgl_pengembalian` timestamp NULL DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `keterangankondisi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_users`
--

CREATE TABLE `type_users` (
  `idlevel` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `namalevel` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text,
  `no_telp` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `typeuser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `alamat`, `no_telp`, `email`, `username`, `password`, `typeuser_id`) VALUES
(1, 'admin', NULL, NULL, NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3', 3),
(4, 'bayu', 'malang', 2147483647, 'bayu@gamil.com', 'bayu', 'a430e06de5ce438d499c2e4063d60fd6', 2),
(5, 'ivfa', 'malang', 2147483647, 'ivfatut@gmail.com', 'ivfa', 'e70c7e007a4fb1f0781da38df3319235', 1),
(11, 'mila', 'malang', 2147483647, 'mila@gmail.com', 'mila', '38cb862715ae650d05f745edfe66576a', 1),
(14, 'dewi', 'malng', 2147483647, 'dewiina@gmail.com', 'dewi', 'ed1d859c50262701d92e5cbf39652792', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `barang_pk` (`id_barang`);

--
-- Indexes for table `detail_transactions`
--
ALTER TABLE `detail_transactions`
  ADD PRIMARY KEY (`id_detail`),
  ADD UNIQUE KEY `detail_transactions_pk` (`id_detail`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idbayar`),
  ADD UNIQUE KEY `pembayaran_pk` (`idbayar`),
  ADD KEY `dapat_fk` (`id_transaction`),
  ADD KEY `harus_fk` (`id_user`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`idpengembalian`),
  ADD UNIQUE KEY `pengembalian_pk` (`idpengembalian`),
  ADD KEY `dapat_fk` (`id_user`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD UNIQUE KEY `transactions_pk` (`id_transaction`),
  ADD KEY `dapat_fk` (`idbayar`),
  ADD KEY `disewa_fk` (`id_barang`),
  ADD KEY `melakukan_fk` (`idpengembalian`),
  ADD KEY `menyewa_fk` (`id_user`);

--
-- Indexes for table `type_users`
--
ALTER TABLE `type_users`
  ADD PRIMARY KEY (`idlevel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
