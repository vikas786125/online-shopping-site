-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2018 at 12:11 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(10) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'INDIAGATE'),
(2, 'PATANJALI'),
(3, 'FORTUNE'),
(4, 'TATA'),
(5, 'AMUL'),
(8, 'COLGATE'),
(9, 'TATA');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `ip_add`, `qty`) VALUES
(7, 0, 1),
(8, 0, 1),
(11, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'RICE'),
(2, 'FLOUR'),
(3, 'OIL&GHEE'),
(4, 'PULSE'),
(5, 'MILK'),
(6, 'SPICE'),
(7, 'TEA'),
(8, 'TOOTHPASTE');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` varchar(100) NOT NULL,
  `customer_contact` int(100) NOT NULL,
  `customer_address` varchar(200) NOT NULL,
  `customer_image` text NOT NULL,
  `customer_ip` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`) VALUES
(1, 'vikas gupta', 'vikasgupta@gmail.com', '123456', 'India', 'mumbai', 2147483647, 'jogeshwari', 'a.jpg', 0),
(2, 'maitri gosalia', 'maitri@gmail.com', '123456', 'India', 'abc', 123456789, 'xyz', 'Welcome Scan.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `order_id` int(100) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `due_amount` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `total_products` int(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`order_id`, `customer_id`, `due_amount`, `invoice_no`, `total_products`, `order_date`, `order_status`) VALUES
(1, 1, 200, 352067235, 2, '2017-09-19 16:18:20', 'Complete'),
(2, 1, 294, 1515418797, 3, '2017-11-01 05:50:09', 'Complete'),
(3, 1, 275, 1876670220, 3, '2017-10-24 14:42:08', 'Pending'),
(4, 1, 250, 600036793, 3, '2017-10-26 15:30:58', 'Pending'),
(5, 1, 194, 1875385136, 2, '2017-10-27 10:55:45', 'Pending'),
(6, 1, 100, 1427080917, 1, '2017-10-27 11:59:41', 'Pending'),
(7, 1, 144, 1173299950, 1, '2017-11-01 04:49:55', 'Pending'),
(8, 1, 100, 1636727927, 1, '2017-11-01 05:46:10', 'Pending'),
(9, 1, 488, 1308958100, 2, '2017-11-01 07:30:11', 'Pending'),
(10, 1, 525, 447216392, 2, '2017-11-01 12:06:52', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `pending_orders`
--

CREATE TABLE `pending_orders` (
  `customer_id` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_orders`
--

INSERT INTO `pending_orders` (`customer_id`, `invoice_no`, `product_id`, `qty`, `order_status`) VALUES
(1, 352067235, 9, 1, 'Pending'),
(1, 1515418797, 11, 1, 'Pending'),
(1, 1876670220, 10, 1, 'Pending'),
(1, 600036793, 10, 1, 'Pending'),
(1, 1875385136, 11, 1, 'Pending'),
(1, 1427080917, 9, 1, 'Pending'),
(1, 1173299950, 11, 1, 'Pending'),
(1, 1636727927, 9, 1, 'Pending'),
(1, 1308958100, 11, 2, 'Pending'),
(1, 447216392, 8, 3, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `brand_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_title` text NOT NULL,
  `product_img1` text NOT NULL,
  `product_img2` text NOT NULL,
  `product_img3` text NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_desc` text NOT NULL,
  `status` text NOT NULL,
  `product_keywords` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `cat_id`, `brand_id`, `date`, `product_title`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_desc`, `status`, `product_keywords`) VALUES
(5, 1, 1, '2017-10-26 15:25:25', 'RICE 1', 'indiagate.jpg', 'rice1.jpg', 'swaraj.jpg', 100, 'THIS IS BEST QUALITY', 'on', 'rice'),
(6, 2, 2, '2017-10-26 15:26:33', 'PATANJALI', 'atlanta.jpg', 'lajavab.jpg', 'swad.jpg', 50, 'GOOD LUCK', 'on', 'patanjali'),
(7, 4, 2, '2017-10-26 15:26:54', 'PULSE', 'moong.jpg', 'urad.jpg', 'dals.jpg', 100, 'GOOD ', 'on', 'pulse'),
(8, 7, 2, '2017-10-26 15:27:17', 'TEA CHAI', 'redlabel.jpg', 'taaza.jpg', 'taj.jpg', 75, 'TEA GOOD ', 'on', 'tea'),
(9, 7, 5, '2017-10-26 15:27:37', 'COFFE', 'brucoff.jpg', 'nescafecoff.jpg', 'nestlecoff.jpg', 100, 'THIS IS ..', 'on', 'coffe'),
(10, 7, 2, '2017-10-26 15:29:32', 'COFFE2', 'narasucoffee.jpg', 'tatacoffee.jpg', 'coffee1.jpg', 100, 'THIS   AJKKD', 'on', 'coffe'),
(11, 6, 4, '2017-10-26 15:27:59', 'cleaner', 'cleanser4.jpg', 'cleanser3.jpg', 'cleanser2.jpeg', 144, 'this is cleaner', 'on', 'cleaner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
