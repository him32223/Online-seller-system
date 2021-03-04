-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 09:46 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartid`
--

CREATE TABLE `cartid` (
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `Id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `receipt` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tracking_num` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`Id`, `cart_id`, `payment`, `amount`, `receipt`, `address`, `tel`, `username`, `user_id`, `tracking_num`) VALUES
(1, 1, 'YES', '2', 'receipt/20200313065633.jpg', '1', '1', '1', 3, 'ddadaa'),
(2, 1, 'NO', '0', '', 'g', 'g', 'g', 1, 'dad'),
(3, 1, 'YES', '2', 'receipt/20200313062715.jfif', 'gg', 'g', 'g', 3, ''),
(4, 1, 'NO', '2', '', 'f', 'f', 'f', 1, ''),
(5, 1, 'NO', '2', '', 'j', 'j', 'j', 1, ''),
(6, 1, 'NO', '2', '', 'dd', 'd', 'd', 1, ''),
(7, 1, 'NO', '23', '', 'gg', 'gg', 'gg', 1, ''),
(8, 1, 'YES', '23', 'receipt/20200313065027.jpg', 'f', 'f', 'f', 3, ''),
(9, 1, 'NO', '23', '', 'd', 'dadd', 'ada', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `item_table`
--

CREATE TABLE `item_table` (
  `Id` int(11) NOT NULL,
  `image` varchar(455) DEFAULT NULL,
  `SKU` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `Price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `Id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `p_status` varchar(255) DEFAULT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cart`
--

INSERT INTO `tb_cart` (`Id`, `item_id`, `user_id`, `p_status`, `cart_id`) VALUES
(1, 4, 3, 'CHECKOUT', 1),
(2, 4, 3, 'CHECKOUT', 1),
(6, 5, 3, 'CHECKOUT', 1),
(7, 5, 3, 'CHECKOUT', 1),
(9, 5, 3, 'CHECKOUT', 1),
(10, 5, 3, 'CHECKOUT', 1),
(11, 5, 3, 'CHECKOUT', 1),
(12, 5, 3, 'CHECKOUT', 1),
(13, 5, 1, 'CHECKOUT', 1),
(14, 5, 1, 'CHECKOUT', 1),
(17, 5, 1, 'CHECKOUT', 1),
(18, 5, 1, 'CHECKOUT', 1),
(19, 5, 3, 'CHECKOUT', 1),
(20, 5, 3, 'CHECKOUT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_copy`
--

CREATE TABLE `tb_copy` (
  `Id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Permission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_copy`
--

INSERT INTO `tb_copy` (`Id`, `Username`, `Password`, `Permission`) VALUES
(1, 'h', 'h', 'Seller');

-- --------------------------------------------------------

--
-- Table structure for table `tb_item1`
--

CREATE TABLE `tb_item1` (
  `Id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `SKU` varchar(255) NOT NULL,
  `Quantity` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_item1`
--

INSERT INTO `tb_item1` (`Id`, `image`, `SKU`, `Quantity`, `Price`) VALUES
(5, 'img/20200312044147.png', '1', '12', '23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `Id` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Permission` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`Id`, `Username`, `Password`, `Permission`) VALUES
(1, 'h', 'h', 'Seller'),
(3, 'j', 'j', 'Buyer'),
(4, 'g', 'g', 'Seller'),
(5, 'dad', 'dadd', NULL),
(6, 'daadada', 'daadwdw', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartid`
--
ALTER TABLE `cartid`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `item_table`
--
ALTER TABLE `item_table`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tb_copy`
--
ALTER TABLE `tb_copy`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tb_item1`
--
ALTER TABLE `tb_item1`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartid`
--
ALTER TABLE `cartid`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item_table`
--
ALTER TABLE `item_table`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_copy`
--
ALTER TABLE `tb_copy`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_item1`
--
ALTER TABLE `tb_item1`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
