-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2019 at 06:45 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `home-service`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(10) UNSIGNED NOT NULL,
  `city_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `created_at`, `updated_at`) VALUES
(1, 'Sylhet', NULL, '2019-01-24 11:11:35'),
(2, 'Dhaka', NULL, NULL),
(3, 'Khulna', NULL, NULL),
(4, 'Rajshahi', '2019-01-24 10:33:59', '2019-01-24 10:33:59'),
(5, 'Barisal', '2019-01-24 10:34:07', '2019-01-24 10:34:07'),
(6, 'Chattogram', '2019-01-24 10:34:15', '2019-01-24 10:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `fname`, `lname`, `email`, `phone_number`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Juman', 'Ahmed', 'md050@gmail.com', '1764287785', 'This is a test messge.', 1, NULL, NULL),
(3, 'Nazrul', 'Ahmed', 'nazrulahmed204@gmail.com', '0183273434', 'hello', 1, '2019-03-14 08:44:03', '2019-03-14 08:44:03'),
(4, 'Atik', 'Rahman', 'atik@gmail.com', '0173438934', 'testing', 0, '2019-03-17 04:01:24', '2019-03-17 04:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_07_102201_create_services_table', 2),
(4, '2019_01_07_102522_create_service_subs_table', 2),
(5, '2019_01_07_104015_create_sub_services_table', 2),
(6, '2019_01_07_104236_create_cities_table', 3),
(8, '2019_01_13_104519_create_orders_table', 4),
(9, '2019_01_13_112525_create_settings_table', 5),
(10, '2019_02_05_055751_create_contacts_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_total` double(10,2) NOT NULL,
  `customer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_area` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone_number` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_total`, `customer_name`, `customer_city`, `customer_area`, `customer_address`, `customer_phone_number`, `customer_email`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 450.00, 'Rasel Ahmed', 'Dhaka', 'Banani', 'House 122, Road 1, Block F, Banani, Dhaka -1213, Bangladesh', '01846345645', 'raselrr@gmail.com', 0, '2019-03-10 03:54:39', '2019-03-10 03:54:39'),
(2, 210.00, 'Elias Ahmed', 'Dhaka', 'Nikanjia-2', 'Nikanjia-2 Dhaka', '0176234345', 'eliasahm@gmail.com', 1, '2019-03-15 03:56:09', '2019-03-17 03:56:09'),
(3, 210.00, 'Atik Ahmed', 'Sylhet', 'Zindabazar', 'zindabazar, sylhet', '01763493345', 'atik@gmail.com', 1, '2019-03-17 03:58:16', '2019-03-17 03:58:16'),
(4, 300.00, 'demo', 'Dhaka', 'demo', 'demon, address', '1764283785', 'md050@gmail.com', 0, '2019-03-19 23:22:15', '2019-03-19 23:22:15'),
(5, 310.00, 'demo', 'Dhaka', 'demo', 'demon, address', '1764283785', 'md050@gmail.com', 1, '2019-03-19 23:22:42', '2019-03-19 23:22:42'),
(6, 735.00, 'sadsad', 'Sylhet', 'adas', 'sdasd', '01764287785', 'md050@gmail.com', 0, '2019-03-21 02:21:11', '2019-03-21 02:21:11'),
(7, 525.00, 'Juman Ahmed', 'Sylhet', 'saasf', 'sdfdssdf', '4545454554454', 'md050@gmail.com', 1, '2019-03-21 02:23:51', '2019-03-21 02:23:51'),
(8, 525.00, 'dsfdsf', 'Sylhet', 'sadasdsa', 'sadsad', '17642827785', 'md050@gmail.com', 1, '2019-03-21 03:04:36', '2019-03-21 03:04:36'),
(9, 525.00, 'new email', 'Dhaka', 'sadsad', 'sadsada', '17642877853', 'md050@gmail.com', 0, '2019-03-21 03:05:42', '2019-03-21 03:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_services`
--

CREATE TABLE `order_services` (
  `order_service_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_services`
--

INSERT INTO `order_services` (`order_service_id`, `service_id`, `order_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 4, 3),
(4, 6, 4),
(5, 6, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `order_sub_services`
--

CREATE TABLE `order_sub_services` (
  `order_sub_service_id` int(11) NOT NULL,
  `sub_service_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_sub_services`
--

INSERT INTO `order_sub_services` (`order_sub_service_id`, `sub_service_id`, `order_id`) VALUES
(1, 2, 1),
(2, 4, 1),
(3, 5, 1),
(4, 17, 2),
(5, 18, 2),
(6, 2, 3),
(7, 21, 4),
(8, 22, 4),
(9, 21, 5),
(10, 22, 5),
(11, 2, 6),
(12, 3, 6),
(13, 4, 6),
(14, 3, 7),
(15, 4, 7),
(16, 3, 8),
(17, 4, 8),
(18, 3, 9),
(19, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$8LMzTAnSEe7Wy1sWXhHmDuP.XBxaAoVKlY31gvf5N0Mb3GkI0g1pe', '2019-03-14 07:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `request_calls`
--

CREATE TABLE `request_calls` (
  `id` int(11) NOT NULL,
  `req_name` varchar(100) NOT NULL,
  `req_number` varchar(15) NOT NULL,
  `req_status` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_calls`
--

INSERT INTO `request_calls` (`id`, `req_name`, `req_number`, `req_status`, `created_at`) VALUES
(2, 'adasd', '324335345345', 0, '2019-03-20 05:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `request_services`
--

CREATE TABLE `request_services` (
  `req_service_id` int(11) NOT NULL,
  `req_user_name` varchar(100) NOT NULL,
  `req_user_phone` varchar(15) NOT NULL,
  `req_service_name` varchar(100) NOT NULL,
  `req_service_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_services`
--

INSERT INTO `request_services` (`req_service_id`, `req_user_name`, `req_user_phone`, `req_service_name`, `req_service_description`, `created_at`) VALUES
(1, 'test user', '02234344454', 'test name', 'demo', '2019-03-20 05:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(10) UNSIGNED NOT NULL,
  `service_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_short_desc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_long_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_slug`, `service_icon`, `service_short_desc`, `service_long_desc`, `service_img`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'Home Appliances', 'home-appliances', 'fa fa-home', 'What to service? Be it AC Servicing & Repairing, AC Shifting, Replacement, Installation, and AC GAS Charge, or Fridge Servicing, Oven Repairing, Geyser Installation & Repairing, Washing Machine Servicing, TV Repairing, Wall TV Installation- HandyMama does it all with 100% guaranteed satisfaction. Book in a minute!', 'What to service? Be it AC Servicing & Repairing, AC Shifting, Replacement, Installation, and AC GAS Charge, or Fridge Servicing, Oven Repairing, Geyser Installation & Repairing, Washing Machine Servicing, TV Repairing, Wall TV Installation- HandyMama does it all with 100% guaranteed satisfaction. Book in a minute!', '1547220319.png', 0, NULL, '2019-01-11 09:25:19'),
(2, 'Painting', 'painting', 'fa fa-paint-brush', 'Get your home or office painted by the best painting professionals. HandyMama offers you a wide range of services including- Wall plaster work, Power washing, Drywall repair, Waterproofing, Wall Painting, Custom Design Color, Floor coating, Weather coat, Distemper and more.', 'Get your home or office painted by the best painting professionals. HandyMama offers you a wide range of services including- Wall plaster work, Power washing, Drywall repair, Waterproofing, Wall Painting, Custom Design Color, Floor coating, Weather coat, Distemper and more.', '1547221389.png', 0, '2019-01-08 00:50:10', '2019-01-11 09:58:18'),
(3, 'Computer Servicing', 'computer-servicing', 'fa fa-desktop', 'HandyMama makes your computing life easy and hassle free. Now can get your Desktop, Laptop, Notebook, Printer, Photocopier serviced by the best computer hardware engineers. You can also easily get your IPS/ UPS and Projector Repaired by HandyMama''s professional engineers. The biggest surprise is- we pick your cracked device from your home and deliver the serviced one safely at your hand for FREE.', 'HandyMama makes your computing life easy and hassle free. Now can get your Desktop, Laptop, Notebook, Printer, Photocopier serviced by the best computer hardware engineers. You can also easily get your IPS/ UPS and Projector Repaired by HandyMama''s professional engineers. The biggest surprise is- we pick your cracked device from your home and deliver the serviced one safely at your hand for FREE.', '1547220562.jpg', 0, '2019-01-08 00:59:25', '2019-01-11 09:29:22'),
(4, 'Laundry', 'laundry', 'fa fa-support', 'Looking for the best and easy dry wash services in Dhaka? HandyMama is here to take all your dry wash hassles with FREE Doorstep Pickup & Delivery within 12-48 hours! Get the state-of-the-art dry wash and laundry  Services according to your need. We have multiple packages to choose from. No matter how many pieces of clothes you have, it takes only ONE MINUTE to get all cleaned!', 'Looking for the best and easy dry wash services in Dhaka? HandyMama is here to take all your dry wash hassles with FREE Doorstep Pickup & Delivery within 12-48 hours! Get the state-of-the-art dry wash and laundry  Services according to your need. We have multiple packages to choose from. No matter how many pieces of clothes you have, it takes only ONE MINUTE to get all cleaned!', '', 0, '2019-01-08 01:01:34', '2019-03-20 09:58:44'),
(5, 'Transport', 'transport', 'fa fa-truck', 'If you ask who are the best pest control services providers in Dhaka? The answer is- HandyMama. We have best and most experienced pest control services professionals who are only specialized in their job. Our professionals use latest technologies, imported chemicals and safest strategies for longer lasting result.', 'If you ask who are the best pest control services providers in Dhaka? The answer is- HandyMama. We have best and most experienced pest control services professionals who are only specialized in their job. Our professionals use latest technologies, imported chemicals and safest strategies for longer lasting result.', '1547221954.png', 0, '2019-01-08 01:10:20', '2019-01-11 09:52:34'),
(6, 'Carpentry', 'carpentry', 'fa fa-cog', 'HandyMama has the town''s best professional carpenters who have done hundreds of professional projects. Hire our best wood professionals for any kinds of furniture repairing, varnishing and making works at very affordable rates.', 'HandyMama has the town''s best professional carpenters who have done hundreds of professional projects. Hire our best wood professionals for any kinds of furniture repairing, varnishing and making works at very affordable rates.', '1547222156.png', 0, '2019-01-08 05:10:57', '2019-01-11 09:55:56'),
(7, 'Pack & Shift', 'pack-and-shift', 'fa fa-ship', 'Whatever you want to pack, move or shift, HandyMama offers you the one-stop solution. We have the complete arrangement for you including but limited to- Electrical, Pluming, AC Shifting and All Other Essential Services! We know what you need while you shift, we have all in place. What all you do is just book, we do the rest and you relax!', 'Whatever you want to pack, move or shift, HandyMama offers you the one-stop solution. We have the complete arrangement for you including but limited to- Electrical, Pluming, AC Shifting and All Other Essential Services! We know what you need while you shift, we have all in place. What all you do is just book, we do the rest and you relax!', '1547217988.png', 0, '2019-01-10 07:56:39', '2019-01-11 09:34:11'),
(13, 'Electrical', 'electrical', 'fa fa-bolt', 'Household Wiring to Light & Fan Installation, Fan Servicing to Water Motor Servicing, Generator Installation, Generator Repairing, UPS Repairing, IPS Servicing--Get any kinds of electrical works done by the best professions at very affordable costs.', 'Household Wiring to Light & Fan Installation, Fan Servicing to Water Motor Servicing, Generator Installation, Generator Repairing, UPS Repairing, IPS Servicing--Get any kinds of electrical works done by the best professions at very affordable costs.', '1547129754.png', 0, '2019-01-10 08:15:54', '2019-03-17 01:21:42');

-- --------------------------------------------------------

--
-- Table structure for table `service_subs`
--

CREATE TABLE `service_subs` (
  `service_sub_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `sub_service_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_subs`
--

INSERT INTO `service_subs` (`service_sub_id`, `service_id`, `sub_service_id`, `created_at`, `updated_at`) VALUES
(4, 1, 2, NULL, NULL),
(5, 7, 2, NULL, NULL),
(7, 1, 3, NULL, NULL),
(8, 1, 4, NULL, NULL),
(9, 1, 5, NULL, NULL),
(10, 1, 7, NULL, NULL),
(11, 3, 13, NULL, NULL),
(12, 3, 14, NULL, NULL),
(13, 3, 15, NULL, NULL),
(14, 3, 16, NULL, NULL),
(15, 4, 2, NULL, NULL),
(16, 5, 2, NULL, NULL),
(17, 6, 20, NULL, NULL),
(18, 6, 21, NULL, NULL),
(19, 6, 22, NULL, NULL),
(20, 6, 23, NULL, NULL),
(21, 7, 10, NULL, NULL),
(22, 7, 11, NULL, NULL),
(23, 7, 12, NULL, NULL),
(24, 13, 1, NULL, NULL),
(25, 13, 3, NULL, NULL),
(26, 13, 4, NULL, NULL),
(27, 13, 5, NULL, NULL),
(28, 13, 6, NULL, NULL),
(29, 2, 17, NULL, NULL),
(30, 2, 18, NULL, NULL),
(31, 2, 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `hour_of_operation` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_number` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_us` text COLLATE utf8mb4_unicode_ci,
  `fb_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tw_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ln_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insta_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_long` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintanance_mode` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `address`, `hour_of_operation`, `email`, `whatsapp_number`, `phone_number`, `about_us`, `fb_link`, `tw_link`, `ln_link`, `insta_link`, `map_lat`, `map_long`, `footer_text`, `maintanance_mode`, `created_at`, `updated_at`) VALUES
(1, NULL, 'sylhet', NULL, 'md050@gmail.com', '01764287785', '01764287785', 'Ghorersheba is your one-call solution for a wide range of home maintenance and repair needs. Our uniformed technicians are fully insured professionals. We arrive on time in uniform and a marked van with the tools to complete the job right.', 'https://facebook.com/juman050', 'https://twitter.com/juman050', 'https://linkedin.com/in/juman050', 'http://instagram.com/juman050', NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_services`
--

CREATE TABLE `sub_services` (
  `sub_service_id` int(10) UNSIGNED NOT NULL,
  `sub_service_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_service_price` float(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_services`
--

INSERT INTO `sub_services` (`sub_service_id`, `sub_service_name`, `sub_service_price`, `created_at`, `updated_at`) VALUES
(1, 'General AC Servicing', 410.00, '2019-01-08 05:01:01', '2019-03-16 14:11:47'),
(2, 'lorem imsum', 210.00, '2019-01-10 07:47:10', '2019-03-16 14:06:11'),
(3, 'Household Wiring', 405.00, '2019-01-11 09:09:41', '2019-03-16 14:06:49'),
(4, 'Light Installation', 120.00, '2019-01-11 09:09:51', '2019-03-16 14:03:28'),
(5, 'Fan Installation', 120.00, '2019-01-11 09:10:00', '2019-03-16 14:03:57'),
(6, 'IPS Servicing', 200.00, '2019-01-11 09:10:08', '2019-03-16 14:03:50'),
(7, 'AC Shifting & Replacement', 10.00, '2019-01-11 09:11:20', '2019-01-11 09:11:20'),
(8, 'Oven Repairing', 230.00, '2019-01-11 09:11:31', '2019-03-16 14:06:17'),
(9, 'Washing Machine Servicing', 110.00, '2019-01-11 09:11:40', '2019-03-16 14:06:23'),
(10, 'Home Shifting', 150.00, '2019-01-11 09:12:28', '2019-03-16 14:06:32'),
(11, 'Office Shifting', 120.00, '2019-01-11 09:12:43', '2019-03-16 14:06:39'),
(12, 'Furniture Shifting', 222.00, '2019-01-11 09:12:55', '2019-03-16 14:03:43'),
(13, 'Desktop Servicing', 300.00, '2019-01-11 09:13:17', '2019-03-16 14:03:18'),
(14, 'Laptop Servicing', 200.00, '2019-01-11 09:13:24', '2019-03-16 14:03:08'),
(15, 'Notebook Servicing', 300.00, '2019-01-11 09:13:35', '2019-03-16 14:03:03'),
(16, 'Computer Networking', 200.00, '2019-01-11 09:13:42', '2019-03-16 14:02:57'),
(17, 'Wall Plaster Work', 99.00, '2019-01-11 09:18:33', '2019-03-16 14:02:51'),
(18, 'Power Washing', 111.00, '2019-01-11 09:18:40', '2019-03-16 14:02:46'),
(19, 'Wall Painting', 120.00, '2019-01-11 09:18:50', '2019-03-16 14:02:40'),
(20, 'Old Furniture Repairing', 100.00, '2019-01-11 09:32:55', '2019-03-16 14:02:36'),
(21, 'New Furniture Making', 200.00, '2019-01-11 09:33:02', '2019-03-16 14:02:27'),
(22, 'Workstation Making', 100.00, '2019-01-11 09:33:13', '2019-03-16 14:02:23'),
(23, 'Varnish Works', 120.00, '2019-01-11 09:33:24', '2019-03-16 14:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'mdjuman', 'md050@gmail.com', '$2y$10$nh9vrRdVTyXhCM5rAB9t/uLi/ljyxmNCbEEOuJiFPDFht5PL7K7ba', 'super_admin', NULL, '2019-03-21 02:44:18', '2019-03-21 02:44:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_services`
--
ALTER TABLE `order_services`
  ADD PRIMARY KEY (`order_service_id`);

--
-- Indexes for table `order_sub_services`
--
ALTER TABLE `order_sub_services`
  ADD PRIMARY KEY (`order_sub_service_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `request_calls`
--
ALTER TABLE `request_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_services`
--
ALTER TABLE `request_services`
  ADD PRIMARY KEY (`req_service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD UNIQUE KEY `services_service_slug_unique` (`service_slug`);

--
-- Indexes for table `service_subs`
--
ALTER TABLE `service_subs`
  ADD PRIMARY KEY (`service_sub_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_services`
--
ALTER TABLE `sub_services`
  ADD PRIMARY KEY (`sub_service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `order_services`
--
ALTER TABLE `order_services`
  MODIFY `order_service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `order_sub_services`
--
ALTER TABLE `order_sub_services`
  MODIFY `order_sub_service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `request_calls`
--
ALTER TABLE `request_calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `request_services`
--
ALTER TABLE `request_services`
  MODIFY `req_service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `service_subs`
--
ALTER TABLE `service_subs`
  MODIFY `service_sub_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sub_services`
--
ALTER TABLE `sub_services`
  MODIFY `sub_service_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
