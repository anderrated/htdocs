-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 07:54 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DeptID` int(11) NOT NULL,
  `DeptName` text NOT NULL,
  `MgrEmpID` int(11) NOT NULL,
  `Budget` decimal(10,0) NOT NULL,
  `DeptCity` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DeptID`, `DeptName`, `MgrEmpID`, `Budget`, `DeptCity`) VALUES
(1, 'DPSM', 7, '100000', 'Wellington'),
(2, 'Dummy Department', 2, '200000', 'Auckland'),
(3, 'Ghost Department', 5, '0', 'Iloilo');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmpID` int(11) NOT NULL,
  `EmpName` text NOT NULL,
  `Age` int(11) NOT NULL,
  `Salary` decimal(10,4) NOT NULL,
  `HireDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmpID`, `EmpName`, `Age`, `Salary`, `HireDate`) VALUES
(1, 'Bing Jiang', 35, '20000.0000', '2011-04-02'),
(2, 'River Dale', 35, '20000.0000', '2019-06-01'),
(3, 'Anthony Peterson', 38, '21000.5000', '2019-07-01'),
(4, 'Robert Brickson', 40, '19000.7500', '2019-10-01'),
(5, 'Ghost Employee', 100, '0.0000', '1990-11-01'),
(6, 'Robert Winson', 0, '40000.2500', '0000-00-00'),
(7, 'Robert Winson', 30, '40000.2500', '2018-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `EmpID` int(11) NOT NULL,
  `DeptID` int(11) NOT NULL,
  `Percent_Time` decimal(10,4) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`EmpID`, `DeptID`, `Percent_Time`) VALUES
(1, 1, '100.0000'),
(2, 2, '100.0000'),
(3, 1, '50.0000'),
(4, 2, '100.0000'),
(5, 3, '100.0000'),
(6, 2, '100.0000'),
(7, 1, '100.0000');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DeptID`),
  ADD UNIQUE KEY `MgrEmpID` (`MgrEmpID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmpID`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD UNIQUE KEY `EmpID` (`EmpID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DeptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
