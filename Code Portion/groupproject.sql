-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2019 at 09:01 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `starttime`, `endtime`, `groupname`, `reservedDate`, `color`) VALUES
(3, '05:00:00', '07:00:00', 'Dota2', '2019-12-25', 'red'),
(4, '15:06:00', '17:06:00', 'Dota3', '2019-12-25', 'red'),
(5, '15:33:00', '16:33:00', 'Dota3', '2019-12-18', 'red'),
(10, '13:00:00', '15:30:00', 'Overwatch', '2019-12-10', 'purple'),
(8, '06:53:00', '06:56:00', 'Dota3', '2019-12-25', 'red'),
(11, '15:45:00', '17:45:00', 'LOL', '2019-12-10', 'green'),
(12, '13:01:00', '16:00:00', 'Overwatch', '2019-12-11', 'purple'),
(13, '15:51:00', '20:51:00', 'LOL', '2019-12-13', 'green');

<<<<<<< Updated upstream:Code Portion/groupproject.sql
DELIMITER $$
--
-- Events
--
DROP EVENT `clean`$$
CREATE DEFINER=`root`@`localhost` EVENT `clean` ON SCHEDULE EVERY 1 WEEK STARTS '2019-12-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM reservation WHERE reservation.reservedDate < NOW()$$

DELIMITER ;
=======
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'xximagamerxx69', '$2y$10$hA8OqzAwR8HzS3I9.j8SNuYLcRVFsZSRBtg.1afYt06n/qLe0ndGm');
>>>>>>> Stashed changes:Game_App/groupproject.sql
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE users
(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(50) NOT NULL UNIQUE,
password VARCHAR(128) NOT NULL
)


