-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 23, 2024 at 10:10 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `productin`
--

DROP TABLE IF EXISTS `productin`;
CREATE TABLE IF NOT EXISTS `productin` (
  `Productin_id` int(11) NOT NULL AUTO_INCREMENT,
  `ProductCode` int(11) DEFAULT NULL,
  `prin_Date` date DEFAULT NULL,
  `prin_Quantity` int(11) DEFAULT NULL,
  `prin_Unit_Price` decimal(15,2) DEFAULT NULL,
  `prin_TotalPrice` decimal(20,2) GENERATED ALWAYS AS ((`prin_Quantity` * `prin_Unit_Price`)) STORED,
  PRIMARY KEY (`Productin_id`),
  KEY `productin_ibfk_1` (`ProductCode`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productin`
--

INSERT INTO `productin` (`Productin_id`, `ProductCode`, `prin_Date`, `prin_Quantity`, `prin_Unit_Price`) VALUES
(2, 4, '2024-06-23', 90, '300.00'),
(4, 2, '2024-06-12', 12, '1000.00'),
(5, 5, '2024-06-23', 100, '370.00'),
(6, 9, '2024-06-23', 50, '950.00'),
(7, 10, '2024-06-24', 25, '1500.00');

-- --------------------------------------------------------

--
-- Table structure for table `productout`
--

DROP TABLE IF EXISTS `productout`;
CREATE TABLE IF NOT EXISTS `productout` (
  `ProductOut_id` int(11) NOT NULL AUTO_INCREMENT,
  `ProductCode` int(11) DEFAULT NULL,
  `prout_Date` date DEFAULT NULL,
  `prout_Quantity` int(11) DEFAULT NULL,
  `prout_Unit_Price` decimal(15,2) DEFAULT NULL,
  `prout_TotalPrice` decimal(20,2) GENERATED ALWAYS AS ((`prout_Quantity` * `prout_Unit_Price`)) STORED,
  PRIMARY KEY (`ProductOut_id`),
  KEY `ProductCode` (`ProductCode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ProductCode` int(11) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(100) NOT NULL,
  PRIMARY KEY (`ProductCode`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductCode`, `ProductName`) VALUES
(1, 'EGGPLANT'),
(2, 'PASTA (Spaghetti Italiano)'),
(3, 'SOAP'),
(4, 'JUICE'),
(5, 'CASSAVA'),
(6, 'TZ RICE'),
(7, 'SOAPF'),
(8, 'SWEET POTATOES'),
(9, 'UGALI'),
(10, 'PORRIDGE'),
(11, 'broccoli');

-- --------------------------------------------------------

--
-- Table structure for table `storekeeper`
--

DROP TABLE IF EXISTS `storekeeper`;
CREATE TABLE IF NOT EXISTS `storekeeper` (
  `StorekeeperId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`StorekeeperId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storekeeper`
--

INSERT INTO `storekeeper` (`StorekeeperId`, `UserName`, `Password`) VALUES
(1, 'manager', '123');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `UserName`, `Password`) VALUES
(1, 'demo@gmail.com', '123'),
(6, 'bobrwanda', '111');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productin`
--
ALTER TABLE `productin`
  ADD CONSTRAINT `productin_ibfk_1` FOREIGN KEY (`ProductCode`) REFERENCES `products` (`ProductCode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productout`
--
ALTER TABLE `productout`
  ADD CONSTRAINT `productout_ibfk_1` FOREIGN KEY (`ProductCode`) REFERENCES `products` (`ProductCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
