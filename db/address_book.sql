-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2019 at 03:28 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `address_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `first_name`, `last_name`, `email`, `birthdate`, `telephone`, `address`, `image_name`) VALUES
(1, 'Pedro', 'Chapman', 'pedro.chapman@example.com', '1952-04-01', '(107)-138-3450', '5750 Poplar Dr', 'pedro-chapman.jpg'),
(2, 'Jesus', 'Gutierrez', 'jesus.gutierrez@example.com', '1965-06-06', '(054)-990-7792', '5567 Marsh Ln', 'jesus-gutierrez.jpg'),
(3, 'Marjorie', 'Bates', 'marjorie.bates@example.com', '1989-03-12', '(367)-064-9508', '1885 W Sherman Dr', 'marjorie-bates.jpg'),
(4, 'Joe', 'Sims', 'joe.sims@example.com', '1951-05-05', '(831)-319-4391', '240 W 6th St', 'joe-sims.jpg'),
(5, 'Sergio', 'Morales', 'sergio.morales@example.com', '1979-04-06', '(482)-342-2749', '2353 Frances Ct', 'sergio-morales.jpg'),
(6, 'Theodore', 'Ray', 'theodore.ray@example.com', '1964-02-06', '(707)-503-4999', '8606 Fairview St', 'theodore-ray.jpg'),
(7, 'Patrick', 'Cruz', 'patrick.cruz@example.com', '1960-04-11', '(740)-692-1631', '4468 Hillcrest Rd', 'patrick-cruz.jpg'),
(8, 'Hazel', 'Montgomery', 'hazel.montgomery@example.com', '1994-12-07', '(866)-304-2483', '7669 Pecan Acres Ln', 'hazel-montgomery.jpg'),
(9, 'Antonio', 'Freeman', 'antonio.freeman@example.com', '1992-02-29', '(824)-225-7848', '2123 Oak Ridge Ln', 'antonio-freeman.jpg'),
(10, 'Zachary', 'Rhodes', 'zachary.rhodes@example.com', '1979-06-05', '(976)-037-3466', '1029 Washington Ave', 'zachary-rhodes.jpg'),
(11, 'Georgia', 'Black', 'georgia.black@example.com', '1986-04-09', '(588)-906-8246', '5427 Photinia Ave', 'georgia-black.jpg'),
(12, 'Carole', 'Harrison', 'carole.harrison@example.com', '2016-10-01', '(029)-031-7568', '7750 Lone Wolf Trail', 'carole-harrison.jpg'),
(13, 'Diana', 'Gordon', 'diana.gordon@example.com', '1988-12-19', '(528)-735-3770', '9646 Dogwood Ave', 'diana-gordon.jpg'),
(14, 'Jerome', 'Jerome Morgan', 'jerome.morgan@example.com', '1984-06-18', '(131)-783-7183', '157 Hogan St', 'jerome-jerome morgan.jpg'),
(15, 'Derrick', 'Steeves', 'derrick.steeves@example.com', '1983-03-03', '(634)-242-3438', '6637 Taylor St', 'derrick-steeves.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
