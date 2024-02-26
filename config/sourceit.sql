-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 26, 2024 at 07:22 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sourceit`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
CREATE TABLE IF NOT EXISTS `matches` (
  `id_match` int NOT NULL AUTO_INCREMENT,
  `map` varchar(99) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `scoreA` int NOT NULL,
  `scoreB` int NOT NULL,
  `av_level` int NOT NULL,
  `m_state` int NOT NULL,
  `players` varchar(9999) NOT NULL,
  `serverport` int NOT NULL,
  `runningserverhandle` int NOT NULL,
  PRIMARY KEY (`id_match`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id_match`, `map`, `scoreA`, `scoreB`, `av_level`, `m_state`, `players`, `serverport`, `runningserverhandle`) VALUES
(2, 'vertigo', 0, 0, 0, 6, '[\'1\',\'4\',\'668\',\'670\']', 27015, 1),
(6, 'vertigo', 16, 3, 0, 0, '[fakezaopae]', 27016, 0),
(7, 'vertigo', 15, 15, 115, 0, '[fakezaopae]', 27017, 0),
(8, 'vertigo', 4, 16, 2200, 0, '[fakezaopae]', 27018, 0),
(9, 'vertigo', 15, 15, 444, 0, '[fakezaopae]', 27019, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(999) NOT NULL,
  `passwords` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gamename` varchar(9999) NOT NULL,
  `alevel` int NOT NULL,
  `matches` varchar(999) NOT NULL,
  `ac_match` int NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=671 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `passwords`, `gamename`, `alevel`, `matches`, `ac_match`) VALUES
(1, '0gudu', 'sjoaburro', 'gudu765', 0, '[\'2\']', 2),
(3, 'gudu765', '$2y$10$XUSaQgFl6gAknQ0jPbaYCuwOKeH1Ucnetr9xVzUFl8uV7kZwvAd3u', 'gudu765', 0, '', 0),
(4, 'oioi', '$2y$10$jhXVCGl/QA9Y/CU1Jmj7YeI.7V6L2zr9kIJMeyziPslTas2Nw1y0C', 'gudu765', 0, '[\"2\"]', 2),
(668, '12', '$2y$10$DxxleCfkgzeBO0cfH58WJedd1/3.zElhVVX4xmHRN7yWgztsCINCq', 'gudu765', 0, '[\"2\"]', 2),
(670, '13', '$2y$10$9Pwe6BxmXEzgI49FyadEvO7BylPb7wDTbm3bvPs5tiDXpqBE60OyK', 'gudu765', 0, '[\"2\"]', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
