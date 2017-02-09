-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2016 at 12:29 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `olx`
--

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `serialNo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `buyerId` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL,
  `bidPrice` int(10) unsigned DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `statusTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted` enum('y','n','h') DEFAULT NULL,
  PRIMARY KEY (`serialNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`serialNo`, `buyerId`, `productId`, `bidPrice`, `time`, `statusTime`, `accepted`) VALUES
(1, 2, 19, 45629, '2016-03-28 13:47:24', '2016-03-28 13:47:24', 'h'),
(3, 3, 26, 5000, '2016-03-30 06:56:27', '2016-04-01 09:24:36', 'h'),
(4, 3, 27, 1346, '2016-03-30 06:56:56', '2016-03-30 06:56:56', 'h'),
(5, 3, 28, 10000, '2016-03-30 13:41:08', '2016-04-01 09:23:08', 'y'),
(6, 3, 29, 1234, '2016-03-30 13:41:17', '2016-03-30 17:14:09', 'n'),
(7, 4, 32, 21, '2016-03-31 18:00:08', '2016-03-31 18:00:08', 'h'),
(14, 4, 34, 55448, '2016-03-31 07:16:55', '2016-03-31 07:16:55', 'h'),
(15, 4, 35, 8, '2016-03-30 17:46:04', '2016-03-30 17:46:54', 'y'),
(18, 4, 36, 34345, '2016-03-31 18:00:42', '2016-03-31 18:00:42', 'h'),
(19, 8, 34, 55444, '2016-03-31 18:21:46', '2016-03-31 18:21:46', 'h'),
(20, 4, 37, 121, '2016-04-01 08:31:29', '2016-04-01 08:31:29', 'h'),
(21, 4, 39, 66, '2016-04-01 08:33:44', '2016-04-01 09:27:07', 'y'),
(22, 4, 38, 444, '2016-04-01 08:33:57', '2016-04-01 09:54:48', 'n'),
(25, 6, 30, 2356, '2016-04-01 09:52:31', '2016-04-01 09:53:22', 'y'),
(26, 6, 33, 44, '2016-04-01 09:52:36', '2016-04-01 09:53:15', 'y'),
(27, 6, 32, 12, '2016-04-01 09:52:39', '2016-04-01 09:54:18', 'y'),
(28, 6, 39, 66, '2016-04-01 09:52:41', '2016-04-01 09:54:40', 'y'),
(30, 6, 38, 4444, '2016-04-01 10:14:49', '2016-04-01 10:14:49', 'h');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
