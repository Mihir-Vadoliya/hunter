-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 21, 2024 at 04:32 PM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u952853138_Hunterits`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `an` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `admin_id` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`an`, `username`, `admin_id`, `password`) VALUES
(1, 'admin', 'admin', 'jgc9cab12850b40d2185080b0941a760cd7');

-- --------------------------------------------------------

--
-- Table structure for table `credit_log`
--

CREATE TABLE `credit_log` (
  `transaction_id` int(11) NOT NULL,
  `transaction_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_by` varchar(20) NOT NULL,
  `transaction_for` varchar(20) NOT NULL,
  `credit_amount` int(11) NOT NULL,
  `mode` varchar(20) NOT NULL,
  `sub_admin_id` int(255) NOT NULL,
  `super_id` int(255) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `miniadmin_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demoswitch`
--

CREATE TABLE `demoswitch` (
  `switch_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `demoswitch`
--

INSERT INTO `demoswitch` (`switch_id`, `status`) VALUES
(1, 'Deactive');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `sn` int(11) NOT NULL,
  `agent_user` varchar(50) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `mac` varchar(50) NOT NULL,
  `mob` varchar(50) NOT NULL,
  `registration` timestamp NULL DEFAULT NULL,
  `admin_msg` varchar(100) NOT NULL,
  `payment` int(11) NOT NULL,
  `payment_date` varchar(20) DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `activated` int(11) NOT NULL,
  `super_pay` int(11) NOT NULL DEFAULT 0,
  `super_pay_date` varchar(20) DEFAULT NULL,
  `admin_pay` int(11) DEFAULT 0,
  `admin_pay_date` varchar(20) DEFAULT NULL,
  `macid-f` varchar(100) DEFAULT NULL,
  `CreatedDate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`sn`, `agent_user`, `user_id`, `client_name`, `status`, `user_type`, `mac`, `mob`, `registration`, `admin_msg`, `payment`, `payment_date`, `expiry_date`, `activated`, `super_pay`, `super_pay_date`, `admin_pay`, `admin_pay_date`, `macid-f`, `CreatedDate`) VALUES
(1971, 'SONU', 'RAHAM199', 'RAHAM199', 0, 1, '972C-2825-E413-F97E-624A-F7DC-AE3F-0E87', 'not_registered', '2024-09-22 06:42:49', 'hello', 1, '2024-06-27 11:38:46p', '2024-10-22 11:14:37', 1, 0, '2024-07-20 11:57:13p', 1, '2024-09-22 06:43:50a', NULL, '2024-09-22'),
(5097, 'SONU', 'UMARSD', 'UMARSD', 0, 1, '8EA3-2E55-AD27-36B7-24D6-2486-180E-47BF', 'not_registered', '2024-10-09 09:05:55', 'hello', 0, NULL, '2024-12-18 02:37:59', 0, 0, NULL, 1, '2024-10-09 09:06:58a', NULL, '2024-10-09'),
(5104, 'MAHEK', 'SIDRATUL', 'Sidratul', 0, 1, '38BE-287D-D6A4-2DED-42D4-31BF-0755-773F', 'not_registered', '2024-10-11 01:40:10', 'hello', 0, NULL, '2024-11-10 01:40:10', 0, 0, NULL, 1, '2024-10-11 02:43:33p', NULL, '2024-10-11'),
(5049, 'SONU', 'SONAM', 'SONAM', 0, 1, '9B33-6592-4A91-E052-63B8-BEC5-56DC-9F74', 'not_registered', '2024-09-21 11:21:46', 'hello', 1, '2024-09-21 11:43:41p', '2024-10-19 11:14:47', 0, 0, NULL, 1, '2024-09-21 11:46:25p', NULL, '2024-09-21'),
(4298, 'HABIBTS', 'HABIBTS_SELF', 'HABIBTS_SELF', 0, 1, '9254-0068-C8FF-51D5-3085-D094-7B08-02B8', 'not_registered', '2024-09-09 08:34:17', 'hello', 0, NULL, '2025-09-06 11:14:50', 0, 0, NULL, 1, '2024-09-09 08:41:29a', NULL, '2024-09-09'),
(5093, 'SONU', 'ARUN', 'ARUN', 0, 1, '750E-603A-69CE-32D9-6F04-C4C7-F739-AC08', 'not_registered', '2024-10-08 09:42:59', 'hello', 0, NULL, '2024-11-07 09:42:59', 0, 0, NULL, 1, '2024-10-08 09:43:23a', NULL, '2024-10-08'),
(5086, 'SHAKTISELLER', 'SHKTIMAN', 'SHKTIMAN', 0, 1, 'D959-AF58-D33E-DB65-F046-BBC6-BD8E-C81A', 'not_registered', '2024-10-06 09:00:27', 'hello', 0, NULL, '2024-11-05 09:00:27', 0, 0, NULL, 1, '2024-10-06 09:17:54a', NULL, '2024-10-06'),
(5099, 'MHHUNTER', 'BIKUHINTER', 'BIKASH', 0, 1, '5849-0C58-3BBE-AB5E-98F9-5E08-D1D0-E9DC', 'not_registered', '2024-10-10 09:46:51', 'hello', 0, NULL, '2024-11-03 09:48:48', 0, 0, NULL, 1, '2024-10-10 09:48:31a', NULL, '2024-10-10'),
(5101, 'ENJSELAR', 'BADSA', 'BADSA', 0, 1, 'AA76-1B2B-1194-DD82-3700-C079-F18F-1DC4', 'not_registered', '2024-10-10 10:17:34', 'hello', 0, NULL, '2024-11-09 10:17:34', 0, 0, NULL, 1, '2024-10-10 10:21:46a', NULL, '2024-10-10'),
(5106, 'MAHEK', 'PIHU12', 'Pihu12', 0, 1, '5FED-3D2A-5F3E-1CD1-50E4-53DE-FC08-759E', 'not_registered', '2024-10-12 02:26:53', 'hello', 0, NULL, '2024-11-11 02:26:53', 0, 0, NULL, 1, '2024-10-12 02:27:11p', NULL, '2024-10-12'),
(5109, 'KING', 'DON789              ', ' don', 0, 1, 'D8CC-19C0-9EE1-A86E-048C-C076-6D92-2B48', 'not_registered', '2024-10-12 08:19:50', 'hello', 0, NULL, '2024-11-11 08:19:50', 0, 0, NULL, 1, '2024-10-12 08:54:35p', NULL, '2024-10-12'),
(5126, 'SONU', 'ROMONI', 'ROMONI', 0, 1, '006D-4A85-E3A4-5DE2-E442-16D7-9617-F57C', 'not_registered', '2024-10-15 09:46:14', 'hello', 0, NULL, '2024-11-14 09:46:14', 0, 0, NULL, 1, '2024-10-15 09:51:37p', NULL, '2024-10-15'),
(5129, 'ANILL5522', 'RKASHARI5522', 'rkashari5522', 0, 1, '78B3-CD16-A29D-22FE-1B72-8555-EF40-A6E1', 'not_registered', '2024-10-16 10:47:26', 'hello', 0, NULL, '2024-11-15 10:47:26', 0, 0, NULL, 1, '2024-10-16 10:48:51a', NULL, '2024-10-16'),
(5147, 'SONU', 'SINGH369', 'SINGH369', 0, 1, '1499-CCE5-126E-4BDA-F0B9-FD76-40B8-4D24', 'not_registered', '2024-10-19 10:27:08', 'hello', 0, NULL, '2024-11-18 10:27:08', 0, 0, NULL, 1, '2024-10-19 10:27:36a', NULL, '2024-10-19'),
(5119, 'SKYSELLER', 'RAMESH15', 'Sky', 0, 1, '6DD2-014F-13F4-33FA-DCCF-9585-0CA9-98B4', 'not_registered', '2024-10-13 10:27:22', 'hello', 0, NULL, '2024-11-12 10:27:22', 0, 0, NULL, 1, '2024-10-13 10:28:22a', NULL, '2024-10-13'),
(5120, 'SONU', 'FAIZAL15', 'FAIZAL15', 0, 1, '750E-603A-69CE-32D9-6F04-C4C7-F739-AC08', 'not_registered', '2024-10-13 01:51:17', 'hello', 0, NULL, '2024-11-12 01:51:17', 0, 0, NULL, 1, '2024-10-13 01:51:24p', NULL, '2024-10-13'),
(5123, 'SKYSELLER', 'RANJIV', 'Ranjiv', 0, 1, '191C-55B5-207E-C6C7-D2F9-0A62-F8A4-944B', 'not_registered', '2024-10-14 10:27:40', 'hello', 0, NULL, '2024-11-13 10:27:40', 0, 0, NULL, 1, '2024-10-14 10:29:08a', NULL, '2024-10-14'),
(5137, 'SATYAJEET2', 'TANNU552', 'Tannu552', 0, 1, '6659-B1D3-D152-6C75-20F8-2964-2331-A553', 'not_registered', '2024-10-17 08:59:18', 'hello', 0, NULL, '2024-11-16 08:59:18', 0, 0, NULL, 1, '2024-10-17 09:03:03a', NULL, '2024-10-17'),
(5141, 'SKYSELLER', 'BIGUSER', 'Big user ', 0, 1, '750E-603A-69CE-32D9-6F04-C4C7-F739-AC08', 'not_registered', '2024-10-18 09:27:39', 'hello', 0, NULL, '2024-11-17 09:27:39', 0, 0, NULL, 1, '2024-10-18 09:36:05a', NULL, '2024-10-18'),
(5148, 'SARTHAK', 'HARU', 'HARU', 0, 1, '5C31-982F-DE42-D550-7C32-7289-C0D8-1B1F', 'not_registered', '2024-10-19 07:25:14', 'hello', 0, NULL, '2024-11-18 07:25:14', 0, 0, NULL, 1, '2024-10-19 08:14:54p', NULL, '2024-10-19'),
(5149, 'SARTHAK', 'CHOTTU', 'CHOTTU', 0, 1, '919E-E5AF-4E72-CC67-0F11-DD99-226D-B58F', 'not_registered', '2024-10-19 07:25:34', 'hello', 0, NULL, '2024-11-18 07:25:34', 0, 0, NULL, 1, '2024-10-19 08:20:08p', NULL, '2024-10-19'),
(5150, 'SARTHAK', 'SARTHAK', 'SARTHAK', 0, 1, 'D691-D50E-D805-8F90-BF14-27C1-9279-5731', 'not_registered', '2024-10-19 08:24:40', 'hello', 0, NULL, '2024-11-18 08:24:40', 0, 0, NULL, 1, '2024-10-20 08:48:25a', NULL, '2024-10-19'),
(5152, 'ENJSELAR', 'ALIZA', 'ALIZA', 0, 1, '77E8-071E-7501-0ECA-0BDA-33A4-F758-6723', 'not_registered', '2024-10-20 10:28:06', 'hello', 0, NULL, '2024-11-19 10:28:06', 0, 0, NULL, 1, '2024-10-20 10:46:17p', NULL, '2024-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `detailsip`
--

CREATE TABLE `detailsip` (
  `detusr_id` int(255) NOT NULL,
  `detsuper_key` varchar(1000) NOT NULL,
  `detusr_key` varchar(1000) NOT NULL,
  `detusr_name` varchar(1000) NOT NULL,
  `detusr_ip` varchar(1000) NOT NULL,
  `detusr_port` varchar(1000) NOT NULL,
  `detusr_pass` varchar(1000) NOT NULL,
  `sell_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detailsip`
--

INSERT INTO `detailsip` (`detusr_id`, `detsuper_key`, `detusr_key`, `detusr_name`, `detusr_ip`, `detusr_port`, `detusr_pass`, `sell_id`) VALUES
(162, 'MKKING', 'JAANHAI', 'awsindia', '45.112.173.243', '59100', 'proxyindia', 0),
(164, 'MRALI1', 'MRALI2W', 'baba32', '172.232.102.31', '3128', 'baba32', 0),
(165, 'MRALI1', 'MRALI2W', 'baba34', '172.235.18.123', '3128', 'baba34', 0),
(166, 'MRALI1', 'MRALI2W', 'nas72', '172.236.72.64', '3128', 'nas72', 0),
(170, 'AKBARBHAI8', 'ASLAM6393', 'tk1agil9', '500028.i06e4644461013c033.rizzen.org', '55000', '257q7ecl', 0),
(172, 'HACK57', 'ABC118', 'Abc12-zone-resi-region-in', 'btsee73548714e00.cud.as.pyproxy.io', '16666', 'Abc12', 0),
(175, 'AFRIDIBRO', 'KASHIF12', 'tdvgeibr', '45.151.162.198', '6600', '0bzw140zscbx', 0),
(180, 'MAHEK', 'PIHU12', 'pihu', '43.250.254.30', '3128', 'pihu', 0),
(182, 'ENJOY', '6208', '5ehorn14', '43.205.186.192', '10000', 'Q8T3RNgs', 0),
(183, 'ENJOY', '6208', 'boss252proxy77', '103.242.117.105', '8000', 'hxjTPn7g', 0),
(184, 'ENJOY', '6208', '1AnK4d1q', '45.140.4.72', '63438', 'XmCrccye', 0),
(197, 'RENUS', 'FDGFDG', 'renu', '43.204.24.44', '3128', 'renu', 0),
(198, 'R1R2R5', 'RT', 'hghfghhgfgfgfgfg-zone-resi-region-in', 'btshl60702112m99.yto.na.pyproxy.io', '16666', 'gfgfgfgfgfgfgfttrrtrtrttrtrrt', 0),
(204, 'SONU', 'RAHAM199', 'awsindia', '45.112.173.243', '59100', 'proxyindia', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mini_admin`
--

CREATE TABLE `mini_admin` (
  `mini_id` int(11) NOT NULL,
  `mini_username` varchar(50) NOT NULL,
  `mini_admin_id` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `registration` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activated` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mini_admin`
--

INSERT INTO `mini_admin` (`mini_id`, `mini_username`, `mini_admin_id`, `password`, `registration`, `expiry_date`, `activated`, `status`, `payment`, `admin_id`) VALUES
(32, 'SONU', 'SONU', 'jgcf7cfdde9db36af8e0d9a6d123d5c385e', '2024-10-19 14:48:21', '2024-07-25 02:39:26', 0, 0, 11, 1),
(33, 'ENJOY', 'ENJADMIN', 'jgc72abe12121ca64627043d3de49fa1e46', '2024-10-10 04:50:44', '2024-07-29 12:34:33', 0, 0, 5, 1),
(34, 'SKTBRO', 'SKTADMIN', 'jgc2a6b0af69cfd9525476df175cc1c989e', '2024-10-18 04:06:05', '2024-07-29 12:39:57', 0, 0, 45, 1),
(54, 'RANJANMS', 'RANJANMS', 'jgc4e96027aa1343c074050558e39ba618d', '2024-10-16 05:15:15', '2024-10-08 12:10:34', 0, 0, 0, 1),
(56, 'SHAKTIMASTER', 'SHAKTIMASTER', 'jgc32f3c8a6595f39e1dcf5b0f53f5cbd87', '2024-10-17 03:31:30', '2024-10-08 04:19:28', 0, 0, 9, 1),
(59, 'JUMBO', 'JUMBO', 'jgcad13fcfd1163f3aed2f8f62f790833c4', '2024-10-02 04:02:50', '2024-10-16 10:34:54', 0, 0, 0, 1),
(64, 'SURYABHAI', 'SURYAMSTR', 'jgc7caf0ff621808365ac2883cfe1d1c811', '2024-10-01 08:47:35', '2024-10-31 08:47:35', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `nn` int(11) NOT NULL,
  `home_news` varchar(1000) NOT NULL,
  `super_news` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pnr`
--

CREATE TABLE `pnr` (
  `pno` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `train` varchar(200) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `pnr` varchar(20) NOT NULL,
  `identity` varchar(10) NOT NULL,
  `smalliden` varchar(100) NOT NULL,
  `time` varchar(10) NOT NULL,
  `timestampofpnr` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `software`
--

CREATE TABLE `software` (
  `sn` int(11) NOT NULL,
  `soft_news` varchar(1000) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soft_news`
--

CREATE TABLE `soft_news` (
  `nno` int(11) NOT NULL,
  `news` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `soft_news`
--

INSERT INTO `soft_news` (`nno`, `news`) VALUES
(1, ''),
(6, 'Hi, Welcome All ADMIN !'),
(2, 'Hello Seller..Congratulations:- Aaj Ke Din Aap Ka Price..800 Par Id Ho Gaya Hai........Offers:- Seller Me 2 Key Paid Karne Par 1 Credit Seller Panel Direct Developer Gift Milega...Seller Panel Se Gift Credit Se Kisi Vi Key Ko Direct Paid Kar Sakte Hai...And Jis Seller Panel Me 5 Key Running Rahega Usko 365 Day Ka Key Free Me Active Kar Diya Jayega...'),
(3, 'Hello Super.. Congratulations:- Aaj ke din aap ka Price...700 Par ID ho gaya hai!!!'),
(4, 'Hello Master Admin...Congratulations, aaj ke din aap ka Price 500 Par ID ho gaya hai!!!'),
(5, 'Hello Admin...Congratulations, aaj ke din aap ka Price 600 Par ID ho gaya hai!!!');

-- --------------------------------------------------------

--
-- Table structure for table `sub_admin`
--

CREATE TABLE `sub_admin` (
  `san` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `sub_admin_id` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `registration` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activated` int(255) NOT NULL,
  `status` int(11) NOT NULL,
  `paid_button` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `mini_admin_id` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `sub_admin`
--

INSERT INTO `sub_admin` (`san`, `username`, `sub_admin_id`, `password`, `registration`, `expiry_date`, `activated`, `status`, `paid_button`, `payment`, `admin_id`, `mini_admin_id`) VALUES
(133, 'ENJMIMIN', 'ENJMIMIN', 'jgcd6c228fb58c030ed6d892740a6776791', '2024-10-10 04:51:04', '2024-07-29 03:22:06', 0, 0, 0, 0, 0, 33),
(132, 'SONU', 'SONU', 'jgcf7cfdde9db36af8e0d9a6d123d5c385e', '2024-10-19 14:49:22', '2024-07-25 02:40:41', 0, 0, 0, 6, 0, 32),
(228, 'HANUMAN108', 'HANUMAN108', 'jgc098903a575bb886227c8904b894f0437', '2024-10-17 03:32:37', '2024-11-16 08:56:11', 0, 0, 1, 0, 0, 56),
(200, 'YASHBHAI', 'YASHBHAI', 'jgc86d5768f0660019bbea0aca83d6ab8e4', '2024-10-12 15:24:35', '2024-10-07 08:33:33', 0, 0, 0, 0, 0, 32),
(215, 'ADMINJUMBO', 'ADMINJUMBO', 'jgcb58153f1295469303c4cbbb4da770b0e', '2024-10-02 04:02:12', '2024-10-16 10:37:02', 0, 0, 0, 9, 0, 59),
(227, 'ROHAN', 'ROHANBHAI', 'jgcfc7ca5bc0f0bc0e377db4328153a7b5d', '2024-10-09 08:28:51', '2024-11-08 08:28:51', 0, 0, 1, 0, 0, 32),
(208, 'RAJESH5522', 'RAJESH5522', 'jgce0f2e2660c5e405e635dcce14ebfd5c4', '2024-10-16 05:15:44', '2024-10-09 09:23:39', 0, 0, 0, 0, 0, 54),
(183, 'SKT', 'SKTMINI', 'jgc3b712de48137572f3849aabd5666a4e3', '2024-08-24 03:24:49', '2024-09-01 10:32:46', 0, 0, 0, 0, 0, 34),
(191, 'SHAKTIMANADN', 'SHAKTIMANADN', 'jgc0a078a9c6399348c6be68e91e084be8b', '2024-09-09 07:41:07', '2024-10-05 02:46:32', 0, 0, 0, 0, 0, 32);

-- --------------------------------------------------------

--
-- Table structure for table `super`
--

CREATE TABLE `super` (
  `sn` int(11) NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `s_id` varchar(50) NOT NULL,
  `payment` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `sub_admin_id` int(255) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `registration` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expire_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `miniadmin_id` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `super`
--

INSERT INTO `super` (`sn`, `admin_name`, `name`, `password`, `s_id`, `payment`, `status`, `sub_admin_id`, `admin_id`, `registration`, `expire_date`, `miniadmin_id`) VALUES
(261, 'ENJMIMIN', 'ENJSUPAR', 'jgc2fe124f1f66cb641e32aafb1f0d445bd', 'ENJSUPAR', 3, 0, 133, 0, '2024-10-20 17:16:17', '2024-07-29 03:23:25', 0),
(260, 'SONU', 'SONU', 'jgcf7cfdde9db36af8e0d9a6d123d5c385e', 'SONU', 3, 0, 132, 0, '2024-10-08 04:13:23', '2024-07-25 02:41:12', 0),
(377, 'ADMINJUMBO', 'SUPER2', 'jgcd0474defb591959fa30a7fc02cae502c', 'SUPER2', 0, 0, 215, 0, '2024-09-16 10:38:43', '2024-10-16 10:38:43', 0),
(370, 'RAJESH5522', 'SHURAKG552', 'jgc09e9b2ea71d4ae865d73e791c7cdaea0', 'SHURAKG552', 4, 0, 208, 0, '2024-10-16 05:18:51', '2024-10-09 09:24:01', 0),
(374, 'SONU', 'AHAMED', 'jgccd8c69e07a3d9212bf780829e7a27ccf', 'AHAMEDSP', 1, 0, 132, 0, '2024-09-13 10:56:37', '2024-10-10 08:30:39', 0),
(360, 'SONU', 'MKBHAI', 'jgc2738b5d6ad8023e9c729e9f92477859a', 'MKBHAI', 4, 0, 132, 0, '2024-10-19 14:50:08', '2024-10-08 03:03:35', 0),
(391, 'SONU', 'RN', 'jgc1aa142ae6595bb3247ac51fb07d7155b', 'RNSUPER', 5, 0, 132, 0, '2024-10-17 03:09:59', '2024-11-16 08:37:50', 0),
(392, 'HANUMAN108', 'SATYAJEET1', 'jgcc924514711d599ec4c2b8ec505de11f7', 'SATYAJEET1', 0, 0, 228, 0, '2024-10-17 03:33:03', '2024-11-16 08:57:32', 0),
(346, 'SONU', 'PATEL', 'jgc782a2d56bd5a1cc389ff3148d11afe72', 'PATEL', 0, 0, 132, 0, '2024-09-06 03:46:19', '2024-10-06 03:46:19', 0),
(347, 'SONU', 'RAGHWSUP', 'jgc13224daf9e28dee5d9b44095f2559c42', 'RAGHWSUP', 0, 0, 132, 0, '2024-09-06 03:47:40', '2024-10-06 03:47:40', 0),
(324, 'SKTMINI', 'SKT', 'jgc3b712de48137572f3849aabd5666a4e3', 'SKTSUPER', 0, 0, 183, 0, '2024-08-31 06:51:57', '2024-09-01 10:33:25', 0),
(353, 'YASHBHAI', 'LAST', 'jgca5f3c6a11b03839d46af9fb43c97c188', 'LAST', 0, 0, 200, 0, '2024-10-13 16:17:08', '2024-10-07 08:39:37', 0),
(338, 'SONU', 'YASH', 'jgcb040a82ff9acdc50fa7f8590b7499316', 'YASH', 0, 0, 132, 0, '2024-09-05 07:33:58', '2024-10-05 07:33:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `SL` bigint(20) UNSIGNED NOT NULL,
  `UserID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Mac` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Log` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Src_Dest` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `TrainNo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Gateway` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `base64image` blob NOT NULL,
  `PNR_Time` datetime NOT NULL,
  `Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets2`
--

CREATE TABLE `tickets2` (
  `SL` bigint(20) UNSIGNED NOT NULL,
  `Bank` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Trainno` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Cls` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Quota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `From` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `To` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Jdate` date DEFAULT NULL,
  `Pnrtime` time DEFAULT NULL,
  `Pnr` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Irctcid` varchar(100) NOT NULL,
  `Slot` varchar(100) NOT NULL,
  `Key` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Seller` varchar(100) NOT NULL,
  `Totalpassenger` varchar(100) NOT NULL,
  `ticketId` varchar(100) NOT NULL,
  `Today` date NOT NULL DEFAULT current_timestamp(),
  `pnrtime2` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets3`
--

CREATE TABLE `tickets3` (
  `ID` int(11) NOT NULL,
  `SrcDest` text DEFAULT NULL,
  `TrainNo` text NOT NULL,
  `PayMode` text NOT NULL,
  `Macid` text DEFAULT NULL,
  `userid` text NOT NULL,
  `ip` text DEFAULT NULL,
  `tDate` date NOT NULL,
  `pnr` text DEFAULT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets3`
--

INSERT INTO `tickets3` (`ID`, `SrcDest`, `TrainNo`, `PayMode`, `Macid`, `userid`, `ip`, `tDate`, `pnr`, `img`) VALUES
(5564, 'LTT_PCOI', '13202', 'PHONEPE_IRCTC', '7C156047', 'RAM991882', '', '2023-12-11', '', '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');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_log`
--

CREATE TABLE `transaction_log` (
  `transaction_id` int(11) NOT NULL,
  `transaction_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_by` varchar(20) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `sn` int(11) NOT NULL,
  `super_name` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `p_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `user_credit` int(11) NOT NULL,
  `super_id` int(255) NOT NULL,
  `registration` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expire-date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`sn`, `super_name`, `name`, `p_id`, `password`, `status`, `user_credit`, `super_id`, `registration`, `expire-date`) VALUES
(424, 'ENJSUPAR', 'ENJSELAR', 'ENJSELAR', 'jgc321b743281e0d88d34a1058c150c72d3', 0, 0, 261, '2024-08-31 06:32:53', '2024-07-29 03:24:37'),
(423, 'SONU', 'SONU', 'SONU', 'jgcf7cfdde9db36af8e0d9a6d123d5c385e', 0, 0, 260, '2024-10-13 08:21:24', '2024-07-25 02:41:31'),
(653, 'SUPER2', 'MHHUNTER', 'MHHUNTER', 'jgc3bc96169f18fbe376abf8beea6b35314', 0, 0, 377, '2024-09-16 10:39:23', '2024-10-16 10:39:23'),
(637, 'SHURAKG552', 'ANILL5522', 'ANILL5522', 'jgc33d46af8a8163868b5f691ed64d4bea7', 0, 0, 370, '2024-09-09 09:24:35', '2024-10-09 09:24:35'),
(638, 'MKBHAI', 'MKBHAI', 'MKBHAI', 'jgcf5997ae4144a62665d70c93989f14f9f', 1, 0, 360, '2024-10-19 06:07:53', '2024-10-09 09:33:31'),
(630, 'MKBHAI', 'MAHEK', 'MAHEK', 'jgc1a3650aedfdd3a21444047ed2d89458f', 0, 0, 360, '2024-10-12 08:56:03', '2024-10-09 08:17:15'),
(667, 'LAST', 'KING', 'KING', 'jgc123b28961dd0f97d91bcb55d7a3b7c1c', 0, 0, 353, '2024-10-13 16:16:03', '2024-10-31 01:08:22'),
(610, 'ENJSUPAR', 'ENJOY', 'ENJOY', 'jgcd0970714757783e6cf17b26fb8e2298f', 0, 0, 261, '2024-10-06 18:09:41', '2024-10-08 02:33:40'),
(608, 'SONU', 'HABIBTS', 'HABIBTS', 'jgcee44a8083eaaf1178b72f23e6e7ad0aa', 0, 0, 260, '2024-09-09 02:52:05', '2024-10-08 12:16:21'),
(607, 'PATEL', 'HUNTAR', 'HUNTAR1', 'jgc0121c85589fec032a3128e716dce1299', 0, 0, 346, '2024-09-08 06:36:09', '2024-10-08 12:04:49'),
(557, 'SKTSUPER', 'SKTSELLER', 'SKYSELLER', 'jgc3b712de48137572f3849aabd5666a4e3', 0, 0, 324, '2024-08-02 10:33:48', '2024-09-01 10:33:48'),
(576, 'SHAKTISUPER', 'SHAKTISELLER', 'SHAKTISELLER', 'jgccb04d4522a88a1ebf6f384875bd2c536', 0, 0, 341, '2024-10-02 07:47:43', '2024-10-05 10:07:53'),
(677, 'MKBHAI', 'SARTHAK', 'SARTHAK', 'jgc7d55ef0cca401241b37568ccf404f072', 0, 0, 360, '2024-10-20 03:18:25', '2024-11-18 11:40:13'),
(674, 'SATYAJEET1', 'SATYAJEET2', 'SATYAJEET2', 'jgcc924514711d599ec4c2b8ec505de11f7', 0, 0, 392, '2024-10-17 08:58:19', '2024-11-16 08:58:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`an`);

--
-- Indexes for table `credit_log`
--
ALTER TABLE `credit_log`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `demoswitch`
--
ALTER TABLE `demoswitch`
  ADD PRIMARY KEY (`switch_id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `detailsip`
--
ALTER TABLE `detailsip`
  ADD PRIMARY KEY (`detusr_id`);

--
-- Indexes for table `mini_admin`
--
ALTER TABLE `mini_admin`
  ADD PRIMARY KEY (`mini_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`nn`);

--
-- Indexes for table `pnr`
--
ALTER TABLE `pnr`
  ADD PRIMARY KEY (`pno`);

--
-- Indexes for table `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `soft_news`
--
ALTER TABLE `soft_news`
  ADD PRIMARY KEY (`nno`);

--
-- Indexes for table `sub_admin`
--
ALTER TABLE `sub_admin`
  ADD PRIMARY KEY (`san`);

--
-- Indexes for table `super`
--
ALTER TABLE `super`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `s_id` (`s_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD UNIQUE KEY `SL` (`SL`);

--
-- Indexes for table `tickets2`
--
ALTER TABLE `tickets2`
  ADD PRIMARY KEY (`SL`);

--
-- Indexes for table `tickets3`
--
ALTER TABLE `tickets3`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `p_id` (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `an` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `credit_log`
--
ALTER TABLE `credit_log`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6626;

--
-- AUTO_INCREMENT for table `demoswitch`
--
ALTER TABLE `demoswitch`
  MODIFY `switch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5153;

--
-- AUTO_INCREMENT for table `detailsip`
--
ALTER TABLE `detailsip`
  MODIFY `detusr_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `mini_admin`
--
ALTER TABLE `mini_admin`
  MODIFY `mini_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `nn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pnr`
--
ALTER TABLE `pnr`
  MODIFY `pno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soft_news`
--
ALTER TABLE `soft_news`
  MODIFY `nno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_admin`
--
ALTER TABLE `sub_admin`
  MODIFY `san` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `super`
--
ALTER TABLE `super`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `SL` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43610;

--
-- AUTO_INCREMENT for table `tickets2`
--
ALTER TABLE `tickets2`
  MODIFY `SL` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=649;

--
-- AUTO_INCREMENT for table `tickets3`
--
ALTER TABLE `tickets3`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5585;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=678;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
