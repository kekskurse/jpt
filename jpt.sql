-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 22, 2014 at 05:28 PM
-- Server version: 5.5.32-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jpt`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `username` varchar(255) NOT NULL,
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access`
--


-- --------------------------------------------------------

--
-- Table structure for table `listen_entries`
--

CREATE TABLE IF NOT EXISTS `listen_entries` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `liste` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `liste` (`liste`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `listen_felder`
--

CREATE TABLE IF NOT EXISTS `listen_felder` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `liste` int(255) NOT NULL,
  `typ` enum('int','string','text') NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `liste` (`liste`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `listen_listen`
--

CREATE TABLE IF NOT EXISTS `listen_listen` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `aktiv` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `listen_listen`
--

INSERT INTO `listen_listen` (`id`, `name`, `aktiv`) VALUES
(1, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `listen_value`
--

CREATE TABLE IF NOT EXISTS `listen_value` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `entry` int(255) NOT NULL,
  `feld` int(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `entry` (`entry`),
  KEY `feld` (`feld`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lokogruppen`
--

CREATE TABLE IF NOT EXISTS `lokogruppen` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `more` text,
  `aktiv` tinyint(1) NOT NULL DEFAULT '0',
  `bundesland` enum('baden-württemberg','bayern','berlin','brandenburg','bremen','hamburg','hessen','mecklenburg-vorpommern','niedersachsen','nordrhein-westfalen','rheinland-pfalz','saarland','sachsen','sachsen-anhalt','schleswig-holstein','thueringen') DEFAULT NULL,
  `typ` enum('crew','lo','lv','treffen','stammtisch','sonstiges') NOT NULL,
  `wiki` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `lokogruppen`
--



-- --------------------------------------------------------

--
-- Table structure for table `lokomenschen`
--

CREATE TABLE IF NOT EXISTS `lokomenschen` (
  `twitter` varchar(255) NOT NULL,
  UNIQUE KEY `twitter` (`twitter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokomenschen`
--


-- --------------------------------------------------------

--
-- Table structure for table `lokopeople`
--

CREATE TABLE IF NOT EXISTS `lokopeople` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `group` int(255) NOT NULL,
  `more` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `group` (`group`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `lokopeople`
--

-- Constraints for dumped tables
--

--
-- Constraints for table `listen_entries`
--
ALTER TABLE `listen_entries`
  ADD CONSTRAINT `listen_entries_ibfk_1` FOREIGN KEY (`liste`) REFERENCES `listen_listen` (`id`);

--
-- Constraints for table `listen_felder`
--
ALTER TABLE `listen_felder`
  ADD CONSTRAINT `listen_felder_ibfk_1` FOREIGN KEY (`liste`) REFERENCES `listen_listen` (`id`);

--
-- Constraints for table `listen_value`
--
ALTER TABLE `listen_value`
  ADD CONSTRAINT `listen_value_ibfk_2` FOREIGN KEY (`feld`) REFERENCES `listen_felder` (`id`),
  ADD CONSTRAINT `listen_value_ibfk_1` FOREIGN KEY (`entry`) REFERENCES `listen_entries` (`id`);

--
-- Constraints for table `lokopeople`
--
ALTER TABLE `lokopeople`
  ADD CONSTRAINT `lokopeople_ibfk_1` FOREIGN KEY (`group`) REFERENCES `lokogruppen` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
