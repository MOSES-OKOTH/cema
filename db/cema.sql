-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 03:57 PM
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
-- Database: `cema`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id_number` varchar(20) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `deceased` tinyint(1) DEFAULT 0,
  `decease_date_time` datetime DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `multiple_birth` tinyint(1) DEFAULT 0,
  `phone_number1` varchar(20) DEFAULT NULL,
  `phone_number2` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `physical_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `next_of_kin_name` varchar(255) DEFAULT NULL,
  `next_of_kin_relationship` varchar(50) DEFAULT NULL,
  `next_of_kin_phone_number` varchar(20) DEFAULT NULL,
  `next_of_kin_email` varchar(200) DEFAULT NULL,
  `next_of_kin_physical_address` varchar(255) DEFAULT NULL,
  `next_of_kin_permanent_address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(20) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id_number`, `full_name`, `gender`, `date_of_birth`, `deceased`, `decease_date_time`, `marital_status`, `multiple_birth`, `phone_number1`, `phone_number2`, `email`, `nationality`, `physical_address`, `permanent_address`, `photo_url`, `next_of_kin_name`, `next_of_kin_relationship`, `next_of_kin_phone_number`, `next_of_kin_email`, `next_of_kin_physical_address`, `next_of_kin_permanent_address`, `created_at`, `created_by`) VALUES
('23456789', 'Moses Okoth', 'Male', '2002-02-01', 0, NULL, 'Single', 0, '+254714263898', '+254102335968', 'test@mail.com', 'Kenyan', 'Nairobi, Kenya', 'Nairobi, Kenya', '', 'Grace Otieno', 'Parent', '+254711256357', '', 'Kapenguria, Kenya', 'Kapenguria, Kenya', '2025-04-27 06:44:13', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `client_programs`
--

CREATE TABLE `client_programs` (
  `id` int(20) NOT NULL,
  `client_id` varchar(20) NOT NULL,
  `program_id` varchar(100) NOT NULL,
  `enrollment_date` date DEFAULT current_timestamp(),
  `enrolled_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_programs`
--

INSERT INTO `client_programs` (`id`, `client_id`, `program_id`, `enrollment_date`, `enrolled_by`) VALUES
(2, '23456789', 'B54', '2025-04-27', '12345678'),
(3, '23456789', 'B20', '2025-04-27', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` varchar(100) NOT NULL,
  `program_name` varchar(100) NOT NULL,
  `program_description` text DEFAULT NULL,
  `created_by` varchar(20) DEFAULT 'admin',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`, `program_description`, `created_by`, `created_at`) VALUES
('B20', 'HIV', 'HIV program Kenya', '12345678', '2025-04-27 08:50:44'),
('B54', 'Malaria', 'Malaria program for Kenya', '12345678', '2025-04-27 07:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_number` varchar(20) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `full_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `deceased` tinyint(1) DEFAULT 0,
  `decease_date_time` datetime DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `multiple_birth` tinyint(1) DEFAULT 0,
  `phone_number1` varchar(20) DEFAULT NULL,
  `phone_number2` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `physical_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `passkey` text DEFAULT '$2y$10$.16Q.6Wc7gkmPzQTSRDHeOqFdKmN5lTs8ufZxl/m2jZroPpbur0r6',
  `token` varchar(200) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(20) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_number`, `active`, `full_name`, `gender`, `date_of_birth`, `deceased`, `decease_date_time`, `marital_status`, `multiple_birth`, `phone_number1`, `phone_number2`, `email`, `nationality`, `physical_address`, `permanent_address`, `photo_url`, `passkey`, `token`, `token_expiry`, `created_at`, `created_by`) VALUES
('12345678', 1, 'TEST USER', 'Male', '2002-02-01', 0, NULL, 'Single', 0, '0712345678', '0723456789', 'test@mail.com', 'Kenyan', 'Nairobi, Kenya', 'Nairobi, Kenya', NULL, '$2y$10$.16Q.6Wc7gkmPzQTSRDHeOqFdKmN5lTs8ufZxl/m2jZroPpbur0r6', '25ce09a7e89792db69077d5df0693cee', '2025-04-30 07:01:19', '2025-04-27 07:03:11', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_number`);

--
-- Indexes for table `client_programs`
--
ALTER TABLE `client_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_programs`
--
ALTER TABLE `client_programs`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
