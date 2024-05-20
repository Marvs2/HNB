-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 04:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dperson`
--

CREATE TABLE `dperson` (
  `id` int(30) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `DofBirth` date NOT NULL,
  `DofDeath` date NOT NULL,
  `Graveno` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dperson`
--

INSERT INTO `dperson` (`id`, `firstname`, `lastname`, `middlename`, `DofBirth`, `DofDeath`, `Graveno`) VALUES
(1, 'John', 'Smith', 'Peregrines', '1944-01-23', '2014-11-05', 1),
(2, 'Jennie Rose', 'Matagumpay ', '', '1943-11-01', '2000-12-02', 2),
(3, 'Marwin', 'Smith', 'adelhaide', '1935-02-02', '2015-03-03', 3),
(4, 'Mubarak', 'Hussain', 'brave', '1992-06-21', '2023-07-20', 4),
(5, 'Khan', 'Shahid', 'Alvi', '1997-07-23', '2023-04-14', 5),
(6, 'Khan', 'Mudassir', 'Kardam', '1979-04-12', '2010-05-11', 6),
(7, 'Khan', 'Nazeem', 'rabad', '1985-03-30', '2023-03-29', 7),
(8, 'Furquan', 'Mohammad', 'Bha', '1977-05-05', '2020-06-16', 8),
(9, 'janpura', 'Mehtab', 'Alib', '1988-11-20', '2020-08-31', 9),
(10, 'Lal', 'Ratan', 'Gokul', '1978-09-13', '2020-02-15', 10),
(11, 'Solanki', 'Rahul', 'Nagar', '1953-04-09', '2020-12-02', 11),
(12, 'Sharma', 'Ankit', 'Khas', '1993-07-23', '2020-09-21', 12),
(13, 'Kumar', 'Vinod', 'puri', '1975-05-08', '2020-08-24', 13),
(14, 'Bhan', 'Vir', 'Singh', '1972-11-05', '2020-07-25', 14),
(15, 'Hussain', 'Ashfaq', 'Mustafabad', '1996-06-07', '2020-07-15', 15),
(16, 'Khan', 'Ishak', 'Deepak', '1986-11-09', '2020-11-01', 16),
(17, 'Khan', 'Smith', 'adelhaide', '1975-03-28', '2023-03-29', 17),
(18, 'Khan', 'Smith', 'adelhaide', '1975-03-28', '2023-03-29', 18),
(21, 'Elaine', 'Villaberde', 'Kardam', '1975-07-01', '2022-10-20', 19),
(22, 'Wilfred', 'Salve', 'Rome', '0000-00-00', '0000-00-00', 20),
(43, 'asd', 'qwe', 'qwerty', '2023-01-11', '2023-07-11', 22),
(44, 'sad', 'asd', 'asd', '2023-03-06', '2023-07-11', 23),
(45, 'asd', 'qwe', 'qwerty', '2022-04-15', '2023-02-16', 24),
(46, 'sad', 'asd', 'asd', '1918-11-01', '2000-10-05', 25),
(47, 'sad', 'asd', 'asd', '2023-06-27', '2023-07-11', 26),
(48, 'sad', 'asd', 'asd', '1926-11-01', '1990-11-02', 27),
(49, 'sad', 'asd', 'asd', '1963-07-12', '2025-01-30', 28),
(50, 'asd', 'qwe', 'qwerty', '2023-01-19', '2023-07-10', 30),
(51, 'asd', 'qwe', 'qwerty', '2023-06-08', '2023-07-04', 29),
(52, 'asd', 'qwe', 'qwerty', '2023-04-04', '2023-07-11', 30),
(53, 'sad', 'asd', 'asd', '2023-07-09', '2023-07-10', 31),
(55, 'mack', 'kenly', 'live', '2023-07-05', '2023-07-12', 32),
(56, 'thing', 'thingy', 'things', '1970-07-13', '2023-07-12', 21),
(57, 'mack', 'kenly', 'measly', '1942-04-13', '2010-06-29', 540);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `middlename` text NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `password` varchar(25) NOT NULL,
  `password_hash` varchar(25) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `position` int(11) NOT NULL DEFAULT 1,
  `password` varchar(25) NOT NULL,
  `password_hash` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `firstname`, `lastname`, `middlename`, `email`, `contact`, `birthday`, `position`, `password`, `password_hash`) VALUES
(1, 'Marvin', 'Villanueva', 'Rebato', 'marvinvillanueva325@gmail.com', '09274170976', '2001-08-23', 1, '$2y$10$WRHa6hS1wh9c6MuBpw', '$2y$10$WRHa6hS1wh9c6MuBpw'),
(6, 'Mavs', 'Vin', 'Rebs', 'mavs@gmail.com', '09123456789', '0000-00-00', 1, '$2y$10$uIkNiph/MJKd2ihBu6', '$2y$10$uIkNiph/MJKd2ihBu6'),
(7, 'qwerty', 'qwerty', 'qwerty', 'qwerty2@gmail.com', '09123456789', '1979-05-17', 1, '$2y$10$g.gyLLbthEDF8YTfd7', '$2y$10$g.gyLLbthEDF8YTfd7'),
(8, 'Froilan', 'Perez', 'Parang', 'froilan@gmail.com', '09123456789', '1999-10-21', 1, '$2y$10$O1VU2qCi8wjKoqE3ND', '$2y$10$O1VU2qCi8wjKoqE3ND');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dperson`
--
ALTER TABLE `dperson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dperson`
--
ALTER TABLE `dperson`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
