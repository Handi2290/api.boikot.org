-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2021 at 12:42 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_code`
--

CREATE TABLE `tbl_code` (
  `id` int(1) NOT NULL,
  `project` int(1) NOT NULL,
  `induk` int(1) NOT NULL,
  `cabang` int(2) NOT NULL,
  `ranting` int(1) NOT NULL,
  `uraian` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_code`
--

INSERT INTO `tbl_code` (`id`, `project`, `induk`, `cabang`, `ranting`, `uraian`) VALUES
(1, 2, 1, 0, 0, 'Overhead');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cr_dtl`
--

CREATE TABLE `tbl_cr_dtl` (
  `cr_id_dtl` int(2) NOT NULL,
  `cr_id_hdr` int(2) NOT NULL,
  `cr_tanggal` date NOT NULL,
  `cr_dtl_nominal` int(50) NOT NULL,
  `cr_uraian` varchar(300) NOT NULL,
  `cr_user` varchar(15) NOT NULL,
  `cr_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cr_updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cr_created_by` varchar(15) NOT NULL,
  `cr_updated_by` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cr_dtl`
--

INSERT INTO `tbl_cr_dtl` (`cr_id_dtl`, `cr_id_hdr`, `cr_tanggal`, `cr_dtl_nominal`, `cr_uraian`, `cr_user`, `cr_created_at`, `cr_updated_at`, `cr_created_by`, `cr_updated_by`) VALUES
(1, 1, '2021-12-24', 500000, 'cr untuk overhead', 'admin', '2021-12-25 00:40:54', '0000-00-00 00:00:00', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cr_hdr`
--

CREATE TABLE `tbl_cr_hdr` (
  `cr_id_hdr` int(2) NOT NULL,
  `cr_no_hdr` int(3) NOT NULL,
  `cr_foto` varchar(300) NOT NULL,
  `cr_tanggal` date NOT NULL,
  `cr_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cr_updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cr_hdr`
--

INSERT INTO `tbl_cr_hdr` (`cr_id_hdr`, `cr_no_hdr`, `cr_foto`, `cr_tanggal`, `cr_created_at`, `cr_updated_at`) VALUES
(1, 1, 'foto.jpg', '2021-12-24', '2021-12-24 02:25:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `avatar` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(256) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `role_id`, `password`, `is_active`, `created_at`) VALUES
(1, 'Administrator', 'admin@boikot.org', 'avatar.png', 1, 'a883902a7959246b3bdb248c44af93ed3469a3cf2c9cf3a36da5a4be4539d45f', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Superadmin'),
(2, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_code`
--
ALTER TABLE `tbl_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cr_dtl`
--
ALTER TABLE `tbl_cr_dtl`
  ADD PRIMARY KEY (`cr_id_dtl`),
  ADD KEY `cr_id_hdr` (`cr_id_hdr`);

--
-- Indexes for table `tbl_cr_hdr`
--
ALTER TABLE `tbl_cr_hdr`
  ADD PRIMARY KEY (`cr_id_hdr`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_code`
--
ALTER TABLE `tbl_code`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cr_dtl`
--
ALTER TABLE `tbl_cr_dtl`
  MODIFY `cr_id_dtl` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cr_hdr`
--
ALTER TABLE `tbl_cr_hdr`
  MODIFY `cr_id_hdr` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cr_hdr`
--
ALTER TABLE `tbl_cr_hdr`
  ADD CONSTRAINT `tbl_cr_hdr_ibfk_1` FOREIGN KEY (`cr_id_hdr`) REFERENCES `tbl_cr_dtl` (`cr_id_hdr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
