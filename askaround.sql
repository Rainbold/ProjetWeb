-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2014 at 10:34 AM
-- Server version: 5.5.35
-- PHP Version: 5.4.4-14+deb7u8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `askaround`
--
CREATE DATABASE `askaround` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `askaround`;

-- --------------------------------------------------------

--
-- Table structure for table `aa_users`
--

CREATE TABLE IF NOT EXISTS `aa_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `color` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `aa_users`
--

INSERT INTO `aa_users` (`id`, `pseudo`, `email`, `password`, `color`) VALUES
(1, 'pseudo', 'test@test.fr', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '82c2cf'),
(2, 'RainbowLyte', 'test@aei.fr', '1fb0e331c05a52d5eb847d6fc018320d', '82c2cf'),
(3, 'Maxime', 'max@lyte.fr', '05a671c66aefea124cc08b76ea6d30bb', '65be04'),
(4, 'RainbowLyte42', 'rootazdaz@azdazd.fr', 'fb907665e5a25cd116c79c122ebc1e4f', 'ae57d4'),
(5, 'zefzef', 'root@root.fr', 'c9cfe3fc782e26917a95e00eb4c27509', '3f3e71');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
