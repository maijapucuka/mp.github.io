-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 05:40 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sw_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `SKU` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `special` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`SKU`, `name`, `price`, `product`, `is_deleted`, `special`) VALUES
('35', '35', 35, 'DVD', 1, 'Size: 35 MB'),
('36', '3', 3, 'book', 1, 'Weight: 4KG'),
('37', '7', 4, 'DVD', 1, 'Size: 5 MB'),
('43', '13', 3, 'DVD', 1, 'Size: 3 MB'),
('B12', 'To kill a mockingbird', 12, 'book', 1, 'Weight: 2KG'),
('B1555', 'Anna Karenina', 30, 'book', 0, 'Weight: 55KG'),
('B165', 'Lolita', 15, 'book', 0, 'Weight: 6KG'),
('B203', ' The Great Gatsby', 35, 'book', 0, 'Weight: 3KG'),
('Bggg6', 'Great Expectations', 4, 'book', 0, 'Weight: 55KG'),
('Bw', 'Don Quixote', 5, 'book', 0, 'Weight: 6KG'),
('By', 'Ulysses', 4, 'book', 0, 'Weight: 4KG'),
('D13', 'Titanic', 12, 'DVD', 1, 'Size: 650 MB'),
('D166', 'Avatar', 33, 'DVD', 0, 'Size: 1050 MB'),
('D2', 'Gladiator', 40, 'DVD', 0, 'Size: 4578 MB'),
('D202', 'Terminator', 23, 'DVD', 0, 'Size: 267 MB'),
('D2344', 'Fight Club', 24, 'DVD', 0, 'Size: 55 MB'),
('D24', 'When in Rome', 12, 'DVD', 0, 'Size: 2 MB'),
('D5', 'Pirates of the Caribbean ', 55, 'DVD', 0, 'Size: 55 MB'),
('D56', 'Dark Knight', 56, 'DVD', 0, 'Size: 56 MB'),
('D567', 'In Search of Lost Time', 5, 'book', 0, 'Weight: 5KG'),
('D56r', 'Hamlet', 56, 'book', 0, 'Weight: 56KG'),
('D7777', 'Batman Begins', 4, 'DVD', 0, 'Size: 4 MB'),
('D78', 'Green Mile', 1, 'DVD', 0, 'Size: 5 MB'),
('D8', 'Love Actually', 8, 'DVD', 0, 'Size:  8 MB'),
('D9', 'Mean girls', 9, 'DVD', 0, 'Size:  56 MB'),
('Dhhh5', 'Black Swan', 5, 'DVD', 0, 'Size: 5 MB'),
('F56', 'Red table', 56, 'furniture', 0, 'Dimension: 67x78x34'),
('F7777g', 'Big bed', 1, 'furniture', 0, 'Dimension: 55x67x34'),
('F88', 'Red sofa', 15, 'furniture', 0, 'Dimension: 8x8x8'),
('Fggg7', 'Blue chair', 6, 'furniture', 0, 'Dimension: 56x78x78');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`SKU`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
