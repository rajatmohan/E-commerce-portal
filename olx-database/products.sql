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
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `userId` int(10) unsigned NOT NULL,
  `productId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(20) DEFAULT NULL,
  `minPrice` int(10) unsigned DEFAULT NULL,
  `uploadedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(60) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`userId`, `productId`, `category`, `minPrice`, `uploadedTime`, `description`) VALUES
(4, 26, 'books', 4235, '2016-03-29 20:42:07', ''),
(4, 28, 'bucket', 10000, '2016-03-30 06:21:44', ''),
(4, 30, 'bucket', 2356, '2016-03-30 06:22:21', ''),
(3, 32, 'laptops', 12, '2016-03-30 13:21:14', ''),
(4, 33, 'bucket', 44, '2016-03-30 16:39:49', 'gfsdgasdfgh\r\nsndbshjgs\r\nfdsfdsf'),
(6, 34, 'cycle (girls)', 55445, '2016-03-30 17:45:07', '898'),
(6, 35, 'mattress', 0, '2016-03-30 17:45:31', 'iutgiutgu'),
(6, 36, 'books', 343, '2016-03-31 07:18:22', 'rur'),
(6, 37, 'books', 121, '2016-04-01 07:41:55', 'ewfd'),
(5, 38, 'cycle (boys)', 444, '2016-04-01 08:33:05', 'aaa'),
(5, 39, 'laptops', 66, '2016-04-01 08:33:32', 'aaa'),
(4, 40, 'laptops', 55, '2016-04-01 08:34:51', 'aaa');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
