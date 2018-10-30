-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 29, 2018 at 02:02 PM
-- Server version: 5.6.41
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appscrip_scriptskincare`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `brand_company_id` int(10) DEFAULT NULL,
  `supplier_parent_id` int(11) DEFAULT NULL,
  `brand_logo` varchar(255) NOT NULL,
  `user_added_by` int(11) DEFAULT NULL,
  `is_approved` tinyint(10) NOT NULL DEFAULT '0' COMMENT '0 - not approved, 1 - approved',
  `approved_by` int(10) NOT NULL,
  `status` tinyint(10) NOT NULL COMMENT 'Active - 0 / Deactive - 1',
  `is_deleted` tinyint(10) NOT NULL DEFAULT '0' COMMENT '0 – not deleted, 1 – deleted',
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) NOT NULL,
  `modified_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_company_id`, `supplier_parent_id`, `brand_logo`, `user_added_by`, `is_approved`, `approved_by`, `status`, `is_deleted`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(1, 'Colorescience', 1, 38, 'brand7504.jpg', 38, 0, 38, 0, 0, '2018-10-23 05:13:12', '2018-10-23 17:06:31', 1, 1),
(2, 'La Roche-Posay', 2, NULL, 'brand8773.jpg', NULL, 0, 39, 0, 0, '2018-10-23 05:20:40', '0000-00-00 00:00:00', 1, 1),
(3, 'Regenerate', 3, NULL, 'brand1540272560_6147.jpg', NULL, 0, 41, 0, 0, '2018-10-23 05:29:20', '0000-00-00 00:00:00', 1, 1),
(4, 'SkinMedica', 4, NULL, 'brand1540273214_5026.jpg', NULL, 0, 42, 0, 0, '2018-10-23 05:40:14', '0000-00-00 00:00:00', 1, 1),
(5, 'ASAP', 5, 43, 'brand1540276389_7766.jpg', 43, 0, 43, 0, 0, '2018-10-23 06:33:09', '2018-10-23 17:33:09', 1, 1),
(6, 'SkinCeuticals', 5, 43, 'brand1540276592_2010.jpg', 43, 0, 43, 0, 0, '2018-10-23 06:36:32', '2018-10-23 17:36:47', 1, 1),
(7, 'The Skincare Company', 7, 45, 'brand1540290034_8380.jpg', 45, 0, 45, 0, 0, '2018-10-23 10:20:34', '2018-10-23 21:20:34', 1, 1),
(8, 'Inova', 9, 46, 'brand1540445198_9844.jpg', 46, 0, 46, 0, 0, '2018-10-25 05:26:38', '2018-10-25 16:26:38', 1, 1),
(9, 'SkinCeuticals', 10, 49, 'brand1540466813_9682.jpg', 49, 0, 49, 0, 0, '2018-10-25 11:26:53', '2018-10-25 22:26:53', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_details`
--

CREATE TABLE `client_details` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `address_line1` text,
  `address_line2` text,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `pregnancy_status` varchar(10) DEFAULT NULL COMMENT 'Yes / No',
  `loyalty_points` varchar(10) DEFAULT NULL,
  `email_subscription` varchar(10) DEFAULT NULL COMMENT 'Yes/ No',
  `skin_type` text COMMENT 'Multiple comma separator',
  `skin_concerns` text COMMENT 'Multiple comma separator',
  `routine` text COMMENT 'Multiple comma separator',
  `sensitivity_level` text COMMENT 'Multiple comma separator',
  `history` text COMMENT 'Multiple comma separator',
  `manual_skin_assessment` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 - not manual, 1 - manual assessment',
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 – Active, 1- Inactive',
  `signup_source` varchar(50) DEFAULT NULL,
  `registered_by` int(10) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 – not deleted, 1 – deleted',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_details`
--

INSERT INTO `client_details` (`id`, `first_name`, `last_name`, `dob`, `address_line1`, `address_line2`, `city`, `state`, `country`, `phone_number`, `mobile_number`, `email`, `gender`, `pregnancy_status`, `loyalty_points`, `email_subscription`, `skin_type`, `skin_concerns`, `routine`, `sensitivity_level`, `history`, `manual_skin_assessment`, `status`, `signup_source`, `registered_by`, `is_deleted`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(1, 'James', 'Heng', '1994-10-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hypervivi_3388@hotmail.com', 'Male', NULL, NULL, NULL, 'combination', 'Wrinkles, Anti ageing, Loss of elasticity, Obvious pores', NULL, NULL, NULL, 0, '0', 'Self', 1, '0', '2018-08-14 00:00:00', '2018-10-23 17:02:38', 1, 1),
(2, 'Dick', 'Congreve', '1992-06-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hypervivi@gmail.com', 'Male', NULL, NULL, NULL, 'oily', 'Obvious pores, Acne prone, Loss of elasticity, Wrinkles', NULL, NULL, NULL, 1, '0', 'Self', 1, '0', '2018-10-16 00:00:00', '2018-10-23 17:03:55', 1, 1),
(3, 'shreesha', 'karantha', '2000-02-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karanths@yahoo.com', 'Female', NULL, NULL, NULL, 'normal', 'Loss of elasticity, Wrinkles', NULL, NULL, NULL, 0, '0', 'Self', 1, '0', '2018-10-03 00:00:00', '2018-10-23 17:05:18', 1, 1),
(4, 'Lizzy', 'bindu', '2010-06-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'lizzy@yahoo.com', 'Female', NULL, NULL, NULL, 'Dry', 'Obvious pores, Wrinkles, Loss of elasticity, Redness', NULL, NULL, NULL, 0, '0', 'Self', 1, '0', '2018-10-09 00:00:00', '2018-10-23 17:06:35', 1, 1),
(5, 'Sprim', 'hima', '2009-02-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sprimhima@hotmail.com', 'Male', NULL, NULL, NULL, 'Oily', 'Sun damaged, Redness, Anti ageing, Pigmentation , Acne prone', NULL, NULL, NULL, 0, '0', 'Self', 1, '0', '2018-09-10 00:00:00', '2018-10-23 17:08:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clinic_details`
--

CREATE TABLE `clinic_details` (
  `id` int(11) NOT NULL,
  `clinic_name` varchar(255) DEFAULT NULL COMMENT 'Registered business name',
  `trading_name` varchar(255) DEFAULT NULL COMMENT 'Trading Name',
  `clinic_location` varchar(255) DEFAULT NULL COMMENT 'Address',
  `telephone_number` varchar(50) DEFAULT NULL,
  `clinic_email` varchar(255) DEFAULT NULL COMMENT 'email',
  `clinic_website` varchar(255) DEFAULT NULL,
  `clinic_status` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic_details`
--

INSERT INTO `clinic_details` (`id`, `clinic_name`, `trading_name`, `clinic_location`, `telephone_number`, `clinic_email`, `clinic_website`, `clinic_status`, `is_deleted`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(2, 'Script Skincare', 'Skincare', '8-10 Howitt Street', '0398264966', 'elizabeth@div.net.au', 'https://www.scriptskincare.com.au', 0, 0, '2018-10-25 22:45:36', '2018-10-26 09:45:36', 1, 1),
(3, 'info', 'test', 'test', '12345678901', 'ggg@ss.com', 'http://scriptskincareapp.platformgroup.com.au/retailadd', 1, 0, '2018-10-26 12:08:36', '2018-10-26 12:08:36', 1, 1),
(4, 'Institute of Victoria', 'Victoria', '8-10 Howitt Street', '0398264966', 'melissa@div.net.au', 'https://www.div.net.au', 1, 0, '2018-10-26 12:14:01', '2018-10-26 12:14:01', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trading_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Australian Business Number',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_telephone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT 'Active - 0, Deactive - 1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Not Deleted, 1 - Deleted',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`id`, `business_name`, `trading_name`, `abn`, `address`, `business_telephone_number`, `email_address`, `website`, `status`, `is_deleted`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(1, 'Advance skin technology', 'Skin', '123456', '8-10 Howitt Street South Yarra  Melbourne', '1234567890', 'elizabeth@div.net.au', 'https://www.scriptskincare.com.au', 0, 0, '2018-10-23 05:07:05', '2018-10-23 16:07:05', 1, 1),
(2, 'L\'oreal Australia Pty Ltd', 'L\'oreal', '1234567', '564 St Kilda Rd, Melbourne, Victoria, Australia', '1800648851', 'Olga.SHCHUR@loreal.com', 'https://regenerateskincare.com/', 0, 0, '2018-10-23 05:16:59', '2018-10-23 16:16:59', 1, 1),
(3, 'Cosmétiques de France (Aust) Pty Ltd', 'Cosmétiques', '585258', '34 William Street , Balaclava, Victoria, Australia', '1800648851', 's.yung@cosmetiquesdefrance.com.au', 'https://www.cosmetiquesdefrance.com.au', 0, 0, '2018-10-23 05:26:35', '2018-10-23 16:26:35', 1, 1),
(4, 'Propaira Pty Ltd', 'Propaira', '4659781', '23 Church St, Abbotsford, Victoria, Australia', '6547894560', 'bh@propaira.com', 'https://www.propaira.com', 0, 0, '2018-10-23 05:38:22', '2018-10-23 16:38:22', 1, 1),
(5, 'The Dermatology Institute of Victoria', 'Dermatology', '657981', '8-10 Howitt Street South Yarra', '982649667799', 'tara@div.net.au', 'https://www.div.net.au/56513d918', 0, 0, '2018-10-23 06:30:38', '2018-10-24 21:40:47', 1, 1),
(6, 'SSR CARE', 'Beauty care', '83686386', 'Howitt Street', '123456789012', 'danni@div.net.au', 'https://www.scriptcare.com', 0, 0, '2018-10-23 09:04:03', '2018-10-23 20:04:03', 1, 1),
(7, 'Inova Pharmaceuticals', 'Inova', '46598732', '8-10 Howitt Street', '0398264966', 'amber@div.net.au', 'https://www.pharmaceuticals.com/', 0, 0, '2018-10-23 10:17:43', '2018-10-23 21:17:43', 1, 1),
(8, 'Jay', 'Jay', '465978321', 'AUS', '7894569781', 'jay@gmail.com', 'https://www.jayesup.com', 0, 0, '2018-10-23 10:41:05', '2018-10-25 22:43:26', 1, 1),
(9, 'Dermatology Victoria', 'Skin', '5469781', '8-10 Howitt Street', '45697812000', 'dermo@gmail.com', 'https://www.dermo.com.au', 0, 0, '2018-10-25 05:09:18', '2018-10-25 16:09:18', 1, 1),
(10, 'Test Hardik', 'Propaira', '98754620', 'Test 123 Ahmedabad 380054', '7896543210', 'akash@gmail.com', 'https://regenerateskincare.com/', 0, 0, '2018-10-25 10:39:12', '2018-10-25 21:39:12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2018_10_04_072610_create_supplier_details_table', 1),
(7, '2018_10_08_092728_create_roles_permissions_table', 1),
(8, '2018_10_08_114337_create_company_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT 'Active - 0, Deactive - 1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Not Deleted, 1 - Deleted',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_type` int(11) DEFAULT NULL COMMENT '0 - Admin,1 - Supplier,2 - retailer, 3 - customer',
  `status` tinyint(4) NOT NULL COMMENT 'Active - 0, Deactive - 1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Not Deleted, 1 - Deleted',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `label`, `role_type`, `status`, `is_deleted`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(1, 'supplier_list', 'Supplier List', 1, 0, 0, '2018-10-17 06:44:39', '2018-10-23 16:12:10', 1, 1),
(2, 'setup_new_supplier', 'Set-Up New Supplier', 1, 0, 0, '2018-10-17 12:18:01', '2018-10-23 16:12:13', 1, 1),
(3, 'manage_edit_supplier', 'Manage / Edit A Supplier', 1, 0, 0, '2018-10-17 12:18:45', '2018-10-23 16:12:16', 1, 1),
(4, 'manage_user_permission', 'Manage User Permissions', 1, 0, 0, '2018-10-17 12:19:21', '2018-10-23 16:12:19', 1, 1),
(5, 'manage_brand', 'Manage Brands', 1, 0, 0, '2018-10-17 12:21:19', '2018-10-23 16:12:21', 1, 1),
(6, 'manage_role_permission', 'Manage Role Permissions', 0, 0, 0, '2018-10-17 18:05:23', '2018-10-17 18:05:24', 1, 1),
(7, 'product_list', 'Product List', 1, 0, 0, '2018-10-17 18:05:23', '2018-10-17 18:05:24', 1, 1),
(8, 'new_product', 'New Product', 1, 0, 0, '2018-10-17 18:05:23', '2018-10-17 18:05:24', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT 'Active - 0, Deactive - 1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Not Deleted, 1 - Deleted',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`, `status`, `is_deleted`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(8, 3, 0, 0, '2018-10-17 18:07:19', '2018-10-17 18:07:20', 1, 1),
(7, 3, 0, 0, '2018-10-17 18:07:19', '2018-10-17 18:07:20', 1, 1),
(1, 3, 0, 0, '2018-10-18 09:09:34', '2018-10-18 14:39:34', 1, 1),
(6, 1, 0, 0, '2018-10-17 18:07:19', '2018-10-17 18:07:20', 1, 1),
(5, 1, 0, 0, '2018-10-17 18:07:19', '2018-10-17 18:07:20', 1, 1),
(4, 1, 0, 0, '2018-10-17 18:07:19', '2018-10-17 18:07:20', 1, 1),
(3, 1, 0, 0, '2018-10-17 18:07:19', '2018-10-17 18:07:20', 1, 1),
(2, 1, 0, 0, '2018-10-17 18:07:19', '2018-10-17 18:07:20', 1, 1),
(1, 1, 0, 0, '2018-10-17 18:07:19', '2018-10-17 18:07:20', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productline`
--

CREATE TABLE `productline` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `productline_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT 'Active - 0, Deactive - 1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Not Deleted, 1 - Deleted',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productline`
--

INSERT INTO `productline` (`id`, `brand_id`, `productline_name`, `status`, `is_deleted`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(1, 3, 'sample', 0, 0, '2018-10-24 11:32:08', '2018-10-24 17:15:26', 43, 43);

-- --------------------------------------------------------

--
-- Table structure for table `retail_details`
--

CREATE TABLE `retail_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_role_id` int(10) UNSIGNED NOT NULL,
  `user_parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '0  - supplier admin, else respective parent user_id',
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_tel_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line_1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line_2` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clinic_id` tinyint(4) DEFAULT NULL,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT 'Active - 0, Deactive - 1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Not Deleted, 1 - Deleted',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `retail_details`
--

INSERT INTO `retail_details` (`id`, `user_id`, `user_role_id`, `user_parent_id`, `first_name`, `last_name`, `email`, `business_tel_number`, `address_line_1`, `mobile_number`, `address_line_2`, `city`, `state`, `country`, `clinic_id`, `position`, `status`, `is_deleted`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(5, 52, 6, 0, 'Elizabeth', 'Ryan', 'elizabeth@gmail.com', '0398264966', '8-10 Howitt Street', '1234567890', '', '', '', '', 2, 'Jr', 0, 0, '2018-10-26 10:01:24', '2018-10-26 21:01:24', 1, 1),
(6, 53, 6, 0, 'vijya', 'rana', 'xyz@xyz.com', '12345678901', 'test', '12345678900', '', '', '', '', 3, 'demo', 0, 0, '2018-10-26 10:10:08', '2018-10-26 21:10:08', 1, 1),
(7, 54, 6, 0, 'Lizzy', 'bindu', 'lizzy@gmail.com', '0398264966', '8-10 Howitt Street', '9876543210', '', '', '', '', 2, 'jr', 0, 0, '2018-10-26 10:30:36', '2018-10-26 21:30:36', 1, 1),
(8, 55, 6, 0, 'Jaymin', 'Rana', 'jaymin1@gmail.com', '0398264966', '8-10 Howitt Street', '9876543210', '', '', '', '', 4, 'jr', 0, 0, '2018-10-26 10:33:09', '2018-10-26 21:33:09', 1, 1),
(9, 56, 7, 8, 'Akash', 'Panchal', 'akash1@gmail.com', '0398264966', '8-10 Howitt Street', '9876543210', '', '', '', '', 4, 'Jr.', 0, 0, '2018-10-26 10:33:38', '2018-10-26 21:33:38', 1, 1),
(10, 57, 8, 0, 'Afroz', 'Fox', 'fox@gmail.com', '0398264966', '8-10 Howitt Street', '1234567890', '', '', '', '', 2, 'Jr.', 0, 0, '2018-10-26 10:35:38', '2018-10-26 21:35:38', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL COMMENT '0 - Admin,1 - Supplier,2 - retailer, 3 - customer',
  `status` tinyint(4) NOT NULL COMMENT 'Active - 0, Deactive - 1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Not Deleted, 1 - Deleted',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `user_type`, `status`, `is_deleted`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(1, 'super_admin', 'Super Admin', 0, 0, 0, '2018-10-11 05:57:36', '2018-10-17 18:13:52', 1, 1),
(2, 'admin', 'Admin', 0, 0, 0, '2018-10-11 11:33:08', '2018-10-11 11:33:10', 1, 1),
(3, 'supplier_admin', 'Supplier', 1, 0, 0, '2018-10-11 11:33:08', '2018-10-11 11:33:51', 1, 1),
(4, 'brand_manager', 'Brand Manager', 1, 0, 0, '2018-10-11 11:33:08', '2018-10-11 11:33:51', 1, 1),
(5, 'product_manager', 'Product Manager', 1, 0, 0, '2018-10-11 11:33:08', '2018-10-11 11:33:51', 1, 1),
(6, 'retail_admin', 'Retailer', 2, 0, 0, '2018-10-11 11:39:45', '2018-10-11 11:39:46', 1, 1),
(7, 'retail_manager', 'Retailer Manager', 2, 0, 0, '2018-10-11 11:39:45', '2018-10-11 11:39:46', 1, 1),
(8, 'retail_user', 'Retailer User', 2, 0, 0, '2018-10-11 11:39:45', '2018-10-11 11:39:46', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT 'Active - 0, Deactive - 1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Not Deleted, 1 - Deleted',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `status`, `is_deleted`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(8, 57, 0, 0, '2018-10-26 10:35:38', '2018-10-26 21:35:38', 1, 1),
(7, 56, 0, 0, '2018-10-26 10:33:43', '2018-10-26 21:33:43', 1, 1),
(6, 55, 0, 0, '2018-10-26 10:33:09', '2018-10-26 21:33:09', 1, 1),
(6, 54, 0, 0, '2018-10-26 10:30:36', '2018-10-26 21:30:36', 1, 1),
(6, 53, 0, 0, '2018-10-26 10:10:08', '2018-10-26 21:10:08', 1, 1),
(6, 52, 0, 0, '2018-10-26 10:10:36', '2018-10-26 21:10:36', 1, 1),
(3, 51, 0, 0, '2018-10-25 12:21:01', '2018-10-25 23:21:01', 1, 1),
(5, 50, 0, 0, '2018-10-25 05:31:13', '2018-10-25 16:31:13', 1, 1),
(4, 49, 0, 0, '2018-10-25 05:23:31', '2018-10-25 16:23:31', 1, 1),
(3, 48, 0, 0, '2018-10-25 05:14:12', '2018-10-25 16:14:12', 1, 1),
(3, 47, 0, 0, '2018-10-23 10:18:48', '2018-10-23 21:18:48', 1, 1),
(3, 46, 0, 0, '2018-10-23 09:08:21', '2018-10-23 20:08:21', 1, 1),
(3, 45, 0, 0, '2018-10-24 10:40:47', '2018-10-24 21:40:47', 1, 1),
(3, 44, 0, 0, '2018-10-23 05:40:02', '2018-10-23 16:40:02', 1, 1),
(3, 43, 0, 0, '2018-10-23 05:28:16', '2018-10-23 16:28:16', 1, 1),
(4, 42, 0, 0, '2018-10-23 05:20:12', '2018-10-23 16:20:12', 1, 1),
(5, 41, 0, 0, '2018-10-23 07:25:52', '2018-10-23 18:25:52', 1, 1),
(3, 40, 0, 0, '2018-10-23 05:11:09', '2018-10-23 16:13:57', 1, 1),
(1, 1, 0, 0, '2018-10-23 05:11:09', '2018-10-23 16:13:57', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_details`
--

CREATE TABLE `supplier_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `user_parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '0  - supplier admin, else respective parent user_id',
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_tel_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_address_line_1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_address_line_2` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'comma seperator - e.g 1,5,3',
  `status` tinyint(4) NOT NULL COMMENT 'Active - 0, Deactive - 1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Not Deleted, 1 - Deleted',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_details`
--

INSERT INTO `supplier_details` (`id`, `user_id`, `company_id`, `user_parent_id`, `first_name`, `last_name`, `supplier_name`, `position`, `business_tel_number`, `business_address_line_1`, `business_address_line_2`, `city`, `state`, `country`, `mobile_number`, `brand_ids`, `status`, `is_deleted`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(44, 46, 6, 0, 'Rodney', 'Saha', '', NULL, '1234567890', 'Howitt Street', 'Aus', '', '', '', '0391234560', NULL, 0, 0, '2018-10-23 09:08:21', '2018-10-23 20:08:21', 1, 1),
(45, 47, 7, 0, 'Suma', 'bindu', '', NULL, '4659784650', '203/95 Ormond Rd ,', 'Elwood, Victoria, Australia', '', '', '', '9876543210', ',7', 0, 0, '2018-10-23 10:18:48', '2018-10-23 21:20:53', 1, 1),
(43, 45, 5, 0, 'Ron', 'Rack', '', 'test', '6549873120', '8-10 Howitt Street', '8-10 Howitt Street', '', '', '', '4654658501', '6,5', 0, 0, '2018-10-23 06:32:22', '2018-10-25 19:23:40', 1, 1),
(42, 44, 4, 0, 'Mangala', 'Samy', '', NULL, '5478914651', '564 St Kilda Rd, Melbourne,', 'Victoria, Australia', '', '', '', '6579456187', ',4', 0, 0, '2018-10-23 05:40:02', '2018-10-23 16:40:14', 1, 1),
(41, 43, 3, 0, 'Sujan', 'Saha', '', NULL, '0257985123', '8/31 Fiveways Blvd, Melbourne,', 'Victoria, Australia', '', '', '', '0257985123', ',3', 0, 0, '2018-10-23 05:28:16', '2018-10-23 16:29:20', 1, 1),
(39, 41, 2, 0, 'Afroz', 'Khan', '', NULL, '8956230147', '203/95 Ormond Rd ,', 'Elwood, Victoria, Australia', '', '', '', '8956230147', '', 0, 0, '2018-10-23 05:18:20', '2018-10-23 18:25:52', 1, 1),
(40, 42, 2, 0, 'Lizzy', 'bindu', '', NULL, '0404427593', '313 Pakington Street, Newtown,', 'Australian Capital Territory, Australia', '', '', '', '0404427593', ',2', 0, 0, '2018-10-23 05:20:12', '2018-10-23 16:41:05', 1, 1),
(38, 40, 1, 0, 'Jeff', 'Fox', '', NULL, '9876543210', '8-10 Howitt Street', 'Melbourne', '', '', '', '9876543210', ',1', 0, 0, '2018-10-23 05:11:09', '2018-10-23 17:06:31', 1, 1),
(46, 48, 9, 0, 'Sagar', 'Rana', '', 'Jr.', '4567891230', 'South Yarra  Melbourne', 'South Yarra  Melbourne', '', '', '', '9876543210', ',8', 0, 0, '2018-10-25 05:14:12', '2018-10-25 20:06:21', 1, 1),
(47, 49, 9, 46, 'Akash', 'Panchal', '', 'Jr.', '4567891000', 'South Yarra  Melbourne', 'South Yarra  Melbourne', '', '', '', '1234567890', ',8', 0, 0, '2018-10-25 05:15:04', '2018-10-25 20:06:21', 1, 1),
(48, 50, 9, 46, 'Jaymin', 'Panchal', '', 'Jr.', '9876543210', '8-10 Howitt Street', 'Melbourne', '', '', '', '9876543210', ',8', 0, 0, '2018-10-25 05:25:56', '2018-10-25 20:06:21', 1, 1),
(49, 51, 10, 0, 'Jaymin', 'Rana', '', 'jr', '9876543210', '313 Pakington Street, Newtown,', 'Victoria, Australia', '', '', '', '8765410200', ',9', 0, 0, '2018-10-25 11:25:28', '2018-10-25 23:21:08', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT 'Active - 0, Deactive - 1',
  `user_type` tinyint(4) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Not Deleted, 1 - Deleted',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `user_type`, `is_deleted`, `remember_token`, `created_date`, `modified_date`, `created_by`, `modified_by`) VALUES
(1, 'Admin', 'admin@mail.com', NULL, '$2y$10$9G6Uisl7NryE58z8oxWTreyTqo.jQQbUmC4V7mjzHaSeg0uvOb8mG', 0, 0, 0, 'He3uHjM7k261BkLjOo961SqC7yBc5023oaS2ZBxtHuNkig8btLvkFDTH5X5d', '2018-10-08 12:06:04', '2018-10-26 22:44:34', 0, 0),
(57, 'Afroz', 'fox@gmail.com', NULL, '$2y$10$J24imfLwO7/huoasL/rNOuDCuB3K5H.85relniKzVH7CFyTor9mL6', 0, 1, 0, NULL, '2018-10-26 10:35:38', '2018-10-26 21:35:38', 1, 1),
(56, 'Akash', 'akash1@gmail.com', NULL, '$2y$10$Lwkc1Pe5QNFIT6xoP7ZKKOie7pzJFx0WxtscUHVsWocnM/pBBUEOi', 0, 1, 0, NULL, '2018-10-26 10:33:38', '2018-10-26 21:33:38', 1, 1),
(55, 'Jaymin', 'jaymin1@gmail.com', NULL, '$2y$10$IOINBQrQLh/1P3cITlBvuOQqaZcgqL0wyEoTIOaDdNy/v/LzOY926', 0, 1, 0, NULL, '2018-10-26 10:33:09', '2018-10-26 21:33:09', 1, 1),
(54, 'Lizzy', 'lizzy@gmail.com', NULL, '$2y$10$htJ6zQivai41lf8pWGtsP.W99eFk3rCP72vxUdTIZprp9cY9ZzFT2', 0, 1, 0, NULL, '2018-10-26 10:30:36', '2018-10-26 21:30:36', 1, 1),
(53, 'vijya', 'xyz@xyz.com', NULL, '$2y$10$3DpbGlFNOsdGPnMWkMREE.2cz8y2oN2xTg2xqh8pH5Mqr4NUPlbLe', 0, 1, 0, NULL, '2018-10-26 10:10:08', '2018-10-26 21:10:08', 1, 1),
(52, 'Elizabeth', 'elizabeth@gmail.com', NULL, '$2y$10$OIjFM5zJ6kNAbEK8n6z1ceec0uYo2G90JW86Zo3bx8tvwcdD6CBGu', 0, 1, 0, NULL, '2018-10-26 10:01:24', '2018-10-26 21:01:24', 1, 1),
(51, 'Jaymin', 'test@test.com', NULL, '$2y$10$mNaSzWQ0zVTQ8BRLC.UoweyZAFktQ9mhVPOxeP5ptEOAuS1k2dUX6', 0, 1, 0, NULL, '2018-10-25 11:25:28', '2018-10-25 22:25:28', 1, 1),
(50, 'Jaymin', 'jaymin@gmail.com', NULL, '$2y$10$vyJ1p6wi5QiqeTi0I8Eag.5p7A1BQMkqdUyyNp4jbAFjPTeJ2qjkC', 0, 1, 0, NULL, '2018-10-25 05:25:56', '2018-10-25 16:25:56', 1, 1),
(49, 'Akash', 'akash@gmail.com', NULL, '$2y$10$WPM8FFBbaWHzAmK49yiQR.6ecvdyb2c3YkKqdeIoFMXU68HzKEGby', 0, 1, 0, NULL, '2018-10-25 05:15:04', '2018-10-25 16:15:04', 1, 1),
(48, 'Sagar', 'sagar@gmail.com', NULL, '$2y$10$QmY3LnxDBxZqkj7tvfAbBOjQx3pI5xyLnIW4ujeqBBqTL75YMa91y', 0, 1, 0, NULL, '2018-10-25 05:14:12', '2018-10-25 16:14:12', 1, 1),
(47, 'Suma', 'info@health-multiplex.com', NULL, '$2y$10$BYT7V8h124qano8Sn.BfBOT8yFVPwI.OGa9unecM5Irb3bwI8j8K2', 0, 1, 0, NULL, '2018-10-23 10:18:48', '2018-10-24 23:45:44', 1, 1),
(46, 'Rodney', 'rodney@hotmail.com', NULL, '$2y$10$eoHWavItpaHzPOoR4lWLAeJPnxYZlLCNODQvtFkviN1djx.BYWMUG', 0, 1, 0, NULL, '2018-10-23 09:08:21', '2018-10-24 23:45:48', 1, 1),
(45, 'Ron', 'jij@jij.com', NULL, '$2y$10$z2aI8pCOnf6OStg8sD59r.SIVTVarUeEbx6DbyL8n03sIM50EWxwa', 0, 1, 0, NULL, '2018-10-23 06:32:22', '2018-10-24 23:45:54', 1, 1),
(44, 'Mangala', 'mangaleswaran1be@gmail.com', NULL, '$2y$10$ldNt4bWG7wm7dKVvxnn7ceDlmruP0/O9fZq8NV.rH7XhjOxlYkjQC', 0, 1, 0, NULL, '2018-10-23 05:40:02', '2018-10-24 23:46:02', 1, 1),
(43, 'Sujan', 'sujan.saha@sprim.com', NULL, '$2y$10$ZwBdcvN14zUHNkSeu5DO..S/9nbqc8rstczTY.zd6ZZ4/NiGvSyA2', 0, 1, 0, '2yu800HMvyJvUsH6zRtdavv9dWsliQRfL5UpdyAbhcvaWp352TApGumDySvS', '2018-10-23 05:28:16', '2018-10-29 12:43:43', 1, 1),
(42, 'Lizzy', 'suman.yulop@gmail.com', NULL, '$2y$10$ZrdZFciy1THdmVY5rI2Lput/CTWuJsSvlI3JX5R2CguauEDaiJchy', 0, 1, 0, NULL, '2018-10-23 05:20:12', '2018-10-24 23:45:58', 1, 1),
(40, 'Jeff', 'amber@div.net.au', NULL, '$2y$10$h8OmcWv5Q1Ez2rT2UTWiDuuBI.Fc0g4eWYoIeb2G8xrT.f.IzhdfG', 0, 1, 0, NULL, '2018-10-23 05:11:09', '2018-10-24 23:45:56', 1, 1),
(41, 'Afroz', 'afroz.khan@gmail.com', NULL, '$2y$10$oFTW5dqIKZKxpcYhLX6LaeXK8HRL3pQ4j4X3R815S20LerQKvxpny', 0, 1, 0, NULL, '2018-10-23 05:18:20', '2018-10-24 23:46:04', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_details`
--
ALTER TABLE `client_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinic_details`
--
ALTER TABLE `clinic_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `productline`
--
ALTER TABLE `productline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_details`
--
ALTER TABLE `retail_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_details_user_id_foreign` (`user_id`),
  ADD KEY `supplier_details_company_id_foreign` (`user_role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `supplier_details`
--
ALTER TABLE `supplier_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_details_user_id_foreign` (`user_id`),
  ADD KEY `supplier_details_company_id_foreign` (`company_id`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client_details`
--
ALTER TABLE `client_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clinic_details`
--
ALTER TABLE `clinic_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `productline`
--
ALTER TABLE `productline`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `retail_details`
--
ALTER TABLE `retail_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier_details`
--
ALTER TABLE `supplier_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
