-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 07:35 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billspaye`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_items`
--

CREATE TABLE `tbl_category_items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `item_name` varchar(150) DEFAULT NULL,
  `file_name` varchar(150) DEFAULT NULL,
  `file_type` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category_items`
--

INSERT INTO `tbl_category_items` (`id`, `category_id`, `item_name`, `file_name`, `file_type`) VALUES
(2, 1, 'Arabian', 'i6.jpg', 'image/jpeg'),
(3, 1, 'Sai Ram', 'img7 (1).png', 'image/png'),
(4, 1, 'Siva Priya', 's12 (2).png', 'image/png'),
(5, 2, 'T-shirts', 'download.jpg', 'image/jpeg'),
(6, 2, 'T-shirts for men', 'download (1).jpg', 'image/jpeg'),
(7, 7, 'Sweet Treats Bakery', 'download (5).jpg', 'image/jpeg'),
(8, 7, 'Flour Power Bakery', 'download (4).jpg', 'image/jpeg'),
(9, 7, 'Heavenly Delights Bakery', 'download (3).jpg', 'image/jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category_items`
--
ALTER TABLE `tbl_category_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category_items`
--
ALTER TABLE `tbl_category_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
