-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2018 at 06:51 PM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `StudyBuddy`
--
CREATE DATABASE IF NOT EXISTS `StudyBuddy` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `StudyBuddy`;

-- --------------------------------------------------------

--
-- Table structure for table `Accounts`
--

CREATE TABLE `Accounts` (
  `user_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Accounts`
--

INSERT INTO `Accounts` (`user_id`, `email`, `password`) VALUES
(1, 'fytrgurt@yahoo.com', 'cat'),
(2, 'yibrahim2497@gmail.com', 'butt_dogs'),
(3, 'Violetg367@gmail.com', 'april'),
(5, 'test@test.com', 'test123'),
(6, ' ', ' '),
(7, 'violet_gooding@yahoo.com', 'pass'),
(8, 'Test@gmail.com', 'test'),
(9, 'kanikataneja@gmail.com', 'pass'),
(10, 'yibrahim@umd.edu', '1234'),
(11, 'Test@yahoo.com', 'test'),
(12, 'Hello@gmail.com', 'hello'),
(13, 'kanikataneja@gmail.com', 'asdf'),
(15, 'wassup@gmail.com', 'hi'),
(16, 'random@gmail.com', 'asdf'),
(17, 'hi@gmail.com', 'poop'),
(18, 'lina.abdo14@gmail.com', 'cat');

-- --------------------------------------------------------

--
-- Table structure for table `Notes`
--

CREATE TABLE `Notes` (
  `page_id` int(11) NOT NULL,
  `contents` text NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `class_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Notes`
--

INSERT INTO `Notes` (`page_id`, `contents`, `user_id_fk`, `class_name`) VALUES
(2, 'vchjfhj', 17, 'lknlkn'),
(3, '', 17, 'ljhlh'),
(4, 'These are my INST 377 Notes!', 16, 'INST 377'),
(5, '', 16, 'INST 462'),
(6, 'hey', 3, 'inst456'),
(9, '', 18, 'inst414'),
(11, '', 18, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `ToDo`
--

CREATE TABLE `ToDo` (
  `idToDo` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ToDo`
--

INSERT INTO `ToDo` (`idToDo`, `name`, `user_id_fk`) VALUES
(7, 'lob', 7),
(8, 'Hi', 8),
(10, 'task 1', 9),
(11, 'task 2', 9),
(12, 'task 3', 9),
(14, 'hi', 17),
(15, 'hi2', 17),
(16, 'hi3', 17),
(18, 'Home work', 16),
(19, 'Study for Exam', 16),
(20, 'Walk dog', 16),
(21, 'task', 3),
(22, 'first', 3),
(24, 'h', 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Accounts`
--
ALTER TABLE `Accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `Notes`
--
ALTER TABLE `Notes`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `ToDo`
--
ALTER TABLE `ToDo`
  ADD PRIMARY KEY (`idToDo`),
  ADD KEY `user_id_fk` (`user_id_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Accounts`
--
ALTER TABLE `Accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `Notes`
--
ALTER TABLE `Notes`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ToDo`
--
ALTER TABLE `ToDo`
  MODIFY `idToDo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ToDo`
--
ALTER TABLE `ToDo`
  ADD CONSTRAINT `ToDo_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `Accounts` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
