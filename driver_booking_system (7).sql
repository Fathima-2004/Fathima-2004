-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 04:02 AM
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
-- Database: `driver_booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `from_place` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `booking_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` enum('cash','done') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `driver_id`, `from_place`, `destination`, `booking_date`, `created_at`, `payment_status`) VALUES
(9, 18, 2, 'Kasargod', 'Kozhikod', '2024-12-22', '2024-12-06 11:26:51', 'done'),
(10, 25, 1, 'kochi', 'alappuzha', '2024-12-07', '2024-12-06 13:26:02', 'done'),
(11, 25, 2, 'alappuzha', 'ernakulam', '2024-12-07', '2024-12-06 13:40:21', 'cash'),
(12, 25, 1, 'alappuzha', 'trivandrum', '2024-12-21', '2024-12-06 15:17:33', 'done'),
(13, 25, 2, 'dvcb,hcvg', 'nhjgsfkj', '2024-12-23', '2024-12-06 16:37:33', 'cash'),
(14, 25, 2, 'bnvh', 'xnjhcdjh', '2025-01-01', '2024-12-06 16:38:13', 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `username` varchar(25) NOT NULL,
  `phno` varchar(12) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pwd` varchar(15) NOT NULL,
  `user_type` varchar(25) NOT NULL,
  `driver_id` int(10) NOT NULL,
  `district` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`username`, `phno`, `email`, `pwd`, `user_type`, `driver_id`, `district`) VALUES
('shamsudheen', '9846666509', 'shamsu@gmail.com', 'asdf', 'driver', 1, 'Ernakulam'),
('gdghg', '2147483647', 'dgg@gmail.com', 'qwer', 'driver', 2, 'Ernakulam');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `user_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`username`, `email`, `feedback`, `user_id`) VALUES
('jirfpele;khfrur', 'shamsu@gmail.com', 'kjfiljflekwgedtyui', 4);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `user_type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`email`, `password`, `user_type`) VALUES
('ameena@gmail.com', 'qwer', '4'),
('sana@gmail.com', 'sana', '0'),
('fasna@gmail.com', 'fasna', '0'),
('shamsu@gmail.com', 'qwer', '1'),
('shamsu@gmail.com', 'asdf', '1'),
('shamsu@gmail.com', 'asdf', '1'),
('bsvh@gmail.com', 'lkjh', '0'),
('bsvh@gmail.com', 'lkjh', '0'),
('hdgf@gmail.com', 'asdf', '0'),
('dgg@gmail.com', 'qwer', '1');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `from_place` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` time DEFAULT NULL,
  `price` int(11) DEFAULT 0,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `user_status` varchar(20) DEFAULT 'requested'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `user_id`, `driver_id`, `from_place`, `destination`, `booking_date`, `booking_time`, `price`, `status`, `user_status`) VALUES
(9, 25, 2, 'kollam', 'ernakulam', '2025-01-06', '03:00:00', 0, 'rejected', 'requested'),
(11, 25, 1, 'fdghghsf', 'jsgjk', '2024-12-16', '04:00:00', 1500, 'approved', 'rejected'),
(12, 25, 2, 'dvcb,hcvg', 'nhjgsfkj', '2024-12-23', '03:00:00', 2200, 'approved', 'paid'),
(13, 25, 2, 'bnvh', 'xnjhcdjh', '2025-01-01', '12:02:00', 3000, 'approved', 'paid'),
(14, 25, 1, 'shwjsklwh', 'bjkwhklw', '2024-12-08', '11:02:00', 3000, 'approved', 'requested'),
(15, 25, 2, 'bhk.fjh', 'nmeghfhe', '2025-01-08', '11:22:00', 1200, 'approved', 'requested'),
(16, 25, 1, 'kdfhudhf', ',jdldjdi', '2025-01-01', '13:34:00', 3000, 'approved', 'requested');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `phno` varchar(22) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `user_type` varchar(25) NOT NULL,
  `user_id` int(10) NOT NULL,
  `district` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `phno`, `email`, `pwd`, `user_type`, `user_id`, `district`) VALUES
('sana', '2147483647', 'sana@gmail.com', 'sana', 'user', 18, ''),
('fasna', '9658564568', 'fasna@gmail.com', 'fasna', 'user', 19, 'Ernakulam'),
('shamsu', '2147483647', 'shamsu@gmail.com', 'asdf', 'driver', 22, ''),
('sfgshgsh', '2147483647', 'bsvh@gmail.com', 'lkjh', 'user', 23, ''),
('sfgshgsh', '2147483647', 'bsvh@gmail.com', 'lkjh', 'user', 24, ''),
('gdhdhfd', '2147483647', 'hdgf@gmail.com', 'asdf', 'user', 25, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `user_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
