-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2016 at 12:26 PM
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `password` char(41) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `lastLogout` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `joinDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` enum('m','f') DEFAULT NULL,
  `favoriteItems` varchar(20) DEFAULT NULL,
  `emailAddress` varchar(50) DEFAULT NULL,
  `otherInterests` text,
  `phoneno` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `emailAddress` (`emailAddress`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `lastLogout`, `joinDate`, `gender`, `favoriteItems`, `emailAddress`, `otherInterests`, `phoneno`) VALUES
(3, 'rajat', '*D5B9A187A714422DC9ABB2FC668C4A189425596A', 'rajat', '2016-04-01 09:54:25', '2016-03-28 14:02:27', NULL, NULL, NULL, NULL, '9837058646'),
(4, 'pulkit', '*02AC0895113AD2D4B0FE19190FA03D15E6E9FF63', 'pulkit', '2016-04-01 10:14:03', '2016-03-28 14:03:00', NULL, NULL, 'pulkitgulati9837@gmail.com', NULL, '344'),
(5, 'abc', '*0D3CED9BEC10A777AEC23CCC353A8C08A633045E', 'ABC', '2016-04-01 09:54:57', '2016-03-30 16:35:27', NULL, NULL, 'ffg@hgh.com', NULL, '98888'),
(6, 'a', '*667F407DE7C6AD07358FA38DAED7828A72014B4E', 'A', '2016-04-01 10:14:25', '2016-03-30 17:07:47', NULL, NULL, 'a@a.com', NULL, '9989789'),
(7, 'wq', '*A7A9FADD822492649C01057FB6ADBBC9D2FD02DE', 'WQ', '2016-03-31 18:19:23', '2016-03-31 18:19:23', NULL, NULL, 'qw@2.com', NULL, 'wq'),
(8, 'awawa', '*16863C23B2E91537AEAEDDE9D1B40DA2A975C5DC', 'AWW', '2016-03-31 18:22:29', '2016-03-31 18:20:07', NULL, NULL, 'wqq@qw.com', NULL, '233');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
