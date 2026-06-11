-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2026 at 07:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan_pbo_ti_1d_afrizalnurditya`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` int NOT NULL,
  `nama_film` varchar(255) NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` int NOT NULL,
  `harga_dasar_tiket` decimal(10,2) NOT NULL,
  `jenis_studio` enum('Regular','IMAX','Velvet') NOT NULL,
  `tipe_audio` varchar(50) DEFAULT NULL,
  `lokasi_baris` varchar(50) DEFAULT NULL,
  `kacamata_3d_id` varchar(50) DEFAULT NULL,
  `efek_gerak_fitur` varchar(100) DEFAULT NULL,
  `bantal_selimut_pack` varchar(50) DEFAULT NULL,
  `layanan_butler` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_audio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(85, 'The Shadow of Tomorrow', '2026-06-15 13:00:00', 1, '50000.00', 'Regular', 'Dolby Digital 5.1', 'Row E', NULL, NULL, NULL, NULL),
(86, 'Misteri Rumah Tua', '2026-06-15 15:30:00', 2, '50000.00', 'Regular', 'Dolby Atmos', 'Row G', NULL, NULL, NULL, NULL),
(87, 'Laugh Out Loud', '2026-06-15 17:45:00', 1, '45000.00', 'Regular', 'Standard Stereo', 'Row C', NULL, NULL, NULL, NULL),
(88, 'Chasing Horizons', '2026-06-16 12:00:00', 4, '40000.00', 'Regular', 'Dolby Digital 5.1', 'Row F', NULL, NULL, NULL, NULL),
(89, 'Cinta di Kota Tua', '2026-06-16 14:15:00', 2, '40000.00', 'Regular', 'Standard Stereo', 'Row D', NULL, NULL, NULL, NULL),
(90, 'Cyberpunk 2099', '2026-06-16 19:00:00', 1, '50000.00', 'Regular', 'Dolby Atmos', 'Row A', NULL, NULL, NULL, NULL),
(91, 'Whisper of the Wind', '2026-06-17 10:30:00', 3, '35000.00', 'Regular', 'Dolby Digital 5.1', 'Row H', NULL, NULL, NULL, NULL),
(92, 'Galaksi Terakhir', '2026-06-15 14:30:00', 2, '85000.00', 'IMAX', 'IMAX 12-Channel', 'Row IMAX-B', 'GLASSES-3D-001', 'D-BOX Motion Active', NULL, NULL),
(93, 'Cyberpunk 2099', '2026-06-15 18:00:00', 1, '90000.00', 'IMAX', 'IMAX 12-Channel', 'Row IMAX-A', 'GLASSES-3D-002', 'D-BOX Motion Active', NULL, NULL),
(94, 'The Shadow of Tomorrow', '2026-06-15 21:15:00', 2, '90000.00', 'IMAX', 'Dolby Atmos IMAX', 'Row IMAX-C', 'GLASSES-3D-003', 'Standard No-Motion', NULL, NULL),
(95, 'Chasing Horizons', '2026-06-16 13:00:00', 2, '80000.00', 'IMAX', 'IMAX 12-Channel', 'Row IMAX-D', 'GLASSES-3D-004', 'D-BOX Motion Active', NULL, NULL),
(96, 'Galaksi Terakhir', '2026-06-16 16:30:00', 1, '80000.00', 'IMAX', 'IMAX 12-Channel', 'Row IMAX-B', 'GLASSES-3D-005', 'Standard No-Motion', NULL, NULL),
(97, 'Detektif Buta', '2026-06-16 20:00:00', 3, '85000.00', 'IMAX', 'Dolby Atmos IMAX', 'Row IMAX-E', 'GLASSES-3D-006', 'Standard No-Motion', NULL, NULL),
(98, 'Langkah Sang Juara', '2026-06-17 14:00:00', 2, '75000.00', 'IMAX', 'IMAX 12-Channel', 'Row IMAX-C', 'GLASSES-3D-007', 'D-BOX Motion Active', NULL, NULL),
(99, 'Cinta di Kota Tua', '2026-06-15 16:00:00', 2, '250000.00', 'Velvet', NULL, 'Sofa-Bed 01', NULL, NULL, 'Premium Quilt Pack A', 'Personal Butler Assigned'),
(100, 'Whisper of the Wind', '2026-06-15 19:30:00', 2, '250000.00', 'Velvet', NULL, 'Sofa-Bed 04', NULL, NULL, 'Premium Quilt Pack A', 'Personal Butler Assigned'),
(101, 'The Shadow of Tomorrow', '2026-06-15 22:15:00', 2, '275000.00', 'Velvet', NULL, 'Sofa-Bed 02', NULL, NULL, 'Luxury Silk Pack B', 'VIP Butler On-Call'),
(102, 'Misteri Rumah Tua', '2026-06-16 15:00:00', 2, '220000.00', 'Velvet', NULL, 'Sofa-Bed 05', NULL, NULL, 'Premium Quilt Pack A', 'Personal Butler Assigned'),
(103, 'Langkah Sang Juara', '2026-06-16 18:15:00', 2, '220000.00', 'Velvet', NULL, 'Sofa-Bed 03', NULL, NULL, 'Premium Quilt Pack A', 'On-Demand Service Only'),
(104, 'Galaksi Terakhir', '2026-06-16 21:30:00', 2, '275000.00', 'Velvet', NULL, 'Sofa-Bed 01', NULL, NULL, 'Luxury Silk Pack B', 'VIP Butler On-Call'),
(105, 'Detektif Buta', '2026-06-17 16:45:00', 2, '200000.00', 'Velvet', NULL, 'Sofa-Bed 06', NULL, NULL, 'Standard Velvet Pack', 'On-Demand Service Only');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  MODIFY `id_tiket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
