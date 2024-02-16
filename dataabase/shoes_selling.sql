-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2022 at 09:09 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shoes_selling`
--
CREATE DATABASE IF NOT EXISTS `shoes_selling` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shoes_selling`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_detail`
--

CREATE TABLE IF NOT EXISTS `admin_detail` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_detail`
--

INSERT INTO `admin_detail` (`admin_id`, `admin_name`, `email_id`, `pwd`) VALUES
(1, 'admin', 'admin@shoes.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE IF NOT EXISTS `bill_detail` (
  `bill_id` int(10) NOT NULL,
  `bill_date` date NOT NULL,
  `order_id` int(10) NOT NULL,
  `cart_id` int(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `total_amt` int(10) NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`bill_id`, `bill_date`, `order_id`, `cart_id`, `cust_id`, `total_amt`) VALUES
(1, '2022-09-10', 1, 2, 1, 3800);

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE IF NOT EXISTS `cart_detail` (
  `cart_d_id` int(10) NOT NULL,
  `cart_id` int(10) NOT NULL,
  `shoes_id` int(10) NOT NULL,
  `size` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`cart_d_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`cart_d_id`, `cart_id`, `shoes_id`, `size`, `qty`, `price`) VALUES
(1, 1, 1, 8, 1, 1500),
(2, 1, 10, 8, 1, 900),
(3, 2, 8, 7, 2, 700),
(4, 2, 2, 8, 2, 1200),
(5, 3, 3, 8, 2, 600),
(6, 3, 17, 7, 1, 800);

-- --------------------------------------------------------

--
-- Table structure for table `cat_master`
--

CREATE TABLE IF NOT EXISTS `cat_master` (
  `cat_id` int(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_master`
--

INSERT INTO `cat_master` (`cat_id`, `category`) VALUES
(1, 'Sneakers'),
(2, 'Loafers');

-- --------------------------------------------------------

--
-- Table structure for table `cust_detail`
--

CREATE TABLE IF NOT EXISTS `cust_detail` (
  `cust_id` int(10) NOT NULL,
  `cust_name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cust_detail`
--

INSERT INTO `cust_detail` (`cust_id`, `cust_name`, `address`, `city`, `mobile_no`, `email_id`, `pwd`) VALUES
(1, 'Pinal', 'tithal road', 'valsad', '8596321470', 'pinal@yahoo.com', '111111');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_id` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `cart_id` int(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `del_add` varchar(200) NOT NULL,
  `del_mno` varchar(10) NOT NULL,
  `tot_amt` int(10) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `order_date`, `cart_id`, `cust_id`, `del_add`, `del_mno`, `tot_amt`) VALUES
(1, '2022-09-09', 2, 1, 'tithal Road\r\nvalsad', '8596321470', 3800),
(2, '2022-09-10', 3, 1, 'tithal road', '8596321470', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `shoes_detail`
--

CREATE TABLE IF NOT EXISTS `shoes_detail` (
  `shoes_id` int(10) NOT NULL,
  `shoes_name` varchar(50) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` int(10) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `child_adult` int(1) NOT NULL,
  `shoes_img` varchar(50) NOT NULL,
  PRIMARY KEY (`shoes_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoes_detail`
--

INSERT INTO `shoes_detail` (`shoes_id`, `shoes_name`, `cat_id`, `description`, `price`, `gender`, `child_adult`, `shoes_img`) VALUES
(1, 'karaas', 1, 'A Clean Cool And Dry Shoes Environment For Your Feet\r\n', 1500, 'MALE', 2, 'shoes_img/S1_6880.png'),
(2, 'Bacca Bucci', 1, 'Quickly absorb sweat and drying friendly make feet cool and dry\r\n', 1200, 'MALE', 2, 'shoes_img/S2_7312.png'),
(3, 'Generic', 1, 'Casual Sports Running Gym Training\r\n', 600, 'MALE', 2, 'shoes_img/S3_5326.png'),
(4, 'Centrino', 1, 'These soft Casual shoe for men use are relaxing yet cool\r\n', 700, 'MALE', 2, 'shoes_img/S4_5834.png'),
(5, 'Robbie jones', 1, 'Dust any dry dirt from the surface using a clean cloth', 1000, 'MALE', 2, 'shoes_img/S5_7837.png'),
(6, 'Denill', 1, 'Stylish And Comfortable Shoes For Both Casual Party Wear\r\n', 500, 'FEMALE', 2, 'shoes_img/S6_8656.png'),
(7, 'Red Tape', 1, 'Classic Sneaker edition to add to your wardrobe Rock your casual daily\r\n', 800, 'FEMALE', 2, 'shoes_img/S7_3558.png'),
(8, 'Bella Toes', 1, 'Â Extremely light sole and upper material for all day comfort', 700, 'FEMALE', 2, 'shoes_img/S8_1330.png'),
(9, 'Vendoz', 1, 'Gives comfort during walking jogging running and in playing conditions\r\n', 1300, 'FEMALE', 2, 'shoes_img/S9_1699.png'),
(10, 'Bata', 1, 'Gym Joggers Indoor Outdoor Home Vacation Party Leisure and etc', 900, 'FEMALE', 2, 'shoes_img/S10_1623.png'),
(11, 'Max', 1, 'Wipe with a clean dry cloth to remove dust Do not use polish or shiner', 600, 'MALE', 1, 'shoes_img/S11_6366.png'),
(12, 'Campus', 1, 'This also helps them retain their natural shape Do not use polish or shiner', 500, 'MALE', 1, 'shoes_img/S12_4033.png'),
(13, 'Bubblegummers', 1, ' This pair is perfect to give your quintessential dressing an upgrade', 400, 'MALE', 1, 'shoes_img/S13_6887.png'),
(14, 'Hopscotch', 1, 'Elevate your style with this classy pair of Led Light Shoe from the house of Hopscotch brand', 1000, 'FEMALE', 1, 'shoes_img/S14_1936.png'),
(15, 'Adrianna', 1, 'Use a soft shoe brush to remove dust loose dirt Remove stains using stain removers', 500, 'FEMALE', 1, 'shoes_img/S15_1682.png'),
(16, 'Frozen', 1, 'Disney FROZEN kids girls Sea Green lycra shoe', 400, 'FEMALE', 1, 'shoes_img/S16_1170.png'),
(17, 'Centrino', 2, 'Allow your pair of shoes to air and de odorize at regular basis', 800, 'MALE', 2, 'shoes_img/S17_6750.png'),
(18, 'Fentacia', 2, 'Party Casual Daily Wear Shoes', 900, 'MALE', 2, 'shoes_img/S18_5564.png'),
(19, 'Rockfield', 2, ' The Sun Will Cause The Leather To Shrink Wrinkle Harden Dry And Crack', 700, 'MALE', 2, 'shoes_img/S19_2720.png'),
(20, 'ShoeRise', 2, 'High Quality Synthetic Leather upper which is perfect for daily all day activities', 1000, 'MALE', 2, 'shoes_img/S20_9559.png'),
(21, 'Levanse', 2, 'Use shoe bags to prevent from stains and mildew', 900, 'MALE', 2, 'shoes_img/S21_9345.png'),
(22, 'RazMaz', 2, 'Super Lightweight Breathable Heat Resistant Water Resistant  Anti Slip Sole and Ultra Durable', 500, 'FEMALE', 2, 'shoes_img/S22_8461.png'),
(23, 'CatBird', 2, 'Stay comfortable all day with the faux leather inner of these loafers These loafers are highly durable apart from looking very stylish', 600, 'FEMALE', 2, 'shoes_img/S23_6724.png'),
(24, 'CatBird', 2, ' Texture Feel Of Superior Comfortable, Stretching Resistance And Firmly With Great Flexibility', 900, 'FEMALE', 2, 'shoes_img/S24_5725.png'),
(25, 'Surexo', 2, 'Walking Indoor Outdoor Travel Party Wear And Any Other Occasions', 500, 'FEMALE', 2, 'shoes_img/S25_4946.png'),
(26, 'Marc Loire', 2, 'Marc Loire is an online fashion Brand for taste makers and trend breakers all over the country', 1000, 'FEMALE', 2, 'shoes_img/S26_7269.png');

-- --------------------------------------------------------

--
-- Table structure for table `size_detail`
--

CREATE TABLE IF NOT EXISTS `size_detail` (
  `size_id` int(10) NOT NULL,
  `shoes_id` int(10) NOT NULL,
  `size` varchar(5) NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size_detail`
--

INSERT INTO `size_detail` (`size_id`, `shoes_id`, `size`) VALUES
(1, 1, '7'),
(2, 1, '8'),
(3, 1, '9'),
(4, 2, '7'),
(5, 2, '8'),
(6, 2, '9'),
(7, 3, '7'),
(8, 3, '8'),
(9, 3, '9'),
(10, 4, '7'),
(11, 4, '8'),
(12, 4, '9'),
(13, 5, '7'),
(14, 5, '8'),
(15, 5, '9'),
(16, 6, '7'),
(17, 6, '8'),
(18, 6, '9'),
(19, 7, '7'),
(20, 7, '8'),
(21, 7, '9'),
(22, 8, '7'),
(23, 8, '8'),
(24, 8, '9'),
(25, 9, '7'),
(26, 9, '8'),
(27, 9, '9'),
(28, 10, '7'),
(29, 10, '8'),
(30, 10, '9'),
(31, 11, '3'),
(32, 11, '4'),
(33, 11, '5'),
(34, 12, '3'),
(35, 12, '4'),
(36, 12, '5'),
(37, 13, '3'),
(38, 13, '4'),
(39, 13, '5'),
(40, 14, '3'),
(41, 14, '4'),
(42, 14, '5'),
(43, 15, '3'),
(44, 15, '4'),
(45, 15, '5'),
(46, 16, '3'),
(47, 16, '4'),
(48, 16, '5'),
(49, 17, '7'),
(50, 17, '8'),
(51, 17, '9'),
(52, 18, '7'),
(53, 18, '8'),
(54, 18, '9'),
(55, 19, '7'),
(56, 19, '8'),
(57, 19, '9'),
(58, 20, '7'),
(59, 20, '8'),
(60, 20, '9'),
(61, 21, '7'),
(62, 21, '8'),
(63, 21, '9'),
(64, 22, '7'),
(65, 22, '8'),
(66, 22, '9'),
(67, 23, '7'),
(68, 23, '8'),
(69, 23, '9'),
(70, 24, '7'),
(71, 24, '8'),
(72, 24, '9'),
(73, 25, '7'),
(74, 25, '8'),
(75, 25, '9'),
(76, 26, '7'),
(77, 26, '8'),
(78, 26, '9');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
