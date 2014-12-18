-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2014 at 11:37 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `keawebshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_email` (`customer_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_partner_id` int(11) NOT NULL,
  `order_customer_id` int(11) NOT NULL,
  `order_delivery_address` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_delivery_date` datetime NOT NULL,
  `order_phone` int(20) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `order_product_quantity` int(4) NOT NULL,
  `order_delivered` tinyint(1) NOT NULL DEFAULT '0',
  `order_tracking_number` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `partner_id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_name` varchar(100) NOT NULL,
  `partner_email` varchar(255) NOT NULL,
  `partner_password` varchar(255) NOT NULL,
  `partner_url` varchar(1000) NOT NULL,
  `partner_comission` tinyint(4) NOT NULL DEFAULT '20',
  `partner_key` varchar(19) NOT NULL,
  `partner_active` tinyint(1) NOT NULL DEFAULT '0',
  `partner_type` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`partner_id`),
  UNIQUE KEY `partner_key` (`partner_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`partner_id`, `partner_name`, `partner_email`, `partner_password`, `partner_url`, `partner_comission`, `partner_key`, `partner_active`, `partner_type`) VALUES
(1, 'admin', 'gedemins@gmail.com', 'adminadmin', 'abc.com/webshop', 20, 'jahfdkj', 1, 1),
(3, '', 'gediminas@bivainis.com', '$2y$10$n2ZjesjRKQV696Q2c.0m6Ok3qUKDQsVR2iIfHx19DniYTdS1x6./i', '', 20, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_price` decimal(6,2) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(1000) NOT NULL,
  `product_external_id` int(11) DEFAULT NULL,
  `product_image` varchar(1000) NOT NULL,
  `product_active` tinyint(1) NOT NULL DEFAULT '1',
  `product_quantity` int(5) NOT NULL DEFAULT '0',
  `product_partner_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_price`, `product_name`, `product_description`, `product_external_id`, `product_image`, `product_active`, `product_quantity`, `product_partner_id`) VALUES
(11, '999.00', 'Stupid product', 'Voluptas recusandae. Voluptate consequat. Expedita cillum a quia natus qui ipsum voluptatibus aspernatur.', NULL, '/assets/img/placeholder.png', 1, 100000, 0),
(23, '734.00', 'Hamish Santiago', 'Eos, ullamco do aut consequatur velit, explicabo. Minima non laborum. Ut cumque magna qui molestiae sit, sunt accusantium facilis.', NULL, '/assets/img/placeholder.png', 1, 438, 3),
(24, '657.00', 'Daryl Sykes', 'Omnis autem dignissimos dolor distinctio. Rerum magna nulla debitis labore molestiae deserunt vel sit nobis.', NULL, '/assets/img/placeholder.png', 1, 472, 3),
(25, '646.00', 'Riley Saunders', 'Praesentium aut esse, harum rerum iusto assumenda non tempore, labore vero omnis recusandae. Dolore doloribus.', NULL, '/assets/img/placeholder.png', 1, 208, 3),
(26, '530.00', 'Iona Palmer', 'Ut veniam, quia amet, dolores tempora omnis mollitia quasi iure qui deserunt et officia amet, quisquam esse.', NULL, '/assets/img/placeholder.png', 1, 496, 3),
(27, '530.00', 'Iona Palmer', 'Ut veniam, quia amet, dolores tempora omnis mollitia quasi iure qui deserunt et officia amet, quisquam esse.', NULL, '/assets/img/placeholder.png', 1, 496, 3),
(28, '534.00', 'Kirsten Taylor', 'Voluptas quo quo anim in dicta doloribus distinctio. Dolore ipsum beatae qui aliquip dolore deserunt.', NULL, '/assets/img/placeholder.png', 1, 706, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
