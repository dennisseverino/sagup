-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2024 at 06:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sagup`
--

-- --------------------------------------------------------

--
-- Table structure for table `donation_tb`
--

CREATE TABLE `donation_tb` (
  `donation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_amount` varchar(100) NOT NULL,
  `payment_date` varchar(100) NOT NULL,
  `card_number` varchar(100) NOT NULL,
  `expiration_date` varchar(100) NOT NULL,
  `security_code` varchar(100) NOT NULL,
  `billing_firstname` varchar(100) NOT NULL,
  `billing_lastname` varchar(100) NOT NULL,
  `billing_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_tb`
--

INSERT INTO `donation_tb` (`donation_id`, `user_id`, `payment_amount`, `payment_date`, `card_number`, `expiration_date`, `security_code`, `billing_firstname`, `billing_lastname`, `billing_address`) VALUES
(1, 100, '10000', '2024-03-07', '555', '2024-03-28', '123', 'test', 'test', 'bpi'),
(2, 99, '5000', '2024-03-07', '12345', '2024-03-28', '515', 'firstname', 'lastname', 'BDO'),
(3, 2147483647, '2500', '2024-03-06', '12345', '2024-03-06', '556', 'testingg', 'testingg', 'chinabank'),
(4, 1075852826, '10000', '2024-04-10', '123', '2024-04-04', '123', 'secretary', 'secretary', 'BDO');

-- --------------------------------------------------------

--
-- Table structure for table `program_tb`
--

CREATE TABLE `program_tb` (
  `program_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `program_name` varchar(100) DEFAULT NULL,
  `program_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_tb`
--

INSERT INTO `program_tb` (`program_id`, `user_id`, `program_name`, `program_description`) VALUES
(19, 99, 'herozero', 'Helps Vendors'),
(20, 101, 'herozero', 'Helps Vendors'),
(22, 101, 'foodwastemitigation', 'Helps clean the environment.'),
(23, 100, 'foodwastemitigation', 'Helps clean the environment.'),
(24, 100, 'foodpantry', 'Help provide food for those in need.'),
(25, 100, 'herozero', 'Helps Vendors'),
(26, 100, 'herozero', 'Helps Vendors'),
(27, 2147483647, 'foodwastemitigation', 'Helps clean the environment.'),
(28, 2147483647, 'foodpantry', 'Help provide food for those in need.'),
(29, 2147483647, 'herozero', 'Helps Vendors');

-- --------------------------------------------------------

--
-- Table structure for table `role_tb`
--

CREATE TABLE `role_tb` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL,
  `role_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_tb`
--

INSERT INTO `role_tb` (`role_id`, `role_name`, `role_description`) VALUES
(2, 'Member', 'Main Workforce of the organization'),
(3, 'Secretary', 'Responsible for administrative tasks'),
(4, 'Admin', 'Oversees the website');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `date_of_birth` varchar(100) NOT NULL,
  `block_number` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `images` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `role_id`, `firstname`, `lastname`, `age`, `date_of_birth`, `block_number`, `street`, `country`, `barangay`, `city`, `zip_code`, `contact_number`, `email`, `username`, `password`, `images`) VALUES
(99, 4, 'dennis', 'severino', '21', '2024-03-19', '15', 'alderdrive', 'Philippines', 'cubay', 'silay', '6115', '09231', 'dennis@gmail.com', 'admin', '$2y$10$JwiQ9gm7tHnIb4u9BSQDI.PtIDpbdJSaGRLpYQ2CDq0ja0ngWg1C6', 'admin - 2024.04.01 - 08.05.05am.jpg'),
(101, 3, 'Paolo', 'Dubwisit', '20', '2024-03-19', '51', 'alderdrive', 'Philippines', 'cubay', 'silay', '6115', '09231', 'dennis@gmail.com', 'paolo', '$2y$10$IxRxZ/qJtgCbRJg/iEHZH.kcLbcAxtLX6j7RFUb9DJb9XycJSw9mm', ''),
(239580, 4, 'Stella Marie', 'Eriman/Severino', '21', '2002-08-23', '15', 'mingoy', 'Philippines', 'guinhalaran', 'silay', '6115', '09231', 'dennis@gmail.com', 'stella', '$2y$10$F2psCIo9NlxpX7yCL8Hkhuz5GZF7fXMALIuXQfqlFdVin4217Udgi', ''),
(64014504, 2, 'Paolo', 'Dubwisit', '24', '2024-03-05', '15', 'alderdrive', 'Philippines', 'brgy 13', 'bacolod city', '6100', '099192939', 'PD@gmail.com', 'paodub', '$2y$10$NudFl9wsDPSjA3q7647EwO9SGdIzu3wDTWWdaVXJQgT.Rnl1Rn62C', 'paodub - 2024.04.01 - 05.54.56pm.jpg'),
(1075852826, 3, 'secretary', 'severino', '21', '2024-04-05', '15', 'alderdrive', 'Philippines', 'secret', 'silay', '6115', '09231', 'dennis@gmail.com', 'secretary', '$2y$10$G6jGPLcL00d2pxV3sZOTUejrvo.YcFNVia/tRTSaOQ7IxBh/DWSoa', ''),
(2147483647, 2, 'testing', 'test', '21', '2024-04-26', '15', 'street', 'Philippines', 'cubay', 'tal', '12345', '091234', 'tester@gmail.com', 'member', '$2y$10$vpLeYAEOQD5v/jDUNmUmS.Jf4zzAI.92p5/0GMj0V4Y.BV.5oMDZG', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donation_tb`
--
ALTER TABLE `donation_tb`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `program_tb`
--
ALTER TABLE `program_tb`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role_tb`
--
ALTER TABLE `role_tb`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donation_tb`
--
ALTER TABLE `donation_tb`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `program_tb`
--
ALTER TABLE `program_tb`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `role_tb`
--
ALTER TABLE `role_tb`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
