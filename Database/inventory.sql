-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2019 at 07:06 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `bid` int(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`bid`, `brand_name`, `status`) VALUES
(8, 'huawei', '1'),
(9, 'Lenovo', '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(20) NOT NULL,
  `parent_cat` int(20) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `parent_cat`, `category_name`, `status`) VALUES
(21, 0, 'Phone', '1'),
(22, 0, 'lap', '1'),
(23, 0, 'electronic ', '1'),
(24, 0, 'charger', '1'),
(25, 0, 'bag', '1'),
(26, 0, 'monitor', '1');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_no` int(255) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `order_date` char(20) NOT NULL,
  `sub_total` double NOT NULL,
  `discount` double NOT NULL,
  `Total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `customer_name`, `order_date`, `sub_total`, `discount`, `Total`, `paid`, `due`, `payment_type`) VALUES
(86, 'dayawansha', '2019-17-04', 60000, 0, 60000, 60000, 0, 'Cash'),
(87, 'dd', '2019-18-04', 60000, 0, 60000, 30000, 30000, 'Cash'),
(88, 'dd', '2019-18-04', 60000, 0, 60000, 30000, 30000, 'Cash'),
(89, 'dd', '2019-18-04', 60000, 0, 60000, 30000, 30000, 'Cash'),
(90, 'dd', '2019-18-04', 60000, 0, 60000, 40000, 20000, 'Cash'),
(91, 'dd', '2019-18-04', 60000, 0, 60000, 40000, 20000, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(255) NOT NULL,
  `barcode` char(100) NOT NULL,
  `invoice_no` int(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `barcode`, `invoice_no`, `product_name`, `price`, `qty`) VALUES
(92, '112', 86, '13', 60000, 1),
(93, '112', 90, '13', 60000, 1),
(94, '112', 91, '13', 60000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `barcode` char(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `invoice_no` char(100) NOT NULL,
  `stock_date` date NOT NULL,
  `get_price` double NOT NULL,
  `exp_date` date NOT NULL,
  `i_status` enum('1','0') NOT NULL,
  `i_qty` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`barcode`, `pid`, `invoice_no`, `stock_date`, `get_price`, `exp_date`, `i_status`, `i_qty`) VALUES
('111111111', 0, '30', '2019-04-12', 100, '2019-04-12', '1', 0),
('11111111111111111111111', 8, '555', '2019-04-13', 1000, '0000-00-00', '1', 1),
('112', 13, '11', '0000-00-00', 0, '0000-00-00', '1', 11),
('12121', 0, '1', '2019-04-12', 0, '2019-04-12', '1', 10),
('121212', 10, '1212', '2019-04-14', 1000, '2019-04-05', '1', 10),
('222', 12, '20', '0000-00-00', 50, '0000-00-00', '1', 9),
('5', 11, '40', '0000-00-00', 1000, '0000-00-00', '1', 10),
('66666666', 13, '50', '0000-00-00', 1000, '0000-00-00', '1', 10);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(100) NOT NULL,
  `cid` int(100) NOT NULL,
  `bid` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` double NOT NULL,
  `product_stock` int(11) NOT NULL,
  `minimum_qty` int(100) NOT NULL,
  `added_date` date NOT NULL,
  `p_status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `cid`, `bid`, `product_name`, `product_price`, `product_stock`, `minimum_qty`, `added_date`, `p_status`) VALUES
(8, 21, 8, 'y3 2', 20000, 100, 15, '2019-04-09', '1'),
(9, 22, 9, 'lenovo lap', 60000, 37, 0, '2019-04-09', '1'),
(10, 24, 8, 'huawei chager', 600, 20, 0, '2019-04-12', '1'),
(11, 25, 9, 'lap bag', 4000, 18, 0, '2019-04-12', '1'),
(12, 23, 8, 'head phone', 400, 106, 0, '2019-04-12', '1'),
(13, 26, 9, 'lenovo monitor', 60000, 11, 0, '2019-04-12', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` enum('Admin','Other') NOT NULL,
  `register_date` date NOT NULL,
  `last_login` datetime NOT NULL,
  `notes` varchar(255) NOT NULL,
  `phone_no` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`, `phone_no`) VALUES
(9, 'dhanushka', 'dayawansha@gmail.com', '$2y$10$KbZDqrXQ40RrwMYTh6SgVOAHAhhi7buaODvyEWzxkI2for2XSTetq', 'Admin', '2019-04-09', '2019-04-18 14:50:57', '', '0719869318'),
(10, 'kumara', 'herath@gmail.com', '$2y$10$d3l0f8dK2B8ZHu9Lul/nqeReDJfAq77PaWaY5buNK6YY.vROvsdRK', 'Admin', '2019-04-15', '2019-04-15 11:56:39', '', '0719869318');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_no`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`barcode`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `cid` (`cid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `bid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `brand` (`bid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
