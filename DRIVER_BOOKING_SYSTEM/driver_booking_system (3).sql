-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 02:58 PM
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
(1, 17, 1, 'kochi', 'alapuzha', '2024-10-19', '2024-10-17 07:25:01', 'cash'),
(2, 17, 2, 'kochi', 'alapuzha', '2024-10-20', '2024-10-17 07:34:37', 'done'),
(4, 17, 1, 'assgfdfd', 'bcbcc', '2024-10-29', '2024-10-17 07:41:28', 'done'),
(5, 25, 1, 'kochi', 'kasarkod', '2024-10-25', '2024-10-17 08:35:13', 'cash');

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
('fasna', '2147483647', 'fasna@gmail.com', 'fasna', 'user', 19, ''),
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
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
