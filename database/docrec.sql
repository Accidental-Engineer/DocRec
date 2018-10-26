-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2018 at 09:46 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `docrec`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(10) NOT NULL,
  `appointment_id` varchar(16) NOT NULL,
  `doctor_id` int(18) NOT NULL,
  `patient_fullname` varchar(150) NOT NULL,
  `dob` date NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `body_pain` tinyint(4) NOT NULL DEFAULT '0',
  `fatigue` tinyint(5) NOT NULL DEFAULT '0',
  `headache` tinyint(5) NOT NULL DEFAULT '0',
  `infection` tinyint(5) NOT NULL DEFAULT '0',
  `abdominal_pain` tinyint(5) NOT NULL DEFAULT '0',
  `anxiety` tinyint(5) NOT NULL DEFAULT '0',
  `nausea` tinyint(5) NOT NULL DEFAULT '0',
  `common_cold` tinyint(5) NOT NULL DEFAULT '0',
  `dizziness` tinyint(5) NOT NULL DEFAULT '0',
  `diarrhea` tinyint(5) NOT NULL DEFAULT '0',
  `constipation` tinyint(5) NOT NULL DEFAULT '0',
  `hypertension` tinyint(5) NOT NULL DEFAULT '0',
  `fever` tinyint(5) NOT NULL DEFAULT '0',
  `cough` tinyint(5) NOT NULL DEFAULT '0',
  `stress` tinyint(5) NOT NULL DEFAULT '0',
  `perspiration` tinyint(5) NOT NULL DEFAULT '0',
  `migraine` tinyint(5) NOT NULL DEFAULT '0',
  `anorxeia` tinyint(5) NOT NULL DEFAULT '0',
  `bloating` tinyint(5) NOT NULL DEFAULT '0',
  `muscle_pain` tinyint(5) NOT NULL DEFAULT '0',
  `arthritis` tinyint(5) NOT NULL DEFAULT '0',
  `joint_pain` tinyint(4) NOT NULL DEFAULT '0',
  `hair_loss` tinyint(4) NOT NULL DEFAULT '0',
  `irritation_in_eyes` tinyint(4) NOT NULL DEFAULT '0',
  `problem` text NOT NULL,
  `descr_title` varchar(200) NOT NULL,
  `descr_content` text NOT NULL,
  `date_of_entry` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointment_id`, `doctor_id`, `patient_fullname`, `dob`, `mobile`, `email`, `address`, `body_pain`, `fatigue`, `headache`, `infection`, `abdominal_pain`, `anxiety`, `nausea`, `common_cold`, `dizziness`, `diarrhea`, `constipation`, `hypertension`, `fever`, `cough`, `stress`, `perspiration`, `migraine`, `anorxeia`, `bloating`, `muscle_pain`, `arthritis`, `joint_pain`, `hair_loss`, `irritation_in_eyes`, `problem`, `descr_title`, `descr_content`, `date_of_entry`) VALUES
(1, 'DvlJpJXfKg7V244F', 1, 'Suman Devi', '0000-00-00', '8562104562', 'suman41@gmail.com', 'Chapra', 0, 6, 6, 0, 6, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-07-31 23:52:05'),
(2, 'oiKtWWBIsDOsSMWH', 1, 'Sohan Radhe', '0000-00-00', '9262104562', 'radhehello412@gmail.com', 'Patna', 0, 0, 0, 0, 0, 6, 6, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-07-31 23:55:59'),
(3, 'x4rDnbkpiyL6FKKH', 1, 'Aman Singh', '0000-00-00', '895414562', 'amancpr@gmail.com', 'Patna', 0, 0, 6, 0, 6, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-07-31 23:58:06'),
(4, 'ew8aygFEYyX0hzfG', 1, 'Aman Singh', '0000-00-00', '895414562', 'amancpr@gmail.com', 'Patna', 0, 0, 6, 0, 6, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-07-31 23:59:29'),
(5, '99DeoioZ5BHFvusV', 1, 'Aman Singh', '0000-00-00', '895414562', 'amancpr@gmail.com', 'Patna', 0, 0, 6, 0, 6, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-08-01 00:02:10'),
(6, 'UPAd0LMbPqAQ9QDi', 1, 'Aman Singh', '0000-00-00', '895414562', 'amancpr@gmail.com', 'Patna', 0, 0, 6, 0, 6, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-08-01 00:02:27'),
(7, 'lTMR1RQuVUu2la6n', 1, 'Aman Singh', '0000-00-00', '895414562', 'amancpr@gmail.com', 'Patna', 0, 0, 6, 0, 6, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-08-01 00:12:59'),
(8, 'rIVEKK3DX106Nybd', 1, 'Suman Devi', '0000-00-00', '8562104562', 'suman41@gmail.com', 'Chapra', 0, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-08-01 00:15:10'),
(9, 'POYgmUnMxY287ito', 1, 'Suman Devi', '0000-00-00', '8562104562', 'suman41@gmail.com', 'Chapra', 0, 6, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-08-01 00:18:56'),
(10, 'UI6Pif19urcqkT1h', 1, 'Suman Devi', '0000-00-00', '8562104562', 'aradityaraj2002@gmail.com', 'Chapra', 0, 6, 0, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-08-01 00:25:12'),
(11, '1wlkA7UFrg4XcL4f', 1, 'Suman Devi', '0000-00-00', '8562104562', 'aradityaraj2002@gmail.com', 'Chapra', 0, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-08-01 00:26:40'),
(12, 'O0843GiVjXL9zlEI', 1, 'Suman Devi', '2018-08-09', '8562104562', 'aradityaraj2002@gmail.com', 'Chapra', 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2018-08-01 00:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `middle_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `specialization` int(11) NOT NULL,
  `work_place` varchar(150) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `almameter` varchar(150) NOT NULL,
  `experience` int(11) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `first_name`, `middle_name`, `last_name`, `specialization`, `work_place`, `sex`, `degree`, `almameter`, `experience`, `latitude`, `longitude`) VALUES
(1, 'Ranjit', 'Damodar', 'Deshmukh', 4, 'PMCH, Patna', 1, 'MBBS', 'AIIMS (DELHI)', 5, 25.6205, 85.1581),
(2, 'Ruchika', 'Prasad', 'Singh', 3, 'NMCH, Patna', 0, 'MBBS, MD', 'PMCH, Patna', 3, 25.6009, 85.1983),
(3, 'Suman', 'Rajshree', 'Pandey', 5, 'Udayan Hospital, Patna', 0, 'BDS', 'IGIMS, Patna', 2, 25.621, 85.1229);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
