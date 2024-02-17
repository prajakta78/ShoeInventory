-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 05:46 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoe_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(111, 'Admin', 'admin@gmail.com', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `items_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`items_details`)),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `bill_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `bill_number`, `items_details`, `total_amount`, `bill_date`) VALUES
(1, 'BILL-64e2f8fe7561a', NULL, '2100.00', '2023-08-21'),
(2, 'BILL-64e43f1b2994e', NULL, '600.00', '2023-08-22'),
(3, '', NULL, '0.00', '2023-08-22'),
(4, '', NULL, '0.00', '2023-08-22'),
(5, '', NULL, '0.00', '2023-08-22'),
(6, 'BILL-64e2f8fe7561a', NULL, '0.00', '2023-08-22'),
(7, 'BILL-64e2f8fe7561a', NULL, '0.00', '2023-08-22'),
(8, 'BILL-64e4856cd4dc0', NULL, '1000.00', '2023-08-22'),
(9, 'BILL-64e496212eafb', NULL, '1000.00', '2023-08-22'),
(10, 'BILL-64e4988741769', NULL, '0.00', '2023-08-22'),
(11, 'BILL-64e4a1e94d0ef', NULL, '2000.00', '2023-08-22'),
(12, 'BILL-64e4a4945b70c', NULL, '5000.00', '2023-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `billlss`
--

CREATE TABLE `billlss` (
  `id` int(11) NOT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `bill_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billlss`
--

INSERT INTO `billlss` (`id`, `bill_number`, `total_amount`, `bill_date`) VALUES
(1, 'BILL-64e05f12ed6a6', '0.00', '2023-08-19 06:20:02'),
(2, 'BILL-64e05f48e83b9', '0.00', '2023-08-19 06:20:56'),
(3, 'BILL-64e05f59980d6', '1200.00', '2023-08-19 06:21:13'),
(4, 'BILL-64e060671ac4a', '1400.00', '2023-08-19 06:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `bill_number` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_data` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `per_piece_price` decimal(10,2) NOT NULL,
  `bill_date` date NOT NULL DEFAULT current_timestamp(),
  `total_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `bill_number`, `product_code`, `product_name`, `product_data`, `category`, `brand`, `price`, `quantity`, `per_piece_price`, `bill_date`, `total_price`) VALUES
(1, 'BILL-64ddc0948cf72', '111', 'shoe', '0', 'men', 'nikenn', '2000.00', 4, '1000.00', '2023-08-17', ''),
(2, 'BILL-64ddc0a2b0e07', '548', 'facewash', '0', 'women', 'Brand', '3000.00', 4, '1000.00', '2023-08-17', ''),
(3, 'BILL-64ddc18a62fdd', '111', 'shoe', '0', 'men', 'nikenn', '2000.00', 2, '1000.00', '2023-08-17', ''),
(4, 'BILL-64ddc1988ea77', '111', 'shoe', '0', 'men', 'nikenn', '4000.00', 4, '1000.00', '2023-08-17', ''),
(5, 'BILL-64ddc1988ea77', '548', 'facewash', '0', 'women', 'Brand', '2000.00', 2, '0.00', '2023-08-17', ''),
(6, 'BILL-64dde35f168be', '111', 'shoe', '0', 'men', 'nikenn', '2000.00', 2, '0.00', '2023-08-17', ''),
(7, 'BILL-64dde3fe2a87a', '111', 'shoe', '0', 'men', 'nikenn', '2000.00', 2, '0.00', '2023-08-17', ''),
(8, 'BILL-64ddfee0affe2', '111', 'shoe', '0', 'men', 'nikenn', '4000.00', 4, '1000.00', '2023-08-17', ''),
(9, 'BILL-64de01e42b0b9', '548', 'facewash', '0', 'women', 'Brand', '2000.00', 2, '1000.00', '2023-08-17', ''),
(10, 'BILL-64de08a091fed', '111', 'shoe', '0', 'men', 'nikenn', '2000.00', 2, '1000.00', '2023-08-17', ''),
(11, 'BILL-64de08a091fed', '548', 'facewash', '0', 'women', 'Brand', '3000.00', 3, '1000.00', '2023-08-17', ''),
(12, 'BILL-64df07da1337d', '548', 'facewash', '0', 'women', 'Brand', '2000.00', 2, '1000.00', '2023-08-18', ''),
(13, 'BILL-64df1219edd5f', '548', 'facewash', '0', 'women', 'Brand', '2000.00', 2, '1000.00', '2023-08-18', ''),
(14, 'BILL-64df585adec05', '111', 'shoe', '0', 'men', 'nikenn', '2000.00', 2, '1000.00', '2023-08-18', ''),
(15, 'BILL-64df58878df79', '111', 'shoe', '0', 'men', 'nikenn', '8000.00', 8, '1000.00', '2023-08-18', ''),
(16, 'BILL-64e0558e6d6be', '548', 'facewash', '0', 'women', 'nikenn', '2000.00', 2, '1000.00', '2023-08-19', ''),
(17, 'BILL-64e055afb26b6', '548', 'facewash', '0', 'women', 'nikenn', '2000.00', 2, '1000.00', '2023-08-19', ''),
(18, 'BILL-64e055afb26b6', '111', 'shoe', '0', 'men', 'nikenn', '2000.00', 2, '1000.00', '2023-08-19', ''),
(19, 'BILL-64e05937eeb43', '222', 'dove', '0', 'women', 'Brand', '100.00', 1, '100.00', '2023-08-19', ''),
(20, 'BILL-64e05937eeb43', '333', 'santoor', '0', 'women', 'Brand', '400.00', 2, '200.00', '2023-08-19', ''),
(21, 'BILL-64e05acbc58ee', '', 'dove,santoor', '0', '', '', '200.00', 0, '100.00', '2023-08-19', '600'),
(22, 'BILL-64e06c76e159e', '111', 'shoe', '', 'men', 'nikenn', '1000.00', 1, '1000.00', '2023-08-19', ''),
(23, 'BILL-64e06c76e159e', '222', 'dove', '', 'women', 'Brand', '100.00', 1, '100.00', '2023-08-19', ''),
(24, 'BILL-64e06d0e14c79', '111', 'shoe', '', 'men', 'nikenn', '1000.00', 1, '1000.00', '2023-08-19', ''),
(25, 'BILL-64e09800a4a16', '111', 'shoe', '', 'men', 'nikenn', '1000.00', 1, '1000.00', '2023-08-19', '');

-- --------------------------------------------------------

--
-- Table structure for table `billss`
--

CREATE TABLE `billss` (
  `id` int(11) NOT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `bill_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bill_customers`
--

CREATE TABLE `bill_customers` (
  `id` int(30) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_customers`
--

INSERT INTO `bill_customers` (`id`, `customer_name`, `customer_email`) VALUES
(1, 'prajakta sdcfsullkd', 'prajakta02fegade@gmail.com'),
(2, 'prajakta sdcfsullkd', 'prajakta02fegade@gmail.com'),
(3, 'prajakta sdcfsullkd', 'prajakta02fegade@gmail.com'),
(4, 'prajakta sdcfsullkd', 'prajakta02fegade@gmail.com'),
(5, 'prajakta sdcfsullkd', 'prajakta02fegade@gmail.com'),
(6, 'rohit', 'prajakta02fegade@gmail.com'),
(7, 'rohit', 'prajakta02fegade@gmail.com'),
(8, 'rohit', 'prajakta02fegade@gmail.com'),
(9, 'pooja', 'pooja@gmail.com'),
(10, '', ''),
(11, '', ''),
(12, '', ''),
(13, '', ''),
(14, '', ''),
(15, '', ''),
(16, '', ''),
(17, '', ''),
(18, '', ''),
(19, '', ''),
(20, '', ''),
(21, '', ''),
(22, '', ''),
(23, '', ''),
(24, '', ''),
(25, '', ''),
(26, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bill_product`
--

CREATE TABLE `bill_product` (
  `id` int(11) NOT NULL,
  `bill_number` varchar(255) NOT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `per_piece_price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_product`
--

INSERT INTO `bill_product` (`id`, `bill_number`, `product_code`, `product_name`, `category`, `brand`, `price`, `quantity`, `per_piece_price`, `total_price`) VALUES
(63, 'BILL-64e4a4945b70c', '548', 'facewash', 'women', 'nikenn', NULL, 5, '1000.00', '5000.00'),
(64, 'BILL-64e4a4945b70c', '548', 'facewash', 'women', 'nikenn', NULL, 5, '1000.00', '5000.00'),
(66, 'BILL-64e4a4945b70c', '333', 'santoor', 'women', 'nikenn', NULL, 3, '1000.00', '5000.00'),
(67, 'BILL-64e4a4945b70c', '222', 'dove', 'women', 'nikenn', NULL, 4, '1000.00', '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `bill_products`
--

CREATE TABLE `bill_products` (
  `id` int(100) NOT NULL,
  `product_code` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price_per_unit` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(100) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_img` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_img`, `description`) VALUES
(2, 'nikenn', 'course1.png', 'rtfgrgdf');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(30) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_code`, `description`, `created_by`, `created_date`) VALUES
(2, 'men', '123', 'vcjvjuhd', '', '2023-08-08'),
(3, 'men', '123', 'dfvfsdf', '', '2023-08-08'),
(5, 'women', '4556', 'dfeddfvb', '', '2023-08-08'),
(9, 'kidssssss', '487', 'dscwfwsxcascddwerf', '', '2023-08-08'),
(0, 'fhnfcghnfg ', '45445', 'gfhjnfgjn f', '', '2023-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `category`, `brand`, `product_code`, `quantity`, `description`, `price`, `status`, `product_image`, `created_by`, `created_date`) VALUES
(1, 'shoe', 'men', 'nikenn', '111', -20, 'dsfvfegdfsvgdf', '1000.00', 'open', 'shoe_2.jpeg', '', '2023-08-08'),
(2, 'facewash', 'women', 'nikenn', '548', -21, 'GHJTGFJHN', '1000.00', 'open', 'coming.jpg', '', '2023-08-11'),
(4, 'dove', 'women', 'Brand', '222', 19, 'xdwteyyrtgfrdghfghfghfrt', '100.00', 'open', 'dove.jpeg', '', '2023-08-19'),
(5, 'santoor', 'women', 'Brand', '333', 23, 'dfgesfgdfgd', '200.00', 'open', 'santoor.jpeg', '', '2023-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `fld_size_id` int(200) NOT NULL,
  `fld_category_id` int(200) NOT NULL,
  `fld_brand_id` int(200) NOT NULL,
  `fld_size_number` int(100) NOT NULL,
  `fld_size_current_date` datetime NOT NULL DEFAULT current_timestamp(),
  `fld_size_modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billlss`
--
ALTER TABLE `billlss`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bill_number` (`bill_number`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billss`
--
ALTER TABLE `billss`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bill_number` (`bill_number`);

--
-- Indexes for table `bill_customers`
--
ALTER TABLE `bill_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_product`
--
ALTER TABLE `bill_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_products`
--
ALTER TABLE `bill_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`fld_size_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `billlss`
--
ALTER TABLE `billlss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `billss`
--
ALTER TABLE `billss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_customers`
--
ALTER TABLE `bill_customers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `bill_product`
--
ALTER TABLE `bill_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `bill_products`
--
ALTER TABLE `bill_products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `fld_size_id` int(200) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
