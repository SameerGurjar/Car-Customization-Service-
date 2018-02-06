-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2017 at 06:06 AM
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
-- Database: `usermanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_detail`
--

CREATE TABLE `car_detail` (
  `UserID` varchar(120) NOT NULL,
  `Maker` varchar(100) NOT NULL,
  `Model` varchar(100) NOT NULL,
  `Sub_model` varchar(100) NOT NULL,
  `Year` int(11) NOT NULL,
  `Description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `filesrepository`
--

CREATE TABLE `filesrepository` (
  `unique_ID` int(10) NOT NULL,
  `file_ID` varchar(25) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `current_folder` varchar(500) NOT NULL,
  `destination_folder` varchar(500) NOT NULL,
  `new_file_name` varchar(500) DEFAULT NULL,
  `file_save_folder` varchar(500) DEFAULT NULL,
  `file_temp` varchar(500) DEFAULT NULL,
  `file_size` varchar(100) DEFAULT NULL,
  `file_extension` varchar(50) DEFAULT NULL,
  `file_name` varchar(500) DEFAULT NULL,
  `actual_url` varchar(500) DEFAULT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IPADDRESS` varchar(100) NOT NULL,
  `deleteFlag` int(1) NOT NULL DEFAULT '0',
  `file_type` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `finished_filesrepository`
--

CREATE TABLE `finished_filesrepository` (
  `unique_ID` int(10) NOT NULL,
  `file_ID` varchar(25) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `current_folder` varchar(500) NOT NULL,
  `destination_folder` varchar(500) NOT NULL,
  `new_file_name` varchar(500) DEFAULT NULL,
  `file_save_folder` varchar(500) DEFAULT NULL,
  `file_temp` varchar(500) DEFAULT NULL,
  `file_size` varchar(100) DEFAULT NULL,
  `file_extension` varchar(50) DEFAULT NULL,
  `file_name` varchar(500) DEFAULT NULL,
  `actual_url` varchar(500) DEFAULT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IPADDRESS` varchar(100) NOT NULL,
  `deleteFlag` int(1) NOT NULL DEFAULT '0',
  `file_type` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `UserID` varchar(120) NOT NULL,
  `UserName` varchar(150) NOT NULL,
  `FirstName` varchar(150) DEFAULT NULL,
  `LastName` varchar(150) DEFAULT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(1000) DEFAULT NULL,
  `MemberSince` varchar(255) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`UserID`, `UserName`, `FirstName`, `LastName`, `Email`, `Password`, `MemberSince`, `Active`) VALUES
('5v6fnj', 'sam', 'sam', 'sam', 'sam', 'cee93e7d7eee066e4f59d61b95961d2bf7ac208d6a7d1638a89c333863223eacc', '1513404557', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `UserID` varchar(120) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Addr1` varchar(120) NOT NULL,
  `Addr2` varchar(120) NOT NULL,
  `Landmark` varchar(120) NOT NULL,
  `Pincode` varchar(120) NOT NULL,
  `State` varchar(120) NOT NULL,
  `Mobnum` varchar(120) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_detail`
--
ALTER TABLE `car_detail`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `filesrepository`
--
ALTER TABLE `filesrepository`
  ADD PRIMARY KEY (`unique_ID`);

--
-- Indexes for table `finished_filesrepository`
--
ALTER TABLE `finished_filesrepository`
  ADD PRIMARY KEY (`unique_ID`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`UserName`,`Email`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filesrepository`
--
ALTER TABLE `filesrepository`
  MODIFY `unique_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finished_filesrepository`
--
ALTER TABLE `finished_filesrepository`
  MODIFY `unique_ID` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
