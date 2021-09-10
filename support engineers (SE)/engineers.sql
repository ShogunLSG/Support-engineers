-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2021 at 04:55 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `engineers`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(15) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_username` varchar(255) NOT NULL,
  `company_password` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_username`, `company_password`, `company_address`) VALUES
(1, 'TUT SUPPORT ENGINEERS', 'icon', '$2y$10$ULnHTS/jUNfL/tl9GmDZOeHVTmZak43WauwfKmsRY1ESkS7gZd3Ha', 'SOSHANGUVE');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(15) NOT NULL,
  `company_id` int(15) NOT NULL,
  `emp_username` varchar(255) NOT NULL,
  `emp_password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `company_id`, `emp_username`, `emp_password`, `first_name`, `surname`) VALUES
(1, 1, 'RIKHOTSO', '$2y$10$5Au6SxPmHMz1e0QuzHvxyO8LE1FcAeeJVbgvhRuSi299XdTWe.ctS', 'MATIMU', 'MATIMBA'),
(2, 1, 'K', '$2y$10$VNYEZcg2b8w9Lp4DO9RfoOzzR2nN9Lyqa9HUgY/kuJxFFfIlxP.fK', 'K', 'K'),
(3, 1, 'S', '$2y$10$b0rmqwywALuwuTbiwB/3MuIVZdzvU5K.zVh.F97kkv7HctU/f/efq', 'S', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `emp_task`
--

CREATE TABLE `emp_task` (
  `emp_task_id` int(15) NOT NULL,
  `emp_id` int(15) NOT NULL,
  `company_id` int(15) NOT NULL,
  `task_id` int(15) NOT NULL,
  `completed_date` date NOT NULL,
  `amount` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_task`
--

INSERT INTO `emp_task` (`emp_task_id`, `emp_id`, `company_id`, `task_id`, `completed_date`, `amount`) VALUES
(1, 1, 1, 3, '2002-05-05', 20755),
(2, 1, 1, 4, '2025-05-05', 9321),
(3, 2, 1, 2, '2002-05-05', 1485),
(4, 2, 1, 5, '2021-08-07', 233),
(5, 1, 1, 6, '2021-08-07', 10544),
(6, 2, 1, 3, '2021-03-04', 233),
(7, 2, 0, 7, '2021-06-12', 343),
(8, 0, 0, 8, '0000-00-00', 767);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(15) NOT NULL,
  `emp_id` int(15) NOT NULL,
  `salary` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salary_id`, `emp_id`, `salary`) VALUES
(1, 1, 40620),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `school_id` int(15) NOT NULL,
  `school_username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`school_id`, `school_username`, `password`, `school_name`, `school_location`) VALUES
(1, 'MOSEEDI', '$2y$10$ThyXZRH/fs3h1QQckGh0Vusc.vKYqC0ZNsQYnDZ0ce8NgwyEdicKy', 'MOSEEDI', 'MAKOTSE'),
(2, 'I', '$2y$10$njvGtKDUfRydiO.bzJpSQedviWQaTz8LfTZ5MGYkXX6v0HE/9om7i', 'DERICK KOBE', 'Lebowakgomo'),
(3, 'capricorn high school', '$2y$10$Z/DMTQL0AgYUSKe8rZoErO9R2vgL.bO6EPJwdk6qE9uc6XOuo6zzu', 'capricorn high school', 'polokwane');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(15) NOT NULL,
  `school_id` int(15) NOT NULL,
  `company_id` int(15) NOT NULL,
  `task_Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `school_id`, `company_id`, `task_description`) VALUES
(1, 2, 1, 'Monitor Brother'),
(2, 1, 1, 'Printer fix'),
(3, 3, 1, 'CPU Broken'),
(4, 2, 1, 'Printer Ink'),
(5, 1, 1, ' KEYBOARD '),
(6, 3, 1, 'LAN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `emp_task`
--
ALTER TABLE `emp_task`
  ADD PRIMARY KEY (`emp_task_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_task`
--
ALTER TABLE `emp_task`
  MODIFY `emp_task_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `school_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
