-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 10:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical_record`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_dokter`
--

CREATE TABLE `data_dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `spesialisasi` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_dokter`
--

INSERT INTO `data_dokter` (`id_dokter`, `nama_dokter`, `spesialisasi`, `user_type`, `username`, `password`) VALUES
(6, 'Dr. Sukamto Irawan', 'Dokter Umum', 'Dokter', 'sukamto123', '$2y$10$MtcI4fFV69XPh8N2ju9yruobojqonUlRWdmZSx9EO5b2BnK4byk..'),
(7, 'Dr. Galuh Raras Pramesti', 'Dokter Umum', 'Dokter', 'galuh123', '$2y$10$XOEwouvjRJ3cPe93uNJXcedvpZ31K2tONX7QvM0JF3MY1h0VsXB6.'),
(8, 'Drg. Wahyu Alfin Fauziah', 'Dokter Gigi', 'Dokter', 'wahyu123', '$2y$10$W3MFGnN/bmEjtOifMs7a7Oze.CXyzqiY4b9q2zDG5qq2u7ESoAWJ.');

-- --------------------------------------------------------

--
-- Table structure for table `data_pasien`
--

CREATE TABLE `data_pasien` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `poli` varchar(25) NOT NULL,
  `nomor_rekam_medis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pasien`
--

INSERT INTO `data_pasien` (`id`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `status`, `pekerjaan`, `telepon`, `poli`, `nomor_rekam_medis`) VALUES
(11, '31212i314', 'test only', 'jakarta', '2002-12-14', 'jl jkt', 'Laki-laki', 'Menikah', 'pengangguran profesional', '08977777', 'Poli Umum', '000002'),
(12, '323243', 'tes dulu', 'jakarta', '2019-03-05', 'jl. iya', 'Laki-laki', 'Menikah', 'pengangguran', '08977777', 'Poli Gigi', '000003'),
(14, '12121', 'tes lagi', 'jakarta', '1999-03-12', 'jl tesss', 'Laki-laki', 'Lajang', 'ada', '021111', 'Poli Gigi', '000004'),
(15, '31212', 'kevin', 'jakarta', '1998-04-23', 'jl iya', 'Laki-laki', 'Lajang', 'pengangguran', '089877', 'Poli Umum', '000005');

-- --------------------------------------------------------

--
-- Table structure for table `data_poli`
--

CREATE TABLE `data_poli` (
  `id_poli` int(11) NOT NULL,
  `nama_poli` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_poli`
--

INSERT INTO `data_poli` (`id_poli`, `nama_poli`) VALUES
(1, 'Poliklinik Umum'),
(2, 'Poliklinik Gigi'),
(3, 'Poliklinik KIA');

-- --------------------------------------------------------

--
-- Table structure for table `data_staff`
--

CREATE TABLE `data_staff` (
  `id_staff` int(11) NOT NULL,
  `nama_staff` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_staff`
--

INSERT INTO `data_staff` (`id_staff`, `nama_staff`, `username`, `password`, `email`, `alamat`, `telepon`, `tanggal_lahir`, `jenis_kelamin`, `user_type`) VALUES
(2, 'andri', 'andri123', '$2y$10$bQP2OBGFCi3J3fLk6ysZFePNcJy/wzalQWlE4t1xaBMUKSreUkXpm', '', NULL, NULL, NULL, NULL, 'Staff'),
(3, 'tes lagi', 'tes123', '$2y$10$ROkNlr4fF1z6/ufTEq5U9eq.vaNONNsQc8FQ.a3vl8qLyqeiCpLxa', '', NULL, NULL, NULL, NULL, 'Staff'),
(4, 'tes', 'tesw12', '$2y$10$hm1Cuojrc2Nom1AbXxrcZuaW0mIlFA3I2cDzdWza1S.JrpesWM81u', '', NULL, NULL, NULL, NULL, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` int(11) NOT NULL,
  `nomor_rekam_medis` varchar(10) NOT NULL,
  `nama_pasien` varchar(225) DEFAULT NULL,
  `keluhan_utama` text DEFAULT NULL,
  `keluhan_tambahan` text DEFAULT NULL,
  `berat_badan` decimal(5,2) DEFAULT NULL,
  `cara_berjalan` text DEFAULT NULL,
  `menopang_duduk` text DEFAULT NULL,
  `imt_kurang` enum('Ya','Tidak') DEFAULT NULL,
  `kehilangan_bb` enum('Ya','Tidak') DEFAULT NULL,
  `penurunan_asupan` enum('Ya','Tidak') DEFAULT NULL,
  `sakit_berat` text DEFAULT NULL,
  `diagnosa` text NOT NULL,
  `waktu_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id`, `nomor_rekam_medis`, `nama_pasien`, `keluhan_utama`, `keluhan_tambahan`, `berat_badan`, `cara_berjalan`, `menopang_duduk`, `imt_kurang`, `kehilangan_bb`, `penurunan_asupan`, `sakit_berat`, `diagnosa`, `waktu_input`) VALUES
(12, '', 'test only', 'perut sakit', '', 78.00, '', '', 'Tidak', 'Tidak', 'Ya', 'tidak', 'maag', '2023-09-27 02:20:23'),
(13, '', 'tes dulu', 'sakit perut', '', 87.00, '', 'tidak', 'Ya', 'Tidak', 'Ya', 'tidak', 'maag', '2023-09-28 09:04:39'),
(17, '', 'kevin', 'ngantukan', '', 100.00, 'Tidak Seimbang', 'tidak', 'Tidak', 'Ya', 'Tidak', 'tidak', 'emang ngantuk', '2023-10-14 06:21:18'),
(26, '000006', 'fuad', 'Badan Lemas', 'lemes', 98.00, 'Tidak Seimbang', 'tidak', 'Tidak', 'Tidak', 'Ya', 'tidak', 'masih tes', '2023-10-29 04:39:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_dokter`
--
ALTER TABLE `data_dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `data_pasien`
--
ALTER TABLE `data_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_poli`
--
ALTER TABLE `data_poli`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `data_staff`
--
ALTER TABLE `data_staff`
  ADD PRIMARY KEY (`id_staff`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama_pasien` (`nama_pasien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_dokter`
--
ALTER TABLE `data_dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_pasien`
--
ALTER TABLE `data_pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `data_poli`
--
ALTER TABLE `data_poli`
  MODIFY `id_poli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_staff`
--
ALTER TABLE `data_staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
