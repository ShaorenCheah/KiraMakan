-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2023 at 03:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiramakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountID` varchar(5) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `token` varchar(6) DEFAULT NULL,
  `accountType` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `email`, `password`, `token`, `accountType`) VALUES
('A0001', 'mcd@gmail.com', '$2y$10$5M4sMHISEPYD46Oc732kVu/II/iudTm60bvM6eR6IIdNA1anUw2qi', NULL, 'Restaurant'),
('A0002', 'guest@gmail.com', '$2y$10$5M4sMHISEPYD46Oc732kVu/II/iudTm60bvM6eR6IIdNA1anUw2qi', NULL, 'Customer'),
('A0003', 'shaorencheah@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', '259037', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` varchar(5) NOT NULL,
  `customerName` varchar(256) NOT NULL,
  `phoneNo` varchar(255) DEFAULT NULL,
  `accountID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `customerName`, `phoneNo`, `accountID`) VALUES
('C0001', 'Guest', '012-3456789', 'A0002'),
('C0002', 'Cheah Shaoren', '016-3381806', 'A0003');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuID` varchar(5) NOT NULL,
  `restaurantID` varchar(5) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `itemDescription` longtext NOT NULL,
  `itemPrice` decimal(10,2) NOT NULL,
  `menuURL` longtext NOT NULL,
  `availability` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuID`, `restaurantID`, `itemName`, `itemDescription`, `itemPrice`, `menuURL`, `availability`) VALUES
('M0001', 'R0001', 'Fillet O Fish', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ligula dolor, scelerisque eu libero accumsan, venenatis mollis justo. Suspendisse sit amet leo dolor. ', '12.00', 'filletofish.jpg', 'Available'),
('M0002', 'R0001', 'Mc Chicken', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ligula dolor, scelerisque eu libero accumsan, venenatis mollis justo. Suspendisse sit amet leo dolor. ', '10.00', 'mcchicken.jpg', 'Available'),
('M0003', 'R0001', 'Ayam Goreng McD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ligula dolor, scelerisque eu libero accumsan, venenatis mollis justo. Suspendisse sit amet leo dolor. ', '14.00', 'ayamgorengmcd.png', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` varchar(7) NOT NULL,
  `restaurantID` varchar(5) NOT NULL,
  `customerID` varchar(5) DEFAULT NULL,
  `orderDate` datetime NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_person`
--

CREATE TABLE `order_person` (
  `opID` varchar(6) NOT NULL,
  `orderID` varchar(7) NOT NULL,
  `personName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person_menu`
--

CREATE TABLE `person_menu` (
  `opID` varchar(7) NOT NULL,
  `menuID` varchar(5) NOT NULL,
  `quantity` int(2) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurantID` varchar(5) NOT NULL,
  `restaurantName` varchar(256) NOT NULL,
  `accountID` varchar(5) NOT NULL,
  `restaurantDescription` longtext NOT NULL,
  `restaurantURL` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`restaurantID`, `restaurantName`, `accountID`, `restaurantDescription`, `restaurantURL`) VALUES
('R0001', 'McDonalds', 'A0001', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ligula dolor, scelerisque eu libero accumsan, venenatis mollis justo.', 'mcdonaldslogo.png'),
('R0002', 'McDonalds', 'A0001', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ligula dolor, scelerisque eu libero accumsan, venenatis mollis justo.', 'mcdonaldslogo.png'),
('R0003', 'McDonalds', 'A0001', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ligula dolor, scelerisque eu libero accumsan, venenatis mollis justo.', 'mcdonaldslogo.png'),
('R0004', 'McDonalds', 'A0001', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ligula dolor, scelerisque eu libero accumsan, venenatis mollis justo.', 'mcdonaldslogo.png'),
('R0005', 'McDonalds', 'A0001', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ligula dolor, scelerisque eu libero accumsan, venenatis mollis justo.', 'mcdonaldslogo.png'),
('R0006', 'McDonalds', 'A0001', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ligula dolor, scelerisque eu libero accumsan, venenatis mollis justo.', 'mcdonaldslogo.png'),
('R0007', 'McDonalds', 'A0001', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ligula dolor, scelerisque eu libero accumsan, venenatis mollis justo.', 'mcdonaldslogo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuID`),
  ADD KEY `restaurantID` (`restaurantID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `restaurantID` (`restaurantID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `order_person`
--
ALTER TABLE `order_person`
  ADD PRIMARY KEY (`opID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `person_menu`
--
ALTER TABLE `person_menu`
  ADD PRIMARY KEY (`opID`,`menuID`),
  ADD KEY `menuID` (`menuID`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`restaurantID`),
  ADD KEY `accountID` (`accountID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `restaurants` (`restaurantID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `restaurants` (`restaurantID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`);

--
-- Constraints for table `order_person`
--
ALTER TABLE `order_person`
  ADD CONSTRAINT `order_person_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`);

--
-- Constraints for table `person_menu`
--
ALTER TABLE `person_menu`
  ADD CONSTRAINT `person_menu_ibfk_1` FOREIGN KEY (`opID`) REFERENCES `order_person` (`opID`),
  ADD CONSTRAINT `person_menu_ibfk_2` FOREIGN KEY (`menuID`) REFERENCES `menu` (`menuID`);

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
