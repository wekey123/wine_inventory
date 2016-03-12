-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2016 at 02:11 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wine_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT 'Status 0 - inactive ,1 - active ',
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`, `created`, `modified`) VALUES
(1, 'Wine', 'taste', 1, '2016-03-05 06:59:01', '2016-03-05 06:59:01'),
(2, 'Brandy', 'taste', 1, '2016-03-05 06:59:01', '2016-03-05 06:59:01'),
(3, 'Whisky', 'Taste', 1, '2016-03-05 06:59:37', '2016-03-05 06:59:37'),
(4, 'Vodka', 'Taste', 1, '2016-03-05 06:59:37', '2016-03-05 06:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE IF NOT EXISTS `inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `po_no` varchar(200) NOT NULL COMMENT 'Purchase order Number',
  `invoice_no` varchar(200) NOT NULL,
  `product _no` int(11) NOT NULL,
  `payment_no` varchar(50) NOT NULL,
  `shipping_no` varchar(50) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `po_no`, `invoice_no`, `product _no`, `payment_no`, `shipping_no`, `total_quantity`, `total_price`, `created`, `modified`) VALUES
(1, 1, 'ORD299913', 'INV299913', 0, '', 'SHIP123456', 350, '0', '2016-03-12 08:35:07', '2016-03-12 08:35:07');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `po_no` varchar(50) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `invoice_date` date NOT NULL,
  `vendor_name` varchar(50) NOT NULL,
  `vendor_address` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_method` varchar(50) NOT NULL,
  `payment_terms` text NOT NULL,
  `estimated_shipping_date` date NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `product_id`, `po_no`, `invoice_no`, `invoice_date`, `vendor_name`, `vendor_address`, `customer_id`, `shipping_method`, `payment_terms`, `estimated_shipping_date`, `total_quantity`, `total_price`, `status`, `created`, `modified`) VALUES
(1, 3, 0, 'ORD145589', 'INV0021', '2016-03-09', 'Bevmo', 'test', 23456, 'USPS', 'test', '2016-03-16', 570, '77500', 2, '2016-03-12 08:09:32', '2016-03-12 08:09:32'),
(2, 1, 0, 'ORD299913', 'INV299913', '2016-03-10', '', '', 0, 'Ship', '', '2016-03-02', 350, '35500', 3, '2016-03-12 08:23:47', '2016-03-12 08:23:47'),
(3, 3, 0, 'ORD999023', 'INV0025', '2016-03-10', 'Bevmo', 'test', 23456, 'USPS', 'test', '2016-03-15', 60, '14000', 0, '2016-03-12 08:41:16', '2016-03-12 08:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `po_no` varchar(200) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `po_no`, `total_quantity`, `total_price`, `status`, `created`, `modified`) VALUES
(1, 3, 1, 'ORD145589', 150, '17500.00', 2, '2016-03-12 08:08:17', '2016-03-12 08:08:17'),
(2, 3, 2, 'ORD145589', 150, '10500.00', 2, '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(3, 3, 3, 'ORD145589', 150, '7500.00', 2, '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(4, 3, 4, 'ORD145589', 150, '52500.00', 2, '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(5, 1, 1, 'ORD299913', 150, '17500.00', 3, '2016-03-12 08:22:24', '2016-03-12 08:22:24'),
(6, 1, 2, 'ORD299913', 200, '18000.00', 3, '2016-03-12 08:22:24', '2016-03-12 08:22:24'),
(7, 3, 1, 'ORD999023', 36, '4200.00', 1, '2016-03-12 08:39:09', '2016-03-12 08:39:09'),
(8, 3, 4, 'ORD999023', 36, '12600.00', 1, '2016-03-12 08:39:10', '2016-03-12 08:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `po_no` varchar(200) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `payment_no` varchar(50) NOT NULL COMMENT 'Random Generated',
  `payment_amount` float NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `po_no`, `invoice_no`, `payment_no`, `payment_amount`, `payment_date`, `payment_method`, `created`, `modified`) VALUES
(1, 3, '', 'INV0021', '9625001', 50000, '2016-03-12', 'Master card (credit)', '2016-03-12 08:21:36', '2016-03-12 08:21:36'),
(2, 3, '', 'INV0021', '9625001', 27500, '2016-03-12', 'Master card (credit)', '2016-03-12 08:22:50', '2016-03-12 08:22:50'),
(3, 1, '', 'INV299913', 'PAY299913', 35000, '2016-03-10', 'Bank', '2016-03-12 08:24:41', '2016-03-12 08:24:41'),
(4, 1, '', 'INV299913', 'PAY168429', 500, '2016-03-24', 'Bank', '2016-03-12 08:25:31', '2016-03-12 08:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `brand` varchar(200) NOT NULL COMMENT 'brand - LAGAVULIN , Remi martin etc.,',
  `vendor` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL COMMENT 'type / varietal - Scotch,Bock,gin,Specialty Beer',
  `flavor` varchar(200) NOT NULL,
  `label` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_name`, `title`, `description`, `brand`, `vendor`, `country`, `type`, `flavor`, `label`, `image`, `status`, `created`, `modified`) VALUES
(1, 1, 'Wine', 'MOMOKAWA NIGORI GENSHU PEARL SAKE (750 ML)', '', 'Momokawa', 'Momokawa', 'Momokawa', 'Sake', 'Momokawa', 'Blue', '56e40130-046c-4676-8609-27d4c0a80169.jpg', '1', '2016-03-12 07:14:49', '2016-03-12 07:14:49'),
(2, 1, 'Wine', 'OZEKI KARATANBA (300 ML)', 'The vintage indicated may not be available. Another vintage will be substituted unless noted when order is placed. Please check the bottle for vintage if shopping in a store.', 'Ozeki', 'Hyogo', 'Japan', 'Sake', 'RED', 'Brown', '56e4026b-b1d0-4cb4-b77a-27d4c0a80169.jpg', '1', '2016-03-12 07:20:03', '2016-03-12 07:20:03'),
(3, 1, 'Wine', 'GEKKEIKAN SUZAKU JUNMAI GINJO (300 ML)', 'The vintage indicated may not be available. Another vintage will be substituted unless noted when order is placed. Please check the bottle for vintage if shopping in a store.', 'Gekkeikan', 'Gekkeikan', 'Japan', 'Sake', 'Red', 'Green', '56e40316-ff28-4a4f-86b9-27d4c0a80169.jpg', '1', '2016-03-12 07:22:54', '2016-03-12 07:22:54'),
(4, 1, 'Brandy', 'REMY MARTIN COGNAC XO EXCELLENCE (750 ML)', '90 PTS WINE ENTHUSIAST,GOLD MEDAL-SF 2008 SPIRITS COMP. This mellow and complex cognac is aged a minimum of 22 years and is considered to have the ideal balance between floral and fruity flavors.', 'Remy Martin', 'Remy', 'France', 'Brandy', 'Red', 'Green', '56e403fa-6484-4a9c-baf0-27d4c0a80169.jpg', '1', '2016-03-12 07:26:43', '2016-03-12 07:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE IF NOT EXISTS `shippings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `po_no` varchar(200) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `shipping_no` varchar(50) NOT NULL COMMENT 'Random Generated',
  `shipping_quantity` int(11) NOT NULL,
  `defective_quantity` int(11) NOT NULL,
  `missing_quantity` int(11) NOT NULL,
  `shipping_method` varchar(50) NOT NULL,
  `tracking_no` varchar(50) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `received_date` date NOT NULL COMMENT 'Actual date of product received',
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `user_id`, `po_no`, `invoice_no`, `shipping_no`, `shipping_quantity`, `defective_quantity`, `missing_quantity`, `shipping_method`, `tracking_no`, `weight`, `received_date`, `created`, `modified`) VALUES
(1, 1, 'ORD299913', 'INV299913', 'SHIP123456', 350, 20, 0, '', '', '0', '2016-03-23', '2016-03-12 08:35:07', '2016-03-12 08:35:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'admin', '$2a$10$f/MGmpzPg9pARhcgB5ZTeufl0h/Mrbk7dJke1IzdlchYY47J/mumW', 'admin', '2016-03-05 07:17:57', '2016-03-12 13:01:46'),
(2, 'kumar', '$2a$10$/h1enRZ8fDPSnSa8lg2Jxexue/fpHRKjSZsz3/NfOG4Z2M./3KDPq', 'staff', '2016-03-05 08:58:56', '2016-03-05 08:58:56'),
(3, 'vicky', '$2a$10$g0Gos3W2Bz3Z96MdneByFu.h0oCI7SGBBL9pcyfGv/q5u5TV5yXQC', 'admin', '2016-03-12 13:04:46', '2016-03-12 13:04:46');

-- --------------------------------------------------------

--
-- Table structure for table `varies`
--

CREATE TABLE IF NOT EXISTS `varies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `variant` varchar(200) NOT NULL,
  `sku` varchar(200) NOT NULL,
  `barcode` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_total` int(11) NOT NULL,
  `defect` int(11) NOT NULL,
  `missing` int(11) NOT NULL,
  `type` varchar(200) NOT NULL COMMENT 'type - product,order,invoice,inventory,sales',
  `po_no` varchar(50) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

--
-- Dumping data for table `varies`
--

INSERT INTO `varies` (`id`, `product_id`, `variant`, `sku`, `barcode`, `price`, `quantity`, `price_total`, `defect`, `missing`, `type`, `po_no`, `created`, `modified`) VALUES
(1, 1, '750ml', 'Mom750ML', 'MomBar001', '50.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:14:49', '2016-03-12 07:14:49'),
(2, 1, '1lt', 'Mom001lt', 'MomBar002', '100.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:14:49', '2016-03-12 07:14:49'),
(3, 1, '2lt', 'Mom002lt', 'MomBar003', '200.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:14:49', '2016-03-12 07:14:49'),
(4, 2, '300ml', 'OZEKI300', 'OZEKIBAR001', '30.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:20:03', '2016-03-12 07:20:03'),
(5, 2, '750ml', 'OZEKI700', 'OZEKIBAR002', '60.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:20:03', '2016-03-12 07:20:03'),
(6, 2, '1.5lt', 'OZEK1500', 'OZEKIBAR003', '120.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:20:03', '2016-03-12 07:20:03'),
(7, 2, '2lt', 'OZEK2000', 'OZEKIBAR004', '150.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:20:03', '2016-03-12 07:20:03'),
(8, 3, '300ml', 'GEKK001', 'GEKK001BAR', '25.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:22:54', '2016-03-12 07:22:54'),
(9, 3, '750ml', 'GEKK002', 'GEKK002BAR', '50.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:22:54', '2016-03-12 07:22:54'),
(10, 3, '1lt', 'GEKK003', 'GEKK003BAR', '75.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:22:54', '2016-03-12 07:22:54'),
(11, 4, '750ml', 'REMY001', 'REMY001BAR', '150.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:26:43', '2016-03-12 07:26:43'),
(12, 4, '1lt', 'REMY002', 'REMY002BAR', '300.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:26:43', '2016-03-12 07:26:43'),
(13, 4, '2lt', 'REMY003', 'REMY003BAR', '600.00', 0, 0, 0, 0, 'product', '', '2016-03-12 07:26:43', '2016-03-12 07:26:43'),
(66, 1, '750ml', 'Mom750ML', 'MomBar001', '50.00', 50, 2500, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(67, 1, '1lt', 'Mom001lt', 'MomBar002', '100.00', 50, 5000, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(68, 1, '2lt', 'Mom002lt', 'MomBar003', '200.00', 50, 10000, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(69, 2, '300ml', 'OZEKI300', 'OZEKIBAR001', '30.00', 50, 1500, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(70, 2, '750ml', 'OZEKI700', 'OZEKIBAR002', '60.00', 50, 3000, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(71, 2, '1.5lt', 'OZEK1500', 'OZEKIBAR003', '120.00', 50, 6000, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(72, 2, '2lt', 'OZEK2000', 'OZEKIBAR004', '150.00', 0, 0, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(73, 3, '300ml', 'GEKK001', 'GEKK001BAR', '25.00', 50, 1250, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(74, 3, '750ml', 'GEKK002', 'GEKK002BAR', '50.00', 50, 2500, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(75, 3, '1lt', 'GEKK003', 'GEKK003BAR', '75.00', 50, 3750, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(76, 4, '750ml', 'REMY001', 'REMY001BAR', '150.00', 50, 7500, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(77, 4, '1lt', 'REMY002', 'REMY002BAR', '300.00', 50, 15000, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(78, 4, '2lt', 'REMY003', 'REMY003BAR', '600.00', 50, 30000, 0, 0, 'order', 'ORD145589', '2016-03-12 08:08:18', '2016-03-12 08:08:18'),
(79, 1, '750ml', 'Mom750ML', 'MomBar001', '50.00', 50, 2500, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:32', '2016-03-12 08:09:32'),
(80, 1, '1lt', 'Mom001lt', 'MomBar002', '100.00', 50, 5000, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:32', '2016-03-12 08:09:32'),
(81, 1, '2lt', 'Mom002lt', 'MomBar003', '200.00', 50, 10000, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:32', '2016-03-12 08:09:32'),
(82, 2, '300ml', 'OZEKI300', 'OZEKIBAR001', '30.00', 50, 1500, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:32', '2016-03-12 08:09:32'),
(83, 2, '750ml', 'OZEKI700', 'OZEKIBAR002', '60.00', 50, 3000, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:33', '2016-03-12 08:09:33'),
(84, 2, '1.5lt', 'OZEK1500', 'OZEKIBAR003', '120.00', 50, 6000, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:33', '2016-03-12 08:09:33'),
(85, 2, '2lt', 'OZEK2000', 'OZEKIBAR004', '150.00', 0, 0, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:33', '2016-03-12 08:09:33'),
(86, 3, '300ml', 'GEKK001', 'GEKK001BAR', '25.00', 50, 1250, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:33', '2016-03-12 08:09:33'),
(87, 3, '750ml', 'GEKK002', 'GEKK002BAR', '50.00', 50, 2500, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:33', '2016-03-12 08:09:33'),
(88, 3, '1lt', 'GEKK003', 'GEKK003BAR', '75.00', 50, 3750, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:33', '2016-03-12 08:09:33'),
(89, 4, '750ml', 'REMY001', 'REMY001BAR', '150.00', 40, 6000, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:33', '2016-03-12 08:09:33'),
(90, 4, '1lt', 'REMY002', 'REMY002BAR', '300.00', 40, 12000, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:33', '2016-03-12 08:09:33'),
(91, 4, '2lt', 'REMY003', 'REMY003BAR', '600.00', 40, 24000, 0, 0, 'invoice', 'INV0021', '2016-03-12 08:09:33', '2016-03-12 08:09:33'),
(92, 1, '750ml', 'Mom750ML', 'MomBar001', '50.00', 50, 2500, 0, 0, 'order', 'ORD299913', '2016-03-12 08:22:24', '2016-03-12 08:22:24'),
(93, 1, '1lt', 'Mom001lt', 'MomBar002', '100.00', 50, 5000, 0, 0, 'order', 'ORD299913', '2016-03-12 08:22:24', '2016-03-12 08:22:24'),
(94, 1, '2lt', 'Mom002lt', 'MomBar003', '200.00', 50, 10000, 0, 0, 'order', 'ORD299913', '2016-03-12 08:22:24', '2016-03-12 08:22:24'),
(95, 2, '300ml', 'OZEKI300', 'OZEKIBAR001', '30.00', 50, 1500, 0, 0, 'order', 'ORD299913', '2016-03-12 08:22:24', '2016-03-12 08:22:24'),
(96, 2, '750ml', 'OZEKI700', 'OZEKIBAR002', '60.00', 50, 3000, 0, 0, 'order', 'ORD299913', '2016-03-12 08:22:24', '2016-03-12 08:22:24'),
(97, 2, '1.5lt', 'OZEK1500', 'OZEKIBAR003', '120.00', 50, 6000, 0, 0, 'order', 'ORD299913', '2016-03-12 08:22:24', '2016-03-12 08:22:24'),
(98, 2, '2lt', 'OZEK2000', 'OZEKIBAR004', '150.00', 50, 7500, 0, 0, 'order', 'ORD299913', '2016-03-12 08:22:24', '2016-03-12 08:22:24'),
(99, 1, '750ml', 'Mom750ML', 'MomBar001', '50.00', 50, 2500, 0, 0, 'invoice', 'INV299913', '2016-03-12 08:23:47', '2016-03-12 08:23:47'),
(100, 1, '1lt', 'Mom001lt', 'MomBar002', '100.00', 50, 5000, 0, 0, 'invoice', 'INV299913', '2016-03-12 08:23:47', '2016-03-12 08:23:47'),
(101, 1, '2lt', 'Mom002lt', 'MomBar003', '200.00', 50, 10000, 0, 0, 'invoice', 'INV299913', '2016-03-12 08:23:47', '2016-03-12 08:23:47'),
(102, 2, '300ml', 'OZEKI300', 'OZEKIBAR001', '30.00', 50, 1500, 0, 0, 'invoice', 'INV299913', '2016-03-12 08:23:48', '2016-03-12 08:23:48'),
(103, 2, '750ml', 'OZEKI700', 'OZEKIBAR002', '60.00', 50, 3000, 0, 0, 'invoice', 'INV299913', '2016-03-12 08:23:48', '2016-03-12 08:23:48'),
(104, 2, '1.5lt', 'OZEK1500', 'OZEKIBAR003', '120.00', 50, 6000, 0, 0, 'invoice', 'INV299913', '2016-03-12 08:23:48', '2016-03-12 08:23:48'),
(105, 2, '2lt', 'OZEK2000', 'OZEKIBAR004', '150.00', 50, 7500, 0, 0, 'invoice', 'INV299913', '2016-03-12 08:23:48', '2016-03-12 08:23:48'),
(106, 1, '750ml', 'Mom750ML', 'MomBar001', '50.00', 50, 2500, 0, 0, 'inventory', 'ORD299913', '2016-03-12 08:35:07', '2016-03-12 08:35:07'),
(107, 1, '1lt', 'Mom001lt', 'MomBar002', '100.00', 50, 5000, 0, 0, 'inventory', 'ORD299913', '2016-03-12 08:35:07', '2016-03-12 08:35:07'),
(108, 1, '2lt', 'Mom002lt', 'MomBar003', '200.00', 50, 10000, 0, 0, 'inventory', 'ORD299913', '2016-03-12 08:35:07', '2016-03-12 08:35:07'),
(109, 2, '300ml', 'OZEKI300', 'OZEKIBAR001', '30.00', 50, 1500, 0, 0, 'inventory', 'ORD299913', '2016-03-12 08:35:07', '2016-03-12 08:35:07'),
(110, 2, '750ml', 'OZEKI700', 'OZEKIBAR002', '60.00', 50, 3000, 0, 0, 'inventory', 'ORD299913', '2016-03-12 08:35:07', '2016-03-12 08:35:07'),
(111, 2, '1.5lt', 'OZEK1500', 'OZEKIBAR003', '120.00', 50, 6000, 0, 0, 'inventory', 'ORD299913', '2016-03-12 08:35:07', '2016-03-12 08:35:07'),
(112, 2, '2lt', 'OZEK2000', 'OZEKIBAR004', '150.00', 50, 7500, 20, 0, 'inventory', 'ORD299913', '2016-03-12 08:35:07', '2016-03-12 08:35:07'),
(113, 1, '750ml', 'Mom750ML', 'MomBar001', '50.00', 12, 600, 0, 0, 'order', 'ORD999023', '2016-03-12 08:39:09', '2016-03-12 08:39:09'),
(114, 1, '1lt', 'Mom001lt', 'MomBar002', '100.00', 12, 1200, 0, 0, 'order', 'ORD999023', '2016-03-12 08:39:10', '2016-03-12 08:39:10'),
(115, 1, '2lt', 'Mom002lt', 'MomBar003', '200.00', 12, 2400, 0, 0, 'order', 'ORD999023', '2016-03-12 08:39:10', '2016-03-12 08:39:10'),
(116, 4, '750ml', 'REMY001', 'REMY001BAR', '150.00', 12, 1800, 0, 0, 'order', 'ORD999023', '2016-03-12 08:39:10', '2016-03-12 08:39:10'),
(117, 4, '1lt', 'REMY002', 'REMY002BAR', '300.00', 12, 3600, 0, 0, 'order', 'ORD999023', '2016-03-12 08:39:10', '2016-03-12 08:39:10'),
(118, 4, '2lt', 'REMY003', 'REMY003BAR', '600.00', 12, 7200, 0, 0, 'order', 'ORD999023', '2016-03-12 08:39:10', '2016-03-12 08:39:10'),
(119, 1, '750ml', 'Mom750ML', 'MomBar001', '50.00', 10, 500, 0, 0, 'invoice', 'INV0025', '2016-03-12 08:41:16', '2016-03-12 08:41:16'),
(120, 1, '1lt', 'Mom001lt', 'MomBar002', '100.00', 10, 1000, 0, 0, 'invoice', 'INV0025', '2016-03-12 08:41:16', '2016-03-12 08:41:16'),
(121, 1, '2lt', 'Mom002lt', 'MomBar003', '200.00', 10, 2000, 0, 0, 'invoice', 'INV0025', '2016-03-12 08:41:16', '2016-03-12 08:41:16'),
(122, 4, '750ml', 'REMY001', 'REMY001BAR', '150.00', 10, 1500, 0, 0, 'invoice', 'INV0025', '2016-03-12 08:41:16', '2016-03-12 08:41:16'),
(123, 4, '1lt', 'REMY002', 'REMY002BAR', '300.00', 10, 3000, 0, 0, 'invoice', 'INV0025', '2016-03-12 08:41:16', '2016-03-12 08:41:16'),
(124, 4, '2lt', 'REMY003', 'REMY003BAR', '600.00', 10, 6000, 0, 0, 'invoice', 'INV0025', '2016-03-12 08:41:16', '2016-03-12 08:41:16');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
