-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2020 at 11:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_sewa` int(11) DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `gambar_barang` mediumtext DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `ukuran` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id_barang`, `nama_barang`, `harga_sewa`, `deskripsi`, `gambar_barang`, `stok`, `ukuran`) VALUES
(1, 'a', 2222, 'aaaa', 'afa1a5e062c04b31fa0ac2eb4adf034d.jpg', 10, 'besar'),
(2, 'a', 1, 'asd', 'cf45d796e05bcd519688fed66cb16515.jpg', 1, 'kecil'),
(3, 'Bestway Monodome Pavilio X2', 100000, 'coba', '05e2c3fc81212290a46d9062bce7dbf3.jpg', 3, 'besar'),
(4, 'Great Outdoor Flyair', 100000, 'tenda', 'b5707d44fbe2b0a356cab845a5997159.jpg', 0, 'besar');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL DEFAULT 1,
  `tgl_ditambahkan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_barang`, `jumlah_barang`, `tgl_ditambahkan`) VALUES
(1, 4, 3, 1, '2020-05-22 20:02:26'),
(2, 4, 4, 2, '2020-05-22 20:02:26'),
(3, 6, 1, 1, '2020-05-26 19:50:10'),
(4, 6, 3, 1, '2020-05-26 19:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `tgl_deadline` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL COMMENT '0 = belum\r\n1 = sudah\r\n2 = gagal/expired',
  `tgl_bayar` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `bukti_bayar` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_transaksi`, `tgl_deadline`, `status`, `tgl_bayar`, `bukti_bayar`, `is_verified`, `created_at`) VALUES
(2, 4, '2020-05-23 08:02:26', 2, '2020-05-26 19:04:50', NULL, 0, '2020-05-22 20:02:26'),
(3, 6, '2020-05-27 07:50:10', 1, '2020-05-26 21:37:17', 'f185566c6e3b729ec87a5978105eeabc.jpg', 0, '2020-05-26 19:50:10');

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
-- Table structure for table `temp_detail_transaksi`
--

CREATE TABLE `temp_detail_transaksi` (
  `id_temp_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL DEFAULT 1,
  `tgl_ditambahkan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_detail_transaksi`
--

INSERT INTO `temp_detail_transaksi` (`id_temp_detail_transaksi`, `id_transaksi`, `id_barang`, `jumlah_barang`, `tgl_ditambahkan`) VALUES
(6, 1, 3, 5, '2020-05-18 02:22:48'),
(8, 3, 4, 1, '2020-05-19 10:45:53'),
(12, 5, 1, 1, '2020-05-19 16:33:31'),
(13, 5, 4, 1, '2020-05-19 16:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_transaksi` int(11) NOT NULL DEFAULT 0 COMMENT '0 = sementara\r\n1 = transaksi',
  `subtotal` bigint(20) DEFAULT NULL,
  `tgl_pemesanan` timestamp NULL DEFAULT NULL,
  `tgl_sewa` date DEFAULT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `id_tujuan` int(11) DEFAULT NULL,
  `metode_pengambilan` varchar(100) DEFAULT NULL,
  `alamat_pengiriman` text DEFAULT NULL,
  `jarak` float DEFAULT NULL,
  `kode_kendaraan` int(11) DEFAULT NULL,
  `biaya_pengiriman` int(11) DEFAULT NULL,
  `jaminan` varchar(100) DEFAULT NULL,
  `foto_jaminan` varchar(255) DEFAULT NULL,
  `no_identitas` varchar(50) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `total_harga` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `status_transaksi`, `subtotal`, `tgl_pemesanan`, `tgl_sewa`, `tgl_pengembalian`, `id_tujuan`, `metode_pengambilan`, `alamat_pengiriman`, `jarak`, `kode_kendaraan`, `biaya_pengiriman`, `jaminan`, `foto_jaminan`, `no_identitas`, `no_telp`, `total_harga`) VALUES
(1, 5, 0, NULL, '0000-00-00 00:00:00', '2020-05-20', '2020-05-22', 1, 'Diambil', NULL, 0, 0, 0, 'KTP', '28173d6eec49cc44d36511b7269a0baf.png', '1231', '123213', 300000),
(3, 11, 0, 100000, '2020-05-20 08:09:40', '2020-05-20', '2020-05-22', 1, 'Dikirim', 'daasdasd', 0.6, 2, 4800, 'KTP', 'c8d79768f4e95f61425782c26062e943.png', '1231231', '23123', 104800),
(4, 8, 1, 300000, '2020-05-22 19:48:25', '2020-05-20', '2020-05-22', 1, 'Dikirim', 'Jalan kaliurang', 2.5, 2, 20000, 'KTP', 'b66539fcbc8d73a240fc700037ccfca9.jpg', '123', '213', 320000),
(5, 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '', NULL, '', NULL),
(6, 8, 1, 102222, '2020-05-26 19:50:02', '2020-05-28', '2020-06-05', 5, 'Dikirim', 'jalan jalan', 6, 2, 48000, 'KTP', '14dddef21dc23b4d14acab51d022254a.jpg', '999', '321654', 150222);

-- --------------------------------------------------------

--
-- Table structure for table `tujuan`
--

CREATE TABLE `tujuan` (
  `id` int(11) NOT NULL,
  `tujuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tujuan`
--

INSERT INTO `tujuan` (`id`, `tujuan`) VALUES
(1, 'pantai'),
(2, 'gunung'),
(3, 'camping ground'),
(4, 'sekolah'),
(5, 'lapangan'),
(6, 'event');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `alamat`, `no_telp`, `email`, `username`, `password`, `level`) VALUES
(1, 'admin', '', '', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(2, 'bayu', 'malang', '2147483647', 'bayu@gamil.com', 'bayu', 'a430e06de5ce438d499c2e4063d60fd6', 1),
(3, 'ivfa', 'malang', '2147483647', 'ivfatut@gmail.com', 'ivfa', 'e70c7e007a4fb1f0781da38df3319235', 1),
(4, 'mila', 'malang', '2147483647', 'mila@gmail.com', 'mila', '38cb862715ae650d05f745edfe66576a', 2),
(5, 'dewi', 'malng', '2147483647', 'dewiina@gmail.com', 'dewi', 'ed1d859c50262701d92e5cbf39652792', 2),
(8, 'aca', NULL, '123', 'aca@ca.ca', 'aca', '2671eb6e9150cf9b53eb39752a1fb21c', 1),
(11, 'asd', NULL, 'asd', 'asd@asd.sd', 'asd', '7815696ecbf1c96e6894b779456d330e', 1);

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
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `pembayaran_pk` (`id_pembayaran`),
  ADD KEY `dapat_fk` (`id_transaksi`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`idpengembalian`),
  ADD UNIQUE KEY `pengembalian_pk` (`idpengembalian`),
  ADD KEY `dapat_fk` (`id_user`);

--
-- Indexes for table `temp_detail_transaksi`
--
ALTER TABLE `temp_detail_transaksi`
  ADD PRIMARY KEY (`id_temp_detail_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`,`id_barang`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_tujuan` (`id_tujuan`);

--
-- Indexes for table `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temp_detail_transaksi`
--
ALTER TABLE `temp_detail_transaksi`
  MODIFY `id_temp_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
