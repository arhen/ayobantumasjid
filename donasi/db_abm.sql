-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2015 at 01:01 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_abm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_donasi`
--

CREATE TABLE IF NOT EXISTS `tbl_donasi` (
`id` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nop` varchar(16) NOT NULL,
  `email` varchar(25) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `bank` varchar(15) NOT NULL,
  `bukti` varchar(150) NOT NULL,
  `konfirmasi` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prior`
--

CREATE TABLE IF NOT EXISTS `tbl_prior` (
  `id` int(1) NOT NULL DEFAULT '1',
  `id_proyek` int(11) DEFAULT NULL,
  `prior` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prior`
--

INSERT INTO `tbl_prior` (`id`, `id_proyek`, `prior`) VALUES
(1, 7, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proyek`
--

CREATE TABLE IF NOT EXISTS `tbl_proyek` (
`id_proyek` int(11) NOT NULL,
  `nama_proyek` varchar(90) NOT NULL DEFAULT '0',
  `total` varchar(200) DEFAULT '0',
  `konfirm` varchar(2) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `id_session` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `id_session`) VALUES
('admin', 'admin', 'Admin', 'jjvnrdv98crrkublkc3dqi8lv7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_donasi`
--
ALTER TABLE `tbl_donasi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_prior`
--
ALTER TABLE `tbl_prior`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_proyek`
--
ALTER TABLE `tbl_proyek`
 ADD PRIMARY KEY (`id_proyek`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_donasi`
--
ALTER TABLE `tbl_donasi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbl_proyek`
--
ALTER TABLE `tbl_proyek`
MODIFY `id_proyek` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
