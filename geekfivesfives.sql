-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2011 at 07:15 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `geekfives`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `name` varchar(200) NOT NULL,
  `comment` varchar(5000) NOT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`name`, `comment`, `id`) VALUES
('', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `date`
--

CREATE TABLE IF NOT EXISTS `date` (
  `date` date NOT NULL,
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `date`
--


-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` varchar(4) COLLATE utf8_bin NOT NULL,
  `name` varchar(400) COLLATE utf8_bin NOT NULL,
  `twitter` varchar(400) COLLATE utf8_bin NOT NULL,
  `status` varchar(400) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `email`
--

