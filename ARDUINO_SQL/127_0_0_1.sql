-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myarduinodb`
--
CREATE DATABASE IF NOT EXISTS `myarduinodb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `myarduinodb`;

-- --------------------------------------------------------

--
-- Table stucture for table `arduino`
--

CREATE TABLE `arduino` (
  `value` float NOT NULL,
  `time1` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Load sent data `arduino`
--

INSERT INTO `arduino` (`value`, `time1`) VALUES
(44, '2021-04-30 04:40:57'),
(44, '2021-04-30 04:41:02'),
(44, '2021-04-30 04:41:07'),
(81, '2021-04-30 04:41:12'),
(50, '2021-04-30 04:41:22'),
(46, '2021-04-30 04:41:27'),
(47, '2021-04-30 04:41:37'),
(47, '2021-04-30 04:41:42'),
(78, '2021-04-30 04:41:47'),
(52, '2021-04-30 04:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `average`
--

CREATE TABLE `average` (
  `average` float NOT NULL,
  `day` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Load sent data `average`
--

INSERT INTO `average` (`average`, `day`) VALUES
(53.3, '2021-04-30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
