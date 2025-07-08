-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2020 at 07:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dams`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `propic` varchar(255) NOT NULL,
  `type` text NOT NULL DEFAULT 'Admin',
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `email`, `phone`, `admin_id`, `username`, `password`, `propic`, `type`, `status`) VALUES
(3, 'alamin', 'akondho', 'alamin@gmail.com', '01521439114', 'admin@123', 'admin', '123456', '../gallery/propic/admin/preview.png', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `appointmnet_id` varchar(100) NOT NULL,
  `appointment_type` text NOT NULL,
  `request_from` varchar(100) NOT NULL,
  `request_to` varchar(100) NOT NULL,
  `requested_test` varchar(100) NOT NULL,
  `requested_date` varchar(30) NOT NULL,
  `test_name` text NOT NULL,
  `test_price` varchar(20) NOT NULL,
  `visit_price` text NOT NULL,
  `request_status` int(1) NOT NULL DEFAULT 0,
  `is_cancelled` int(1) NOT NULL DEFAULT 0,
  `is_done` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `craeted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointmnet_id`, `appointment_type`, `request_from`, `request_to`, `requested_test`, `requested_date`, `test_name`, `test_price`, `visit_price`, `request_status`, `is_cancelled`, `is_done`, `status`, `craeted_at`, `updated_at`) VALUES
(17, 'appointment@2020-01-16?02:50:56', '', 'client@2019-12-28?05:42:41', 'partner@2020-01-16?02:45:02', '1', '18-01-2020', '', '475', '', 0, 0, 0, 1, '2020-01-16 02:50:56', '2020-01-15 20:50:56'),
(19, 'appointment@2020-04-18?14:19:51', '', 'client@2020-04-07?12:05:24', 'partner@2020-04-07?11:59:37', '1', '19-04-2020', '', '475', '', 0, 0, 0, 1, '2020-04-18 14:19:51', '2020-04-18 08:19:51'),
(23, 'appointment@2020-04-23?20:39:23', 'doctor', 'client@2020-04-07?12:05:24', 'partner@2020-04-21?19:22:49', '', '07-04-2020', '', '', '1000', 0, 1, 0, 0, '2020-04-23 20:39:23', '2020-04-23 14:39:23'),
(24, 'appointment@2020-04-23?20:39:48', 'doctor', 'client@2020-04-07?12:05:24', 'partner@2020-04-21?19:22:49', '', '23-04-2020', '', '', '1000', 0, 1, 0, 0, '2020-04-23 20:39:48', '2020-04-23 14:39:48'),
(31, 'appointment@2020-05-09?17:41:33', '', 'client@2020-04-22?16:33:36', 'partner@2020-04-07?11:59:37', '1', '09-05-2020', '', '475', '', 0, 0, 0, 1, '2020-05-09 17:41:33', '2020-05-09 11:41:33'),
(32, 'appointment@2020-06-22?22:31:06', 'test', 'client@2020-04-22?16:33:36', 'partner@2020-04-07?11:59:37', '1', '23-06-2020', '', '475', '', 0, 0, 0, 1, '2020-06-22 22:31:06', '2020-06-22 16:31:06'),
(33, 'appointment@2020-06-22?22:57:47', 'test', 'client@2020-04-22?16:33:36', 'partner@2020-04-07?11:59:37', '1', '24-06-2020', 'Calcium blood test', '475', '', 0, 0, 0, 1, '2020-06-22 22:57:47', '2020-06-22 16:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `available_tests`
--

CREATE TABLE `available_tests` (
  `id` int(11) NOT NULL,
  `partner_id` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `category_name` text NOT NULL,
  `test_id` varchar(100) NOT NULL,
  `test_name` text NOT NULL,
  `test_price` varchar(100) NOT NULL,
  `test_discount` varchar(100) NOT NULL,
  `test_description` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `available_tests`
--

INSERT INTO `available_tests` (`id`, `partner_id`, `category_id`, `category_name`, `test_id`, `test_name`, `test_price`, `test_discount`, `test_description`, `status`, `created_at`, `update_at`) VALUES
(11, 'partner@2020-04-07?11:59:37', 'blood@test 1', 'bloodtest', '1', 'Calcium blood test', '500', '5', 'follow the rules', 1, '2020-01-16 02:50:00', '2020-06-22 16:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `partner_id` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `institute_name` text NOT NULL,
  `doctor_title` text NOT NULL,
  `partnership_zone` text NOT NULL,
  `institute_logo` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL,
  `region` text NOT NULL,
  `contact_no1` varchar(20) NOT NULL,
  `contact_no2` varchar(20) NOT NULL,
  `contact_no3` varchar(20) NOT NULL,
  `hotline_no` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `service_period` text NOT NULL,
  `off_days` text NOT NULL,
  `visit_price` int(11) NOT NULL,
  `status` tinytext NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `partner_id`, `branch_id`, `institute_name`, `doctor_title`, `partnership_zone`, `institute_logo`, `address`, `country`, `city`, `region`, `contact_no1`, `contact_no2`, `contact_no3`, `hotline_no`, `email`, `service_period`, `off_days`, `visit_price`, `status`, `created_at`, `updated_at`) VALUES
(5, 'partner@2020-04-13?15:25:35', '', 'Lazz Pharma', '', 'pharmacy', '../../gallery/propic/partners/logo.png', 'wdsadas sad sad asds aas das', 'Bangladesh', 'Dhaka', 'Mirpur 11', '+123456789', '01521xxxxxxxx', '01521xxxxxxxx', '+123456789', 'sadaakalo39@gmail.com', '24/8', 'Sunday', 0, '1', '2020-04-17 15:14:20', '2020-05-14 19:35:22'),
(16, 'partner@2020-04-13?15:25:35', '', 'Lazz Pharma', '', 'pharmacy', '../../gallery/propic/partners/logo.png', 'wdsadas sad sad asds aas das', 'Bangladesh', 'Dhaka', 'Mirpur 11', '+123456789', '01521xxxxxxxx', '01521xxxxxxxx', '+123456789', 'sadaakalo39@gmail.com', '24/8', 'Sunday', 0, '1', '2020-04-17 15:14:20', '2020-05-14 19:35:22'),
(17, 'partner@2020-04-21?19:22:49', 'branch@2020-04-23?20:32:27', 'Janata Diagnostics Center ', 'Dr. MD Alamin Akando', 'doctor', '../../gallery/propic/partners/logo.png', 'sadsadsa dsad sadsa dsadsadsadsad sad sa', 'Bangladesh', 'Dhaka', 'MIrpur 10', '01521xxxxxxxx', '01521xxxxxxxxxx', '01521xxxxxxxxxx', '+123456789', 'alamin291mohammad@gmail.com', '24/7', 'None', 2000, '1', '2020-04-24 00:32:27', '2020-05-09 19:08:45');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_id`, `description`, `status`, `created_at`) VALUES
(26, 'bloodtest', 'blood@test 1', 'there are various category in blood test', '1', '2020-01-15 20:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `client_id` varchar(100) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL,
  `address` text NOT NULL,
  `propic` varchar(255) NOT NULL,
  `username` text DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `joining_date` varchar(20) NOT NULL,
  `year` int(4) NOT NULL,
  `month` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `crated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) NOT NULL,
  `partner_id` varchar(100) NOT NULL,
  `institute_name` text NOT NULL,
  `drug_name` text NOT NULL,
  `drug_type` text NOT NULL,
  `drug_group` text NOT NULL,
  `producer` text NOT NULL,
  `unit_price` int(11) NOT NULL,
  `drug_quantity` text NOT NULL,
  `publication_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `partner_id`, `institute_name`, `drug_name`, `drug_type`, `drug_group`, `producer`, `unit_price`, `drug_quantity`, `publication_status`, `created_at`, `updated_at`) VALUES
(14, 'partner@2020-04-13?15:25:35', 'Lazz Pharma', 'Pyrenol', 'Tablet', 'Peracitamol', 'Square', 2, '250 mg', 1, '2020-04-19 22:15:10', '2020-04-19 16:15:10'),
(15, 'partner@2020-04-13?15:25:35', 'Lazz Pharma', 'Napa', 'Tablet', 'Peracitamol', 'Square', 2, '250 mg', 1, '2020-04-19 22:15:36', '2020-04-19 16:15:36'),
(16, 'partner@2020-04-13?15:25:35', 'Lazz Pharma', 'ACE+', 'Tablet', 'Peracitamol', 'Square', 2, '250 mg', 1, '2020-04-19 22:15:59', '2020-04-19 16:15:59'),
(17, 'partner@2020-04-13?15:25:35', 'Lazz Pharma', 'Tuska', 'Liquid', 'Xxxxx', 'Square', 100, '250 ml', 1, '2020-04-19 22:17:18', '2020-04-19 16:17:18'),
(18, 'partner@2020-04-13?15:25:35', 'Lazz Pharma', 'Napa Xtra', 'Tablet', 'Peracitamol', 'Square', 2, '250 mg', 1, '2020-04-19 22:17:47', '2020-04-19 16:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `drugs_ordered`
--

CREATE TABLE `drugs_ordered` (
  `id` int(11) NOT NULL,
  `client_id` varchar(100) NOT NULL,
  `partner_id` varchar(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `drug_name` text NOT NULL,
  `drug_quantity` text NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `delivery_type` text NOT NULL,
  `total_price` int(11) NOT NULL,
  `ordered_on` varchar(100) NOT NULL,
  `delivered_on` varchar(100) NOT NULL,
  `is_delivered` tinyint(1) NOT NULL,
  `is_received` tinyint(1) NOT NULL,
  `is_pending` tinyint(1) NOT NULL DEFAULT 1,
  `is_processing` tinyint(1) NOT NULL DEFAULT 0,
  `is_cancelled` tinyint(1) NOT NULL DEFAULT 0,
  `cancelled_by` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drugs_ordered`
--

INSERT INTO `drugs_ordered` (`id`, `client_id`, `partner_id`, `order_id`, `drug_id`, `drug_name`, `drug_quantity`, `order_quantity`, `delivery_type`, `total_price`, `ordered_on`, `delivered_on`, `is_delivered`, `is_received`, `is_pending`, `is_processing`, `is_cancelled`, `cancelled_by`, `created_at`, `updated_at`) VALUES
(3, 'client@2020-04-22?16:33:36', 'partner@2020-04-13?15:25:35', 'order@2020-04-21?23:17:34', 14, 'Pyrenol', '250 mg', 5, 'Home Delivery', 210, 'Tuesday ,April 21, 2020', '', 0, 0, 0, 1, 0, '', '2020-04-22 03:17:34', '2020-05-14 18:58:54'),
(4, 'client@2020-04-22?16:33:36', 'partner@2020-04-13?15:25:35', 'order@2020-04-21?23:18:00', 14, 'Pyrenol', '250 mg', 10, 'Home Delivery', 220, 'Tuesday ,April 21, 2020', '23-04-2020', 1, 1, 0, 0, 0, '', '2020-04-22 03:18:00', '2020-05-14 19:06:37'),
(5, 'client@2020-04-22?16:33:36', 'partner@2020-04-13?15:25:35', 'order@2020-05-08?00:05:05', 14, 'Pyrenol', '250 mg', 5, 'Home Delivery', 210, '08-05-2020', '', 0, 0, 0, 0, 1, 'client@2020-04-22?16:33:36', '2020-05-08 04:05:05', '2020-05-14 19:04:56');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `email_to` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cc` text NOT NULL,
  `bcc` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `sent_on` varchar(100) DEFAULT NULL,
  `is_sent` tinyint(1) NOT NULL DEFAULT 0,
  `is_drafted` tinyint(1) NOT NULL DEFAULT 0,
  `craeted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email_id`, `email_to`, `address`, `cc`, `bcc`, `subject`, `message`, `sent_on`, `is_sent`, `is_drafted`, `craeted_at`, `updated_at`) VALUES
(1, 'email@2020-05-07?05:45:46', 'partner@2020-04-07?11:59:37', 'tahasinislam39@gmail.com', '', '', 'This is a test mail', '<p>Hello,</p>\r\n\r\n<p>Tahasin Islam.</p>\r\n', 'Thursday ,May 7, 2020, 5:45 am', 1, 0, '2020-05-07 05:45:46', '2020-05-06 23:45:46'),
(2, 'email@2020-05-07?05:49:10', 'partner@2020-04-07?11:59:37', 'tahasinislam39@gmail.com', 'tahasinislam39@gmail.com', 'tahasinislam39@gmail.com', 'New member in the team!', 'Dear all,\r\n\r\nI am glad to introduce you to {name of person}, who will be assisting us as an intern for the next 6 months. He is a third-year Economics student at {name of institution}, and is excited about joining the team.\r\n\r\nI hope to see you all welcome him into the office and provide him with your help and feedback wherever necessary.\r\n\r\nFond regards,\r\n{Your name}', 'Thursday ,May 7, 2020, 5:49 am', 1, 0, '2020-05-07 05:49:10', '2020-05-07 00:20:44');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message_id` varchar(100) NOT NULL,
  `message_from` varchar(100) NOT NULL,
  `message_to` varchar(100) NOT NULL,
  `message_for` text NOT NULL,
  `message_owner` text NOT NULL,
  `message_body` text NOT NULL,
  `sent_on` varchar(100) NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message_id`, `message_from`, `message_to`, `message_for`, `message_owner`, `message_body`, `sent_on`, `is_seen`, `created_on`, `updated_on`) VALUES
(2, 'message@2020-05-07?15:45:48', 'admin', 'partner@2020-04-21?19:22:49', 'partner', '', '<p>Hello...</p>\r\n', 'Thursday ,May 7, 2020, 3:45 pm', 1, '2020-05-07 15:45:48', '2020-05-09 15:43:12'),
(3, 'message@2020-05-07?16:04:53', 'admin', 'partner@2020-04-21?19:22:49', 'partner', '', '<p>Hi...</p>\r\n', 'Thursday ,May 7, 2020, 4:04 pm', 1, '2020-05-07 16:04:53', '2020-05-11 12:33:35'),
(4, 'message@2020-05-07?16:08:14', 'admin', 'client@2020-04-22?16:33:36', 'client', '', '<p>helllo</p>\r\n', 'Thursday ,May 7, 2020, 4:08 pm', 1, '2020-05-07 16:08:14', '2020-05-14 19:43:06'),
(5, 'message@2020-05-09?19:23:58', 'partner@2020-04-21?19:22:49', '', 'admin', 'partner', '', 'Saturday ,May 9, 2020, 7:23 pm', 0, '2020-05-09 19:23:58', '2020-05-14 19:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notification_id` varchar(100) NOT NULL,
  `notification_to` varchar(100) NOT NULL,
  `notification_from` varchar(100) NOT NULL,
  `notification_type` text NOT NULL,
  `notification_about` text NOT NULL,
  `notification_for` text NOT NULL,
  `notification_time` varchar(50) NOT NULL,
  `is_seen` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `package_name` varchar(20) NOT NULL,
  `price_taka` varchar(10) NOT NULL,
  `price_usd` varchar(10) NOT NULL,
  `offer_1` text NOT NULL,
  `offer_2` text NOT NULL,
  `offer_3` text NOT NULL,
  `offer_4` text NOT NULL,
  `offer_5` text NOT NULL,
  `offer_6` text NOT NULL,
  `offer_7` text NOT NULL,
  `offer_8` text NOT NULL,
  `offer_9` text NOT NULL,
  `offer_10` text NOT NULL,
  `publication_status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_name`, `price_taka`, `price_usd`, `offer_1`, `offer_2`, `offer_3`, `offer_4`, `offer_5`, `offer_6`, `offer_7`, `offer_8`, `offer_9`, `offer_10`, `publication_status`, `created_at`) VALUES
(15, 'Bronze', '2000', '20', 'free for one month', 'free to use', '', '', '', '', '', '', '', '', 1, '2019-12-27 23:32:22'),
(16, 'Silver', '3000', '30', 'free for 2 month', 'unlimited use', '', '', '', '', '', '', '', '', 1, '2019-12-27 23:33:20'),
(17, 'Gold', '4000', '40', '4 month free use', 'unlimited add test', '', '', '', '', '', '', '', '', 1, '2019-12-27 23:33:53'),
(18, 'Platinum', '5000', '60', 'free five month use', 'unlimited test adding', '', '', '', '', '', '', '', '', 1, '2019-12-27 23:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `partner_id` varchar(100) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `institute_type` text NOT NULL,
  `service_period` text NOT NULL,
  `off_days` text NOT NULL,
  `short_form` varchar(20) NOT NULL,
  `tin_number` varchar(100) NOT NULL,
  `tin_certificate` varchar(1000) NOT NULL,
  `reg_number` varchar(100) NOT NULL,
  `licence_certificate` varchar(1000) NOT NULL,
  `contact_no1` varchar(30) NOT NULL,
  `contact_no2` varchar(30) NOT NULL,
  `contact_no3` varchar(30) NOT NULL,
  `hotline_no` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL,
  `region` text NOT NULL,
  `map_name` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `website_link` varchar(1000) NOT NULL,
  `facebook_link` varchar(100) NOT NULL,
  `institute_logo` varchar(255) NOT NULL,
  `partnership_zone` text NOT NULL,
  `doctor_type` text NOT NULL,
  `doctor_degree` text NOT NULL,
  `doctor_title` text NOT NULL,
  `visit_price` text NOT NULL,
  `about` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `joining_date` varchar(100) NOT NULL,
  `mail_verification` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1,
  `account_status` int(1) NOT NULL DEFAULT 0,
  `location_status` int(1) NOT NULL DEFAULT 0,
  `profile_status` int(1) NOT NULL DEFAULT 0,
  `premium_status` int(1) DEFAULT 0,
  `account_request` int(1) NOT NULL DEFAULT 0,
  `location_request` int(1) NOT NULL DEFAULT 0,
  `account_failed` int(1) NOT NULL DEFAULT 0,
  `location_failed` int(1) NOT NULL DEFAULT 0,
  `account_failed_cause` text NOT NULL,
  `location_failed_cause` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_id` varchar(100) NOT NULL,
  `posted_by` text NOT NULL,
  `posted_for` text NOT NULL,
  `post_title` text NOT NULL,
  `post_description` text NOT NULL,
  `posted_on` varchar(100) NOT NULL,
  `publication_status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_id`, `posted_by`, `posted_for`, `post_title`, `post_description`, `posted_on`, `publication_status`, `created_at`, `updated_at`) VALUES
(1, 'post@2020-05-07?18:16:20', 'admin', '', 'This is a test post.', '<p>Dear all,</p>\r\n\r\n<p>I am glad to introduce you to {name of person}, who will be assisting us as an intern for the next 6 months. He is a third-year Economics student at {name of institution}, and is excited about joining the team.</p>\r\n\r\n<p>I hope to see you all welcome him into the office and provide him with your help and feedback wherever necessary.</p>\r\n\r\n<p>Fond regards,<br />\r\n{Your name}</p>\r\n', 'Thursday ,May 7, 2020, 6:16 pm', 1, '2020-05-08 03:09:45', '2020-05-07 21:09:45'),
(2, 'post@2020-05-07?18:18:11', 'admin', '', 'This is a test post.', '<p>Dear all,</p>\r\n\r\n<p>I am glad to introduce you to {name of person}, who will be assisting us as an intern for the next 6 months. He is a third-year Economics student at {name of institution}, and is excited about joining the team.</p>\r\n\r\n<p>I hope to see you all welcome him into the office and provide him with your help and feedback wherever necessary.</p>\r\n\r\n<p>Fond regards,<br />\r\n{Your name}</p>\r\n', 'Thursday ,May 7, 2020, 6:18 pm', 1, '2020-05-08 03:09:40', '2020-05-07 21:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `premium`
--

CREATE TABLE `premium` (
  `id` int(11) NOT NULL,
  `partner_id` varchar(100) DEFAULT NULL,
  `package_name` text DEFAULT NULL,
  `package_price` varchar(10) DEFAULT NULL,
  `executed_at` varchar(20) DEFAULT NULL,
  `validate_to` varchar(20) DEFAULT NULL,
  `year` int(4) NOT NULL,
  `month` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `cretaed_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `client_id` varchar(100) NOT NULL,
  `partner_id` varchar(100) NOT NULL,
  `prescription_image` varchar(255) NOT NULL,
  `ordered_on` varchar(100) NOT NULL,
  `delivered_on` varchar(100) NOT NULL,
  `is_delivered` tinyint(1) NOT NULL DEFAULT 0,
  `is_received` tinyint(1) DEFAULT 0,
  `is_pending` tinyint(1) NOT NULL DEFAULT 1,
  `is_processing` tinyint(1) NOT NULL DEFAULT 0,
  `is_cancelled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `test_name` text NOT NULL,
  `test_id` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `video_link` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_name`, `test_id`, `category_id`, `description`, `video_link`, `status`, `created_at`) VALUES
(21, 'Calcium blood test', '1', 'blood@test 1', '<p>concerns on body&#39;s calcium availability</p>\r\n', '', 1, '2020-03-22 08:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` int(11) NOT NULL,
  `partner_id` varchar(100) NOT NULL,
  `verification_id` varchar(100) NOT NULL,
  `verification_type` text NOT NULL,
  `tin_certificate` varchar(1000) NOT NULL,
  `license_certificate` varchar(1000) NOT NULL,
  `map_name` varchar(100) NOT NULL,
  `longitude` varchar(1000) NOT NULL,
  `latitude` varchar(1000) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `available_tests`
--
ALTER TABLE `available_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_id` (`category_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_id` (`client_id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs_ordered`
--
ALTER TABLE `drugs_ordered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_name` (`package_name`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `partner_id` (`partner_id`);
ALTER TABLE `partners` ADD FULLTEXT KEY `country` (`country`,`city`,`region`,`doctor_type`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `premium`
--
ALTER TABLE `premium`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_id` (`test_id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `available_tests`
--
ALTER TABLE `available_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `drugs_ordered`
--
ALTER TABLE `drugs_ordered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `premium`
--
ALTER TABLE `premium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
