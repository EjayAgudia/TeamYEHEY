-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 04:04 PM
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
  `category` enum('Watches','Clothing','Shoes','Headphones') DEFAULT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(1, 'Guess 1875', NULL, 3000, 'images/watch1.jpg'),
(2, 'Guest Watch', 'Watches', 2500, 'images/watch2.jpg'),
(3, 'Panerai Watch', 'Watches', 3500, 'images/watch3.jpg'),
(4, 'Nonos Watch', 'Watches', 1800, 'images/watch4.jpg'),
(5, 'Levis', NULL, 1800, 'images/shirt1.jpg'),
(6, 'Louis Philippe T-Shirt', 'Clothing', 2500, 'images/shirt2.jpg'),
(7, 'Highlander T-Shirt', 'Clothing', 500, 'images/shirt3.jpg'),
(8, 'GUCCI White T-Shirt', 'Clothing', 2300, 'images/shirt4.jpg'),
(9, 'Nike White Sneaker', 'Shoes', 8000, 'images/shoe1.jpg'),
(10, 'Nike White Shoes', 'Shoes', 7500, 'images/shoe2.jpg'),
(11, 'Nike Yellow Sneaker', 'Shoes', 7000, 'images/shoe3.jpg'),
(12, 'Nike Brown Sneaker', 'Shoes', 6000, 'images/shoe4.jpg'),
(13, 'Beats Headphone', 'Headphones', 22500, 'images/sp1.jpg'),
(14, 'Zolo Headphone', 'Headphones', 4500, 'images/sp2.jpg'),
(15, 'Sony Speaker', 'Headphones', 10500, 'images/sp3.jpg'),
(16, 'Airpods', 'Headphones', 15000, 'images/sp4.jpg'),
(18, 'Omega Seamaster', 'Watches', 12000, 'images/682255e638d6c.jpg'),
(19, 'Casio G-Shock', 'Watches', 5000, 'images/682256463e7e3.jpg'),
(20, 'Fossil Chronograph', 'Watches', 4500, 'images/6822567d3a1ab.jpg'),
(21, 'Polo Ralph Lauren', 'Clothing', 3200, 'images/682258239eee2.jpg'),
(22, 'Tommy Hilfiger Tee', 'Clothing', 2800, 'images/682258481e362.jpg'),
(23, 'Adidas Originals', 'Clothing', 2100, 'images/682258820afee.jpg'),
(24, 'Nike Dri-FIT', 'Clothing', 1900, 'images/682258a0e08d7.jpg'),
(25, 'Adidas Ultraboost', 'Shoes', 9000, 'images/682258c0db9e7.jpg'),
(26, 'Puma Running Shoes', 'Shoes', 6500, 'images/682258d824e23.jpg'),
(27, 'Vans Classic', 'Shoes', 4000, 'images/682258fc0432d.jpg'),
(28, 'Converse Chuck Taylor', 'Shoes', 3800, 'images/6822591881f6d.jpg'),
(29, 'JBL Tune 500BT', 'Headphones', 3500, 'images/6822593a7bb75.jpg'),
(30, 'Bose QuietComfort', 'Headphones', 18000, 'images/6822594f84c78.jpg'),
(31, 'Sennheiser HD 450BT', 'Headphones', 12000, 'images/6822596625aa8.jpg'),
(32, 'Marshall Major IV', 'Headphones', 8500, 'images/6822597986a22.jpg'),
(34, 'hello', NULL, 232983, 'images/68229293db0d0.png'),
(35, 'rod for sale', NULL, 10, 'images/68232ef973015.png');

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
(70, 'admin@gmail.com', 'admin', 'admin', 0, '2025-05-12 19:55:42', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(71, 'admin@shoplift.com', 'Admin', 'User', 0, '2025-05-12 20:08:03', '0192023a7bbd73250516f069df18b500', 'admin');

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
(86, 70, 10, 'Confirmed');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users_products`
--
ALTER TABLE `users_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

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
