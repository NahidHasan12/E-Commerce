-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 02:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-comerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajax_forms`
--

CREATE TABLE `ajax_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `roll` varchar(255) DEFAULT NULL,
  `reg` varchar(255) DEFAULT NULL,
  `board` varchar(255) DEFAULT NULL,
  `session` varchar(255) DEFAULT NULL,
  `avater` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_slug` varchar(255) NOT NULL,
  `brand_logo` varchar(255) DEFAULT NULL,
  `front_page` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_slug`, `brand_logo`, `front_page`, `created_at`, `updated_at`) VALUES
(1, 'Toyota', 'toyo-ta', '16995940671026941854.png', 1, '2023-11-10 13:27:47', '2023-11-10 13:30:43'),
(2, 'Lamborghini', 'lam-bor', '1699594109708990538.jpg', 1, '2023-11-10 13:28:29', '2023-11-10 13:28:29'),
(3, 'BMW', 'b-m-w', '16995941331399920835.png', 1, '2023-11-10 13:28:53', '2023-11-10 13:28:53'),
(4, 'Tesla', 'tes-la', '1699594158393794038.jpg', 1, '2023-11-10 13:29:18', '2023-11-10 13:29:18'),
(5, 'Apple', 'app-le', '1699594186211987846.png', 0, '2023-11-10 13:29:46', '2023-11-10 13:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `campaings`
--

CREATE TABLE `campaings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaings`
--

INSERT INTO `campaings` (`id`, `title`, `start_date`, `end_date`, `image`, `status`, `discount`, `month`, `year`, `created_at`, `updated_at`) VALUES
(1, 'New Shop Opening', '2023-10-09', '2023-10-25', '16995955901110482186.jpg', '1', '50', 'November', '2023', '2023-11-10 13:53:10', '2023-11-10 13:53:10'),
(2, 'Shop Opening anniversary', '2023-10-09', '2023-10-25', '16995956601744593533.jpg', '1', '45', 'November', '2023', '2023-11-10 13:54:20', '2023-11-10 13:54:20'),
(3, 'Shop Marketing', '2023-10-09', '2023-10-25', '16995957071218187439.jpg', '1', '45', 'November', '2023', '2023-11-10 13:55:07', '2023-11-10 13:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `home_page` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `icon`, `category_name`, `category_slug`, `home_page`, `created_at`, `updated_at`) VALUES
(1, '16995943241432706967.png', 'Bike', 'bi-ke', '1', '2023-11-10 13:32:04', '2023-11-10 13:32:04'),
(2, '16995943861821444476.png', 'Car', 'ca-r', '1', '2023-11-10 13:32:28', '2023-11-10 13:33:06'),
(3, '16995944261970212048.png', 'Mobile', 'mobi-le', '0', '2023-11-10 13:32:51', '2023-11-10 13:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `childcategories`
--

CREATE TABLE `childcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `childcategory_name` varchar(255) NOT NULL,
  `childcategory_slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `childcategories`
--

INSERT INTO `childcategories` (`id`, `childcategory_name`, `childcategory_slug`, `category_id`, `subcategory_id`, `created_at`, `updated_at`) VALUES
(1, 'BMW X5', 'bmw-x5', 2, 4, NULL, '2023-11-10 13:43:10'),
(2, 'BMW 3 Series', 'bmw-3-series', 2, 4, '2023-11-10 13:40:30', '2023-11-10 13:40:30'),
(3, 'Camry', 'ca-mry', 2, 3, '2023-11-10 13:44:01', '2023-11-10 13:44:01'),
(4, 'Corolla', 'cor-olla', 2, 3, '2023-11-10 13:44:33', '2023-11-10 13:44:33'),
(5, 'Prius', 'pri-us', 2, 3, '2023-11-10 13:45:03', '2023-11-10 13:45:03'),
(6, 'Yaris', 'yar-is', 2, 3, '2023-11-10 13:45:22', '2023-11-10 13:45:22'),
(7, 'Model S', 'model-s', 2, 2, '2023-11-10 13:46:44', '2023-11-10 13:46:44'),
(8, 'Lamborghini Diablo', 'lamborghini-diablo', 2, 1, '2023-11-10 13:48:08', '2023-11-10 13:48:08'),
(9, 'Lamborghini Veneno', 'lamborghini-veneno', 2, 1, '2023-11-10 13:48:22', '2023-11-10 13:48:22'),
(10, 'lamborgini aventador', 'lamborgini-aventador', 2, 1, '2023-11-10 13:48:39', '2023-11-10 13:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `valid_date` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `coupon_amount` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `valid_date`, `type`, `coupon_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, '4455', '2023-11-13', '1', 5000, '1', '2023-11-13 07:46:45', '2023-11-13 07:46:45'),
(2, '1122', '2023-11-10', '1', 4000, '1', '2023-11-13 08:22:50', '2023-11-13 08:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `customer_reviews`
--

CREATE TABLE `customer_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `review` varchar(255) DEFAULT NULL,
  `rating` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_09_24_112815_create_categories_table', 1),
(7, '2023_09_25_234559_create_ajax_forms_table', 1),
(8, '2023_10_05_193916_create_sub_categories_table', 1),
(9, '2023_10_07_234916_create_childcategories_table', 1),
(10, '2023_10_08_105930_create_brands_table', 1),
(11, '2023_10_13_222625_create_seos_table', 1),
(12, '2023_10_14_002036_create_smtps_table', 1),
(13, '2023_10_14_094051_create_web_settings_table', 1),
(14, '2023_10_14_100653_create_pages_table', 1),
(15, '2023_10_19_073856_create_products_table', 1),
(16, '2023_10_19_085942_create_warehouses_table', 1),
(17, '2023_10_22_065704_create_coupons_table', 1),
(18, '2023_10_22_155413_create_pickup_points_table', 1),
(19, '2023_10_27_193728_create_reviews_table', 1),
(20, '2023_10_28_024345_create_wishlists_table', 1),
(21, '2023_10_29_060950_create_campaings_table', 1),
(22, '2023_11_08_052646_create_customer_reviews_table', 1),
(23, '2023_11_09_034951_create_shippings_table', 1),
(24, '2023_11_09_040628_create_newsletters_table', 1),
(25, '2023_11_13_052411_create_orders_table', 2),
(26, '2023_11_13_052449_create_order_details_table', 2),
(27, '2023_11_14_205143_create_tickets_table', 3),
(28, '2023_11_15_012412_create_replies_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` varchar(25) DEFAULT NULL,
  `c_name` varchar(255) DEFAULT NULL,
  `c_phone` varchar(255) DEFAULT NULL,
  `c_country` varchar(255) DEFAULT NULL,
  `c_city` varchar(255) DEFAULT NULL,
  `c_address` varchar(255) DEFAULT NULL,
  `c_email` varchar(255) DEFAULT NULL,
  `c_zipcode` varchar(255) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_discount` varchar(255) DEFAULT NULL,
  `main_balance` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `shipping_charge` varchar(5) DEFAULT NULL,
  `status` varchar(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_id`, `c_name`, `c_phone`, `c_country`, `c_city`, `c_address`, `c_email`, `c_zipcode`, `date`, `subtotal`, `total`, `coupon_code`, `coupon_discount`, `main_balance`, `payment_type`, `tax`, `shipping_charge`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '70244', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Hazradighi, Noongola, Bogura', 'nahid@gmail.com', '5800', '13-11-23', '442719.00', '509126.85', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 06:13:23', '2023-11-14 06:13:23'),
(2, 1, '44712', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Mirpur-10, Dhaka, Bangladesh', 'dhaka@gmail.com', '1500', '13-11-23', '102662.00', '118061.30', '4455', '5000', '97662', 'Hand Cash', '0', '0', '0', '2023-11-14 06:17:16', '2023-11-14 06:17:16'),
(3, 1, '27225', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Ashokola, Noongola, Bogura', 'nahidhosen024@gmail.com', '5800', '14-11-23', '759064.00', '872923.60', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 09:57:44', '2023-11-14 09:57:44'),
(4, 1, '70616', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Ashokola, Noongola, Bogura', 'nahidhosen024@gmail.com', '5800', '14-11-23', '759064.00', '872923.60', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 09:59:05', '2023-11-14 09:59:05'),
(5, 1, '29854', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Rojakpur, Noongola, Bogura', 'nahidhosen024@gmail.com', '5800', '14-11-23', '625664.00', '719513.60', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 10:13:46', '2023-11-14 10:13:46'),
(6, 1, '18759', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Mirpur-10, Dhaka, Bangladesh', 'nahidhosen024@gmail.com', '2000', '14-11-23', '64542.00', '74223.30', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 10:16:48', '2023-11-14 10:16:48'),
(7, 1, '73287', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Mirpur-10, Dhaka, Bangladesh', 'nahidhosen024@gmail.com', '2000', '14-11-23', '64542.00', '74223.30', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 10:19:11', '2023-11-14 10:19:11'),
(8, 1, '40908', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Mirpur-10, Dhaka, Bangladesh', 'nahidhosen024@gmail.com', '2000', '14-11-23', '64542.00', '74223.30', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 10:20:55', '2023-11-14 10:20:55'),
(9, 1, '47846', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Hazradighi, Noongola, Bogura', 'nahidhosen024@gmail.com', '5800', '14-11-23', '249154.00', '286527.10', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 13:23:00', '2023-11-14 13:23:00'),
(10, 1, '86119', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Hazradighi, Noongola, Bogura', 'nahidhosen024@gmail.com', '5800', '14-11-23', '249154.00', '286527.10', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 13:26:57', '2023-11-14 13:26:57'),
(11, 1, '54853', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Hazradighi, Noongola, Bogura', 'nahidhosen024@gmail.com', '5800', '14-11-23', '249154.00', '286527.10', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 13:33:03', '2023-11-14 13:33:03'),
(12, 1, '58291', 'Developer Nahid', '01581008881', 'bangladesh', NULL, 'Hazradighi, Noongola, Bogura', 'nahidhosen024@gmail.com', '5800', '14-11-23', '249154.00', '286527.10', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 13:34:28', '2023-11-14 13:34:28'),
(13, 2, '65212', 'NAHID HASAN', '01305193123', 'bangladesh', NULL, 'Hazradighi, Noongola, Bogura', 'dhaka@gmail.com', '2000', '14-11-23', '550034.00', '632539.10', NULL, NULL, NULL, 'Hand Cash', '0', '0', '0', '2023-11-14 14:44:14', '2023-11-14 14:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `single_price` varchar(255) DEFAULT NULL,
  `subtotal_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `color`, `size`, `quantity`, `single_price`, `subtotal_price`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 'Prius', 'yellow', 'medium', '1', '375633', '375633', '2023-11-14 06:13:23', '2023-11-14 06:13:23'),
(2, 1, 4, 'BMW 3 Series', 'gray', 'medium', '2', '33543', '67086', '2023-11-14 06:13:23', '2023-11-14 06:13:23'),
(3, 2, 2, 'Lamborghini Veneno', 'black', 'large', '1', '29100', '29100', '2023-11-14 06:17:16', '2023-11-14 06:17:16'),
(4, 2, 8, 'Corolla', 'white', 'large', '1', '64542', '64542', '2023-11-14 06:17:16', '2023-11-14 06:17:16'),
(5, 2, 7, 'Camry', 'red', 'small', '1', '9020', '9020', '2023-11-14 06:17:16', '2023-11-14 06:17:16'),
(6, 4, 10, 'Yaris', 'white', 'large', '1', '750044', '750044', '2023-11-14 09:59:12', '2023-11-14 09:59:12'),
(7, 4, 7, 'Camry', 'white', 'large', '1', '9020', '9020', '2023-11-14 09:59:12', '2023-11-14 09:59:12'),
(8, 5, 9, 'Prius', 'white', 'large', '1', '375633', '375633', '2023-11-14 10:13:52', '2023-11-14 10:13:52'),
(9, 5, 5, 'BMW X5', 'white', 'large', '1', '250031', '250031', '2023-11-14 10:13:52', '2023-11-14 10:13:52'),
(10, 8, 8, 'Corolla', 'white', 'large', '1', '64542', '64542', '2023-11-14 10:21:00', '2023-11-14 10:21:00'),
(11, 12, 7, 'Camry', 'white', 'large', '1', '9020', '9020', '2023-11-14 13:34:36', '2023-11-14 13:34:36'),
(12, 12, 3, 'lamborgini aventador', 'skay blue', 'large', '1', '240134', '240134', '2023-11-14 13:34:36', '2023-11-14 13:34:36'),
(13, 13, 6, 'Model S', 'sky blue', 'medium', '1', '550034', '550034', '2023-11-14 14:44:20', '2023-11-14 14:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_position` int(11) DEFAULT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `page_slug` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_points`
--

CREATE TABLE `pickup_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pickup_point_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `another_phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pickup_points`
--

INSERT INTO `pickup_points` (`id`, `pickup_point_name`, `address`, `phone`, `another_phone`, `created_at`, `updated_at`) VALUES
(1, 'Nahid Store', 'Bogura, Bangladesh', '+1 (233) 831-3258', '+1 (755) 931-2616', '2023-11-10 13:56:05', '2023-11-10 13:56:05'),
(2, 'Sabbir Store', 'Shylet, Bangladesh', '+1 (745) 373-3952', '+1 (755) 931-2616', '2023-11-10 13:56:28', '2023-11-10 13:56:28'),
(3, 'Sakib Store', 'Dhaka, Bangladesh', '+1 (602) 408-5753', '+1 (328) 469-9592', '2023-11-10 13:56:50', '2023-11-10 13:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `childcategory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `pickup_point_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `purchase_price` varchar(255) DEFAULT NULL,
  `selling_price` varchar(255) DEFAULT NULL,
  `discount_price` varchar(255) DEFAULT NULL,
  `stock_quantity` varchar(255) DEFAULT NULL,
  `warehouse` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `product_views` int(11) NOT NULL DEFAULT 1,
  `trendy` int(11) NOT NULL DEFAULT 1,
  `featured` int(11) DEFAULT NULL,
  `slider_show` int(11) DEFAULT NULL,
  `today_deal` int(11) DEFAULT NULL,
  `flash_deal_id` int(11) DEFAULT NULL,
  `cash_on_delivery` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `childcategory_id`, `brand_id`, `pickup_point_id`, `name`, `slug`, `code`, `color`, `size`, `unit`, `tags`, `video`, `purchase_price`, `selling_price`, `discount_price`, `stock_quantity`, `warehouse`, `description`, `status`, `thumbnail`, `images`, `product_views`, `trendy`, `featured`, `slider_show`, `today_deal`, `flash_deal_id`, `cash_on_delivery`, `admin_id`, `date`, `month`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 8, 2, 3, 'Lamborghini Diablo', 'lamborghini-diablo', '558hh', 'red,violet,pale red,pink', 'large,medium,small', 'amr, shonar, bangla', 'car, supper fast car, racing ca, speed master', 'ICN6ql2dVM4', '214350', '234350', '230350', '20', 1, '<div class=\"I506P IFnjPb\"><a href=\"https://www.google.com/search?client=firefox-b-d&amp;sca_esv=580877352&amp;cs=0&amp;sxsrf=AM9HkKkO9Sg_dqKATSqDG9X807nHiQxNIA:1699548442922&amp;q=lamborghini+diablo&amp;stick=H4sIAAAAAAAAAE2ROU7DQABFCTIQTAiKpSAhKCI6Ku92KhoUFoFoSAON5XXsaDx2ZoZ4uQW0dBEVFRIXoOIENOQIljgAVCQKsl2-__WfZmmKhw3tbheaoRVh4Aco6IWR48IeDAj9bXSvaoVtYrLMV5vG4Hp4Mbw1XplGwbRYlg95AaiybdOC6S4xxxOV-tzG-T02bRMVzBa7ucildAyScjSCojKalKVoJRKtKM6gU-tSARTMwXLoACJTi2vfuIRGvQF0QxfRqGD22W0e8KJowwxgL9Q49mReuMjEQVSpMl9LyzPIVpbmc9z5n_qCHlN5PK4SDynIS0ekFOixZkglqZhocUl9nepSjbQ0r5lkgxJfmd-xzbYWiaSkiTjxwkqdZXFFloL7avV2JKlRX0AGqtQEGyLIZWG6xtX_0wlMC0az9b2V98_gOZie_Rw9fh2_XXaePl7k2QN3-v0HW90jYAUCAAA&amp;sa=X&amp;ved=2ahUKEwjO996pr7eCAxUJZmwGHfmEB34Q7fAIegUIABCrAw\">Lamborghini Diablo</a></div><div class=\"YbOmnd s0Odib\"><div class=\"mLpoJb\"><div class=\"Ze3gdf\"><div class=\"duOqab\" jsmodel=\"Wn3aEc\" jscontroller=\"LdB9sd\" jsshadow=\"\" jsaction=\"PdWSXe:h5M12e;rcuQ6b:npT2md;\" jsdata=\"X2sNs;_;CHj34Y\" data-hveid=\"CAAQrgM\"><div jsslot=\"\"><a class=\"ivg-i\" role=\"button\" tabindex=\"0\" jsaction=\"trigger.PdWSXe\" data-ved=\"2ahUKEwjO996pr7eCAxUJZmwGHfmEB34Qt-oFegUIABCvAw\"><div class=\"thumb\" style=\"overflow:hidden;width:92px;height:92px;border-radius:0\"><g-img><img id=\"dimg_Gg1NZc6CN4nMseMP-Yme8Ac_73\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSrqA1gUJ2D2Sv1w_d13xZ6S6aTNTrcxgKNdIsowzjsx-7FYwoxpIT1NyA&amp;s=0\" class=\"YQ4gaf zr758c wA1Bge\" height=\"92\" style=\"margin-left:-40px\" width=\"151\" alt=\"image of Lamborghini Diablo\"></g-img></div><div class=\"Q8j1wd\"></div><span class=\"S5XGBe\" aria-hidden=\"true\">en.wikipedia.org</span></a></div></div><div class=\"nfUtB PZPZlf hb8SAc\" data-attrid=\"description\" data-hveid=\"CAAQsAM\" data-ved=\"2ahUKEwjO996pr7eCAxUJZmwGHfmEB34QziAoAXoFCAAQsAM\"><div jscontroller=\"GCSbhd\" jsaction=\"SKAaMe:c0XUbe;rcuQ6b:npT2md\"><div jscontroller=\"GCSbhd\" class=\"kno-rdesc\" jsaction=\"seM7Qe:c0XUbe;Iigoee:c0XUbe;rcuQ6b:npT2md\"></div></div></div></div></div></div><p>The\r\n Lamborghini Diablo is a high-performance mid-engine sports car built by\r\n Italian automobile manufacturer Lamborghini between 1990 and 2001. It \r\nis the first production Lamborghini capable of attaining a top speed in \r\nexcess of 320 kilometres per hour.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sapien lectus, dapibus eu fermentum a, laoreet sit amet enim. Aliquam a ultrices velit, nec commodo ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla lacinia sit amet metus in iaculis. Quisque nibh magna, scelerisque ut vehicula nec, pulvinar vel felis. Etiam tempus pharetra enim, non molestie sem tempus id. Quisque maximus pellentesque suscipit. Donec sollicitudin convallis faucibus. Cras eget arcu sagittis, ultrices lorem in, lobortis mauris. Sed nulla enim, egestas quis finibus id, efficitur nec quam. In quis enim accumsan, dictum nisi ac, porta mi.<br></p>', 1, '1699596471374288587.png', '[\"16995964711775790778.png\",\"16995964711900592806.png\",\"1699596471357473035.png\"]', 5, 1, 1, 1, 1, NULL, NULL, 1, '10-11-2023', 'November', '2023-11-10 14:07:51', '2023-11-10 15:26:23'),
(2, 2, 1, 9, 2, 3, 'Lamborghini Veneno', 'lamborghini-veneno', '2a2e3', 'black, white, gray, yellow', 'large,medium,small', 'amr, shonar, bangla', 'car, supper fast, speed mastar, mostar', 'MGBPs8p-MiM', '234540', '294540', '29100', '15', 1, '<div class=\"I506P IFnjPb\"><a href=\"https://www.google.com/search?client=firefox-b-d&amp;sca_esv=580877352&amp;cs=0&amp;sxsrf=AM9HkKkO9Sg_dqKATSqDG9X807nHiQxNIA:1699548442922&amp;q=lamborghini+veneno&amp;stick=H4sIAAAAAAAAAE2Ru0rDUACGbYlaY60YqCA6FDen5OQ-uUi9oLjYRZeQpOlJSnKSnnPM7S10dStOToIv4OQTuNhHCPgAOtlSSTJ-_8__cS4tcNgE-t2ubwZWiKHrIa8XhEPH7_keob-N7lWtsE1MlnmzZfSvBxeDW-OVaRRMm2X5gBegItk2LZjuEnMcK9Tl1s_vsWmbqGA22Y1FLqYTmJSjsQ_kcVyWwEpEWlGU-cNalwqwYA6WwyEkErW4zo1DaNjr-07gIBoWzD67xUMeANvPIB4FKseezAsHmdgLK1Xmqml5BsnK0nyO2_9TV9AiKk0mVTJCMhqlY1IKtEg1xJIUTNSoJF2jmlgjNc1rJsmgxJXnd-yw7UUiymkC4lFQqbMsqsiSsa5Ub0eSGukCMlClJtgAMJeE6SpX_8_YQQ4KZ2t7K--f3rM3Pfs5evw6frvcefp4kWYP3On3HzGlVRgGAgAA&amp;sa=X&amp;ved=2ahUKEwjO996pr7eCAxUJZmwGHfmEB34Q7fAIegUIABC9AQ\">Lamborghini Veneno</a></div><div class=\"YbOmnd s0Odib\"><div class=\"mLpoJb\"><div class=\"Ze3gdf\"><div class=\"duOqab\" jsmodel=\"Wn3aEc\" jscontroller=\"LdB9sd\" jsshadow=\"\" jsaction=\"PdWSXe:h5M12e;rcuQ6b:npT2md;\" jsdata=\"X2sNs;_;CHj33o\" data-hveid=\"CAAQwAE\"><div jsslot=\"\"><a class=\"ivg-i\" role=\"button\" tabindex=\"0\" jsaction=\"trigger.PdWSXe\" data-ved=\"2ahUKEwjO996pr7eCAxUJZmwGHfmEB34Qt-oFegUIABDBAQ\"><div class=\"thumb\" style=\"overflow:hidden;width:92px;height:92px;border-radius:0\"><g-img><img id=\"dimg_Gg1NZc6CN4nMseMP-Yme8Ac_39\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0NK4g9sfi7So-uOmzbVksJFvUIYKgdAuK4vAaBup9bYOMlcnyCKAOV8Q&amp;s=0\" class=\"YQ4gaf zr758c wA1Bge\" height=\"92\" style=\"margin-left:-23px\" width=\"139\" alt=\"image of Lamborghini Veneno\"></g-img></div><div class=\"Q8j1wd\"></div><span class=\"S5XGBe\" aria-hidden=\"true\">en.wikipedia.org</span></a></div></div><div class=\"nfUtB PZPZlf hb8SAc\" data-attrid=\"description\" data-hveid=\"CAAQwgE\" data-ved=\"2ahUKEwjO996pr7eCAxUJZmwGHfmEB34QziAoAXoFCAAQwgE\"><div jscontroller=\"GCSbhd\" jsaction=\"SKAaMe:c0XUbe;rcuQ6b:npT2md\"><div jscontroller=\"GCSbhd\" class=\"kno-rdesc\" jsaction=\"seM7Qe:c0XUbe;Iigoee:c0XUbe;rcuQ6b:npT2md\"></div></div></div></div></div></div><p>The\r\n Lamborghini Veneno is a limited production high performance sports car \r\nmanufactured by Italian automobile manufacturer Lamborghini. Based on \r\nthe Lamborghini Aventador, the Veneno was developed to celebrate \r\nLamborghini\'s 50th anniversary. It was introduced at the 2013 Geneva \r\nMotor Show</p><p>The price tag speaks volumes. The Lamborghini <em>Veneno</em> was priced at US$4,500,000 (2013) – every dollar worth just for the unique looks and power alone.</p><p>An over-the-top pantomime on wheels, the Aventador-based <em>Veneno</em> and <em>Veneno</em> Roadster (pictured) were named after an appropriately fast and strong bull. Some<br></p>', 1, '16995971361041340133.png', '[\"1699597136681184267.png\",\"16995971362124631937.png\",\"1699597136572509728.png\"]', 2, 1, 1, 1, 1, NULL, NULL, 1, '10-11-2023', 'November', '2023-11-10 14:18:56', '2023-11-10 15:45:44'),
(3, 2, 1, 10, 2, 3, 'lamborgini aventador', 'lamborgini-aventador', '5fhj4', 'skay blue, blue, gray, green', 'large,medium,small', 'amr, shonar, bangla', 'car, supper fast, nice, speed master', 'Hu4SqWy34ao', '232134', '242134', '240134', '12', 1, '<p>The Lamborghini Aventador is a mid-engine sports car \r\nproduced by the Italian automotive manufacturer Lamborghini. The \r\nAventador’s namesake is a Spanish fighting bull that fought in Zaragoza,\r\n Aragón, in 1993. The Aventador is the successor to the Murciélago and \r\nwas produced in Sant\'Agata Bolognese, Italy.</p><p>The <em>Lamborghini Aventador</em> is a sports car designed and \r\nproduced by Lamborghini, one of the leading sports car manufacturers \r\nfrom Italy. It was launched to the&nbsp;</p><p>The <em>Lamborghini Aventador</em> is a mid-engined sports car \r\nproduced by the Italian manufacturer Automobili Lamborghini. Launched on\r\n 28 February 2011 at the Geneva<br></p>', 1, '16996011781193331872.png', '[\"16996011781564423105.png\",\"16996011781034792845.png\",\"1699601178149469423.png\"]', 2, 1, 1, 1, 1, NULL, NULL, 1, '10-11-2023', 'November', '2023-11-10 15:26:18', '2023-11-10 15:45:24'),
(4, 2, 4, 2, 3, 2, 'BMW 3 Series', 'bmw-3-series', '5fhj4s', 'Black, dark, gray, blue', 'large,medium,small', 'amr, shonar, bangla', 'car, supper fast, nice, speed master', 'dkK-_dnkjgU', '32543', '34543', '33543', '30', 3, '<div class=\"I506P IFnjPb\"><a href=\"https://www.google.com/search?client=firefox-b-d&amp;sca_esv=580917885&amp;cs=0&amp;sxsrf=AM9HkKn7MBMuA7xKovvb7vezNeGIIt-86Q:1699551086395&amp;q=bmw+3+series&amp;stick=H4sIAAAAAAAAAE2RPUvDUBiFrUSJaasSUBEULjroluQmTdPBQUVEsC4WRJdgvpsmab7sbUp_g5OToziL6B9wd3Vycc_gLJ00mtw4XQ7vwznveS_JbVTYi3nFRcDta7oDnG4UTyqLxz8P6Btgr30G1MswmkyT8sFJ56hzLj8SlZSoUnOMy7DQjZMoJZYKZfshTTbAqR529QhTfCwao5SoUVSmBI-NbBdLxZLs2CodE2SYWDUkQf43G9lBKyXqVDVTHAtVz0ywERSR0OylxPKf9GRFbkU0KeBttqk6YzIcZ_gs72qaRq9k7WA-B4fhpQf2-1e-nhILOWpLCA1DFOIQNBrYMSw3QlAclngYxL4oyzbGLdlQoZQS6zmgIMOwVMjTtSy6DYu84lADduiUdkaDD2JJdPGB-WbiWTQp4Up51x50oeTTJMSDwiIQTN-JmiGOELSBGdzN1LIf50H0i7_Prk69vHXvX2-3Nj9bDzfX6e7O-GP8vKZ_PX0DBN4xVSECAAA&amp;sa=X&amp;ved=2ahUKEwjLtp-WubeCAxWexTgGHUXIBwcQ7fAIegUIABC5Ag\">BMW 3 Series</a></div><div class=\"YbOmnd s0Odib\"><div class=\"mLpoJb\"><div class=\"Ze3gdf\"><div class=\"duOqab\" jsmodel=\"Wn3aEc\" jscontroller=\"LdB9sd\" jsshadow=\"\" jsaction=\"PdWSXe:h5M12e;rcuQ6b:npT2md;\" jsdata=\"X2sNs;_;BZ8yZA\" data-hveid=\"CAAQvAI\"><div jsslot=\"\"><a class=\"ivg-i\" role=\"button\" tabindex=\"0\" jsaction=\"trigger.PdWSXe\" data-ved=\"2ahUKEwjLtp-WubeCAxWexTgGHUXIBwcQt-oFegUIABC9Ag\"><div class=\"thumb\" style=\"overflow:hidden;width:92px;height:92px;border-radius:0\"><g-img><img id=\"dimg_bhdNZcvHFp6L4-EPxZCfOA_61\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsTkxIHX47HvcBk0NGOjscD7pqvwYZefKRDpQzJgNM0B3O1f4wKxME2Uo&amp;s=0\" class=\"YQ4gaf zr758c wA1Bge\" height=\"92\" style=\"margin-left:-24px\" width=\"140\" alt=\"image of BMW 3 Series\" data-ilt=\"1699601415534\"></g-img></div><div class=\"Q8j1wd\"></div><span class=\"S5XGBe\" aria-hidden=\"true\"></span></a></div></div><div class=\"nfUtB PZPZlf hb8SAc\" data-attrid=\"description\" data-hveid=\"CAAQvgI\" data-ved=\"2ahUKEwjLtp-WubeCAxWexTgGHUXIBwcQziAoAXoFCAAQvgI\"><div jscontroller=\"GCSbhd\" jsaction=\"SKAaMe:c0XUbe;rcuQ6b:npT2md\"><div jscontroller=\"GCSbhd\" class=\"kno-rdesc\" jsaction=\"seM7Qe:c0XUbe;Iigoee:c0XUbe;rcuQ6b:npT2md\"></div></div></div></div></div></div><p>The\r\n BMW 3 Series is a line of compact executive cars manufactured by the \r\nGerman automaker BMW since May 1975. It is the successor to the 02 \r\nSeries and has been produced in seven generations.</p><p>The <em>3 Series</em>, free from flashy symbols, asserts itself \r\nthrough confident design. An epitome of driving delight, this hydrofoil \r\nfaultlessly unites performance</p><p>Some of the popular BMW cars in India include BMW X7, <em>BMW 3 Series</em>, BMW X5, BMW X1, BMW Z4, BMW M5, BMW 7 Series, BMW iX. As of November 2023, BMW has a&nbsp;<br></p>', 1, '1699601557453698618.png', '[\"16996015571720446852.png\",\"1699601558169708462.png\",\"1699601558786206909.png\"]', 1, 1, 1, 1, 1, NULL, NULL, 1, '10-11-2023', 'November', '2023-11-10 15:32:38', '2023-11-10 15:32:38'),
(5, 2, 4, 1, 3, 2, 'BMW X5', 'bmw-x5', 'BMW3X5', 'white, sky blue, bule, chocolate', 'large,medium,small', 'amr, shonar, bangla', 'car, supper fast, nice, speed master', 'xCFyhwYv8OU', '234231', '254231', '250031', '17', 3, '<div class=\"I506P IFnjPb\"><a href=\"https://www.google.com/search?client=firefox-b-d&amp;sca_esv=580917885&amp;cs=0&amp;sxsrf=AM9HkKn7MBMuA7xKovvb7vezNeGIIt-86Q:1699551086395&amp;q=bmw+x5&amp;stick=H4sIAAAAAAAAAE2RPUvDUBiFrcQS01YloCIoBB10S3Lz0XRwUBERrIsF0SWY76ZJmi97k9Lf4OTkKM4i-gfcXZ1c3DM4SycNJjdOl4f3cM573ouzmzVwuaC4kHKHmu5QTj-Kp7Wlk9-HGhrUfvecUq_CaDqLy4envePehfyE1TKsQczTLs0AN06jDFsuyfZDEheoMz3s6xFScbFojDOsSRA58R4T2S5CxZLs2KocU2iYiASJl__NxnbQybAW0ciJZYDqmSkyAiLk24MMW_lDT1bkTkTiPNpmh2jRJs2yhs9wrqZp5GreDhRz6ii88qiD4bWvZ9hiIbUlCJMQhigEjkd2DKqNIBCTSh4GsS_Kso3klmyoQMqwjUKgQMOwVMCRzTy6C8q88lAjJnEqO0PgglgSXXRgrp16FolLqFLRdQBcIPkkDtCgtAh403eidogieG1kBvdz9fzHE-Gjvjbz-t5_eLvb3vrqPN7eZHu7k8_Jy7r-_fwDZsa8rxsCAAA&amp;sa=X&amp;ved=2ahUKEwjLtp-WubeCAxWexTgGHUXIBwcQ7fAIegUIABDfAg\">BMW X5</a></div><div class=\"YbOmnd s0Odib\"><div class=\"mLpoJb\"><div class=\"Ze3gdf\"><div class=\"duOqab\" jsmodel=\"Wn3aEc\" jscontroller=\"LdB9sd\" jsshadow=\"\" jsaction=\"PdWSXe:h5M12e;rcuQ6b:npT2md;\" jsdata=\"X2sNs;_;BZ8yZI\" data-hveid=\"CAAQ4gI\"><div jsslot=\"\"><a class=\"ivg-i\" role=\"button\" tabindex=\"0\" jsaction=\"trigger.PdWSXe\" data-ved=\"2ahUKEwjLtp-WubeCAxWexTgGHUXIBwcQt-oFegUIABDjAg\"><div class=\"thumb\" style=\"overflow:hidden;width:92px;height:92px;border-radius:0\"><g-img><img id=\"dimg_bhdNZcvHFp6L4-EPxZCfOA_65\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxyPZjS-wupA6i-Bj_lj5-r5t8Huxuf12CKgIWROz9uGG-X1LhVboW3hw&amp;s=0\" class=\"YQ4gaf zr758c wA1Bge\" height=\"92\" style=\"margin-left:-24px\" width=\"140\" alt=\"image of BMW X5\" data-ilt=\"1699601415535\"></g-img></div><div class=\"Q8j1wd\"></div><span class=\"S5XGBe\" aria-hidden=\"true\"></span></a></div></div><div class=\"nfUtB PZPZlf hb8SAc\" data-attrid=\"description\" data-hveid=\"CAAQ5AI\" data-ved=\"2ahUKEwjLtp-WubeCAxWexTgGHUXIBwcQziAoAXoFCAAQ5AI\"><div jscontroller=\"GCSbhd\" jsaction=\"SKAaMe:c0XUbe;rcuQ6b:npT2md\"><div jscontroller=\"GCSbhd\" class=\"kno-rdesc\" jsaction=\"seM7Qe:c0XUbe;Iigoee:c0XUbe;rcuQ6b:npT2md\"></div></div></div></div></div></div><p>The\r\n BMW X5 is a mid-size luxury SUV produced by BMW. The X5 made its debut \r\nin 1999 as the E53 model. It was BMW\'s first SUV. At launch, it featured\r\n all-wheel drive and was available with either a manual or automatic \r\ngearbox. The second generation was launched in 2006, and was known \r\ninternally as the E70</p><p>\"The <em>BMW X5</em> epitomizes substance, seamlessly fusing \r\nrefined aesthetics with potent performance. Its satiny external profile \r\npainlessly captures attention while</p><p><em>BMW</em> branded the <em>X5</em> as a Sport Activity Vehicle rather than an SUV, to emphasize its on-road ability despite its size. Like the Lexus RX 300, the <em>X5</em> heralded th<br></p>', 1, '16996018901874467387.png', '[\"16996018901571500760.png\",\"16996018902090687716.png\",\"1699601890446390372.png\"]', 1, 1, 1, 1, 1, NULL, NULL, 1, '10-11-2023', 'November', '2023-11-10 15:38:10', '2023-11-10 15:38:10'),
(6, 2, 2, 7, 4, 1, 'Model S', 'model-s', 'Moel22S', 'white, red, black, sky blue', 'large,medium,small', 'amr, shonar, bangla', 'car, supper fast, nice, speed master', 'ZfBDx40Grco', '521234', '551234', '550034', '25', 2, '<div class=\"I506P IFnjPb\"><a href=\"https://www.google.com/search?client=firefox-b-d&amp;sca_esv=580917885&amp;cs=0&amp;sxsrf=AM9HkKkaIcSxCG828TD10Elu2-cUxhezNA:1699551776187&amp;q=tesla+model+s&amp;stick=H4sIAAAAAAAAAOMwVGI0iBIoSS3OSVTIzU9JzVHIySwu-cUo7VaUn6tQnF9alJxarJCYXJRfXKxQkpGqUJ6a9IuJI97VL8QzJDJ-AwvjKxZRLi79XH0Dk-TKnOwcIXZfsDHBr1j4uXj10_UNDZONK0wsCpLM4SrTCg1MK3NhKiMQKtOT4k3SjIwqXrHwcfGARIwKynJyLQ3LX7Fwc3GCtRqbFlkgaTBMKsgpK8tAiGQYG5bFm5uWoxlhlodQklZpam5pWmyxiJUX2ePFt9gkGQ5cyVzyRl3qd-jjsxLx7Mxr2r3l3DOY2G8DABhfddYpAQAA&amp;sa=X&amp;ved=2ahUKEwjntJXfu7eCAxWPSmwGHXeDAGMQ7fAIegQIABAR\">Model S</a></div><div class=\"YbOmnd s0Odib\"><div class=\"mLpoJb\"><div class=\"Ze3gdf\"><div class=\"duOqab\" jsmodel=\"Wn3aEc\" jscontroller=\"LdB9sd\" jsshadow=\"\" jsaction=\"PdWSXe:h5M12e;rcuQ6b:npT2md;\" jsdata=\"X2sNs;_;B6139o\" data-hveid=\"CAAQFA\"><div jsslot=\"\"><a class=\"ivg-i\" role=\"button\" tabindex=\"0\" jsaction=\"trigger.PdWSXe\" data-ved=\"2ahUKEwjntJXfu7eCAxWPSmwGHXeDAGMQt-oFegQIABAV\"><div class=\"thumb\" style=\"overflow:hidden;width:92px;height:92px;border-radius:0\"><g-img><img id=\"dimg_IBpNZeekCo-VseMP94aCmAY_5\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPEoAER48xdIYqOmlA8PfZ4YSD_w4iecjHwMj1lDt4NRTtdGXxiDRJG_4&amp;s=0\" class=\"YQ4gaf zr758c wA1Bge\" height=\"92\" style=\"margin-left:-24px\" width=\"140\" alt=\"image of Model S\"></g-img></div><div class=\"Q8j1wd\"></div><span class=\"S5XGBe\" aria-hidden=\"true\"></span></a></div></div><div class=\"nfUtB PZPZlf hb8SAc\" data-attrid=\"description\" data-hveid=\"CAAQFg\" data-ved=\"2ahUKEwjntJXfu7eCAxWPSmwGHXeDAGMQziAoAXoECAAQFg\"><div jscontroller=\"GCSbhd\" jsaction=\"SKAaMe:c0XUbe;rcuQ6b:npT2md\"><div jscontroller=\"GCSbhd\" class=\"kno-rdesc\" jsaction=\"seM7Qe:c0XUbe;Iigoee:c0XUbe;rcuQ6b:npT2md\"></div></div></div></div></div></div><p>The\r\n Tesla Model S is a battery electric full-size luxury sedan with a \r\nliftback body style built by Tesla, Inc. since 2012. The Model S \r\nfeatures a battery-powered dual-motor, all-wheel drive layout, although \r\nearlier versions featured a rear-motor and rear-wheel drive layout</p><p>The <em>Model S</em> won several automotive awards during 2012 and\r\n 2013, including the 2013 Motor Trend Car of the Year, and became the \r\nfirst electric car to top the</p><p>The <em>Model S</em> Plaid is the most impressive of the sedans, \r\nboasting some legitimate performance specs and an upscale, featureful \r\ninterior. Scoring high in the SUV<br></p>', 1, '16996022851773661953.png', '[\"16996022851459897584.png\",\"16996022851695616513.png\",\"16996022851025266448.png\"]', 1, 1, 1, 1, 1, NULL, NULL, 1, '10-11-2023', 'November', '2023-11-10 15:44:45', '2023-11-11 08:38:02'),
(7, 2, 3, 3, 1, 1, 'Camry', 'camry', 'Camry231', 'white, black, red, gray', 'large,medium,small', 'amr, shonar, bangla', 'car, supper fast, nice, speed master', 'bPhBKL37fQ8', '8320', '9320', '9020', '50', 4, '<div class=\"I506P IFnjPb\"><a href=\"https://www.google.com/search?client=firefox-b-d&amp;sca_esv=581269367&amp;cs=0&amp;sxsrf=AM9HkKmj9VxLKAW7GjfsnwL-f_Sv9MBw1Q:1699637373700&amp;q=toyota+camry&amp;stick=H4sIAAAAAAAAAE2SvY7TQBSFCTsmwZsI7bAsogGLF0jG_5EoWEWLFgnQajcgQmM5seNMPOOxZ-yA8yLbr2joqCio6HgBKh7BokdKhU0sJ-V8c-7cc-6dDnraQh9OUpaz1FUo83yiRC71FYJFuml1x9uLConN7Y5z9mb8cjxxvoJWAY7lu33aH2gWijlsjxhnhLgFgA1ODCiNXMrzAjzYwimdGwPYecF4mkU-b8QoF3QNpQuOM1GA-7JcQdXgSVrSictxSQ-3Uv3TILYL8HB7Mnk-NaB8joMFcSNv70nVnnkhlK6ymJemjuriNArXEFy6K70R2mo0daB0jk9nfhNK50YcwrZ-mUX_fSq1pdiOhisIX5W9lBHPsPC5csFdjzX-ULJAWgHuyb1-0EdoPrADPbfSHZnauT0kSFQZDiuiohhZcwt23vmEzDH3d1qxEJqtpd4eMYdhbqbJXgeSIE9PaAEe12QZeqqjrR3Yq5dSWmVCNImtQKzMcjWcfYx2ieMwNmD7yk8yhsuJ9WpzaqBRWhro1hMwNbpc3kjd-svMqv3-vvPo1o9f-HP4bPNl8v3P9fPTt6_F328_D94_mfwDYL39tGICAAA&amp;sa=X&amp;ved=2ahUKEwjd6ZrP-rmCAxVmRmcHHXtcDX4Q7fAIegUIABDCAg\">Camry</a></div><div class=\"YbOmnd s0Odib\"><div class=\"mLpoJb\"><div class=\"Ze3gdf\"><div class=\"duOqab\" jsmodel=\"Wn3aEc\" jscontroller=\"LdB9sd\" jsshadow=\"\" jsaction=\"PdWSXe:h5M12e;rcuQ6b:npT2md;\" jsdata=\"X2sNs;_;BUkqwk\" data-hveid=\"CAAQxQI\"><div jsslot=\"\"><a class=\"ivg-i\" role=\"button\" tabindex=\"0\" jsaction=\"trigger.PdWSXe\" data-ved=\"2ahUKEwjd6ZrP-rmCAxVmRmcHHXtcDX4Qt-oFegUIABDGAg\"><div class=\"thumb\" style=\"overflow:hidden;width:92px;height:92px;border-radius:0\"><g-img><img id=\"dimg_fWhOZZ23JeaMnesP-7i18Ac_63\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkaV50ag7E3gZ9pwI7m_h0obhQz7OP8xp1BNwlgNLfDJh4KnRF5HQaey4&amp;s=0\" class=\"YQ4gaf zr758c wA1Bge\" height=\"92\" style=\"margin-left:-24px\" width=\"140\" alt=\"image of Camry\" data-ilt=\"1699687649150\"></g-img></div><div class=\"Q8j1wd\"></div><span class=\"S5XGBe\" aria-hidden=\"true\"></span></a></div></div><div class=\"nfUtB PZPZlf hb8SAc\" data-attrid=\"description\" data-hveid=\"CAAQxwI\" data-ved=\"2ahUKEwjd6ZrP-rmCAxVmRmcHHXtcDX4QziAoAXoFCAAQxwI\"><div jscontroller=\"GCSbhd\" jsaction=\"SKAaMe:c0XUbe;rcuQ6b:npT2md\"><div jscontroller=\"GCSbhd\" class=\"kno-rdesc\" jsaction=\"seM7Qe:c0XUbe;Iigoee:c0XUbe;rcuQ6b:npT2md\"></div></div></div></div></div></div><p>The\r\n Toyota Camry is an automobile sold internationally by the Japanese auto\r\n manufacturer Toyota since 1982, spanning multiple generations. \r\nOriginally compact in size, the Camry has grown since the 1990s to fit \r\nthe mid-size classification —although the two widths co-existed in that \r\ndecade</p><p><em>Camry</em> comes from the Japanese word \'kanmuri\', meaning \r\n\'crown\'. It\'s an apt name for the car, which as the best-selling car in \r\nAmerica for 12 years straight,</p><p>In 2002 and 2003, Toyota introduced the <em>Camry</em> and Corolla respectively. In 2005, TKM launched the Innova to replace the Qualis, which is based on a modern IMV</p><p><em>Camry</em>. A sleek yet strong design, alloy wheels, stunning exterior colours and sophisticated interior sum up the <em>Camry</em> in one word: Elegant. It boasts a<br></p>', 1, '1699687868109580256.png', '[\"16996878681515979926.png\",\"16996878682121976417.png\",\"1699687868588290928.png\"]', 2, 1, 1, 1, 1, NULL, NULL, 1, '11-11-2023', 'November', '2023-11-11 15:31:08', '2023-11-14 09:46:21'),
(8, 2, 3, 4, 1, 1, 'Corolla', 'corolla', 'Corolla2', 'white, black, dark, gray', 'large,medium,small', 'amr, shonar, bangla', 'car, supper fast, nice, speed master', 'lIkS0C2jRUI', '63542', '65542', '64542', '40', 4, '<div class=\"I506P IFnjPb\"><a href=\"https://www.google.com/search?client=firefox-b-d&amp;sca_esv=581269367&amp;cs=0&amp;sxsrf=AM9HkKmj9VxLKAW7GjfsnwL-f_Sv9MBw1Q:1699637373700&amp;q=toyota+corolla&amp;stick=H4sIAAAAAAAAAE2SvY7TQBSFCYxJ1rsBMbAgGrB4gXj8H4mCVQRaJECr3YAIjeXEjuN4xmPPjMM6L7I9oqGjoqCi4wWoeASLHikVDraclPPNuXPPuXd66ElH_XBf0IIKTyHUD7CSeCRQcMTFpnM0ri-2iG-u99znb8YvxxP3K-iU4J58MCADVbdRymB3RBnF2CsBbHFmQmnkEVaU4LiGUzI3Vdh7QZnIk4C1YlRwsobSGYtyXoK7sryFmskyUdGJx6KKHtZS41JNnRI8qE8WK6YmlE-jcIG9xN97UnNmfgylizxllak7TbFI4jUE597KaIWOlkxdKJ1GJ7OgDWUwM41h1zjPk_8-lcZS6iTDFYSvql7KiOURD5hyxjyftv5QtkB6CW7L_UE4QGiuOqFR2GJHpk7hDDHi2wyHW6KhFNlzG_beBRjPIxbstHzBdUcX_h6xhnFhiWyvA86Qb2SkBI8asox9zdXXLuw3S6msUs7bxHbIV1a1GkY_JrvEaZyasHsRZDmNqon1G3NaqBNSGThqJmDpZLn8JN1qvsys7vD75sNrP35Fn-Onmy-T73-unp28fc3_fvt54_3jyT-aKlkeZAIAAA&amp;sa=X&amp;ved=2ahUKEwjd6ZrP-rmCAxVmRmcHHXtcDX4Q7fAIegUIABCvAg\">Corolla</a></div><div class=\"YbOmnd s0Odib\"><div class=\"mLpoJb\"><div class=\"Ze3gdf\"><div class=\"duOqab\" jsmodel=\"Wn3aEc\" jscontroller=\"LdB9sd\" jsshadow=\"\" jsaction=\"PdWSXe:h5M12e;rcuQ6b:npT2md;\" jsdata=\"X2sNs;_;BUkqwg\" data-hveid=\"CAAQsgI\"><div jsslot=\"\"><a class=\"ivg-i\" role=\"button\" tabindex=\"0\" jsaction=\"trigger.PdWSXe\" data-ved=\"2ahUKEwjd6ZrP-rmCAxVmRmcHHXtcDX4Qt-oFegUIABCzAg\"><div class=\"thumb\" style=\"overflow:hidden;width:92px;height:92px;border-radius:0\"><g-img><img id=\"dimg_fWhOZZ23JeaMnesP-7i18Ac_61\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQa5aL1BRzQP7pp3DsQrnNKXlnd-GuJdtMW_vx24Ve_1T109EysyuVrWFo&amp;s=0\" class=\"YQ4gaf zr758c wA1Bge\" height=\"92\" style=\"margin-left:-24px\" width=\"140\" alt=\"image of Corolla\" data-ilt=\"1699687649150\"></g-img></div><div class=\"Q8j1wd\"></div><span class=\"S5XGBe\" aria-hidden=\"true\"></span></a></div></div><div class=\"nfUtB PZPZlf hb8SAc\" data-attrid=\"description\" data-hveid=\"CAAQtAI\" data-ved=\"2ahUKEwjd6ZrP-rmCAxVmRmcHHXtcDX4QziAoAXoFCAAQtAI\"><div jscontroller=\"GCSbhd\" jsaction=\"SKAaMe:c0XUbe;rcuQ6b:npT2md\"><div jscontroller=\"GCSbhd\" class=\"kno-rdesc\" jsaction=\"seM7Qe:c0XUbe;Iigoee:c0XUbe;rcuQ6b:npT2md\"></div></div></div></div></div></div><p>The\r\n Toyota Corolla is a series of compact cars manufactured and marketed \r\nglobally by the Japanese automaker Toyota Motor Corporation. Introduced \r\nin 1966, the Corolla was the best-selling car worldwide by 1974 and has \r\nbeen one of the best-selling cars in the world since then</p><p>Whether it\'s the refined Camry, the respected <em>Corolla</em>, or the versatile Sienna, our dependable line-up is also remarkably diverse. Take a look at the exciting</p><p>The Toyota <em>Corolla</em> is the largest selling car in the world with over 40 million units sold across the years and generations. In India, the <em>Corolla</em> was launched</p><p>The <em>Corolla</em> is the best example in this sense, soon \r\nbecoming America\'s favorite compact car. But as far as the luxury market\r\n went, Toyota still had trouble with<br></p>', 1, '16996881561374990716.png', '[\"1699688156321736814.png\",\"16996881561250759060.png\",\"1699688156835073053.png\"]', 1, 1, 1, 1, 1, NULL, NULL, 1, '11-11-2023', 'November', '2023-11-11 15:35:56', '2023-11-11 15:35:56'),
(9, 2, 3, 5, 1, 1, 'Prius', 'prius', 'Prius3', 'white, blue, yellow, skyblue', 'large,medium,small', 'amr, shonar, bangla', 'car, supper fast, nice, speed master', '85qJ6j3ONUk', '345633', '385633', '375633', '35', 4, '<div class=\"I506P IFnjPb\"><a href=\"https://www.google.com/search?client=firefox-b-d&amp;sca_esv=581269367&amp;cs=0&amp;sxsrf=AM9HkKmj9VxLKAW7GjfsnwL-f_Sv9MBw1Q:1699637373700&amp;q=toyota+prius&amp;stick=H4sIAAAAAAAAAE2SzY7TMBSFKTi0ZFqhMX9iAxEv0Dr_lVgwqkCDBGg0UxBlE6WTNHVjx4ntFNIXYY_YsGPFghU7XoAVjxCxR-qKhEZpl_58ru8597qHHnWMd3clK5j0NcqCkGiJT0ONYCG3nf50d1Ejsb3a856-mj6fzryvoFOC2-qNIR2ODAelHHYnjDNC_BLAFmcWVCY-5UUJ7uzgnC6sEew9Y1zmSchbMSoE3UDljONclOCWqtZQt3gmKzrzOa7o0U5qfhilbgnu7U42L-YWVE9xtCR-Ehw8qbuXQQyVizzllanjplgm8QaCc39ttkJXT-YeVE7xyWXYhjK5lcawa57nyX-fWmMpdZPxGsIXVS9twnMsQq6dcT9grT-ULZFRgpvqYBgNEVqM3MgsHLknc7dwxwSJOsNRTXSUImfhwN6bkJAF5uFeK5bCcA0ZHBB7HBe2zA46kAwFZkZL8KAhqzjQPWPjwUGzlMoqE6JN7ERibVer4ex9sk-cxqkFuxdhljNcTWzQmNMjg9LKQL-ZgG3Q1eqT0m--TFqv7Pf1-1d-_MKf48fbL7Pvfz4-OXn9Uvz99vPa24ezfygUQ1NiAgAA&amp;sa=X&amp;ved=2ahUKEwjd6ZrP-rmCAxVmRmcHHXtcDX4Q7fAIegUIABDoAg\">Prius</a></div><div class=\"YbOmnd s0Odib\"><div class=\"mLpoJb\"><div class=\"Ze3gdf\"><div class=\"duOqab\" jsmodel=\"Wn3aEc\" jscontroller=\"LdB9sd\" jsshadow=\"\" jsaction=\"PdWSXe:h5M12e;rcuQ6b:npT2md;\" jsdata=\"X2sNs;_;BUkqws\" data-hveid=\"CAAQ6wI\"><div jsslot=\"\"><a class=\"ivg-i\" role=\"button\" tabindex=\"0\" jsaction=\"trigger.PdWSXe\" data-ved=\"2ahUKEwjd6ZrP-rmCAxVmRmcHHXtcDX4Qt-oFegUIABDsAg\"><div class=\"thumb\" style=\"overflow:hidden;width:92px;height:92px;border-radius:0\"><g-img><img id=\"dimg_fWhOZZ23JeaMnesP-7i18Ac_67\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUNEWDV8pCe73uqpsEux3td1pJiUr5bl2QuXKEJlrefYax3HVwnqwZDEs&amp;s=0\" class=\"YQ4gaf zr758c wA1Bge\" height=\"92\" style=\"margin-left:-24px\" width=\"140\" alt=\"image of Prius\" data-ilt=\"1699687649151\"></g-img></div><div class=\"Q8j1wd\"></div><span class=\"S5XGBe\" aria-hidden=\"true\"></span></a></div></div><div class=\"nfUtB PZPZlf hb8SAc\" data-attrid=\"description\" data-hveid=\"CAAQ7QI\" data-ved=\"2ahUKEwjd6ZrP-rmCAxVmRmcHHXtcDX4QziAoAXoFCAAQ7QI\"><div jscontroller=\"GCSbhd\" jsaction=\"SKAaMe:c0XUbe;rcuQ6b:npT2md\"><div jscontroller=\"GCSbhd\" class=\"kno-rdesc\" jsaction=\"seM7Qe:c0XUbe;Iigoee:c0XUbe;rcuQ6b:npT2md\"></div></div></div></div></div></div><p>The\r\n Toyota Prius is a compact/small family liftback produced by Toyota. The\r\n Prius has a hybrid drivetrain, combined with an internal combustion \r\nengine and an electric motor. Initially offered as a four-door sedan, it\r\n has been produced only as a five-door liftback since 2003</p><p>The Toyota <em>Prius</em> is a full hybrid electric mid-size \r\nhatchback, formerly a compact sedan developed and manufactured by \r\nToyota. The EPA and California Air</p><p>The <em>Prius</em> plug-in hybrid combines all the attributes of \r\nthe new, full hybrid, TNGA (Toyota New Global Architecture)-platformed, \r\nfourth generation <em>Prius</em> with a</p><p><em>Prius</em> is Latin for \'prior\' or \'previous\'. Its name can be interpreted as a reference to the fact that at the <em>Prius</em>\' Japan launch in 1997, there had never<br></p>', 1, '16996884411123761449.png', '[\"16996884411304342884.png\",\"16996884411153467212.png\",\"16996884411437709696.png\"]', 1, 1, 1, 1, 1, NULL, NULL, 1, '11-11-2023', 'November', '2023-11-11 15:40:41', '2023-11-11 15:40:41'),
(10, 2, 3, 6, 1, 1, 'Yaris', 'yaris', 'Yaris4', 'white, red, green, dark', 'large,medium,small', 'amr, shonar, bangla', 'car, supper fast, nice, speed master', 'hyI9Brw_zwE', '654644', '754644', '750044', '55', 4, '<p>The Toyota <em>Yaris</em> is a subcompact car sold by Toyota since 1999, replacing the Starlet and Tercel. Toyota has used the \"<em>Yaris</em>\" name on export versions of various<em>Yaris</em>. <em>Yaris</em> stems from a goddess in Greek mythology, named Charis, who was a symbol of beauty and elegance.</p><p>The Toyota <em>Yaris</em> has officially been launched in India and will take on the ... The <em>Yaris</em> also comes well equipped with safety features like 7 airbags, ABSThe Toyota <em>Yaris</em> has officially been launched in India and will take on the ... The <em>Yaris</em> also comes well equipped with safety features like 7 airbags, ABS</p><p>The Toyota <em>Yaris</em> has officially been launched in India and will take on the ... The <em>Yaris</em> also comes well equipped with safety features like 7 airbags, ABS<br></p>', 1, '16996887521226643946.png', '[\"16996887521875957424.png\",\"16996887521797358895.png\",\"16996887521169183104.png\"]', 2, 1, 1, 1, 1, NULL, NULL, 1, '11-11-2023', 'November', '2023-11-11 15:45:52', '2023-11-14 09:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `reply_date` varchar(111) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `user_id`, `ticket_id`, `message`, `image`, `reply_date`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Thanks for your feed back', '1700335245422343589.jpg', NULL, '2023-11-19 03:20:45', '2023-11-19 03:20:45'),
(2, 0, 1, 'Thank you dear Customer', '1700335365439060576.jpg', '2023-11-18', '2023-11-19 03:22:45', '2023-11-19 03:22:45'),
(3, 2, 1, 'You are Most Welcome', NULL, '2023-11-18', '2023-11-19 03:33:02', '2023-11-19 03:33:02');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `review_date` varchar(255) DEFAULT NULL,
  `review_month` varchar(255) DEFAULT NULL,
  `review_year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_author` varchar(255) DEFAULT NULL,
  `meta_tag` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `google_verification` varchar(255) DEFAULT NULL,
  `google_analytics` varchar(255) DEFAULT NULL,
  `alexa_verification` varchar(255) DEFAULT NULL,
  `google_adsense` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_name` varchar(255) DEFAULT NULL,
  `shipping_phone` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_country` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_zipcode` varchar(255) DEFAULT NULL,
  `shipping_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `user_id`, `shipping_name`, `shipping_phone`, `shipping_address`, `shipping_country`, `shipping_city`, `shipping_zipcode`, `shipping_email`, `created_at`, `updated_at`) VALUES
(1, 2, 'Nahid Hasan', '01581008881', 'Hazradighi, Noongola', 'Bangladesh', 'Bogura', '5801', 'nhd3456555@gmail.com', NULL, '2023-11-10 13:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `smtps`
--

CREATE TABLE `smtps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mailer` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `subcategory_name`, `subcategory_slug`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Lamborghini', 'lambo-rghini', 2, '2023-11-10 13:34:50', '2023-11-10 13:34:50'),
(2, 'Tesla', 't-esla', 2, '2023-11-10 13:35:26', '2023-11-10 13:35:26'),
(3, 'Toyota', 'to-yota', 2, '2023-11-10 13:35:44', '2023-11-10 13:35:44'),
(4, 'BMW', 'b-mw', 2, '2023-11-10 13:36:20', '2023-11-10 13:36:20'),
(5, 'iPhone', 'i-phn', 3, '2023-11-10 13:36:49', '2023-11-10 13:36:49'),
(6, 'iPad', 'i-pad', 3, '2023-11-10 13:37:19', '2023-11-10 13:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `subject`, `service`, `priority`, `message`, `image`, `status`, `date`, `created_at`, `updated_at`) VALUES
(1, 2, 'Tesla Business', 'payment', 'medium', 'How To Pay for tesla ?', '1700003047245119613.png', 0, '2023-11-14', '2023-11-15 07:04:07', '2023-11-15 07:04:07'),
(2, 0, NULL, NULL, NULL, 'Thanks for your feed back', '17003326601710410359.jpg', NULL, NULL, '2023-11-19 02:37:40', '2023-11-19 02:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Developer Nahid', 'Admin@gmail.com', NULL, '$2y$10$Jhft/gsuz6aYLJvZING3/u..zyOHlqx3WaK1GAmxBw8k30F3mHehi', '01581008881', 1, NULL, '2023-11-10 13:05:52', '2023-11-10 13:07:43'),
(2, 'NAHID HASAN', 'customer@gmail.com', NULL, '$2y$10$QEoVYWJlDs.IesF70E/.P.W7kG1RZcelzd9mXBbgzqR3qSiydRT56', '01305193123', 2, NULL, '2023-11-10 13:11:11', '2023-11-10 13:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_name` varchar(255) NOT NULL,
  `warehouse_address` varchar(255) NOT NULL,
  `warehouse_phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `warehouse_name`, `warehouse_address`, `warehouse_phone`, `created_at`, `updated_at`) VALUES
(1, 'Lambor Store', 'Bogura', '01581008881', '2023-11-10 13:57:49', '2023-11-10 13:57:49'),
(2, 'Tesla Store', 'Dhaka', '01581008881', '2023-11-10 13:58:02', '2023-11-10 13:58:02'),
(3, 'BMW Store', 'Rangpur', '01581008881', '2023-11-10 13:58:20', '2023-11-10 13:58:20'),
(4, 'Toyota Store', 'Rajshahi', '01581008881', '2023-11-10 13:58:34', '2023-11-10 13:58:34'),
(5, 'Apple Store', 'Bogura', '01581008881', '2023-11-10 13:58:53', '2023-11-10 13:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `web_settings`
--

CREATE TABLE `web_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `phone_one` varchar(255) DEFAULT NULL,
  `phone_two` varchar(255) DEFAULT NULL,
  `main_email` varchar(255) DEFAULT NULL,
  `support_mail` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_settings`
--

INSERT INTO `web_settings` (`id`, `currency`, `phone_one`, `phone_two`, `main_email`, `support_mail`, `logo`, `favicon`, `address`, `facebook`, `twitter`, `linkedin`, `youtube`, `created_at`, `updated_at`) VALUES
(1, '$', '01581-008881', '01305-193123', 'nhd3456555@gmail.com', 'nahid@gmail.com', 'assadad.jpg', 'aaaas.jpg', 'Bogura, Bangladesh', 'https://www.facebook.com/profile.php?id=100036523093263', 'https://twitter.com/NahidHa31164683', 'https://www.linkedin.com/in/nahid-hosen-688057294/', 'https://www.youtube.com/@oboshorbekti', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `date`, `created_at`, `updated_at`) VALUES
(2, 1, 6, '11, 11 23', '2023-11-11 15:47:02', '2023-11-11 15:47:02'),
(3, 2, 10, '12, 11 23', '2023-11-13 06:56:27', '2023-11-13 06:56:27'),
(6, 1, 3, '13, 11 23', '2023-11-14 06:15:10', '2023-11-14 06:15:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajax_forms`
--
ALTER TABLE `ajax_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaings`
--
ALTER TABLE `campaings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `childcategories`
--
ALTER TABLE `childcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `childcategories_category_id_foreign` (`category_id`),
  ADD KEY `childcategories_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pickup_points`
--
ALTER TABLE `pickup_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_user_id_foreign` (`user_id`);

--
-- Indexes for table `smtps`
--
ALTER TABLE `smtps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_settings`
--
ALTER TABLE `web_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ajax_forms`
--
ALTER TABLE `ajax_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `campaings`
--
ALTER TABLE `campaings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `childcategories`
--
ALTER TABLE `childcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickup_points`
--
ALTER TABLE `pickup_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtps`
--
ALTER TABLE `smtps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `web_settings`
--
ALTER TABLE `web_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `childcategories`
--
ALTER TABLE `childcategories`
  ADD CONSTRAINT `childcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `childcategories_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD CONSTRAINT `customer_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
