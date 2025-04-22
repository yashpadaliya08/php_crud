-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 07:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `emp_id` int(11) NOT NULL,
  `emp_fname` varchar(255) NOT NULL,
  `emp_lname` varchar(255) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_pno` varchar(11) NOT NULL,
  `emp_gender` varchar(255) NOT NULL,
  `emp_jdate` date NOT NULL,
  `emp_add` varchar(255) NOT NULL,
  `emp_desi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`emp_id`, `emp_fname`, `emp_lname`, `emp_email`, `emp_pno`, `emp_gender`, `emp_jdate`, `emp_add`, `emp_desi`) VALUES
(3, 'jay', 'patel', 'yash@gmail.com', '2147483647', 'male', '2025-04-19', 'Rajkot', 'TeamLead'),
(4, 'casd', 'dfsa', 'yash@gmail.com', '9638892991', 'male', '2025-04-16', 'wsftf', 'Designer'),
(11, 'Yash', 'Padaliya', 'yashpadaliya2@gmail.com', '9638892991', 'male', '2025-04-01', 'Rajkot', 'Designer'),
(15, 'Vishal', 'Patel', 'vishal222@gmail.com', '123456789', '', '2025-04-11', 'Rajkot', 'QA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
