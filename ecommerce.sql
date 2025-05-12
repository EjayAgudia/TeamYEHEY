-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 06:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'Guess 1875', 30000, 'images/watch1.jpg'),
(2, 'Guest Watch', 25000, 'images/watch2.jpg'),
(3, 'Panerai Watch', 3500, 'images/watch3.jpg'),
(4, 'Nonos Watch', 1800, 'images/watch4.jpg'),
(5, 'Levis', 1800, 'images/shirt1.jpg'),
(6, 'Louis Philippe T-Shirt', 2500, 'images/shirt2.jpg'),
(7, 'Highlander T-Shirt', 500, 'images/shirt3.jpg'),
(8, 'GUCCI White T-Shirt', 2300, 'images/shirt4.jpg'),
(9, 'Nike White Sneaker', 8000, 'images/shoe1.jpg'),
(10, 'Nike White Shoes', 7500, 'images/shoe2.jpg'),
(11, 'Nike Yellow Sneaker', 7000, 'images/shoe3.jpg'),
(12, 'Nike Brown Sneaker', 6000, 'images/shoe4.jpg'),
(13, 'Beats Headphone', 22500, 'images/sp1.jpg'),
(14, 'Zolo Headphone', 4500, 'images/sp2.jpg'),
(15, 'Sony Speaker', 10500, 'images/sp3.jpg'),
(16, 'Airpods', 15000, 'images/sp4.jpg'),
(17, 'Rolex Submariner', 15000, 'images/watch5.jpg'),
(18, 'Omega Seamaster', 12000, 'images/watch6.jpg'),
(19, 'Casio G-Shock', 5000, 'images/watch7.jpg'),
(20, 'Fossil Chronograph', 4500, 'images/watch8.jpg'),
(21, 'Polo Ralph Lauren', 3200, 'images/shirt5.jpg'),
(22, 'Tommy Hilfiger Tee', 2800, 'images/shirt6.jpg'),
(23, 'Adidas Originals', 2100, 'images/shirt7.jpg'),
(24, 'Nike Dri-FIT', 1900, 'images/shirt8.jpg'),
(25, 'Adidas Ultraboost', 9000, 'images/shoe5.jpg'),
(26, 'Puma Running Shoes', 6500, 'images/shoe6.jpg'),
(27, 'Vans Classic', 4000, 'images/shoe7.jpg'),
(28, 'Converse Chuck Taylor', 3800, 'images/shoe8.jpg'),
(29, 'JBL Tune 500BT', 3500, 'images/sp5.jpg'),
(30, 'Bose QuietComfort', 18000, 'images/sp6.jpg'),
(31, 'Sennheiser HD 450BT', 12000, 'images/sp7.jpg'),
(32, 'Marshall Major IV', 8500, 'images/sp8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `phone` int(10) NOT NULL,
  `registration_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email_id`, `first_name`, `last_name`, `phone`, `registration_time`, `password`, `role`) VALUES
(69, 'rod@gmail.com', 'rod', 'rod', 0, '2025-04-29 13:21:58', '52c59993d8e149a1d70b65cb08abf692', 'user'),
(70, 'admin@gmail.com', 'admin', 'admin', 0, '2025-05-02 01:42:57', '21232f297a57a5a743894a0e4a801fc3', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users_products`
--

CREATE TABLE `users_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `status` enum('Added To Cart','Confirmed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_products`
--

INSERT INTO `users_products` (`id`, `user_id`, `item_id`, `status`) VALUES
(76, 70, 9, 'Confirmed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_products`
--
ALTER TABLE `users_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users_products`
--
ALTER TABLE `users_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_products`
--
ALTER TABLE `users_products`
  ADD CONSTRAINT `users_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_products_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
