-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2015 at 04:17 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kws`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`customer_id` int(11) unsigned NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `gender`, `created_at`) VALUES
(5, '', 'gediminas@bivainis.com', '$2y$10$ox8HCnpsLnQfH7nBm.i8xuGHBOi4r/azu.oRkN0hK/5M/vNskKyam', 0, '2014-12-16 20:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`order_id` int(11) unsigned NOT NULL,
  `order_partner_id` int(11) NOT NULL,
  `order_customer_id` int(11) NOT NULL,
  `order_delivery_address` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_delivery_date` datetime NOT NULL,
  `order_phone` int(20) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `order_product_quantity` int(4) NOT NULL,
  `order_delivered` tinyint(1) NOT NULL DEFAULT '0',
  `order_tracking_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
`partner_id` int(11) NOT NULL,
  `partner_name` varchar(100) NOT NULL,
  `partner_email` varchar(255) NOT NULL,
  `partner_password` varchar(255) NOT NULL,
  `partner_url` varchar(1000) NOT NULL,
  `partner_comission` tinyint(4) NOT NULL DEFAULT '20',
  `partner_key` varchar(19) DEFAULT NULL,
  `partner_active` tinyint(1) NOT NULL DEFAULT '0',
  `partner_type` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`partner_id`, `partner_name`, `partner_email`, `partner_password`, `partner_url`, `partner_comission`, `partner_key`, `partner_active`, `partner_type`) VALUES
(1, 'admin', 'admin@admin.com', 'adminadmin', 'abc.com/webshop', 20, 'jahfdkj', 1, 1),
(3, '', 'gediminas@bivainis.com', '$2y$10$n2ZjesjRKQV696Q2c.0m6Ok3qUKDQsVR2iIfHx19DniYTdS1x6./i', '', 20, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`product_id` int(11) unsigned NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(1000) NOT NULL,
  `product_external_id` int(11) DEFAULT NULL,
  `product_image` varchar(1000) NOT NULL,
  `product_active` tinyint(1) NOT NULL DEFAULT '1',
  `product_quantity` int(5) NOT NULL DEFAULT '0',
  `product_partner_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_price`, `product_name`, `product_description`, `product_external_id`, `product_image`, `product_active`, `product_quantity`, `product_partner_id`) VALUES
(26, '530.00', 'Iona Palmer', 'Ut veniam, quia amet, dolores tempora omnis mollitia quasi iure qui deserunt et officia amet, quisquam esse.', NULL, '/assets/img/placeholder.png', 1, 496, 3),
(28, '534.00', 'Kirsten Taylor', 'Voluptas quo quo anim in dicta doloribus distinctio. Dolore ipsum beatae qui aliquip dolore deserunt.', NULL, '/assets/img/placeholder.png', 1, 706, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`customer_id`), ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
 ADD PRIMARY KEY (`partner_id`), ADD UNIQUE KEY `partner_key` (`partner_key`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `customer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
