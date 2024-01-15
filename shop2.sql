-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 15, 2024 at 06:58 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
-- Table structure for table `catagories`
--

CREATE TABLE `catagories` (
  `id` int NOT NULL,
  `name` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `catagories`
--

INSERT INTO `catagories` (`id`, `name`) VALUES
(2, 'Root Vegetables'),
(8, 'Apples'),
(9, 'Meat');

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `stock` int NOT NULL,
  `buy_price` decimal(10,2) NOT NULL,
  `sell_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `name`, `description`, `image`, `stock`, `buy_price`, `sell_price`) VALUES
(32, 'Chicken', 'It&#039;s a chicken.', 'images/659722f2cb50e2.72725826.png', 10, 4.73, 5.20),
(36, 'Beef', 'It&#039;s some beef.', 'images/6597191abd4573.12641744.jpg', 37, 10.00, 9.50),
(37, 'Carrots', 'It&#039;s some carrots.', 'images/65971b065c6291.59813968.png', 54, 1.12, 1.67),
(41, 'Granny Smith', 'It&#039;s an apple.', 'images/6597555c297f93.26923684.jpeg', 116, 0.17, 0.32);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_catagories`
--

CREATE TABLE `equipment_catagories` (
  `equipment_id` int NOT NULL,
  `catagory_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `equipment_catagories`
--

INSERT INTO `equipment_catagories` (`equipment_id`, `catagory_id`) VALUES
(37, 2),
(41, 8),
(32, 9),
(37, 2),
(36, 9);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_suppliers`
--

CREATE TABLE `equipment_suppliers` (
  `equipment_id` int NOT NULL,
  `supplier_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `equipment_suppliers`
--

INSERT INTO `equipment_suppliers` (`equipment_id`, `supplier_id`) VALUES
(32, 1),
(36, 1),
(37, 2),
(41, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `placedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `placedOn`) VALUES
(9, 59, '2024-01-09 06:11:00'),
(10, 59, '2024-01-09 06:13:24'),
(11, 59, '2024-01-09 22:36:14'),
(12, 59, '2024-01-09 22:37:04'),
(13, 59, '2024-01-10 04:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `order_cart`
--

CREATE TABLE `order_cart` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `equipment_id` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_cart`
--

INSERT INTO `order_cart` (`id`, `order_id`, `equipment_id`, `price`, `quantity`) VALUES
(6, 9, 32, 5.20, 3),
(7, 9, 36, 9.50, 2),
(8, 9, 37, 1.67, 8),
(9, 9, 41, 0.32, 5),
(10, 10, 36, 9.50, 12),
(11, 10, 32, 5.20, 1),
(12, 11, 32, 5.20, 12),
(13, 12, 32, 5.20, 12),
(14, 13, 32, 5.20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `restocks`
--

CREATE TABLE `restocks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `placedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restocks`
--

INSERT INTO `restocks` (`id`, `user_id`, `placedOn`) VALUES
(1, 60, '2024-01-08 16:46:02'),
(5, 60, '2024-01-08 19:52:31'),
(6, 60, '2024-01-09 22:13:35'),
(7, 60, '2024-01-09 22:24:12'),
(8, 60, '2024-01-10 04:31:00'),
(9, 60, '2024-01-10 04:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `createdOn`, `modifiedOn`) VALUES
(1, 'User', '2023-11-29 11:09:48', '2024-01-05 03:45:15'),
(2, 'Admin', '2023-11-29 11:09:48', '2024-01-04 21:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` int NOT NULL,
  `restock_id` int NOT NULL,
  `equipment_id` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `payment_term` varchar(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `restock_id`, `equipment_id`, `price`, `quantity`, `payment_term`) VALUES
(1, 1, 41, 0.17, 22, 'NET 30'),
(2, 1, 37, 1.12, 5, 'NET 30'),
(8, 5, 32, 4.73, 6, 'NET 30'),
(9, 5, 36, 10.00, 11, 'NET 30'),
(10, 5, 37, 1.12, 3, 'NET 30'),
(11, 6, 41, 0.17, 1, 'NET 30'),
(12, 7, 32, 4.73, 12, 'NET 30'),
(13, 8, 32, 4.73, 10, 'NET 30'),
(14, 9, 32, 4.73, 10, 'NET 30');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(63) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(511) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`) VALUES
(1, 'Best Food Ltd.', 'bestfoodltd@foodltd.com', '01234567890', '123 Street, Big City, EX1200'),
(2, 'Another Supplier Ltd.', 'anothersupplier@email.com', '1234567777', 'At some address. EE3456');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
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
(2, 'John', 'Doe', '$2y$10$dnrsO8mMy6RSaDvSO1UxoOLe.0PJopTZzp0FomWbVGcp77Kn0.Um.', 'johndoe@gourmetgrocer.com', '2023-11-08 11:50:20', '2024-01-15 06:49:21'),
(3, 'Fred', 'Smith', '$2y$10$OtCIgHEYWtmm2umQShCLBu6KyJ48NefqkRzJ8t2OMCsPof3WnhVhO', 'Fred@Smith.com', '2023-11-15 11:17:49', '2023-11-15 11:17:49'),
(7, 'katie', 'smith', '$2y$10$AKpd5R3rl5PU4aGl0DQK3OE4p3uT19XRWhxCJ/wI5VnQOY8wUXSF2', 'katiesmith2@gmail.com', '2023-11-15 11:37:49', '2023-11-15 14:25:23'),
(8, 'jim', 'smith', '$2y$10$7j56SeGeR5YRMSAjo5LVYu/og703KV1uodU1YDMX73Tg85YNQFTva', 'jimsmith@gmail.com', '2023-11-15 14:31:29', '2023-11-15 14:31:29'),
(9, 'jim', 'smith', '$2y$10$7j56SeGeR5YRMSAjo5LVYu/og703KV1uodU1YDMX73Tg85YNQFTva', 'jimsmith@gmail.com', '2023-11-15 14:31:29', '2023-11-15 14:31:47'),
(10, 'amy', 'smith', '$2y$10$XJpmJ9LHeUUe0dE7YQVf6uQI9.lQcYjV1ks0IEnDb4w0njBZ/cQ/a', 'amysmith@test.com', '2023-11-28 15:03:11', '2023-11-28 15:03:11'),
(59, 'Member', 'Member', '$2y$10$2UAV.lNCi1ay0h5OQd0XAOBwlCQEQRv24We5p/fs7N47eWiOYGXRC', 'member@gmail.com', '2023-12-18 17:22:15', '2023-12-18 17:22:15'),
(60, 'Admin', 'Test', '$2y$10$GTy9mQqDGDN0n97VCCxAIuGOP2sejsUIBpfOsRu7GBb3tj8VkUkIW', 'admin@gmail.com', '2023-12-27 17:00:56', '2024-01-04 21:41:06'),
(63, 'Tester', 'Test', '$2y$10$fnY0GtE/tu8OXWgJFoRfneEabn5EyKx7L1JxZZymtgJ75JcYjcS5m', 'testertest@gmail.com', '2024-01-05 03:37:04', '2024-01-05 03:37:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(2, 1),
(3, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(59, 1),
(63, 1),
(60, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagories`
--
ALTER TABLE `catagories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_catagories`
--
ALTER TABLE `equipment_catagories`
  ADD KEY `equipment_catagory_ibfk_1` (`catagory_id`),
  ADD KEY `equipment_catagory_ibfk_2` (`equipment_id`);

--
-- Indexes for table `equipment_suppliers`
--
ALTER TABLE `equipment_suppliers`
  ADD PRIMARY KEY (`equipment_id`),
  ADD KEY `equipment_supplier_ibfk_2` (`supplier_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user_ibfk_1` (`user_id`);

--
-- Indexes for table `order_cart`
--
ALTER TABLE `order_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_equipment_ibfk_1` (`equipment_id`),
  ADD KEY `cart_order_ibfk_1` (`order_id`);

--
-- Indexes for table `restocks`
--
ALTER TABLE `restocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restock_user_ibfk_1` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restock_equipment_ibfk_1` (`equipment_id`),
  ADD KEY `restock_equipment_ibfk_2` (`restock_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
-- AUTO_INCREMENT for table `catagories`
--
ALTER TABLE `catagories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_cart`
--
ALTER TABLE `order_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `restocks`
--
ALTER TABLE `restocks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment_catagories`
--
ALTER TABLE `equipment_catagories`
  ADD CONSTRAINT `equipment_catagory_ibfk_1` FOREIGN KEY (`catagory_id`) REFERENCES `catagories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipment_catagory_ibfk_2` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `equipment_suppliers`
--
ALTER TABLE `equipment_suppliers`
  ADD CONSTRAINT `equipment_supplier_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipment_supplier_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_cart`
--
ALTER TABLE `order_cart`
  ADD CONSTRAINT `cart_equipment_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restocks`
--
ALTER TABLE `restocks`
  ADD CONSTRAINT `restock_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `restock_equipment_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restock_equipment_ibfk_2` FOREIGN KEY (`restock_id`) REFERENCES `restocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
