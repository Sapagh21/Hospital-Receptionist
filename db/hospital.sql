-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2023 at 08:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `name`, `specialization`, `contact`) VALUES
(1, 'ahmed', 'neurology\r\n', '064289876'),
(2, 'ali', 'urology', '098756432'),
(3, 'ibrahim', 'family doctor\r\n', '02345672'),
(4, 'mhmd', 'Cardiology\r\n', '567838674');

-- --------------------------------------------------------

--
-- Table structure for table `medicalrecord`
--

CREATE TABLE `medicalrecord` (
  `medicalrecord_id` int(100) NOT NULL,
  `diag` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `medication_history` text DEFAULT NULL,
  `patient_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicalrecord`
--

INSERT INTO `medicalrecord` (`medicalrecord_id`, `diag`, `treatment`, `instructions`, `notes`, `medication_history`, `patient_id`) VALUES
(0, 'dummyrecord', 'dummyrecord', 'dummyrecord', 'dummyrecord', 'dummyrecord', 0),
(23, 'asdas', 'dasd', 'asdas', 'asd', 'asda', 27),
(40, 'sick', '', '', '', '', 43),
(41, 'fever', '', '', '', '', 44),
(42, 'fever', '', 'rest', '', '', 45),
(43, 'fever', '', '', '', '', 46),
(44, 'Fever', 'none', 'rest', '', '', 47),
(45, 'cold', '', '', '', '', 48),
(46, 'high temperature', '', 'Rest for 2 days', '', '', 49),
(47, 'Fever cold', '', 'Rest for 2 days', '', 'home treatment', 50);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(20) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `city` varchar(90) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `Gender` enum('Male','Female') NOT NULL,
  `status` enum('Admitted','Discharged') NOT NULL DEFAULT 'Admitted',
  `bill` int(10) NOT NULL DEFAULT 0,
  `room` varchar(90) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `national_id`, `name`, `age`, `city`, `phone`, `Gender`, `status`, `bill`, `room`, `doctor_id`) VALUES
(0, 'dummyrecord', 'dummyrecord', 0, 'dummyrecord', 'dummyrecord', 'Male', 'Admitted', 0, NULL, NULL),
(27, '123456', 'Seif', 22, 'desouk', '010244455858', 'Male', 'Admitted', 10, '3', 1),
(43, '1111111', 'ali', 22, 'cairo ', '0112548214', 'Male', 'Admitted', 0, '3', 2),
(44, '148523548136', 'mohammed', 25, 'alexandria', '0142144817', 'Male', 'Admitted', 0, '3', 2),
(45, '178615784', 'mohammed', 12, 'cairo', '1545415', 'Male', 'Admitted', 0, '1', 3),
(46, '1478523969', 'seif', 22, 'kafr al shiekh', '01712578', 'Male', 'Admitted', 0, '5', 3),
(47, '1598542366', 'Alaa', 22, 'Alexandria ', '0112458451', 'Male', 'Admitted', 0, '1', 2),
(48, '54615564', 'test', 412, 'cairo', '', 'Male', 'Admitted', 0, '3', 1),
(49, '45495681564', 'Ahmed', 23, 'cairo', '0118411587', 'Male', 'Admitted', 10, '5', 3),
(50, '17881546784', 'Alaa', 22, 'Alexandria', '011956878416', 'Female', 'Discharged', 101, '4', 3);

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `recep_id` int(11) NOT NULL,
  `r_name` varchar(100) DEFAULT NULL,
  `r_username` varchar(20) NOT NULL,
  `r_pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receptionist`
--

INSERT INTO `receptionist` (`recep_id`, `r_name`, `r_username`, `r_pass`) VALUES
(1, 'Mohammed', 'test', 'test'),
(2, 'Ahmed', 'ahmed', 'test'),
(3, 'nada', 'nada', 'root');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `medicalrecord`
--
ALTER TABLE `medicalrecord`
  ADD PRIMARY KEY (`medicalrecord_id`),
  ADD KEY `fk_patient_record` (`patient_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`recep_id`),
  ADD UNIQUE KEY `r_username` (`r_username`),
  ADD UNIQUE KEY `r_username_2` (`r_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medicalrecord`
--
ALTER TABLE `medicalrecord`
  MODIFY `medicalrecord_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `recep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
