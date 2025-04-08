-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 12:19 PM
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
-- Database: `stock_control`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'zabha', 'zabha@gmail.com', '1234', '2025-04-05 15:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `buyed_product`
--

CREATE TABLE `buyed_product` (
  `bayed_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,5) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `c_name`) VALUES
(9, ' Pent'),
(11, 'a'),
(2, 'Huddies'),
(6, 'Me\'n Pent'),
(7, 'men Shirt'),
(10, 'Pent'),
(3, 'Shirt'),
(1, 'Shoes'),
(8, 'Test category1'),
(5, 'Women Shirt');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `phone` int(20) NOT NULL,
  `email` int(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `paid_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(225) NOT NULL,
  `image` varchar(225) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `price`, `quantity`, `image`, `added_by`, `created_at`, `category_id`) VALUES
(2, 'Jordan', 1200.00, 5, '1743868633_pexels-pixabay-267301.jpg', 1, '2025-04-05 15:57:13', 1),
(3, 'Trainer', 30.00, 3, '1743873592_istockphoto-1350560575-612x612.jpg', 1, '2025-04-05 17:19:52', 1),
(5, 'Men shoes', 25.00, 2, '1743873746_images.jpeg', 1, '2025-04-05 17:22:26', 1),
(6, 'Dr Martin', 70.00, 6, '1743873982_71LL6yCVP4L._AC_SL1500_.jpg', 1, '2025-04-05 17:26:22', 1),
(7, 'Dr Martin Boots', 70.00, 4, '1743874106_images (1).jpeg', 1, '2025-04-05 17:28:26', 1),
(8, 'Dr Martin Smoth', 30.00, 7, '1743874266_dr-martens-1461-womens-shoes-oxblood-4.jpg', 1, '2025-04-05 17:31:06', 1),
(9, 'Dr. Martens shipping', 25.00, 2, '1743874491_images (2).jpeg', 1, '2025-04-05 17:34:51', 1),
(10, 'Sweatshirts', 12.00, 4, '1743875371_-473Wx593H-700501827-black-MODEL.avif', 1, '2025-04-05 17:49:31', 2),
(11, 'Frsh Girl Fashion', 17.00, 3, '1743875427_Linfrsh-Girls-Fashion-Hoodies-Sweatshirts-Long-Sleeve-NEW-YORK-Graphic-Letter-Print-Plus-Size-Cute-Pullovers-Top-Black-5-6-Years_f7fdac2b-501d-4203-81dd-38d924354263.2c5467221e0c85a5078036c1357fe31b.webp', 1, '2025-04-05 17:50:27', 2),
(12, 'Jordan', 1200.00, 3, '1743923537_images (1).jpeg', 1, '2025-04-06 07:12:17', 2),
(20, 'zabha', 12.00, 4, '1743929713_dr-martens-1461-womens-shoes-oxblood-4.jpg', 1, '2025-04-06 08:55:13', 2),
(21, 'zanvin', 16.00, 3, '1744097621_zanvin mens casual top.webp', 1, '2025-04-08 07:33:41', 5);

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `return_id` int(11) NOT NULL,
  `bayed_id` int(11) DEFAULT NULL,
  `quantity_returned` int(11) DEFAULT NULL,
  `return_reason` text DEFAULT NULL,
  `return_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL,
  `returned_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_sold` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `sold_to` int(11) DEFAULT NULL,
  `sold_by` int(11) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `sale_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `stock_out_id` int(11) NOT NULL,
  `product_id` int(225) NOT NULL,
  `quantity` int(225) NOT NULL,
  `reason` varchar(225) NOT NULL,
  `out_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_out`
--

INSERT INTO `stock_out` (`stock_out_id`, `product_id`, `quantity`, `reason`, `out_time`) VALUES
(1, 6, 2, 'buyed', '2025-04-07 09:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `contact`, `status`) VALUES
(1, 'Nyirabyo', '089888444', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `role` enum('admin','customer','system') DEFAULT 'customer',
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`, `role`, `phone`, `created_at`, `updated_at`, `status`) VALUES
(1, 'zabha_150', '$2y$10$TwRF992smSZrSW1k0brkG.XoZZ7hg8bSkskT5CuOe73iY09NQpkRW', 'zabhaumwe@gmail.com', 'MBARUSHIMANA', 'Emmanuel', 'admin', '0783336193', '2025-04-07 15:06:39', '2025-04-07 15:06:39', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `log_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `buyed_product`
--
ALTER TABLE `buyed_product`
  ADD PRIMARY KEY (`bayed_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`c_name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`return_id`),
  ADD KEY `bayed_id` (`bayed_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `returned_by` (`returned_by`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `sold_to` (`sold_to`),
  ADD KEY `sold_by` (`sold_by`);

--
-- Indexes for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`stock_out_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buyed_product`
--
ALTER TABLE `buyed_product`
  MODIFY `bayed_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `stock_out_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyed_product`
--
ALTER TABLE `buyed_product`
  ADD CONSTRAINT `buyed_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buyed_product_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_admin` FOREIGN KEY (`added_by`) REFERENCES `admins` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `admins` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`bayed_id`) REFERENCES `buyed_product` (`bayed_id`),
  ADD CONSTRAINT `returns_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `returns_ibfk_3` FOREIGN KEY (`returned_by`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`sold_to`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`sold_by`) REFERENCES `user_logs` (`log_id`);

--
-- Constraints for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD CONSTRAINT `stock_out_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
