-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jun 16, 2024 at 05:32 AM
-- Server version: 10.10.3-MariaDB-1:10.10.3+maria~ubu2204
-- PHP Version: 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mk`
--

-- --------------------------------------------------------

--
-- Table structure for table `kurs`
--

CREATE TABLE `kurs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `uch_zav` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `type` int(11) NOT NULL,
  `spec` varchar(255) NOT NULL,
  `kvl` varchar(255) NOT NULL,
  `kl_c` int(11) NOT NULL,
  `prep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kurs_type`
--

CREATE TABLE `kurs_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kurs_type`
--

INSERT INTO `kurs_type` (`id`, `name`) VALUES
(1, 'Образование'),
(2, 'Курсы');

-- --------------------------------------------------------

--
-- Table structure for table `prep`
--

CREATE TABLE `prep` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'root', 'root');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kurs`
--
ALTER TABLE `kurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `prep_id` (`prep_id`);

--
-- Indexes for table `kurs_type`
--
ALTER TABLE `kurs_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `prep`
--
ALTER TABLE `prep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kurs`
--
ALTER TABLE `kurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurs_type`
--
ALTER TABLE `kurs_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prep`
--
ALTER TABLE `prep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kurs`
--
ALTER TABLE `kurs`
  ADD CONSTRAINT `kurs_ibfk_1` FOREIGN KEY (`type`) REFERENCES `kurs_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kurs_ibfk_2` FOREIGN KEY (`prep_id`) REFERENCES `prep` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
