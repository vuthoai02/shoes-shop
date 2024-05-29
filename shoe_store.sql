-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2024 at 09:03 AM
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
-- Database: `shoe_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`) VALUES
(1, 'Nike', 'nike-89', 'Nike is a famous sports company, founded in 1964, specializing in manufacturing and trading shoes, clothing, and sports accessories. Nike is famous for its creativity and unique style, and has achieved global popularity'),
(2, 'Balenciaga', 'balenciaga-45', 'Balenciaga is a prestigious fashion house headquartered in Paris, France, famous for creating shoe designs that are outstanding in style and uniqueness. Balenciaga shoes often combine comfort and fashion, with materials and design creating a unique combination of modern and classic.'),
(3, 'Adidas', 'adidas-42', 'Adidas, a leading global sports brand, is renowned for its innovation and quality in shoe design, delivering outstanding style and performance to sports and fashion lovers across the globe.'),
(4, 'Converse', 'converse', 'Converse, an icon in the sneaker world, is famous for its Chuck Taylor All Star line and simple design.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created_at`) VALUES
(35, 1, '2024-04-19 01:12:20'),
(36, 1, '2024-04-19 01:13:22'),
(37, 1, '2024-04-19 01:14:21'),
(38, 1, '2024-04-19 01:44:28'),
(39, 1, '2024-04-19 02:15:38'),
(40, 1, '2024-04-19 02:56:48'),
(41, 1, '2024-04-25 13:53:11'),
(42, 1, '2024-04-29 08:09:37'),
(43, 1, '2024-05-07 07:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` bigint NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `order_id` bigint DEFAULT NULL,
  `selling_price` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `user_id`, `product_id`, `order_id`, `selling_price`, `quantity`, `created_at`) VALUES
(109, 1, 14, 35, 450000, 1, '2024-04-19 01:12:20'),
(110, 1, 14, 36, 450000, 1, '2024-04-19 01:13:22'),
(111, 1, 13, 37, 425000, 1, '2024-04-19 01:14:21'),
(112, 1, 14, 38, 450000, 1, '2024-04-19 01:44:28'),
(113, 1, 13, 38, 425000, 1, '2024-04-19 01:44:28'),
(114, 1, 14, 39, 450000, 4, '2024-04-19 02:15:38'),
(115, 1, 14, 40, 23, 1, '2024-04-19 02:56:48'),
(116, 1, 14, 41, 23, 4, '2024-04-25 13:53:11'),
(117, 1, 14, 42, 23, 6, '2024-04-29 08:09:37'),
(118, 1, 13, 43, 22, 3, '2024-05-07 07:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `small_description` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `original_price` int NOT NULL,
  `selling_price` int NOT NULL,
  `image` varchar(191) NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `image`, `qty`) VALUES
(1, 1, 'Nike Air Force 1 Gray Cream Suede REP 1:1', 'nike-air-force-1-gray-cream-suede--rep-11-31-80-15-47', 'Material: suede\r\nsize: 37-42\r\nFree shipping', 'Personality style, sporty, dynamic', 24, 22, '1694776681.jpg', 20),
(2, 1, 'Nike Jordan 1 High Gray White Blue REP 1:1', 'nike-jordan-1-high-gray-white-blue-rep-11-34-58', 'Material: Leather fabric\r\nHeight: 3cm\r\nColor: blue white\r\nSize: 36-43\r\nLeather fabric material, easy to clean, soft.\r\nElasticity, good stretch, fits the foot tightly\r\nMolded rubber sole', 'High quality materials, durable and beautiful over time. Fashion Designer. Stylish design. Durable. Easy to coordinate.', 34, 32, '1694777291.jpg', 20),
(3, 1, 'Nike Jordan 1 High Full White REP 1:1', 'nike-jordan-1-high-full-white-rep-11-26-55', 'Material: Leather fabric\r\nHeight: 3cm\r\nColor: blue white\r\nSize: 36-43\r\nLeather fabric material, easy to clean, soft.\r\nElasticity, good stretch, fits the foot tightly\r\nMolded rubber sole', 'High quality materials, durable and beautiful over time. Fashion Designer. Stylish design. Durable. Easy to coordinate.', 26, 25, '1694777421.jpg', 20),
(4, 1, 'Nike Air Jordan 4 Retro White Gray Black REP 1:1', 'nike-air-jordan-4-retro-white-gray-black-rep-11-38-21-63-66', 'Material: Leather fabric\r\nHeight: 3cm\r\nColor: blue white\r\nSize: 36-43\r\nLeather fabric material, easy to clean, soft.\r\nElasticity, good stretch, fits the foot tightly\r\nMolded rubber sole', 'High quality materials, durable and beautiful over time. Fashion Designer. Stylish design. Durable. Easy to coordinate.', 28, 27, '1694777508.jpg', 20),
(5, 2, 'BALENCIAGA Speed Black White', 'balenciaga-speed-black-white-13-11', 'Material: Stretch fabric\r\nHeight: 5cm\r\nColor: black\r\nSize: 36-43\r\nFabric material, easy to clean, soft.\r\nElasticity, good stretch, fits the foot tightly\r\nMolded rubber sole', 'High quality materials, durable and beautiful over time. Fashion Designer. Stylish design. Durable. Easy to coordinate.', 29, 26, '1694778158.jpg', 20),
(6, 2, 'BALENCIAGA TRACK SOCK SNEAKER', 'balenciaga-track-sock-sneaker-40-36', 'Track Sock Sneaker in white and black knit and nylon\r\nMaterial: 75% Polyurethane, 21% Polyester, 4% nylon', 'Unique, strong style, suitable for unique outfits', 31, 30, '1694777957.jpg', 20),
(7, 2, 'BALENCIAGA SPEED 2.0 CLEAR SOLE RECYCLED KNIT SNEAKER', 'balenciaga-speed-20-clear-sole-recycled-knit-sneaker-65-63', 'Speed 2.0 insole sneakers in black recycled knit fabric, white and blue sole', 'Unique, strong style, suitable for unique outfits', 26, 25, '1694778317.jpg', 20),
(8, 2, 'BALENCIAGA TRIPLE S SNEAKER IN OFF WHITE', 'balenciaga-triple-s-sneaker-in-off-white-11', 'Triple S sneakers in off-white and double mesh', 'Unique, strong style, suitable for unique outfits', 26, 25, '1694778426.jpg', 20),
(9, 3, 'Adidas A168 Gray color', 'adidas-a168-gray-color-42-93', 'Material: Fabric\r\nHeight: 2cm\r\nColor: blue white\r\nSize: 36-43\r\nLeather fabric material, easy to clean, soft.\r\nElasticity, good stretch, fits the foot tightly\r\nRubber soles', 'High quality materials, durable and beautiful over time. Simple disign. Durable. Easy to coordinate.', 23, 22, '1694778612.jpg', 20),
(10, 3, 'Adidas Ultra Boost 6.0 Gray Purple REP', 'adidas-ultra-boost-60-gray-purple-rep-50-71-48', 'Material: Fabric\r\nHeight: 2cm\r\nColor: blue white\r\nSize: 36-43\r\nLeather fabric material, easy to clean, soft.\r\nElasticity, good stretch, fits the foot tightly\r\nRubber soles', 'High quality materials, durable and beautiful over time. Simple disign. Durable. Easy to coordinate.', 26, 24, '1694778761.jpg', 20),
(11, 3, 'Adidas Alphabounce Beyond REP Full White', 'adidas-alphabounce-beyond-rep-full-white-71-29', 'Material: Fabric\r\nHeight: 2cm\r\nColor: blue white\r\nSize: 36-43\r\nLeather fabric material, easy to clean, soft.\r\nElasticity, good stretch, fits the foot tightly\r\nRubber soles', 'High quality materials, durable and beautiful over time. Simple disign. Durable. Easy to coordinate.', 23, 22, '1694778853.jpg', 20),
(12, 3, 'Adidas Stan Smith White Black Heel REP 1:1', 'adidas-stan-smith-white-black-heel-rep-11-20-43', 'Material: Fabric\r\nHeight: 2cm\r\nColor: blue white\r\nSize: 36-43\r\nLeather fabric material, easy to clean, soft.\r\nElasticity, good stretch, fits the foot tightly\r\nRubber soles', 'High quality materials, durable and beautiful over time. Simple disign. Durable. Easy to coordinate.', 26, 25, '1694778994.jpg', 20),
(13, 4, 'Converse Chuck Taylor All Star', 'converse-chuck-taylor-all-star-90-41', 'Product line: CHUCK TAYLOR ALL STAR\r\nGender: UNISEX\r\nColor: Black\r\n1 month warranty', 'High quality materials, durable and beautiful over time. Simple disign. Durable. Easy to coordinate.', 24, 22, '1694779991.webp', 15),
(14, 4, 'Converse Chuck Taylor All Star Lift Pride', 'converse-chuck-taylor-all-star-lift-pride-95-31-27-20', 'Product line: Chuck Taylor All Star Lift Pride\r\nGender: UNISEX\r\nColor: WHITE/FRESH YELLOW/GNARLY BLUE\r\n1 month warranty', 'High quality materials, durable and beautiful over time. Simple disign. Durable. Easy to coordinate.', 24, 23, '1702046727.webp', 2),
(15, 1, 'Nike Air Force 1 Low Cream Black Swoosh', 'nike-air-force-1-low-cream-black-swoosh-57-67', 'Product line: Low Swoosh\r\nGender: UNISEX\r\nColor: Cream Black\r\n1 month warranty', 'High quality materials, durable and beautiful over time. Simple disign. Durable. Easy to coordinate.', 30, 29, '1702046777.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'User', 'user@gmail.com', '0123456789', '$2y$10$xdjSZRMIoP0YFO0YwU.iQ.skU42QD41hwyn6h4XXGlJB0rCmkgnvO'),
(2, 'User 2', 'user2@gmail.com', '0123456789', '$2y$10$arUmT.mvBhIbxK9vCG0uGOw4ly6tQiTITCqBnk/nJRz8BDv9hiB.S'),
(3, 'User 3', 'user3@gmail.com', '0123456789', '$2y$10$4IdvrD2RNnWjkzHOer8MVuwvEUqYLRDuA1aFF3eWIZ6/hCeSRva.W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
