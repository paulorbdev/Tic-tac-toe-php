-- phpMyAdmin SQL Dump
-- version 4.2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2015 at 08:25 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tictae`
--

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
`id` int(10) NOT NULL,
  `idp1` int(10) NOT NULL,
  `idp2` int(10) NOT NULL,
  `playing` varchar(10) NOT NULL,
  `time` datetime NOT NULL,
  `div0` varchar(2) NOT NULL,
  `div1` varchar(2) NOT NULL,
  `div2` varchar(2) NOT NULL,
  `div3` varchar(2) NOT NULL,
  `div4` varchar(2) NOT NULL,
  `div5` varchar(2) NOT NULL,
  `div6` varchar(2) NOT NULL,
  `div7` varchar(2) NOT NULL,
  `div8` varchar(2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(50) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(128) NOT NULL,
  `nick` varchar(50) CHARACTER SET utf8 NOT NULL,
  `online` datetime NOT NULL,
  `wins` int(11) NOT NULL,
  `defeats` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD UNIQUE KEY `playig` (`playing`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `nick` (`nick`), ADD UNIQUE KEY `email_2` (`email`,`nick`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
