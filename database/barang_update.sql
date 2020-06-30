-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table ta_rental.barangs: ~2 rows (approximately)
DELETE FROM `barangs`;
/*!40000 ALTER TABLE `barangs` DISABLE KEYS */;
INSERT INTO `barangs` (`id_barang`, `nama_barang`, `harga_sewa`, `deskripsi`, `gambar_barang`, `stok`, `ukuran`) VALUES
	(1, 'Great Outdoor Fly Air', 30000, 'Tenda Size: 240 x 220 x 120 cm', '3b7c030fe318041e18b5851aefcea91a.jpg', 11, 'kecil'),
	(2, 'Eureka! Tetagron', 75000, 'Tenda Size 70.4" x 18.3" x 17.3"', 'd5dde7b0f8380ebd43b9d2431c47dddc.jpg', 3, 'Besar'),
	(3, 'Bestway Monodame Pavillo X2', 25000, 'tenda size: 205 x 140 x 100 cm', 'a558ce4e8459a4cd31ec65d03df64d97.jpg', 11, 'kecil');
/*!40000 ALTER TABLE `barangs` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
