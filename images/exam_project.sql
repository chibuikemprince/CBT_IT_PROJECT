-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2019 at 11:28 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `exam_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `date_string` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `id` int(250) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `email`, `status`, `date_string`, `password`, `id`) VALUES
('prince', 'aaa@bbb.ccc', 'confirm', '', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `name` varchar(250) NOT NULL,
  `creator_email` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `date_string` int(250) unsigned NOT NULL,
  `id` int(250) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`name`, `creator_email`, `status`, `date_string`, `id`) VALUES
('Banks', 'aaa@bbb.ccc', 'confirm', 1569946116, 1),
('UNN', 'aaa@bbb.ccc', 'confirm', 1569946148, 2),
('NNPC EXAM', 'aaa@bbb.ccc', 'confirm', 1569946732, 3),
('COMPUTER SCIENCE', 'aaa@bbb.ccc', 'confirm', 1569963295, 4),
('CURRENT AFFAIRS', 'aaa@bbb.ccc', 'confirm', 1569964640, 5),
('Nigeria Test', 'aaa@bbb.ccc', 'confirm', 1569990807, 6),
('Communication', 'aaa@bbb.ccc', 'confirm', 1569990870, 7),
('Fishing', 'aaa@bbb.ccc', 'confirm', 1569991262, 8),
('Praying', 'aaa@bbb.ccc', 'confirm', 1569991321, 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_recovery`
--

CREATE TABLE IF NOT EXISTS `password_recovery` (
  `email` varchar(250) NOT NULL,
  `recovery_token` varchar(250) NOT NULL,
  `date_string` varchar(250) NOT NULL,
  `expiry_date` varchar(250) NOT NULL,
  `id` int(250) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_recovery`
--

INSERT INTO `password_recovery` (`email`, `recovery_token`, `date_string`, `expiry_date`, `id`) VALUES
('prince@yahoo.com', '771CC2FA0C7CA273068ADFFDF55C0FD4', '1569882821', '1569886421', 20);

-- --------------------------------------------------------

--
-- Table structure for table `pre_test`
--

CREATE TABLE IF NOT EXISTS `pre_test` (
  `email` varchar(250) NOT NULL,
  `current_stage` varchar(250) NOT NULL,
  `date_string` int(250) unsigned NOT NULL,
  `id` int(250) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pre_test`
--

INSERT INTO `pre_test` (`email`, `current_stage`, `date_string`, `id`) VALUES
('youngest@yahoo.com', 'NULL', 1570225151, 11);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `creator_email` varchar(250) NOT NULL,
  `question_text` longtext NOT NULL,
  `status` varchar(250) NOT NULL,
  `option1` varchar(250) NOT NULL,
  `option2` varchar(250) NOT NULL,
  `option3` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `category_id` varchar(250) NOT NULL,
  `date_string` varchar(250) NOT NULL,
  `id` int(250) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`creator_email`, `question_text`, `status`, `option1`, `option2`, `option3`, `answer`, `category_id`, `date_string`, `id`) VALUES
('aaa@bbb.ccc', 'Who is the president of Nigeria?', 'confirm', 'Gburu Gburu', 'Ozumba', 'Osibanjo', 'Buhari', '5', '1569964707', 1),
('aaa@bbb.ccc', 'Who is the governor of Enugu State', 'confirm', 'Gburu Gburu', 'Ozumba', 'Osibanjo', 'Ifeanyi Ugwuanyi', '5', '1569964799', 2),
('aaa@bbb.ccc', 'A in ATM STANDS FOR', 'confirm', 'ANDROID', 'ANT', 'AUTO', 'AUTOMATED', '4', '1570174408', 6),
('aaa@bbb.ccc', 'The Last N in UNN stands for ?', 'confirm', 'Nsude', 'Nigeria', 'National', 'Nsukka', '4', '1570290874', 7);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE IF NOT EXISTS `scores` (
  `email` varchar(250) NOT NULL,
  `category_id` int(250) unsigned NOT NULL,
  `score` varchar(250) NOT NULL,
  `total_question` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `date_string` varchar(250) NOT NULL,
  `id` int(250) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`email`, `category_id`, `score`, `total_question`, `status`, `date_string`, `id`) VALUES
('youngest@yahoo.com', 1, '20', '21', 'confirm', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone_number` varchar(250) NOT NULL,
  `sex` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `date_string` varchar(250) NOT NULL,
  `token` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `blocked` varchar(250) NOT NULL,
  `id` int(250) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`firstname`, `lastname`, `email`, `phone_number`, `sex`, `password`, `date_string`, `token`, `status`, `blocked`, `id`) VALUES
('prince', 'chisom', 'youngest@yahoo.com', '08066934496', 'male', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1569607253', 'd09e4a68f432b992bfd499b99faa74507499da8b1570197689', 'unconfirmed', 'false', 1),
('prince', 'main', 'youngest@yahoo2.com', '08066934496', 'female', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1569607421', 'd359a567dd5843ea0ff52230bf99147cc047155c1569607421', 'blocked', 'false', 2),
('prince', 'Chisoamga', 'youngest@yahoo22.com', '08066934496', 'female', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1569607769', '7a7138b82afd54695c0dc7490ce50bd684a6d0851569607769', 'unconfirmed', 'false', 3),
('prince', 'Chisoamga', 'youngest@yahoo232.com', '08066934496', 'female', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1569607899', 'abcaf056095f047911e8d52057f55246dde079ac1569607899', 'blocked', 'false', 4),
('prince', 'Chisoamga', 'prince@yahoo.com', '08066934496', 'male', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1569608030', 'd4d8bff5c0786beded1a1f1fb09b30f25de9add31569608030', 'unconfirmed', 'false', 5),
('prince', 'Chisoamga', 'youngest@yahoo221.com', '08066934496', 'male', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1569611477', '38501352fee033eba1d01dee44dc0381a9864b5b1569611477', 'unconfirmed', 'false', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_recovery`
--
ALTER TABLE `password_recovery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_test`
--
ALTER TABLE `pre_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(250) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(250) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `password_recovery`
--
ALTER TABLE `password_recovery`
  MODIFY `id` int(250) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `pre_test`
--
ALTER TABLE `pre_test`
  MODIFY `id` int(250) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(250) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(250) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(250) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
