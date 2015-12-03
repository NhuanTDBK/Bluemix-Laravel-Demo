-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2015 at 11:17 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `foodie`
--
CREATE DATABASE IF NOT EXISTS `foodie` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `foodie`;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_NAME` text NOT NULL,
  `DESCRIPTION` text,
  `AVATAR_LINK` text NOT NULL,
  `COVER_LINK` text NOT NULL,
  `FACEBOOK_ID` text,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table user ' AUTO_INCREMENT=1 ;
