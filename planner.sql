-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2026 at 12:18 AM
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
-- Database: `planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `first_name`, `email`, `message`, `created_at`, `last_name`) VALUES
(1, 'Luka', 'lukahorvat@gmail.com', 'Aplikacija šteka', '2026-01-21 22:59:39', 'Horvat'),
(2, 'Ivan', 'ihorvat@gmail.com', 'Aplikacija šteka.', '2026-01-21 23:16:04', 'Horvat'),
(3, 'Luka', 'lhorvat@gmail.com', 'Aplikacija je odlična', '2026-01-21 23:22:30', 'horvat'),
(4, 'Ivana', 'ivanahorvat@gmail.com', 'Aplikacija mi se sviđa.', '2026-01-21 23:23:27', 'Horvat'),
(5, 'Ivana', 'ivanahorvat@gmail.com', 'Aplikacija šteka.', '2026-01-21 23:26:00', 'Horvat'),
(6, 'Lucija', 'lucijahorvat@gmail.com', 'Aplikacija šteka.', '2026-01-21 23:43:38', 'Horvat');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `professor` varchar(100) DEFAULT NULL,
  `ects` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `user_id`, `name`, `professor`, `ects`) VALUES
(1, 1, 'Matematika', 'Ivana', 6),
(2, 1, 'Matematika', 'Ivana', 6),
(3, 11, 'Matematika', 'Ivana', 5),
(4, 9, 'Programiranje', 'Prof', 6),
(5, 9, 'innformatika', 'kika', 7),
(6, 9, 'Matematika', 'Marina', 4),
(7, 11, 'Programiranje', 'Horvat', 7),
(8, 9, 'Tjelesni', 'Vlaho', 1),
(9, 11, 'Psihologija', 'Mateja', 3),
(10, 14, 'Matematika', 'Marina', 5),
(11, 14, 'Programiranje', 'Ivan', 6),
(12, 15, 'Matematika', 'Marina', 4),
(13, 15, 'Programiranje', 'Ivan', 6),
(14, 16, 'Matematika', 'Marina', 4),
(15, 16, 'Programiranje', 'Ivan', 6),
(16, 16, 'Tjelesni', 'Vlaho', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` enum('pending','done','late') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `subject_id`, `title`, `description`, `deadline`, `status`) VALUES
(10, NULL, 8, 'Skupljanje bodova', '', '2026-02-28', 'done'),
(11, NULL, 9, 'Knjiga', '', '2026-01-28', 'pending'),
(12, NULL, 10, 'Vježbanje za kolokvij', '', '2026-02-04', 'done'),
(13, NULL, 11, 'Vježba za ispit', '', '2026-02-08', 'pending'),
(14, NULL, 10, 'Provjeriti kada je kolokvij', '', '2026-01-20', 'pending'),
(15, NULL, 12, 'Kolokvij', '', '2026-02-04', 'done'),
(16, NULL, 13, 'Ispit', '', '2026-01-29', 'pending'),
(17, NULL, 4, 'kolokvij', '', '2026-01-20', 'pending'),
(18, NULL, 14, 'Kolokvij', '', '2026-01-28', 'done'),
(19, NULL, 15, 'Ispit', '', '2026-01-30', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `role`) VALUES
(9, 'antonija', 'haj', 'antonijahaj@gmail.com', 'antonijahaj', '$2y$10$kAC2WAcXo68KGNN1uR8L7.yDUWuGDcFTwZcSvvTiY35LB1brRUrF6', 'admin'),
(11, 'ivan', 'ivic', 'iviv@gmail.com', 'iviv1', '$2y$10$0iyOB35ul33EtdMSITjZne29zotj1L2I1cGtedFy4upaUXn5ipUbi', 'user'),
(12, 'Luka', 'Horvat', 'lukahorvat@gmail.com', 'lukah', '$2y$10$WLwZautWNTeAgGvaHrYHRe3mDNG32ladV7d8addbXAo7nKwopvl8C', 'user'),
(13, 'Luka', 'Kovačić', 'lkovac@gmail.com', 'lkovac', '$2y$10$YqbKgSBEbTS23QrmPQSZLO491j1JUwvKFaWiY2h06HbOzeCO9Hm9S', 'user'),
(14, 'Ivan', 'Horvat', 'ihorvat@gmail.com', 'ihorvat', '$2y$10$h3gmegx2yjkk9CznbYLKYeJtSTyDutvYUXw4dObQjeBYzedHWQBQW', 'user'),
(15, 'Ivana', 'Horvat', 'ivanahorvat@gmail.com', 'ihorvat1', '$2y$10$JHNiocIdTHMFlDWhFGrl4ObJTLCXRKcmiCUkGMAY7HpUz9shiBDLa', 'user'),
(16, 'Lucija', 'Horvat', 'lucijahorvat@gmail.com', 'lhorvat1', '$2y$10$u9efyF.TULt6ar7gde/IU.xGHdLoWDDg8hHw/SBwIRsAROjyptv7m', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tasks_users` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
