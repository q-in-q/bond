-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2020 at 07:57 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bond`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`username`, `nama`, `password`) VALUES
('admin', 'Administrator', '202cb962ac59075b964b07152d234b70'),
('fausa', 'fausa', 'caf1a3dfb505ffed0d024130f58c5cfa'),
('noc2', 'Noc 2', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `idlog` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `jam` time NOT NULL DEFAULT current_timestamp(),
  `nama` varchar(25) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`idlog`, `tanggal`, `jam`, `nama`, `keterangan`) VALUES
(175, '2020-07-03', '08:12:34', 'Administrator', 'BondSQ Client NRT 300 berhasil ditambahkan oleh Administrator'),
(176, '2020-07-03', '08:12:56', 'Administrator', 'BondSQ Client NRT 300 berhasil update oleh Administrator'),
(177, '2020-07-03', '08:13:45', 'Administrator', 'BondSQ Client NRT 300 berhasil perpanjang / diupdate oleh Administrator'),
(178, '2020-07-03', '08:14:14', 'Administrator', 'BondSQ Client NRT 300 berhasil dihapus oleh Administrator'),
(179, '2020-07-03', '08:14:39', 'Administrator', 'BondQT Facebook berhasil ditambahkan oleh Administrator'),
(180, '2020-07-03', '08:24:40', 'Administrator', 'BondSQ Client NRT 300 berhasil ditambahkan oleh Administrator'),
(181, '2020-07-03', '08:25:17', 'Administrator', 'BondSQ Client NRT 300 berhasil perpanjang / diupdate oleh Administrator'),
(182, '2020-07-03', '08:33:23', 'Administrator', 'BondSQ Client NRT 300 berhasil ditambahkan oleh Administrator'),
(183, '2020-07-03', '08:48:28', 'Administrator', 'BondSQ Client NRT 300 berhasil ditambahkan oleh Administrator'),
(184, '2020-07-03', '15:50:23', 'Administrator', 'BondSQ Client NRT 300 berhasil ditambahkan oleh Administrator'),
(185, '2020-07-03', '15:55:25', 'Administrator', 'BondQT Facebook berhasil ditambahkan oleh Administrator'),
(186, '2020-07-03', '17:47:21', 'Administrator', 'BondQT Facebook berhasil dihapus oleh Administrator'),
(187, '2020-07-03', '17:53:09', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(188, '2020-07-03', '17:53:19', 'Administrator', 'BondQT Client NRT 10 berhasil dihapus oleh Administrator'),
(189, '2020-07-03', '17:53:37', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(190, '2020-07-03', '17:54:17', 'Administrator', 'BondSQ Client NRT 300 berhasil dihapus oleh Administrator'),
(191, '2020-07-03', '17:54:21', 'Administrator', 'BondQT Client NRT 10 berhasil dihapus oleh Administrator'),
(192, '2020-07-03', '17:55:14', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(193, '2020-07-03', '17:56:57', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(194, '2020-07-03', '17:59:47', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(195, '2020-07-03', '18:07:57', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(196, '2020-07-03', '18:08:11', 'Administrator', 'BondQT Client NRT 10 berhasil dihapus oleh Administrator'),
(197, '2020-07-03', '18:20:05', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(198, '2020-07-03', '18:27:28', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(199, '2020-07-03', '18:27:53', 'Administrator', 'BondQT Client NRT 10 berhasil dihapus oleh Administrator'),
(200, '2020-07-03', '18:28:48', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(201, '2020-07-03', '18:29:32', 'Administrator', 'BondSQ Client NRT 10 berhasil diupdate oleh Administrator'),
(202, '2020-07-03', '18:32:45', 'Administrator', 'BondSQ Client NRT 10 berhasil perpanjang / diupdate oleh Administrator'),
(203, '2020-07-03', '18:33:07', 'Administrator', 'BondQT Client NRT 10 berhasil dihapus oleh Administrator'),
(204, '2020-07-03', '18:47:01', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(205, '2020-07-04', '14:44:40', 'Administrator', 'BondSQ Client NRT 10 berhasil perpanjang / diupdate oleh Administrator'),
(206, '2020-07-04', '14:45:23', 'Administrator', 'BondSQ Client NRT 10 berhasil perpanjang / diupdate oleh Administrator'),
(207, '2020-07-04', '14:45:36', 'Administrator', 'BondSQ Client NRT 10 berhasil perpanjang / diupdate oleh Administrator'),
(208, '2020-07-04', '14:46:19', 'Administrator', 'BondSQ Client NRT 10 berhasil perpanjang / diupdate oleh Administrator'),
(209, '2020-07-04', '14:46:40', 'Administrator', 'BondQT Client NRT 10 berhasil dihapus oleh Administrator'),
(210, '2020-07-04', '14:47:11', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(211, '2020-07-04', '14:48:16', 'Administrator', 'BondSQ Client NRT 10 berhasil perpanjang / diupdate oleh Administrator'),
(212, '2020-07-04', '14:48:39', 'Administrator', 'BondSQ Client NRT 10 berhasil perpanjang / diupdate oleh Administrator'),
(213, '2020-07-10', '01:48:07', 'Administrator', 'BondSQ queue5 berhasil ditambahkan oleh Administrator'),
(214, '2020-07-10', '01:48:50', 'Administrator', 'BondSQ queue5 berhasil update oleh Administrator'),
(215, '2020-07-10', '01:49:31', 'Administrator', 'BondSQ queue5 berhasil perpanjang / diupdate oleh Administrator'),
(216, '2020-07-10', '01:50:02', 'Administrator', 'BondSQ queue5 berhasil dihapus oleh Administrator'),
(217, '2020-07-10', '01:50:43', 'Administrator', 'BondSQ queue4 berhasil ditambahkan oleh Administrator'),
(218, '2020-07-10', '01:50:52', 'Administrator', 'BondSQ queue4 berhasil dihapus oleh Administrator'),
(219, '2020-07-10', '01:51:33', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(220, '2020-07-10', '01:52:30', 'Administrator', 'BondSQ Client NRT 10 berhasil diupdate oleh Administrator'),
(221, '2020-07-10', '01:53:03', 'Administrator', 'BondQT Client NRT 10 berhasil dihapus oleh Administrator'),
(222, '2020-07-10', '01:53:38', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(223, '2020-07-10', '01:54:22', 'Administrator', 'BondSQ Client NRT 10 berhasil perpanjang / diupdate oleh Administrator'),
(224, '2020-07-10', '01:54:54', 'Administrator', 'BondQT Client NRT 10 berhasil dihapus oleh Administrator'),
(225, '2020-07-10', '01:55:29', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(226, '2020-07-10', '02:03:30', 'Administrator', 'BondQT Client NRT 10 berhasil dihapus oleh Administrator'),
(227, '2020-07-10', '02:03:47', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(228, '2020-07-10', '02:15:35', 'Administrator', 'BondSQ Client NRT 300 berhasil ditambahkan oleh Administrator'),
(229, '2020-07-10', '02:29:45', 'Administrator', 'BondSQ Client NRT 300 berhasil ditambahkan oleh Administrator'),
(230, '2020-07-10', '02:30:01', 'Administrator', 'BondSQ Client NRT 300 berhasil update oleh Administrator'),
(231, '2020-07-10', '02:30:44', 'Administrator', 'BondSQ Client NRT 300 berhasil perpanjang / diupdate oleh Administrator'),
(232, '2020-07-10', '02:31:05', 'Administrator', 'BondSQ Client NRT 300 berhasil perpanjang / diupdate oleh Administrator'),
(233, '2020-07-10', '02:31:35', 'Administrator', 'BondSQ Client NRT 300 berhasil dihapus oleh Administrator'),
(234, '2020-07-10', '02:39:14', 'Administrator', 'BondSQ Client NRT 300 berhasil ditambahkan oleh Administrator'),
(235, '2020-07-10', '02:39:45', 'Administrator', 'BondSQ Client NRT 300 berhasil dihapus oleh Administrator'),
(236, '2020-07-10', '02:39:57', 'Administrator', 'BondSQ queue5 berhasil ditambahkan oleh Administrator'),
(237, '2020-07-10', '02:40:30', 'Administrator', 'BondSQ queue5 berhasil dihapus oleh Administrator'),
(238, '2020-07-10', '02:40:55', 'Administrator', 'BondSQ test berhasil ditambahkan oleh Administrator'),
(239, '2020-07-10', '17:05:00', 'Administrator', 'User baru berhasil ditambahkan oleh Administrator'),
(240, '2020-07-10', '17:05:21', 'Administrator', 'User noc berhasil dihapus oleh Administrator'),
(241, '2020-07-10', '17:05:44', 'Administrator', 'User admin berhasil diupdate oleh Administrator'),
(242, '2020-07-10', '17:06:00', 'Administrator', 'User admin berhasil diupdate oleh Administrator'),
(243, '2020-07-16', '22:20:22', 'Administrator', 'BondSQ Client NRT 200 berhasil ditambahkan oleh Administrator'),
(244, '2020-07-16', '22:22:15', 'Administrator', 'BondSQ Client NRT 200 berhasil ditambahkan oleh Administrator'),
(245, '2020-07-16', '22:22:48', 'Administrator', 'BondSQ Client NRT 200 berhasil dihapus oleh Administrator'),
(246, '2020-07-16', '22:42:00', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(247, '2020-07-16', '22:47:09', 'Administrator', 'BondSQ Client NRT 200 berhasil ditambahkan oleh Administrator'),
(248, '2020-07-16', '23:05:25', 'Administrator', 'BondQT Client NRT 10 berhasil dihapus oleh Administrator'),
(249, '2020-07-16', '23:05:45', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator'),
(250, '2020-07-16', '23:05:55', 'Administrator', 'BondSQ Client NRT 200 berhasil update oleh Administrator'),
(251, '2020-07-16', '23:06:18', 'Administrator', 'BondSQ Client NRT 10 berhasil diupdate oleh Administrator'),
(252, '2020-07-16', '23:06:40', 'Administrator', 'BondSQ Client NRT 200 berhasil update oleh Administrator'),
(253, '2020-07-16', '23:06:50', 'Administrator', 'BondSQ Client NRT 10 berhasil diupdate oleh Administrator'),
(254, '2020-07-16', '23:07:12', 'Administrator', 'BondSQ Client NRT 10 berhasil diupdate oleh Administrator'),
(255, '2020-07-16', '23:07:50', 'Administrator', 'BondSQ Client NRT 10 berhasil diupdate oleh Administrator'),
(256, '2020-07-16', '23:08:56', 'Administrator', 'BondQT Client NRT 10 berhasil dihapus oleh Administrator'),
(257, '2020-07-16', '23:14:23', 'Administrator', 'BondSQ Client NRT 300 berhasil ditambahkan oleh Administrator'),
(258, '2020-07-16', '23:24:06', 'Administrator', 'BondSQ Client NRT 300 berhasil update oleh Administrator'),
(259, '2020-07-21', '12:47:57', 'Administrator', 'BondQT Client NRT 10 berhasil ditambahkan oleh Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tb_queuetree`
--

CREATE TABLE `tb_queuetree` (
  `idqt` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `bandwidth_awal_up` varchar(25) NOT NULL,
  `bandwidth_awal_down` varchar(25) NOT NULL,
  `bandwidth_up` varchar(25) NOT NULL,
  `bandwidth_down` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_queuetree`
--

INSERT INTO `tb_queuetree` (`idqt`, `nama`, `tanggal_mulai`, `tanggal_selesai`, `bandwidth_awal_up`, `bandwidth_awal_down`, `bandwidth_up`, `bandwidth_down`) VALUES
(38, 'Client NRT 10', '2020-07-04', '2020-07-05', '1M/2M', '1M/2M', '1M/5M', '1M/5M'),
(42, 'Client NRT 10', '2020-07-10', '2020-07-10', '5M/5M', '5M/5M', '6M/6M', '6M/6M'),
(45, 'Client NRT 10', '2020-07-21', '2020-07-22', '5M/5M', '5M/5M', '10M/10M', '10M/10M');

-- --------------------------------------------------------

--
-- Table structure for table `tb_simplequeue`
--

CREATE TABLE `tb_simplequeue` (
  `idsq` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `bandwidth_awal` varchar(25) NOT NULL,
  `bandwidth_up` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_simplequeue`
--

INSERT INTO `tb_simplequeue` (`idsq`, `nama`, `tanggal_mulai`, `tanggal_selesai`, `bandwidth_awal`, `bandwidth_up`) VALUES
(27, 'Client NRT 300', '2020-07-03', '2020-07-11', '8M/8M', '15M/15M'),
(37, 'test', '2020-07-10', '2020-07-10', '15M/15M', '13M/13M'),
(38, 'Client NRT 200', '2020-07-16', '2020-07-19', '1M/1M', '13M/13M'),
(40, 'Client NRT 200', '2020-07-16', '2020-07-19', '1M/1M', '13M/13M'),
(41, 'Client NRT 300', '2020-07-16', '2020-07-25', '15M/15M', '10M/10M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`idlog`);

--
-- Indexes for table `tb_queuetree`
--
ALTER TABLE `tb_queuetree`
  ADD PRIMARY KEY (`idqt`);

--
-- Indexes for table `tb_simplequeue`
--
ALTER TABLE `tb_simplequeue`
  ADD PRIMARY KEY (`idsq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `tb_queuetree`
--
ALTER TABLE `tb_queuetree`
  MODIFY `idqt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tb_simplequeue`
--
ALTER TABLE `tb_simplequeue`
  MODIFY `idsq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
