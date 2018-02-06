-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2018 at 03:23 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `30hillsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `usr_id` int(11) NOT NULL,
  `frd_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`usr_id`, `frd_id`) VALUES
(2, 1),
(1, 2),
(3, 2),
(2, 3),
(4, 3),
(5, 3),
(7, 3),
(3, 4),
(3, 5),
(6, 5),
(7, 5),
(10, 5),
(11, 5),
(5, 6),
(3, 7),
(5, 7),
(8, 7),
(12, 7),
(20, 7),
(7, 8),
(12, 9),
(5, 10),
(11, 10),
(5, 11),
(10, 11),
(19, 11),
(20, 11),
(7, 12),
(9, 12),
(13, 12),
(20, 12),
(12, 13),
(14, 13),
(20, 13),
(13, 14),
(15, 14),
(14, 15),
(20, 16),
(18, 17),
(20, 17),
(16, 18),
(17, 18),
(11, 19),
(20, 19),
(7, 20),
(11, 20),
(12, 20),
(13, 20),
(16, 20),
(17, 20),
(19, 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `usr_id` int(11) NOT NULL,
  `usr_firstname` varchar(256) NOT NULL,
  `usr_surname` varchar(256) DEFAULT NULL,
  `usr_age` tinyint(3) UNSIGNED DEFAULT NULL,
  `usr_gender` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`usr_id`, `usr_firstname`, `usr_surname`, `usr_age`, `usr_gender`) VALUES
(1, 'Paul', 'Crowe', 28, 'male'),
(2, 'Rob', 'Fitz', 23, 'male'),
(3, 'Ben', 'O\'Carolan', NULL, 'male'),
(4, 'Victor', '', 28, 'male'),
(5, 'Peter', 'Mac', 29, 'male'),
(6, 'John', 'Barry', 18, 'male'),
(7, 'Sarah', 'Lane', 30, 'female'),
(8, 'Susan', 'Downe', 28, 'female'),
(9, 'Jack', 'Stam', 28, 'male'),
(10, 'Amy', 'Lane', 24, 'female'),
(11, 'Sandra', 'Phelan', 28, 'female'),
(12, 'Laura', 'Murphy', 33, 'female'),
(13, 'Lisa', 'Daly', 28, 'female'),
(14, 'Mark', 'Johnson', 28, 'male'),
(15, 'Seamus', 'Crowe', 24, 'male'),
(16, 'Daren', 'Slater', 28, 'male'),
(17, 'Dara', 'Zoltan', 48, 'male'),
(18, 'Marie', 'D', 28, 'female'),
(19, 'Catriona', 'Long', 28, 'female'),
(20, 'Katy', 'Couch', 28, 'female');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`usr_id`,`frd_id`),
  ADD KEY `fk_frd_id_idx` (`frd_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `fk_frd_id` FOREIGN KEY (`frd_id`) REFERENCES `user` (`usr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usr_id` FOREIGN KEY (`usr_id`) REFERENCES `user` (`usr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
