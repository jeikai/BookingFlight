-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 02:29 PM
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
-- Database: `bookingflight`
--

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `flightId` int(11) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `startCity` varchar(20) NOT NULL,
  `endCity` varchar(20) NOT NULL,
  `startTime` varchar(20) NOT NULL,
  `endTime` varchar(20) NOT NULL,
  `totalCustomer` int(11) NOT NULL,
  `remainingCustomer` int(11) DEFAULT NULL,
  `standardPrice` float NOT NULL,
  `isRoundTrip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`flightId`, `brand`, `startCity`, `endCity`, `startTime`, `endTime`, `totalCustomer`, `remainingCustomer`, `standardPrice`, `isRoundTrip`) VALUES
(1, 'Vietnam Airlines', 'New York', 'Los Angeles', '2024-05-18T10:00', '2024-05-18T15:00', 150, 150, 249, 0),
(2, 'Jetstar', 'London', 'Paris', '2024-05-19 08:30:00', '2024-05-19 11:00:00', 100, 100, 180.5, 0),
(4, 'Vietjet Air', 'Berlin', 'Rome', '2024-05-21 17:45:00', '2024-05-22 14:00:00', 75, 74, 315.25, 1),
(1716782049, 'Bamboo', 'Hanoi', 'Ho Chi Minh', '2024-05-27T10:41', '2024-05-30T10:41', 200, 200, 200, 1),
(1716782118, 'Bamboo', 'Hanoi', 'Ho Chi Minh', '2024-05-28T10:55', '2024-05-30T10:55', 300, 200, 10000, 0),
(1716805621, 'Pacific Airlines', 'Hanoi', 'Ho Chi Minh', '2024-05-28T17:26', '2024-06-01T17:26', 300, 197, 700, 1),
(1716805654, 'Pacific Airlines', 'Hanoi', 'Ho Chi Minh', '2024-06-07T17:27', '2024-06-15T17:27', 300, 300, 500, 1),
(1716805759, 'Emirates', 'Hanoi', 'Ho Chi Minh', '2024-05-28T17:29', '2024-06-07T17:29', 300, 298, 800, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderDetailID` int(11) NOT NULL,
  `flightId` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id_don_hang` int(11) NOT NULL,
  `flightName` varchar(150) NOT NULL,
  `price` varchar(150) NOT NULL,
  `quantity` varchar(150) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `orderDate` varchar(30) DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8 DEFAULT '',
  `price_sum` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id_don_hang`, `flightName`, `price`, `quantity`, `userId`, `orderDate`, `description`, `price_sum`) VALUES
(1716784170, '1716782118, 1', '10000, 250', '1, 1', 1659321007, 'Monday 27th May 2024 11:29:30 ', '', 260),
(1716798122, '1, 2, 4', '250, 180.5, 315.25', '2, 1, 2', 1659321007, 'Monday 27th May 2024 03:22:02 ', '', 1312),
(1716806391, '4', '315.25', '1', 1659321007, 'Monday 27th May 2024 05:39:51 ', '', 315),
(1716806492, '1716805621, 1716805759', '700, 800', '3, 2', 1659321007, 'Monday 27th May 2024 05:41:32 ', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 DEFAULT '',
  `role` varchar(10) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `phoneNumber`, `password`, `address`, `role`) VALUES
(165932097, 'Duy', 'admin', '123456', 'Hồ Chí Minh Cần Thơ', 'admin'),
(1659320946, 'jeikai', '0981933574', '123456', 'A8 An Bình City Phạm Văn Đồng Hà Nội', 'admin'),
(1659321007, 'Trần Quang Phúc', '0989194097', 'phucdepzai123', 'Việt Nam', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`flightId`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderDetailID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id_don_hang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
