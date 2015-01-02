-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2014 at 08:17 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ot3`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `current_number` int(111) NOT NULL DEFAULT '1',
  `state` enum('waiting','starting','inprogress','completed') CHARACTER SET hp8 COLLATE hp8_bin NOT NULL DEFAULT 'waiting',
  `nop` int(111) NOT NULL DEFAULT '1',
  `sstring` varchar(255) DEFAULT '{"id":"0","no":"0"}',
  `xdim` int(11) NOT NULL,
  `ydim` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `current_number`, `state`, `nop`, `sstring`, `xdim`, `ydim`) VALUES
(71, 1, 'starting', 1, '{"id":"1","no":"37"}', 320, 544),
(72, 1, 'starting', 1, '{"id":"1","no":"33"}', 320, 496),
(73, 1, 'starting', 1, '{"id":"1","no":"33"}', 320, 496),
(74, 1, 'starting', 1, '{"id":"1","no":"33"}', 320, 496),
(75, 1, 'starting', 1, '{"id":"1","no":"33"}', 320, 496),
(76, 1, 'starting', 1, '{"id":"1","no":"33"}', 320, 496),
(77, 1, 'starting', 1, '{"id":"1","no":"33"}', 320, 496),
(78, 1, 'starting', 1, '{"id":"1","no":"33"}', 320, 496),
(79, 1, 'starting', 1, '{"id":"1","no":"33"}', 320, 496),
(80, 1, 'starting', 1, '{"id":"2","no":"33"}', 320, 496),
(81, 1, 'starting', 1, '{"id":"1","no":"33"}', 320, 496),
(82, 1, 'starting', 1, '{"id":"1","no":"33"}', 320, 496),
(83, 1, 'starting', 1, '{"id":"1","no":"30"}', 320, 457),
(84, 1, 'starting', 1, '{"id":"2","no":"30"}', 320, 457),
(85, 1, 'starting', 1, '{"id":"1","no":"33"}', 320, 496),
(86, 1, 'starting', 1, '{"id":"2","no":"33"}', 320, 496),
(87, 1, 'starting', 1, '{"id":"2","no":"33"}', 320, 496),
(88, 1, 'starting', 1, '{"id":"3","no":"29"}', 1024, 667),
(89, 1, 'starting', 1, '{"id":"3","no":"39"}', 1024, 667);

-- --------------------------------------------------------

--
-- Table structure for table `match_players`
--

CREATE TABLE IF NOT EXISTS `match_players` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `player_id` int(111) NOT NULL,
  `match_id` int(111) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `color` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=188 ;

--
-- Dumping data for table `match_players`
--

INSERT INTO `match_players` (`id`, `player_id`, `match_id`, `score`, `color`) VALUES
(148, 2, 71, 13, 'blue'),
(149, 1, 71, 24, 'red'),
(150, 1, 72, 24, 'blue'),
(151, 2, 72, 9, 'red'),
(152, 1, 73, 25, 'blue'),
(153, 2, 74, 8, 'blue'),
(154, 1, 74, 25, 'red'),
(155, 2, 73, 8, 'red'),
(156, 2, 75, 25, 'blue'),
(157, 1, 75, 8, 'red'),
(158, 1, 76, 13, 'blue'),
(159, 2, 76, 20, 'red'),
(160, 1, 77, 20, 'blue'),
(161, 2, 77, 13, 'red'),
(162, 2, 78, 11, 'blue'),
(163, 1, 79, 19, 'blue'),
(164, 1, 78, 22, 'red'),
(165, 2, 79, 14, 'red'),
(166, 1, 80, 24, 'blue'),
(167, 2, 80, 9, 'red'),
(168, 1, 81, 20, 'blue'),
(169, 2, 81, 14, 'red'),
(170, 2, 82, 0, 'blue'),
(171, 1, 82, 33, 'red'),
(172, 2, 83, 7, 'blue'),
(173, 20, 83, 1, 'red'),
(174, 1, 83, 22, 'yellow'),
(175, 20, 84, 0, 'blue'),
(176, 2, 84, 12, 'red'),
(177, 1, 84, 18, 'yellow'),
(178, 1, 85, 17, 'blue'),
(179, 2, 85, 16, 'red'),
(180, 2, 86, 26, 'blue'),
(181, 21, 86, 7, 'red'),
(182, 2, 87, 33, 'blue'),
(183, 3, 87, 0, 'red'),
(184, 2, 88, 11, 'blue'),
(185, 3, 88, 18, 'red'),
(186, 2, 89, 18, 'blue'),
(187, 3, 89, 21, 'red');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `state` enum('online','ingame','offline') NOT NULL DEFAULT 'offline',
  `wins` int(111) NOT NULL DEFAULT '0',
  `losses` int(111) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `state`, `wins`, `losses`, `password`) VALUES
(1, 'dax', 'online', 0, 0, 'omg'),
(2, 'shax', 'online', 0, 0, 'hint'),
(3, 'dazzle', 'online', 0, 0, 'omg'),
(5, 'kissa', 'online', 0, 0, '244'),
(6, 'isaac', 'online', 0, 0, 'shayo'),
(7, 'shax1', 'online', 0, 0, 'hint'),
(8, 'liz', 'online', 0, 0, 'deus'),
(9, 'nivlek', 'online', 0, 0, 'vinny'),
(10, 'silvia', 'online', 0, 0, 'eddie'),
(12, 'caroline maumba', 'online', 0, 0, 'titto'),
(13, 'd', 'online', 0, 0, 'omg'),
(14, '', 'online', 0, 0, ''),
(15, 'ben', 'online', 0, 0, 'bentilu'),
(16, 'klaus', 'online', 0, 0, 'klaus'),
(17, 'kitozay', 'online', 0, 0, 'ben'),
(18, 'Perfect B mtui', 'online', 0, 0, 'phonerotic'),
(19, 'frankmkunde', 'online', 0, 0, 'mkunde'),
(20, 'Tupokigwe', 'online', 0, 0, 'hikitty'),
(21, 'ntoga', 'online', 0, 0, 'joseph');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
