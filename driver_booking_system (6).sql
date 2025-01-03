-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 07:15 AM
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
  `user_id` int(10) NOT NULL,
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
(5, 25, 1, 'kochi', 'kasarkod', '2024-10-25', '2024-10-17 08:35:13', 'cash'),
(6, 25, 4, 'thrivandrum', 'alapuzha', '2024-11-11', '2024-11-11 00:46:00', 'done'),
(7, 25, 9, 'kollam', 'alappuzha', '2024-11-11', '2024-11-11 00:56:35', 'cash'),
(8, 25, 8, 'kollam', 'ernakulam', '2024-11-11', '2024-11-11 01:00:44', 'cash'),
(9, 25, 1, 'ernakulam', 'alappuzha', '2024-11-11', '2024-11-11 01:06:51', 'cash'),
(10, 25, 13, 'ernakulam', 'alapuzha', '2024-11-12', '2024-11-11 05:53:17', 'done'),
(11, 25, 11, 'jjjjihbgv', 'jkjjhgg', '2024-12-01', '2024-11-30 04:41:30', 'done');

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
('faies', '9876543210', 'faiesks@gmail.com', 'Faies@1234', 'driver', 3, 'Trivandrum'),
('adhi', '7736911609', 'aadhi@gmail.com', 'Aadhi@0864', 'driver', 4, 'Trivandrum'),
('adhil', '9766527290', 'adhil@gmail.com', 'Adhil@54321', 'driver', 5, 'Trivandrum'),
('pranav', '7537980937', 'pranav@gmail.com', 'Pranav@321', 'driver', 6, 'Trivandrum'),
('arun', '9876368776', 'arun@gmail.com', 'Arun@9876', 'driver', 7, 'Trivandrum'),
('arjun', '9876485367', 'arjun@gmail.com', 'Arjun@654', 'driver', 8, 'Kollam'),
('saleem', '9876657680', 'saleem@gmail.com', 'Saleem@4567', 'driver', 9, 'Kollam'),
('adam', '9876527828', 'adam@gmail.com', 'Adam@8642', 'driver', 10, 'Kollam'),
('shaji', '6547827729', 'shaji@gmail.com', 'Shaji@2468', 'driver', 11, 'Kollam'),
('biju', '7687376870', 'biju@gmail.com', 'Biju@12345', 'driver', 12, 'Kollam'),
('praveen', '8764535770', 'praveen@gamil.com', 'Praveen@65432', 'driver', 13, 'Pathanamthitta'),
('aryan', '6254628918', 'aryan@gmail.com', 'Aryan@1029', 'driver', 14, 'Pathanamthitta'),
('Sahad', '8645837928', 'sahad@gmail.com', 'Sahad@2190', 'driver', 15, 'Pathanamthitta'),
('nishad', '9734797365', 'nishad@gmail.com', 'Nishad@3175', 'driver', 16, 'Pathanamthitta'),
('afsal', '8974683708', 'afsal@gmail.com', 'Afsal@5160', 'driver', 17, 'Pathanamthitta'),
('anshab', '8763468980', 'anshab@gmail.com', 'Anshab@6150', 'driver', 18, 'Allapuzha'),
('akmal', '8645667397', 'akku@gmail.com', 'Akmal@4280', 'driver', 19, 'Allapuzha'),
('rayan', '7864374986', 'rayan@gmail.com', 'Rayan@654789', 'driver', 20, 'Allapuzha'),
('nasar', '6463773738', 'nasar@gmail.com', 'Nasar@56789', 'driver', 21, 'Allapuzha'),
('nisar', '6548883640', 'nisar@gmail.com', 'Nisar@1234', 'driver', 22, 'Allapuzha');

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
('fasna@gmail.com', 'fasna', '0'),
('shamsu@gmail.com', 'qwer', '1'),
('shamsu@gmail.com', 'asdf', '1'),
('shamsu@gmail.com', 'asdf', '1'),
('bsvh@gmail.com', 'lkjh', '0'),
('bsvh@gmail.com', 'lkjh', '0'),
('hdgf@gmail.com', 'asdf', '0'),
('dgg@gmail.com', 'qwer', '1'),
('faiesks@gmail.com', 'Faies@1234', '1'),
('aadhi@gmail.com', 'Aadhi@0864', '1'),
('adhil@gmail.com', 'Adhil@54321', '1'),
('pranav@gmail.com', 'Pranav@321', '1'),
('arun@gmail.com', 'Arun@9876', '1'),
('arjun@gmail.com', 'Arjun@654', '1'),
('saleem@gmail.com', 'Saleem@4567', '1'),
('adam@gmail.com', 'Adam@8642', '1'),
('shaji@gmail.com', 'Shaji@2468', '1'),
('biju@gmail.com', 'Biju@12345', '1'),
('praveen@gamil.com', 'Praveen@65432', '1'),
('aryan@gmail.com', 'Aryan@1029', '1'),
('sahad@gmail.com', 'Sahad@2190', '1'),
('nishad@gmail.com', 'Nishad@3175', '1'),
('afsal@gmail.com', 'Afsal@5160', '1'),
('anshab@gmail.com', 'Anshab@6150', '1'),
('akku@gmail.com', 'Akmal@4280', '1'),
('rayan@gmail.com', 'Rayan@654789', '1'),
('nasar@gmail.com', 'Nasar@56789', '1'),
('nisar@gmail.com', 'Nisar@1234', '1');

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
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

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
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
