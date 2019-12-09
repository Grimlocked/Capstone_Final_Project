-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2019 at 10:18 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `groupproject`
--
CREATE DATABASE IF NOT EXISTS `groupproject` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `groupproject`;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `groupname` varchar(100) NOT NULL,
  `reservedDate` date NOT NULL,
  `color` varchar(10) NOT NULL DEFAULT 'red',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `starttime`, `endtime`, `groupname`, `reservedDate`, `color`) VALUES
(3, '05:00:00', '07:00:00', 'Dota2', '2019-12-25', 'red'),
(4, '15:06:00', '17:06:00', 'Dota3', '2019-12-25', 'red'),
(5, '15:33:00', '16:33:00', 'Dota3', '2019-12-18', 'red'),
(6, '16:34:00', '18:34:00', 'pubq', '2019-12-19', 'purple'),
(7, '15:41:00', '18:41:00', 'pubq', '2019-12-25', 'lightblue'),
(8, '06:53:00', '06:56:00', 'Dota3', '2019-12-25', 'red');

DELIMITER $$
--
-- Events
--
DROP EVENT `clean`$$
CREATE DEFINER=`root`@`localhost` EVENT `clean` ON SCHEDULE EVERY 1 WEEK STARTS '2019-12-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM reservation WHERE reservation.reservedDate < NOW()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
