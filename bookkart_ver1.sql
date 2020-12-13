-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 05:31 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookkart_ver1`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookID` int(11) NOT NULL,
  `book_name` varchar(45) NOT NULL,
  `book_qty` int(11) NOT NULL DEFAULT 1,
  `priceof1` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `book_name`, `book_qty`, `priceof1`) VALUES
(2, 'Fury', 58, 111),
(3, 'HungerGames', 22, 209),
(4, 'FanGirl', 6, 238),
(5, 'Dance of Crows', 98, 351),
(6, 'Game of Thrones', 152, 401),
(7, 'bard of blood', 55, 980);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `book_id` int(5) DEFAULT NULL,
  `book_name` varchar(30) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `user_name` varchar(45) NOT NULL,
  `order_type` varchar(10) NOT NULL,
  `order_date` timestamp(5) NOT NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5),
  `order_status` int(1) NOT NULL DEFAULT 0,
  `priceof1` float DEFAULT NULL,
  `pricetopay` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `book_id`, `book_name`, `quantity`, `user_name`, `order_type`, `order_date`, `order_status`, `priceof1`, `pricetopay`) VALUES
(1, 4, '', 2, 'sab_sush', 'Buy', '2020-11-27 05:43:15.50337', 1, 0, 0),
(2, 4, '', 2, 'sab_sush', 'Buy', '2020-11-26 11:27:47.37417', 1, 0, 0),
(3, 4, '', 1, 'sab_sush', 'Buy', '2020-11-26 10:35:08.60856', 1, 0, 0),
(4, 4, '', 1, 'sab_sush', 'Buy', '2020-11-26 10:35:03.06356', 0, 0, 0),
(5, 1, '', 14, 'sab_sush', 'Buy', '2020-11-26 10:38:14.74746', 1, 0, 0),
(6, 2, '', 12, 'sab_sush', 'Buy', '2020-11-26 11:29:17.04436', 0, 0, 0),
(7, 2, '', 12, 'sab_sush', 'Buy', '2020-11-26 11:30:02.08733', 0, 0, 1332),
(8, 2, '', 11, 'sab_sush', 'Buy', '2020-11-27 09:10:31.85956', 1, 0, 1221),
(9, 2, '', 11, 'sab_sush', 'Buy', '2020-11-26 11:30:56.17845', 1, 0, 1221),
(10, 2, '', 2, 'sab_sush', 'Buy', '2020-11-26 16:47:29.51191', 1, 0, 222),
(11, 2, '', 2, 'sab_sush', 'Buy', '2020-11-26 16:43:43.23792', 0, 0, 222),
(12, 2, '', 2, 'sab_sush', 'Buy', '2020-11-26 16:45:07.65851', 0, 0, 222),
(13, 4, '', 4, 'sab_sush', 'Buy', '2020-11-26 16:45:30.43747', 0, 0, 952),
(14, 4, '', 4, 'sab_sush', 'Buy', '2020-11-27 06:14:49.44536', 1, 0, 952),
(15, 4, '', 2, 'sab_sush', 'Buy', '2020-11-26 16:46:13.99659', 0, 0, 476),
(16, 4, '', 2, 'sab_sush', 'Buy', '2020-11-26 17:19:10.00485', 1, 0, 476),
(17, 2, NULL, 2, 'sab_sush', 'Buy', '2020-11-27 05:47:40.90894', 1, NULL, 222),
(18, NULL, 'Dance of Crows', 100, 'animate', 'Sell', '2020-11-27 06:32:23.80627', 1, 351, NULL),
(19, 2, 'Fury', 4, 'sab_sush', 'Buy', '2020-11-27 09:33:38.74946', 0, NULL, 444),
(20, 2, 'Fury', 2, 'sab_sush', 'Buy', '2020-11-27 09:37:35.29522', 1, NULL, 222),
(21, 5, 'Dance of Crows', 2, 'sab_sush', 'Buy', '2020-11-27 10:46:25.83289', 1, NULL, 702),
(22, NULL, 'Game of Thrones', 152, 'animate', 'Sell', '2020-11-27 10:48:32.85920', 1, 401, NULL),
(23, 4, 'FanGirl', 22, 'sab_sush', 'Buy', '2020-11-27 15:44:54.16711', 1, NULL, 5236),
(24, NULL, 'bard of blood', 55, 'animate', 'Sell', '2020-11-27 14:17:19.22880', 1, 980, NULL),
(25, NULL, 'Fury', 3, 'sab_sush', 'Buy', '2020-11-27 16:25:33.51516', 0, NULL, 333),
(26, NULL, 'Fury', 3, 'sab_sush', 'Buy', '2020-11-27 16:26:13.30385', 0, NULL, 333),
(27, NULL, 'Fury', 3, 'sab_sush', 'Buy', '2020-11-27 16:26:19.00278', 0, NULL, 333),
(28, NULL, 'FanGirl', 4, 'sab_sush', 'Buy', '2020-11-27 16:26:26.34166', 0, NULL, 952);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_name` varchar(10) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` int(11) NOT NULL,
  `contact` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_name`, `password`, `user_type`, `contact`) VALUES
('akash', '1234', 3, '9999999999'),
('aki', 'more', 3, '9898776655'),
('ani', 'mate', 1, '9876543210'),
('animate', 'aaa', 2, '9999999999'),
('sab_sush', '12345', 1, '9999999999'),
('sush', 'sab', 2, '9988776655');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
