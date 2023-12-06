-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2023 at 09:08 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop2`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `name`, `description`, `image`) VALUES
(1, 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` text,
  `email` varchar(255) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `password`, `email`, `createdOn`, `modifiedOn`) VALUES
(1, 'test', 'test', '$2y$10$Lwvt3nt51D5vviIifUAfyu7C02lOj2SBuJLuqNNW.krd26oAEegxy', '', '2023-11-08 11:45:04', '2023-11-08 11:46:07'),
(2, 'egeger', 'ergergerg', '$2y$10$dnrsO8mMy6RSaDvSO1UxoOLe.0PJopTZzp0FomWbVGcp77Kn0.Um.', 'regregreg@egerg.com', '2023-11-08 11:50:20', '2023-11-08 11:50:20'),
(3, 'Fred', 'Smith', '$2y$10$OtCIgHEYWtmm2umQShCLBu6KyJ48NefqkRzJ8t2OMCsPof3WnhVhO', 'Fred@Smith.com', '2023-11-15 11:17:49', '2023-11-15 11:17:49'),
(7, 'katie', 'smith', '$2y$10$AKpd5R3rl5PU4aGl0DQK3OE4p3uT19XRWhxCJ/wI5VnQOY8wUXSF2', 'katiesmith2@gmail.com', '2023-11-15 11:37:49', '2023-11-15 14:25:23'),
(8, 'jim', 'smith', '$2y$10$7j56SeGeR5YRMSAjo5LVYu/og703KV1uodU1YDMX73Tg85YNQFTva', 'jimsmith@gmail.com', '2023-11-15 14:31:29', '2023-11-15 14:31:29'),
(9, 'jim', 'smith', '$2y$10$7j56SeGeR5YRMSAjo5LVYu/og703KV1uodU1YDMX73Tg85YNQFTva', 'jimsmith@gmail.com', '2023-11-15 14:31:29', '2023-11-15 14:31:47'),
(10, 'amy', 'smith', '$2y$10$XJpmJ9LHeUUe0dE7YQVf6uQI9.lQcYjV1ks0IEnDb4w0njBZ/cQ/a', 'amysmith@test.com', '2023-11-28 15:03:11', '2023-11-28 15:03:11'),
(11, 'amy', 'smith', '$2y$10$XJpmJ9LHeUUe0dE7YQVf6uQI9.lQcYjV1ks0IEnDb4w0njBZ/cQ/a', 'amysmith@test.com', '2023-11-28 15:03:11', '2023-11-28 15:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
