-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 02:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(10) NOT NULL,
  `fn` varchar(200) NOT NULL,
  `ln` varchar(200) NOT NULL,
  `at` varchar(200) NOT NULL,
  `dt` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `rp` varchar(200) NOT NULL,
  `rc` varchar(200) NOT NULL,
  `top` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `duration` int(50) NOT NULL,
  `discount` int(50) NOT NULL,
  `add_charge` int(50) NOT NULL,
  `total_cost` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `fn`, `ln`, `at`, `dt`, `email`, `phone`, `rp`, `rc`, `top`, `price`, `duration`, `discount`, `add_charge`, `total_cost`) VALUES
(2, 'Anne Lorraine', 'Ramos', '2024-04-26', '2024-04-30', 'anne@gmail.com', '09466470371', 'Deluxe', 'Single', 'Cash', 300, 5, 150, 0, 1350),
(5, 'Lailanie', 'Fercol', '2024-07-01', '2024-07-31', 'leah@gmail.com', '09105739338', 'Suite', 'Double', 'Check', 800, 31, 0, 1240, 26040),
(6, 'Lanie Gene', 'Ramos', '2024-06-01', '2024-06-30', '', '', 'Suite', 'Double', 'Cash', 800, 30, 3600, 0, 20400);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
