-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2017 at 11:14 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abdelrahman`
--

-- --------------------------------------------------------

--
-- Table structure for table `additions`
--

CREATE TABLE `additions` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additions`
--

INSERT INTO `additions` (`id`, `year`) VALUES
(1, 2017);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `admin_fullName` varchar(60) NOT NULL,
  `admin_username` varchar(30) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_fullName`, `admin_username`, `admin_password`, `admin_email`, `admin_phone`) VALUES
(1, 'Abdelrahman ', 'admin', 'admin', 'tika-1996@hotmail.com', 1112481686),
(2, 'Salah', 'salah97', 'salah97', 'salah@yahoo.com', 1112481686);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_no` int(20) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_no`, `category_name`) VALUES
(1, 'skin care'),
(2, 'hair care'),
(3, 'dental care'),
(4, 'medical care'),
(5, 'baby care'),
(6, 'men care');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_no` int(10) NOT NULL,
  `feedback_text` varchar(100) NOT NULL,
  `userID` int(30) NOT NULL,
  `email_FB` varchar(30) NOT NULL,
  `date_FB` date NOT NULL,
  `updated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_no`, `feedback_text`, `userID`, `email_FB`, `date_FB`, `updated`) VALUES
(1, 'i have big problem', 27, 'ashaaf@gmail.com', '2017-10-19', 1),
(2, 'i love your website <3', 34, 'tika-1996@hotmail.com', '2017-11-30', 1),
(3, 'buffffffffffff', 29, 'baradah@yahoo.com', '2017-11-22', 1),
(4, 'buffffffffff', 34, 'bogy_96', '2017-11-15', 1),
(5, 'hellooo!', 35, 'abdelrahman', '2017-12-28', 1),
(6, 'hello its very good that you have good products!', 27, 'abaradah@gmail.com', '2017-12-07', 1),
(7, 'no problem thank you!', 60, 'abaradah@gmail.com', '2017-12-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `supervisor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_no` int(30) NOT NULL,
  `product_img` varchar(500) DEFAULT NULL,
  `product_img1` varchar(500) DEFAULT NULL,
  `product_img2` varchar(500) DEFAULT NULL,
  `product_img3` varchar(500) DEFAULT NULL,
  `product_describtion` varchar(500) DEFAULT NULL,
  `no_in_stock` int(30) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `tax` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `supplier` int(10) NOT NULL,
  `category_number` int(20) NOT NULL,
  `updated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_no`, `product_img`, `product_img1`, `product_img2`, `product_img3`, `product_describtion`, `no_in_stock`, `product_name`, `price`, `tax`, `discount`, `supplier`, `category_number`, `updated`) VALUES
(1, 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1b.jpg', 'themes/images/products/skin1c.jpg', 'themes/images/products/skin1d.jpg', 'this product is very cute', 90, 'product1', 100, 0, 0, 20161819, 1, 1),
(2, 'themes/images/products/skin2a.jpg', 'themes/images/products/skin2b.jpg', 'themes/images/products/skin2c.jpg', 'themes/images/products/skin2d.jpg', 'this product is very cute', 87, 'product2', 250, 0, 0, 20161819, 1, 1),
(4, 'themes/images/products/skin4a.jpg', 'themes/images/products/skin4b.jpg', 'themes/images/products/skin4c.jpg', 'themes/images/products/skin4d.jpg', 'this product is kinda good', 100, 'product4', 90, 0, 0, 20161819, 1, 1),
(5, 'themes/images/products/skin5a.jpg', 'themes/images/products/skin5b.jpg', 'themes/images/products/skin5c.jpg', 'themes/images/products/skin5d.jpg', 'this product is cheap and good', 89, 'product5', 100, 0, 0, 20161819, 1, 1),
(6, 'themes/images/products/skin6a.jpg', 'themes/images/products/skin6b.jpg', 'themes/images/products/skin6c.jpg', 'themes/images/products/skin6d.jpg', 'this product is fucking good', 82, 'product6', 20, 0, 0, 20161819, 1, 1),
(11, 'themes/images/products/Antibacterial Physicians Gold Soap by Aplicare.jpg', NULL, NULL, NULL, 'this product is good', 167, 'Antibacterial Physicians Gold', 100, 0, 0, 20161819, 1, 1),
(12, 'themes/images/products/Avagard Hand Anti-Septic w-Moisturizer by 3M Healthcare.jpg', NULL, NULL, NULL, 'this product is good', 91, 'Avagard Hand Anti-Septic', 23, 0, 0, 20161819, 1, 1),
(13, 'themes/images/products/Dove Bar Soap.jpg', NULL, NULL, NULL, 'this product is good', 59, 'Dove Bar Soap', 123, 0, 0, 20161819, 1, 1),
(14, 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'this product is good', 45, 'product7', 44, 0, 0, 20161819, 1, 1),
(15, 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'this product is good', 233, 'product7', 12, 0, 0, 20161819, 1, 1),
(16, 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'this product is good', 322, 'product7', 233, 0, 0, 20161819, 1, 1),
(17, 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'this product is good', 34, 'product7', 33, 0, 0, 20161819, 1, 1),
(18, 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'this product is good', 14, 'product7', 45, 0, 0, 20161819, 1, 1),
(19, 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'this product is good', 13, 'product7', 11, 0, 0, 20161819, 1, 1),
(20, 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'this product is good', 14, 'product7', 333, 0, 0, 20161819, 1, 1),
(21, 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'this product is good', 85, 'product7', 100, 0, 0, 20161819, 1, 1),
(23, 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'themes/images/products/skin1a.jpg', 'this product is good', 89, 'product7', 100, 0, 0, 20161819, 1, 1),
(32, 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'this product is good', 69, 'product7', 100, 0, 0, 20161819, 2, 1),
(33, 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'this product is good', 94, 'product7', 100, 0, 0, 20161819, 2, 1),
(34, 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'this product is good', 100, 'product7', 100, 0, 0, 20161819, 2, 1),
(35, 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'this product is good', 100, 'product7', 100, 0, 0, 20161819, 2, 1),
(36, 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'this product is good', 94, 'product7', 100, 0, 0, 20161819, 2, 1),
(37, 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'this product is good', 100, 'product7', 100, 0, 0, 20161819, 2, 1),
(38, 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'this product is good', 100, 'product7', 100, 0, 0, 20161819, 2, 1),
(40, 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'themes/images/products/hair1a.jpg', 'this product is good', 100, 'product7', 100, 0, 0, 20161819, 2, 1),
(45, 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'This product is good for shaving', 84, 'Gillette', 50, 0, 0, 20161819, 6, 1),
(47, 'themes/images/products/thumb-04.jpg', 'themes/images/products/thumb-04.jpg', 'themes/images/products/thumb-04.jpg', 'themes/images/products/thumb-04.jpg', 'wfakjdj', 100, 'bogyyy', 200, NULL, NULL, 20161819, 4, 1),
(48, 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'This product is good for shaving', 84, 'Gillette', 10, 10, 10, 20161818, 6, 0),
(49, 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'This product is good for shaving', 85, 'Gillette', 200, 20, 5, 20161818, 6, 0),
(50, 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'This product is good for shaving', 64, 'Gillette', 10, 10, 10, 20161818, 6, 0),
(51, 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'This product is good for shaving', 100, 'Gillette', 200, 20, 5, 20161818, 6, 1),
(52, 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'themes/images/products/Gillette Blue II Plus Men’s Disposable Razors, 5 count_1.jpg', 'This product is good for shaving', 100, 'Gillette', 200, 20, 5, 20161818, 6, 1),
(53, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 99, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(54, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 82, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(55, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 100, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(56, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 100, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(57, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 98, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(58, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 100, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(59, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 100, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(60, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 100, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(61, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 100, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(62, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 100, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(63, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 100, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(64, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 100, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(65, 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'themes/images/products/signal.jpg', 'This product is good for teeth', 100, 'Signal group', 200, 10, 0, 20161818, 3, 1),
(66, 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'this product is good for babies', 100, 'Tearless Baby Shampoo ', 10, 10, 5, 20161818, 5, 0),
(67, 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'this product is good for babies', 99, 'Tearless Baby Shampoo ', 10, 10, 5, 20161818, 5, 1),
(68, 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'this product is good for babies', 100, 'Tearless Baby Shampoo ', 10, 10, 5, 20161818, 5, 1),
(69, 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'this product is good for babies', 100, 'Tearless Baby Shampoo ', 10, 10, 5, 20161818, 5, 1),
(70, 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'this product is good for babies', 99, 'Tearless Baby Shampoo ', 10, 10, 5, 20161818, 5, 1),
(71, 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'this product is good for babies', 100, 'Tearless Baby Shampoo ', 10, 10, 5, 20161818, 5, 1),
(73, 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'this product is good for babies', 100, 'Tearless Baby Shampoo ', 10, 10, 5, 20161818, 5, 1),
(74, 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'this product is good for babies', 100, 'Tearless Baby Shampoo ', 10, 10, 5, 20161818, 5, 1),
(75, 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'this product is good for babies', 100, 'Tearless Baby Shampoo ', 10, 10, 5, 20161818, 5, 1),
(76, 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'themes/images/products/Tearless Baby Shampoo & Body Wash.JPG', 'this product is good for babies', 100, 'Tearless Baby Shampoo ', 10, 10, 5, 20161818, 5, 1),
(77, 'themes/images/products/', 'themes/images/products/', 'themes/images/products/', 'themes/images/products/', 'ferferferf', 100, 'kfmldkm', 100, NULL, NULL, 20161818, 1, 0),
(78, NULL, NULL, NULL, NULL, 'this product is good', 10, 'signal', 70, NULL, NULL, 20161818, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purch_no` int(20) NOT NULL,
  `netfees` int(20) NOT NULL,
  `discount` int(20) NOT NULL,
  `total` int(20) NOT NULL,
  `UserID` int(10) NOT NULL,
  `date` date NOT NULL,
  `method` varchar(30) DEFAULT NULL,
  `complete` tinyint(1) NOT NULL,
  `updated` tinyint(1) NOT NULL,
  `old` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purch_no`, `netfees`, `discount`, `total`, `UserID`, `date`, `method`, `complete`, `updated`, `old`) VALUES
(66, 0, 0, 40, 27, '2017-12-13', 'credit card', 1, 1, 1),
(67, 0, 0, 450, 27, '2017-12-13', 'paypal', 1, 1, 1),
(68, 0, 0, 2150, 59, '2017-12-13', 'paypal', 1, 1, 1),
(69, 0, 0, 40, 27, '2017-12-13', 'paypal', 1, 1, 1),
(70, 0, 0, 223, 35, '2017-12-14', 'credit card', 1, 1, 1),
(71, 0, 0, 0, 27, '2017-12-14', 'Cash on Delivery', 0, 1, 1),
(72, 0, 0, 350, 27, '2017-12-14', 'credit card', 0, 1, 1),
(73, 20, 10, 1050, 60, '2017-12-17', 'paypal', 0, 1, 1),
(74, 20, 0, 880, 60, '2017-12-17', 'credit card', 0, 1, 1),
(75, 10, 0, 520, 60, '2017-12-17', 'Cash on Delivery', 0, 1, 1),
(76, 0, 0, 1000, 60, '2017-12-17', 'Cash on Delivery', 0, 1, 1),
(77, 0, 0, 1532, 27, '2017-12-18', 'Cash on Delivery', 0, 1, 1),
(78, 0, 0, 440, 27, '2017-12-18', 'Cash on Delivery', 0, 1, 1),
(79, 30, 11, 329, 62, '2017-12-18', 'paypal', 1, 1, 1),
(80, 20, 10, 420, 62, '2017-12-18', 'Cash on Delivery', 0, 1, 1),
(81, 0, 0, 550, 62, '2017-12-18', 'Cash on Delivery', 1, 1, 1),
(82, 30, 11, 229, 63, '2017-12-18', 'paypal', 1, 1, 1),
(83, 0, 0, 550, 64, '2017-12-18', 'paypal', 1, 1, 1),
(84, 0, 0, 1100, 65, '2017-12-18', 'paypal', 1, 1, 1),
(85, 40, 11, 629, 27, '2017-12-20', 'paypal', 0, 0, 1),
(86, 30, 11, 279, 27, '2017-12-20', 'credit card', 0, 0, 1),
(87, 20, 1, 39, 27, '2017-12-20', 'Cash on Delivery', 0, 0, 1),
(88, 20, 10, 620, 27, '2017-12-20', 'Cash on Delivery', 0, 0, 1),
(89, 10, 1, 152, 27, '2017-12-20', 'paypal', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseshipping`
--

CREATE TABLE `purchaseshipping` (
  `package_no` int(20) NOT NULL,
  `package_distnation` varchar(30) NOT NULL,
  `package_source` int(10) NOT NULL,
  `purchase_no` int(20) NOT NULL,
  `Expected_DEL` date NOT NULL,
  `UserID` int(11) NOT NULL,
  `Delivered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseshipping`
--

INSERT INTO `purchaseshipping` (`package_no`, `package_distnation`, `package_source`, `purchase_no`, `Expected_DEL`, `UserID`, `Delivered`) VALUES
(1, 'nasr city', 20161818, 70, '2017-12-26', 35, 0),
(2, 'GIZA', 20161819, 66, '2017-12-18', 27, 0),
(3, 'GIZa', 20161818, 69, '2017-12-04', 27, 0),
(4, 'GIZA', 20161818, 67, '2017-12-18', 27, 0),
(5, 'fsefsef', 20161818, 79, '2017-12-19', 62, 0),
(6, 'nasr city', 20161818, 82, '2017-12-26', 63, 0),
(7, 'mohs', 20161818, 68, '2017-12-20', 59, 0),
(8, 'wqdwed', 20161818, 81, '2017-12-20', 62, 0),
(9, 'frrsdfw', 20161818, 89, '2017-12-25', 27, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_product`
--

CREATE TABLE `purchase_product` (
  `product_id` int(20) NOT NULL,
  `purchase_no` int(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_product`
--

INSERT INTO `purchase_product` (`product_id`, `purchase_no`, `id`) VALUES
(6, 66, 1),
(1, 67, 2),
(2, 67, 3),
(1, 68, 4),
(2, 68, 5),
(6, 69, 6),
(1, 70, 7),
(13, 70, 8),
(1, 72, 9),
(2, 72, 10),
(49, 73, 11),
(53, 74, 12),
(54, 74, 13),
(2, 74, 14),
(57, 75, 15),
(5, 75, 16),
(5, 76, 17),
(1, 77, 18),
(14, 77, 19),
(14, 78, 20),
(45, 79, 21),
(49, 79, 22),
(48, 79, 23),
(49, 80, 24),
(2, 81, 25),
(1, 81, 26),
(50, 82, 28),
(1, 83, 29),
(1, 84, 31),
(2, 84, 32),
(49, 85, 33),
(50, 85, 34),
(54, 85, 35),
(45, 86, 36),
(48, 86, 37),
(49, 86, 38),
(70, 87, 39),
(67, 87, 40),
(21, 88, 41),
(49, 88, 42),
(50, 89, 43);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `rating`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `rating_product`
--

CREATE TABLE `rating_product` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `rating_id` int(10) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_product`
--

INSERT INTO `rating_product` (`id`, `product_id`, `rating_id`, `user_id`) VALUES
(1, 6, 3, 27),
(2, 1, 4, 27),
(3, 1, 4, 35),
(4, 13, 5, 35),
(5, 49, 4, 60),
(6, 11, 3, 27),
(7, 48, 5, 27),
(8, 14, 4, 27),
(9, 49, 5, 27),
(10, 49, 5, 63),
(11, 1, 3, 64),
(12, 50, 3, 27),
(13, 2, 4, 27);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `ID` int(20) NOT NULL,
  `Full_name` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `salary` int(20) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`ID`, `Full_name`, `email`, `username`, `password`, `salary`, `phone_number`, `admin`) VALUES
(5, 'supervisor', 'supervisor@gmail.com', 'supervisor2017', 'supervisor', 10000, 1112481686, NULL),
(6, 'Abdelrahmann', 'abdooooo@yahoo.como', 'helloitamee', 'srgrgragg', 100000, 214748367, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `ID` int(10) NOT NULL,
  `Full_name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`ID`, `Full_name`, `email`, `username`, `password`, `address`, `phone_number`, `admin`) VALUES
(20161818, 'bogy', 'abaradah@gmail.com', 'aboSo7ab', 'password', 'blah', 1154216453, NULL),
(20161819, 'Supplier2017', 'supplier@yahoo.com', 'supplier', '01112481686', 'GIZA', 1112481686, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userproduct`
--

CREATE TABLE `userproduct` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_price` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `user_picture` varchar(500) DEFAULT NULL,
  `full_name` varchar(60) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `address` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `subscrition` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `user_picture`, `full_name`, `birthdate`, `email`, `username`, `password`, `address`, `gender`, `phone_number`, `subscrition`) VALUES
(27, 'themes/images/products/208109_10151124985671715_158236213_n.jpg', 'abaradah', '2017-12-05', 'abaradah@gmail.com', 'bogy_1997', '01112481686', 'blah', 'male', 1154216453, 0),
(28, 'themes/images/products/22449787_1829157477112929_5335239910431094055_n.jpg', 'abdelrahman ashraf', '0000-00-00', 'tika-1996@hotmail.com', 'ashaf_1996', '01112481686', '51 blah', 'male', 1112481686, 0),
(29, NULL, 'David Edwardson', '0000-00-00', 'davidedwardson1@gmail.com', 'david98', '123456789', 'stanley', 'male', 1111111111, 0),
(30, NULL, 'abdelrahman', '0000-00-00', 'ashraf_1996@hotmail.com', 'ashraf_1996', '123456789', '51 blah', '', 2147483647, 0),
(31, NULL, 'abdelrahman', '2017-10-03', 'ashraf_1996@hotmail.com', 'ashraf_19966', '123456789', '51 blah', 'male', 2147483647, 0),
(32, NULL, 'abdelrahman', '2017-10-25', 'ashraf_1996@hotmail.com', 'ashaf_96', 'helloitisme', '51 blah', 'female', 1154216453, 0),
(34, NULL, 'bogy', '1997-10-09', 'abaradah@gmail.com', 'baradah97', 'helloitsme', 'GIZA', 'male', 1154216453, 0),
(35, 'themes/images/products/13912527_1163602930364821_6120724921748223697_n.jpg', 'ganna ashraf', '2002-10-10', 'ganna-2002@hotmail.com', 'ganna-2002', 'princess', 'nasr city', 'female', 112481686, 0),
(36, NULL, 'mohamed ismael', '2017-11-15', 'ismael@yahoo.com', 'ismael', 'helloitsme', 'GIZA', 'male', 111111111, 0),
(37, NULL, 'shaima aziz', '1996-12-17', 'shaimaaaziz25@gmail.com', 'shaimaaziz25', 'helloitsme', 'nasr city', 'female', 1112481686, 0),
(38, NULL, 'Ahmed mohamed', '2017-11-08', 'amemo9115@gmail.com', 'ahmed', 'helloitsme', '51 blah', 'male', 1112481686, 0),
(46, NULL, 'abdelrahman', '2017-11-29', 'ashraf_1996@hotmail.com', 'lolololy', 'helloitsme', '51 blah', 'male', 1111111111, NULL),
(47, NULL, 'hossam', '2017-11-07', 'hossam@yahoo.com', 'hossam', 'helloitsme', 'maadi', 'male', 1112481686, NULL),
(49, NULL, '', '2017-11-29', 'zaky@yahoo.com', 'zaky', 'lovetika1996', '51 blah', 'male', 1112481686, NULL),
(50, NULL, 'Fatma elzahra', '2017-11-27', 'FatmaElzahraa@yahoo.com', 'fatmaElzahraa', 'helloitsme', '51 blah', 'female', 1112481686, NULL),
(51, NULL, 'Abdelrahman Baradah', '2017-11-01', 'abaradah@gmail.com', 'baradah', 'helloitsme', 'GIZA', 'male', 1112481686, NULL),
(53, NULL, 'fsdfsdfsdf', '2017-11-23', 'sdfsd@yahoo.com', 'sdfsdfsdf', '123456789', 'dvsdgsdg', 'female', 2147483647, NULL),
(54, NULL, 'abdelrhaman ashraf', '2017-11-07', 'hello@yahoo.com', 'helllllllllllllllooo', '01112481686', '51 blah', 'male', 1112481686, NULL),
(55, NULL, 'Saeed', '2017-12-06', 'tika-1996@hotmail.com', 'saeed', 'lovetika1996', '51 blah', 'male', 1112481686, NULL),
(56, 'themes/images/products/150575_467330116371_5375602_n.jpg', 'Ashraf Gomaa', '2017-12-06', 'gomaaashraf215@hotmail.com', 'ashraf', '01112481686', 'nasr city', 'male', 1112481686, NULL),
(57, 'themes/images/products/22221522_10154747354166035_4061391313615876395_n.jpg', 'Mohamed Refaat', '2017-12-04', 'mohammedRefaat@yahoo.com', 'mohamed_refaat', '01112481686', 'Nasr City', 'male', 1112481686, NULL),
(58, 'themes/images/products/thumb-03.jpg', 'Ahmed mohamed', '2017-12-05', 'amemo9115@gmail.com', 'aboSo7ab', '01112481686', 'maadi', 'male', 1112481686, NULL),
(59, 'themes/images/products/thumb-03.jpg', 'mohamed', '1997-12-30', 'ziko7162@gmail.com', 'zikooo', '01283058807', 'mokatam', 'male', 1283058807, NULL),
(60, 'themes/images/products/WhatsApp Image 2017-11-03 at 4.07.17 PM.jpeg', 'bogyyy', '1997-12-18', 'abaradah@gmail.com', 'abdo', 'ashaf1996', 'nasr city', 'male', 1154216453, NULL),
(61, NULL, 'Salah', '2017-12-18', 'salah@yahoo.com', 'salah1997', '01112481686', 'masraa city', 'male', 1112481686, NULL),
(62, NULL, 'HASSAn', '2017-12-06', 'drhassancs@gmail.com', 'drhassan', '01112481686', 'blah', 'male', 111248686, NULL),
(63, 'themes/images/products/WhatsApp Image 2017-12-18 at 10.08.29 PM.jpeg', 'Shaima aziz', '2017-12-04', 'shaimaaaziz25@gmail.com', 'shaimaaziz', '01112481686', 'nasr city', 'female', 1112481868, NULL),
(64, 'themes/images/products/WhatsApp Image 2017-12-18 at 10.08.29 PM.jpeg', 'Amal gomaa', '2017-12-04', 'amalgh2011@yahoo.com', 'amalgomaa', '01112481686', 'sdcsdc', 'female', 1112481686, NULL),
(65, 'themes/images/products/Youtube_icon.png', 'Mohamed', '2017-12-13', 'mohamed-moha95@hotmail.com', 'mohamed', '01112481686', 'feferf', 'male', 1112481686, NULL),
(66, NULL, 'Ahmed mohamed', '2017-12-05', 'abaradah@gmail.com', 'ai7aga', 'lovetika1996', 'blah', 'male', 1112481686, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additions`
--
ALTER TABLE `additions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_no`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_no`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `supervisor_id` (`supervisor_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_no`),
  ADD KEY `category_number` (`category_number`),
  ADD KEY `supplier` (`supplier`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purch_no`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `purchaseshipping`
--
ALTER TABLE `purchaseshipping`
  ADD PRIMARY KEY (`package_no`),
  ADD KEY `purchase_no` (`purchase_no`),
  ADD KEY `package_source` (`package_source`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `purchase_product`
--
ALTER TABLE `purchase_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `purchase_no` (`purchase_no`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_product`
--
ALTER TABLE `rating_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `rating_id` (`rating_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `userproduct`
--
ALTER TABLE `userproduct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_no` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purch_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `purchaseshipping`
--
ALTER TABLE `purchaseshipping`
  MODIFY `package_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `purchase_product`
--
ALTER TABLE `purchase_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `rating_product`
--
ALTER TABLE `rating_product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20161820;
--
-- AUTO_INCREMENT for table `userproduct`
--
ALTER TABLE `userproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`ID`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisor` (`ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`ID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_number`) REFERENCES `category` (`category_no`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `purchaseshipping`
--
ALTER TABLE `purchaseshipping`
  ADD CONSTRAINT `purchaseshipping_ibfk_1` FOREIGN KEY (`purchase_no`) REFERENCES `purchase` (`purch_no`),
  ADD CONSTRAINT `purchaseshipping_ibfk_2` FOREIGN KEY (`package_source`) REFERENCES `supplier` (`ID`),
  ADD CONSTRAINT `purchaseshipping_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `purchase_product`
--
ALTER TABLE `purchase_product`
  ADD CONSTRAINT `purchase_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_no`),
  ADD CONSTRAINT `purchase_product_ibfk_2` FOREIGN KEY (`purchase_no`) REFERENCES `purchase` (`purch_no`);

--
-- Constraints for table `rating_product`
--
ALTER TABLE `rating_product`
  ADD CONSTRAINT `rating_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_no`),
  ADD CONSTRAINT `rating_product_ibfk_2` FOREIGN KEY (`rating_id`) REFERENCES `ratings` (`id`),
  ADD CONSTRAINT `rating_product_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Constraints for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `supervisor_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `admin` (`id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `admin` (`id`);

--
-- Constraints for table `userproduct`
--
ALTER TABLE `userproduct`
  ADD CONSTRAINT `userproduct_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `userproduct_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `product` (`product_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
