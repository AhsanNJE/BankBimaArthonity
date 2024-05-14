-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2024 at 01:58 PM
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
-- Database: `bankbima`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Shagufta', 'ssajid3421@gmail.com', NULL, '$2y$12$DeM0dVTN9i84n/yJHd1chuKYia/ih4rCm33jdH1WZBKWPwazTW.62', 0, '2024-05-08 23:26:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendences`
--

CREATE TABLE `attendences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `in` time DEFAULT NULL,
  `out` time DEFAULT NULL,
  `attend_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendences`
--

INSERT INTO `attendences` (`id`, `employee_id`, `date`, `in`, `out`, `attend_status`, `entry_at`, `updated_at`) VALUES
(3, 1, '2024-04-04', '12:36:00', '21:40:00', 'present', '2024-05-09 06:34:31', NULL),
(4, 2, '2024-04-04', NULL, NULL, 'Absent', '2024-05-09 06:34:32', NULL),
(5, 1, '2024-05-09', '12:36:00', '00:36:00', 'present', '2024-05-09 06:36:22', NULL),
(6, 2, '2024-05-09', NULL, NULL, 'Leave', '2024-05-09 06:36:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department__infos`
--

CREATE TABLE `department__infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dept_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department__infos`
--

INSERT INTO `department__infos` (`id`, `dept_name`, `added_at`, `updated_at`) VALUES
(1, 'Accounts', '2024-05-08 09:01:59', '2024-05-12 02:02:40'),
(2, 'Editor', '2024-05-08 09:01:59', NULL),
(3, 'Marketing', '2024-05-08 09:01:59', NULL),
(4, 'Worker', '2024-05-08 09:01:59', NULL),
(5, 'Reporter', '2024-05-08 09:01:59', NULL),
(6, 'Printing', '2024-05-08 09:01:59', NULL),
(7, 'Admin', '2024-05-12 08:02:46', NULL),
(8, 'Sales', '2024-05-12 08:02:52', '2024-05-12 02:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_id` bigint(20) UNSIGNED NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation`, `dept_id`, `added_at`, `updated_at`) VALUES
(1, 'Chief Accountant', 1, '2024-05-08 09:01:59', NULL),
(2, 'Junior Accountant', 1, '2024-05-08 09:01:59', NULL),
(3, 'Junior Editor', 2, '2024-05-08 09:01:59', NULL),
(4, 'Chief Editor', 2, '2024-05-08 09:01:59', NULL),
(5, 'Marketing Chief', 3, '2024-05-08 09:01:59', NULL),
(6, 'Freelencer', 3, '2024-05-08 09:01:59', NULL),
(7, 'Cleaner', 4, '2024-05-08 09:01:59', NULL),
(8, 'Junior Reporter', 5, '2024-05-08 09:01:59', NULL),
(9, 'Chief Reporter', 5, '2024-05-08 09:01:59', NULL),
(10, 'Admin Manager', 7, '2024-05-12 08:03:54', NULL),
(11, 'HR Manager', 7, '2024-05-12 08:04:02', NULL),
(12, 'Assistant Admin Manager', 7, '2024-05-12 08:04:19', NULL),
(13, 'Jr. Salesman', 8, '2024-05-12 08:05:10', '2024-05-12 02:05:19'),
(14, 'Sales Manager', 8, '2024-05-12 08:05:30', NULL),
(15, 'Sr. Salesman', 8, '2024-05-12 08:05:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `education_details`
--

CREATE TABLE `education_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_of_education` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institution_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scale` decimal(8,2) DEFAULT NULL,
  `cgpa` decimal(8,2) DEFAULT NULL,
  `batch` int(11) DEFAULT NULL,
  `passing_year` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 for Active 0 for Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education_details`
--

INSERT INTO `education_details` (`id`, `emp_id`, `level_of_education`, `degree_title`, `group`, `institution_name`, `result`, `scale`, `cgpa`, `batch`, `passing_year`, `status`, `created_at`, `updated_at`) VALUES
(5, 'E000000102', 'SSC', 'Secondary School Certificate', 'Science', 'IPSC', 'Grade', '5.00', '4.99', 2017, 2017, 1, '2024-05-09 00:26:09', '2024-05-09 00:26:09'),
(6, 'E000000102', 'HSC', 'Higher School Certificate', 'Science', 'IPSC', 'Grade', '5.00', '4.90', NULL, 2019, 1, '2024-05-09 00:26:09', '2024-05-09 00:26:09'),
(7, 'E000000102', 'BA', 'Bachelor of Administration', NULL, 'Sher e bangla', NULL, '4.00', '3.33', NULL, 2025, 1, '2024-05-09 00:26:10', '2024-05-09 00:26:10'),
(9, 'E000000101', 'SSC', 'Secondary School Certificate', 'Science', 'IPSC', 'Grade', '5.00', '4.99', 2017, 2017, 1, '2024-05-09 01:00:02', '2024-05-09 01:00:02'),
(10, 'E000000101', 'HSC', 'Higher School Certificate', 'Science', 'IPSC', 'Grade', '5.00', '4.90', NULL, 2019, 1, '2024-05-09 01:00:02', '2024-05-09 01:00:02'),
(11, 'E000000101', 'BSc.', 'Bachelor of Science', NULL, 'UIU', NULL, '4.00', '3.33', NULL, 2025, 1, '2024-05-09 01:00:03', '2024-05-09 01:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `experience_details`
--

CREATE TABLE `experience_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 for Active 0 for Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience_details`
--

INSERT INTO `experience_details` (`id`, `emp_id`, `company_name`, `designation`, `department`, `company_location`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(36, 'E000000102', 'Kinder Garten School', 'Lecturer', 'Math', 'Mirpur', NULL, NULL, 1, '2024-05-09 06:12:08', NULL),
(37, 'E000000102', 'Agriculture', 'Cleaner', 'Worker', 'Gulshan', NULL, NULL, 1, '2024-05-09 06:12:08', NULL),
(40, 'E000000101', 'Agriculture', 'Cleaner', 'Worker', 'Mirpur', NULL, NULL, 1, '2024-05-09 06:15:10', NULL),
(41, 'E000000101', 'Automation Ltd.', 'Tester', 'Testing', 'Dhaka', NULL, NULL, 1, '2024-05-09 06:15:10', NULL),
(42, 'E000000101', 'Kinder Garten School', 'Lecturer', 'Math', 'Gulshan', NULL, NULL, 1, '2024-05-09 06:15:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location__infos`
--

CREATE TABLE `location__infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upazila` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location__infos`
--

INSERT INTO `location__infos` (`id`, `division`, `district`, `upazila`, `added_at`, `updated_at`) VALUES
(1, 'Barishal Division', 'Barguna', 'Amtali', '2024-05-08 09:01:58', NULL),
(2, 'Barishal Division', 'Barguna', 'Bamna', '2024-05-08 09:01:58', NULL),
(3, 'Barishal Division', 'Barguna', 'Barguna Sadar', '2024-05-08 09:01:58', NULL),
(4, 'Barishal Division', 'Barguna', 'Betagi', '2024-05-08 09:01:58', NULL),
(5, 'Barishal Division', 'Barguna', 'Patharghata', '2024-05-08 09:01:58', NULL),
(6, 'Barishal Division', 'Barguna', 'Taltali', '2024-05-08 09:01:58', NULL),
(7, 'Barishal Division', 'Barishal', 'Agailjhara', '2024-05-08 09:01:58', NULL),
(8, 'Barishal Division', 'Barishal', 'Babuganj', '2024-05-08 09:01:58', NULL),
(9, 'Barishal Division', 'Barishal', 'Bakerganj', '2024-05-08 09:01:58', NULL),
(10, 'Barishal Division', 'Barishal', 'Banaripara', '2024-05-08 09:01:58', NULL),
(11, 'Barishal Division', 'Barishal', 'Barishal Sadar', '2024-05-08 09:01:58', NULL),
(12, 'Barishal Division', 'Barishal', 'Gouranadi', '2024-05-08 09:01:58', NULL),
(13, 'Barishal Division', 'Barishal', 'Hizla', '2024-05-08 09:01:58', NULL),
(14, 'Barishal Division', 'Barishal', 'Mehendiganj', '2024-05-08 09:01:58', NULL),
(15, 'Barishal Division', 'Barishal', 'Muladi', '2024-05-08 09:01:58', NULL),
(16, 'Barishal Division', 'Barishal', 'Wazirpur', '2024-05-08 09:01:58', NULL),
(17, 'Barishal Division', 'Bhola', 'Bhola Sadar', '2024-05-08 09:01:58', NULL),
(18, 'Barishal Division', 'Bhola', 'Burhanuddin', '2024-05-08 09:01:58', NULL),
(19, 'Barishal Division', 'Bhola', 'Charfassion', '2024-05-08 09:01:58', NULL),
(20, 'Barishal Division', 'Bhola', 'Daulatkhan', '2024-05-08 09:01:58', NULL),
(21, 'Barishal Division', 'Bhola', 'Lalmohan', '2024-05-08 09:01:58', NULL),
(22, 'Barishal Division', 'Bhola', 'Monpura', '2024-05-08 09:01:58', NULL),
(23, 'Barishal Division', 'Bhola', 'Tazumuddin', '2024-05-08 09:01:58', NULL),
(24, 'Barishal Division', 'Jhalokathi', 'Jhalokathi Sadar', '2024-05-08 09:01:58', NULL),
(25, 'Barishal Division', 'Jhalokathi', 'Kathalia', '2024-05-08 09:01:58', NULL),
(26, 'Barishal Division', 'Jhalokathi', 'Nalchity', '2024-05-08 09:01:58', NULL),
(27, 'Barishal Division', 'Jhalokathi', 'Rajapur', '2024-05-08 09:01:58', NULL),
(28, 'Barishal Division', 'Patuakhali', 'Bauphal', '2024-05-08 09:01:58', NULL),
(29, 'Barishal Division', 'Patuakhali', 'Dashmina', '2024-05-08 09:01:58', NULL),
(30, 'Barishal Division', 'Patuakhali', 'Dumki', '2024-05-08 09:01:58', NULL),
(31, 'Barishal Division', 'Patuakhali', 'Galachipa', '2024-05-08 09:01:58', NULL),
(32, 'Barishal Division', 'Patuakhali', 'Kalapara', '2024-05-08 09:01:58', NULL),
(33, 'Barishal Division', 'Patuakhali', 'Mirjaganj', '2024-05-08 09:01:58', NULL),
(34, 'Barishal Division', 'Patuakhali', 'Patuakhali Sadar', '2024-05-08 09:01:58', NULL),
(35, 'Barishal Division', 'Patuakhali', 'Rangabali', '2024-05-08 09:01:58', NULL),
(36, 'Barishal Division', 'Pirojpur', 'Bhandaria', '2024-05-08 09:01:58', NULL),
(37, 'Barishal Division', 'Pirojpur', 'Kawkhali', '2024-05-08 09:01:58', NULL),
(38, 'Barishal Division', 'Pirojpur', 'Mathbaria', '2024-05-08 09:01:58', NULL),
(39, 'Barishal Division', 'Pirojpur', 'Nazirpur', '2024-05-08 09:01:58', NULL),
(40, 'Barishal Division', 'Pirojpur', 'Nesarabad', '2024-05-08 09:01:58', NULL),
(41, 'Barishal Division', 'Pirojpur', 'Pirojpur Sadar', '2024-05-08 09:01:58', NULL),
(42, 'Barishal Division', 'Pirojpur', 'Zianagar/Indurkani', '2024-05-08 09:01:58', NULL),
(43, 'Chattogram Division', 'Brahmanbaria', 'Akhaura', '2024-05-08 09:01:58', NULL),
(44, 'Chattogram Division', 'Brahmanbaria', 'Ashuganj', '2024-05-08 09:01:58', NULL),
(45, 'Chattogram Division', 'Brahmanbaria', 'Brahmanbaria Sadar', '2024-05-08 09:01:58', NULL),
(46, 'Chattogram Division', 'Brahmanbaria', 'Bancharampur', '2024-05-08 09:01:58', NULL),
(47, 'Chattogram Division', 'Brahmanbaria', 'Bijoynagar', '2024-05-08 09:01:58', NULL),
(48, 'Chattogram Division', 'Brahmanbaria', 'Kasba', '2024-05-08 09:01:58', NULL),
(49, 'Chattogram Division', 'Brahmanbaria', 'Nabinagar', '2024-05-08 09:01:58', NULL),
(50, 'Chattogram Division', 'Brahmanbaria', 'Nasirnagar', '2024-05-08 09:01:58', NULL),
(51, 'Chattogram Division', 'Brahmanbaria', 'Sarail', '2024-05-08 09:01:58', NULL),
(52, 'Chattogram Division', 'Bandarban', 'Alikadam', '2024-05-08 09:01:58', NULL),
(53, 'Chattogram Division', 'Bandarban', 'Bandarban Sadar', '2024-05-08 09:01:58', NULL),
(54, 'Chattogram Division', 'Bandarban', 'Lama', '2024-05-08 09:01:58', NULL),
(55, 'Chattogram Division', 'Bandarban', 'Naikhyongchari', '2024-05-08 09:01:58', NULL),
(56, 'Chattogram Division', 'Bandarban', 'Rowangchari', '2024-05-08 09:01:58', NULL),
(57, 'Chattogram Division', 'Bandarban', 'Ruma', '2024-05-08 09:01:58', NULL),
(58, 'Chattogram Division', 'Bandarban', 'Thanchi', '2024-05-08 09:01:58', NULL),
(59, 'Chattogram Division', 'Chandpur', 'Chandpur Sadar', '2024-05-08 09:01:58', NULL),
(60, 'Chattogram Division', 'Chandpur', 'Faridganj', '2024-05-08 09:01:58', NULL),
(61, 'Chattogram Division', 'Chandpur', 'Haimchar', '2024-05-08 09:01:58', NULL),
(62, 'Chattogram Division', 'Chandpur', 'Haziganj', '2024-05-08 09:01:58', NULL),
(63, 'Chattogram Division', 'Chandpur', 'Kachua', '2024-05-08 09:01:58', NULL),
(64, 'Chattogram Division', 'Chandpur', 'Matlab (Dakshin)', '2024-05-08 09:01:58', NULL),
(65, 'Chattogram Division', 'Chandpur', 'Matlab (Uttar)', '2024-05-08 09:01:58', NULL),
(66, 'Chattogram Division', 'Chandpur', 'Shahrasti', '2024-05-08 09:01:58', NULL),
(67, 'Chattogram Division', 'Chattogram', 'Anwara', '2024-05-08 09:01:58', NULL),
(68, 'Chattogram Division', 'Chattogram', 'Banskhali', '2024-05-08 09:01:58', NULL),
(69, 'Chattogram Division', 'Chattogram', 'Boalkhali', '2024-05-08 09:01:58', NULL),
(70, 'Chattogram Division', 'Chattogram', 'Chandanish', '2024-05-08 09:01:58', NULL),
(71, 'Chattogram Division', 'Chattogram', 'Fatikchari', '2024-05-08 09:01:58', NULL),
(72, 'Chattogram Division', 'Chattogram', 'Hathazari', '2024-05-08 09:01:58', NULL),
(73, 'Chattogram Division', 'Chattogram', 'Karnaphuli', '2024-05-08 09:01:58', NULL),
(74, 'Chattogram Division', 'Chattogram', 'Lohagara', '2024-05-08 09:01:58', NULL),
(75, 'Chattogram Division', 'Chattogram', 'Mirsharai', '2024-05-08 09:01:58', NULL),
(76, 'Chattogram Division', 'Chattogram', 'Patiya', '2024-05-08 09:01:58', NULL),
(77, 'Chattogram Division', 'Chattogram', 'Rangunia', '2024-05-08 09:01:58', NULL),
(78, 'Chattogram Division', 'Chattogram', 'Raojan', '2024-05-08 09:01:58', NULL),
(79, 'Chattogram Division', 'Chattogram', 'Sandwip', '2024-05-08 09:01:58', NULL),
(80, 'Chattogram Division', 'Chattogram', 'Satkania', '2024-05-08 09:01:58', NULL),
(81, 'Chattogram Division', 'Chattogram', 'Sitakunda', '2024-05-08 09:01:58', NULL),
(82, 'Chattogram Division', 'Cox\'s Bazar', 'Cox\'s Bazar Sadar', '2024-05-08 09:01:58', NULL),
(83, 'Chattogram Division', 'Cox\'s Bazar', 'Chakaria', '2024-05-08 09:01:58', NULL),
(84, 'Chattogram Division', 'Cox\'s Bazar', 'Eidgaon', '2024-05-08 09:01:58', NULL),
(85, 'Chattogram Division', 'Cox\'s Bazar', 'Kutubdia', '2024-05-08 09:01:58', NULL),
(86, 'Chattogram Division', 'Cox\'s Bazar', 'Moheskhali', '2024-05-08 09:01:58', NULL),
(87, 'Chattogram Division', 'Cox\'s Bazar', 'Pekua', '2024-05-08 09:01:58', NULL),
(88, 'Chattogram Division', 'Cox\'s Bazar', 'Ramu', '2024-05-08 09:01:58', NULL),
(89, 'Chattogram Division', 'Cox\'s Bazar', 'Teknaf', '2024-05-08 09:01:58', NULL),
(90, 'Chattogram Division', 'Cox\'s Bazar', 'Ukhiya', '2024-05-08 09:01:58', NULL),
(91, 'Chattogram Division', 'Cumilla', 'Barura', '2024-05-08 09:01:58', NULL),
(92, 'Chattogram Division', 'Cumilla', 'Brahmanpara', '2024-05-08 09:01:58', NULL),
(93, 'Chattogram Division', 'Cumilla', 'Burichong', '2024-05-08 09:01:58', NULL),
(94, 'Chattogram Division', 'Cumilla', 'Chandina', '2024-05-08 09:01:58', NULL),
(95, 'Chattogram Division', 'Cumilla', 'Chouddagram', '2024-05-08 09:01:58', NULL),
(96, 'Chattogram Division', 'Cumilla', 'Cumilla Sadar', '2024-05-08 09:01:58', NULL),
(97, 'Chattogram Division', 'Cumilla', 'Cumilla Sadar Daksin', '2024-05-08 09:01:58', NULL),
(98, 'Chattogram Division', 'Cumilla', 'Daudkandi', '2024-05-08 09:01:58', NULL),
(99, 'Chattogram Division', 'Cumilla', 'Debidwar', '2024-05-08 09:01:58', NULL),
(100, 'Chattogram Division', 'Cumilla', 'Homna', '2024-05-08 09:01:59', NULL),
(101, 'Chattogram Division', 'Cumilla', 'Laksham', '2024-05-08 09:01:59', NULL),
(102, 'Chattogram Division', 'Cumilla', 'Lalmai', '2024-05-08 09:01:59', NULL),
(103, 'Chattogram Division', 'Cumilla', 'Meghna', '2024-05-08 09:01:59', NULL),
(104, 'Chattogram Division', 'Cumilla', 'Monohorganj', '2024-05-08 09:01:59', NULL),
(105, 'Chattogram Division', 'Cumilla', 'Muradnagar', '2024-05-08 09:01:59', NULL),
(106, 'Chattogram Division', 'Cumilla', 'Nangalkot', '2024-05-08 09:01:59', NULL),
(107, 'Chattogram Division', 'Cumilla', 'Titas', '2024-05-08 09:01:59', NULL),
(108, 'Chattogram Division', 'Feni', 'Chhagalniya', '2024-05-08 09:01:59', NULL),
(109, 'Chattogram Division', 'Feni', 'Daganbhuiyan', '2024-05-08 09:01:59', NULL),
(110, 'Chattogram Division', 'Feni', 'Feni Sadar', '2024-05-08 09:01:59', NULL),
(111, 'Chattogram Division', 'Feni', 'Fulgazi', '2024-05-08 09:01:59', NULL),
(112, 'Chattogram Division', 'Feni', 'Parshuram', '2024-05-08 09:01:59', NULL),
(113, 'Chattogram Division', 'Feni', 'Sonagazi', '2024-05-08 09:01:59', NULL),
(114, 'Chattogram Division', 'Khagrachari', 'Dighinala', '2024-05-08 09:01:59', NULL),
(115, 'Chattogram Division', 'Khagrachari', 'Guimara', '2024-05-08 09:01:59', NULL),
(116, 'Chattogram Division', 'Khagrachari', 'Khagrachari Sadar', '2024-05-08 09:01:59', NULL),
(117, 'Chattogram Division', 'Khagrachari', 'Lakshmichhari', '2024-05-08 09:01:59', NULL),
(118, 'Chattogram Division', 'Khagrachari', 'Mahalchari', '2024-05-08 09:01:59', NULL),
(119, 'Chattogram Division', 'Khagrachari', 'Manikchari', '2024-05-08 09:01:59', NULL),
(120, 'Chattogram Division', 'Khagrachari', 'Matiranga', '2024-05-08 09:01:59', NULL),
(121, 'Chattogram Division', 'Khagrachari', 'Panchhari', '2024-05-08 09:01:59', NULL),
(122, 'Chattogram Division', 'Khagrachari', 'Ramgarh', '2024-05-08 09:01:59', NULL),
(123, 'Chattogram Division', 'Laxmipur', 'Kamalnagar', '2024-05-08 09:01:59', NULL),
(124, 'Chattogram Division', 'Laxmipur', 'Laxmipur Sadar', '2024-05-08 09:01:59', NULL),
(125, 'Chattogram Division', 'Laxmipur', 'Raipur', '2024-05-08 09:01:59', NULL),
(126, 'Chattogram Division', 'Laxmipur', 'Ramganj', '2024-05-08 09:01:59', NULL),
(127, 'Chattogram Division', 'Laxmipur', 'Ramgati', '2024-05-08 09:01:59', NULL),
(128, 'Chattogram Division', 'Noakhali', 'Begumganj', '2024-05-08 09:01:59', NULL),
(129, 'Chattogram Division', 'Noakhali', 'Chatkhil', '2024-05-08 09:01:59', NULL),
(130, 'Chattogram Division', 'Noakhali', 'Companiganj', '2024-05-08 09:01:59', NULL),
(131, 'Chattogram Division', 'Noakhali', 'Hatiya', '2024-05-08 09:01:59', NULL),
(132, 'Chattogram Division', 'Noakhali', 'Kabirhat', '2024-05-08 09:01:59', NULL),
(133, 'Chattogram Division', 'Noakhali', 'Noakhali Sadar', '2024-05-08 09:01:59', NULL),
(134, 'Chattogram Division', 'Noakhali', 'Senbag', '2024-05-08 09:01:59', NULL),
(135, 'Chattogram Division', 'Noakhali', 'Sonaimuri', '2024-05-08 09:01:59', NULL),
(136, 'Chattogram Division', 'Noakhali', 'Subarna Char', '2024-05-08 09:01:59', NULL),
(137, 'Chattogram Division', 'Rangamati', 'Rangamati Sadar', '2024-05-08 09:01:59', NULL),
(138, 'Chattogram Division', 'Rangamati', 'Baghaichari', '2024-05-08 09:01:59', NULL),
(139, 'Chattogram Division', 'Rangamati', 'Barkal', '2024-05-08 09:01:59', NULL),
(140, 'Chattogram Division', 'Rangamati', 'Belaichhari', '2024-05-08 09:01:59', NULL),
(141, 'Chattogram Division', 'Rangamati', 'Juraichhari', '2024-05-08 09:01:59', NULL),
(142, 'Chattogram Division', 'Rangamati', 'Kaptai', '2024-05-08 09:01:59', NULL),
(143, 'Chattogram Division', 'Rangamati', 'Kaukhali', '2024-05-08 09:01:59', NULL),
(144, 'Chattogram Division', 'Rangamati', 'Langadu', '2024-05-08 09:01:59', NULL),
(145, 'Chattogram Division', 'Rangamati', 'Nanniarchar', '2024-05-08 09:01:59', NULL),
(146, 'Chattogram Division', 'Rangamati', 'Rajasthali', '2024-05-08 09:01:59', NULL),
(147, 'Dhaka Division', 'Dhaka', 'Dhamrai', '2024-05-08 09:01:59', NULL),
(148, 'Dhaka Division', 'Dhaka', 'Dohar', '2024-05-08 09:01:59', NULL),
(149, 'Dhaka Division', 'Dhaka', 'Keraniganj', '2024-05-08 09:01:59', NULL),
(150, 'Dhaka Division', 'Dhaka', 'Nawabganj', '2024-05-08 09:01:59', NULL),
(151, 'Dhaka Division', 'Dhaka', 'Savar', '2024-05-08 09:01:59', NULL),
(152, 'Dhaka Division', 'Faridpur', 'Alfadanga', '2024-05-08 09:01:59', NULL),
(153, 'Dhaka Division', 'Faridpur', 'Bhanga', '2024-05-08 09:01:59', NULL),
(154, 'Dhaka Division', 'Faridpur', 'Boalmari', '2024-05-08 09:01:59', NULL),
(155, 'Dhaka Division', 'Faridpur', 'Charbhadrasan', '2024-05-08 09:01:59', NULL),
(156, 'Dhaka Division', 'Faridpur', 'Faridpur Sadar', '2024-05-08 09:01:59', NULL),
(157, 'Dhaka Division', 'Faridpur', 'Madhukhali', '2024-05-08 09:01:59', NULL),
(158, 'Dhaka Division', 'Faridpur', 'Nagarkanda', '2024-05-08 09:01:59', NULL),
(159, 'Dhaka Division', 'Faridpur', 'Sadarpur', '2024-05-08 09:01:59', NULL),
(160, 'Dhaka Division', 'Faridpur', 'Saltha', '2024-05-08 09:01:59', NULL),
(161, 'Dhaka Division', 'Gazipur', 'Gazipur Sadar', '2024-05-08 09:01:59', NULL),
(162, 'Dhaka Division', 'Gazipur', 'Kaliakoir', '2024-05-08 09:01:59', NULL),
(163, 'Dhaka Division', 'Gazipur', 'Kaliganj', '2024-05-08 09:01:59', NULL),
(164, 'Dhaka Division', 'Gazipur', 'Kapasia', '2024-05-08 09:01:59', NULL),
(165, 'Dhaka Division', 'Gazipur', 'Sreepur', '2024-05-08 09:01:59', NULL),
(166, 'Dhaka Division', 'Gopalganj', 'Gopalganj Sadar', '2024-05-08 09:01:59', NULL),
(167, 'Dhaka Division', 'Gopalganj', 'Kasiani', '2024-05-08 09:01:59', NULL),
(168, 'Dhaka Division', 'Gopalganj', 'Kotwalipara', '2024-05-08 09:01:59', NULL),
(169, 'Dhaka Division', 'Gopalganj', 'Muksudpur', '2024-05-08 09:01:59', NULL),
(170, 'Dhaka Division', 'Gopalganj', 'Tungipara', '2024-05-08 09:01:59', NULL),
(171, 'Dhaka Division', 'Kishoreganj', 'Austagram', '2024-05-08 09:01:59', NULL),
(172, 'Dhaka Division', 'Kishoreganj', 'Bajitpur', '2024-05-08 09:01:59', NULL),
(173, 'Dhaka Division', 'Kishoreganj', 'Bhairab', '2024-05-08 09:01:59', NULL),
(174, 'Dhaka Division', 'Kishoreganj', 'Hossainpur', '2024-05-08 09:01:59', NULL),
(175, 'Dhaka Division', 'Kishoreganj', 'Itna', '2024-05-08 09:01:59', NULL),
(176, 'Dhaka Division', 'Kishoreganj', 'Karimganj', '2024-05-08 09:01:59', NULL),
(177, 'Dhaka Division', 'Kishoreganj', 'Katiadi', '2024-05-08 09:01:59', NULL),
(178, 'Dhaka Division', 'Kishoreganj', 'Kishoreganj Sadar', '2024-05-08 09:01:59', NULL),
(179, 'Dhaka Division', 'Kishoreganj', 'Kuliarchar', '2024-05-08 09:01:59', NULL),
(180, 'Dhaka Division', 'Kishoreganj', 'Mithamoin', '2024-05-08 09:01:59', NULL),
(181, 'Dhaka Division', 'Kishoreganj', 'Nikli', '2024-05-08 09:01:59', NULL),
(182, 'Dhaka Division', 'Kishoreganj', 'Pakundia', '2024-05-08 09:01:59', NULL),
(183, 'Dhaka Division', 'Kishoreganj', 'Tarail', '2024-05-08 09:01:59', NULL),
(184, 'Dhaka Division', 'Madaripur', 'Dasar', '2024-05-08 09:01:59', NULL),
(185, 'Dhaka Division', 'Madaripur', 'Kalkini', '2024-05-08 09:01:59', NULL),
(186, 'Dhaka Division', 'Madaripur', 'Madaripur Sadar', '2024-05-08 09:01:59', NULL),
(187, 'Dhaka Division', 'Madaripur', 'Rajoir', '2024-05-08 09:01:59', NULL),
(188, 'Dhaka Division', 'Madaripur', 'Shibchar', '2024-05-08 09:01:59', NULL),
(189, 'Dhaka Division', 'Manikganj', 'Daulatpur', '2024-05-08 09:01:59', NULL),
(190, 'Dhaka Division', 'Manikganj', 'Ghior', '2024-05-08 09:01:59', NULL),
(191, 'Dhaka Division', 'Manikganj', 'Harirampur', '2024-05-08 09:01:59', NULL),
(192, 'Dhaka Division', 'Manikganj', 'Manikganj Sadar', '2024-05-08 09:01:59', NULL),
(193, 'Dhaka Division', 'Manikganj', 'Saturia', '2024-05-08 09:01:59', NULL),
(194, 'Dhaka Division', 'Manikganj', 'Shivalaya', '2024-05-08 09:01:59', NULL),
(195, 'Dhaka Division', 'Manikganj', 'Singair', '2024-05-08 09:01:59', NULL),
(196, 'Dhaka Division', 'Munshiganj', 'Gazaria', '2024-05-08 09:01:59', NULL),
(197, 'Dhaka Division', 'Munshiganj', 'Lauhajong', '2024-05-08 09:01:59', NULL),
(198, 'Dhaka Division', 'Munshiganj', 'Munshiganj Sadar', '2024-05-08 09:01:59', NULL),
(199, 'Dhaka Division', 'Munshiganj', 'Sirajdikhan', '2024-05-08 09:01:59', NULL),
(200, 'Dhaka Division', 'Munshiganj', 'Sreenagar', '2024-05-08 09:01:59', NULL),
(201, 'Dhaka Division', 'Munshiganj', 'Tongibari', '2024-05-08 09:01:59', NULL),
(202, 'Dhaka Division', 'Narayanganj', 'Araihazar', '2024-05-08 09:01:59', NULL),
(203, 'Dhaka Division', 'Narayanganj', 'Bandar', '2024-05-08 09:01:59', NULL),
(204, 'Dhaka Division', 'Narayanganj', 'Narayanganj Sadar', '2024-05-08 09:01:59', NULL),
(205, 'Dhaka Division', 'Narayanganj', 'Rupganj', '2024-05-08 09:01:59', NULL),
(206, 'Dhaka Division', 'Narayanganj', 'Sonargaon', '2024-05-08 09:01:59', NULL),
(207, 'Dhaka Division', 'Narshingdi', 'Belabo', '2024-05-08 09:01:59', NULL),
(208, 'Dhaka Division', 'Narshingdi', 'Monohardi', '2024-05-08 09:01:59', NULL),
(209, 'Dhaka Division', 'Narshingdi', 'Narshingdi Sadar', '2024-05-08 09:01:59', NULL),
(210, 'Dhaka Division', 'Narshingdi', 'Palash', '2024-05-08 09:01:59', NULL),
(211, 'Dhaka Division', 'Narshingdi', 'Raipura', '2024-05-08 09:01:59', NULL),
(212, 'Dhaka Division', 'Narshingdi', 'Shibpur', '2024-05-08 09:01:59', NULL),
(213, 'Dhaka Division', 'Rajbari', 'Baliakandi', '2024-05-08 09:01:59', NULL),
(214, 'Dhaka Division', 'Rajbari', 'Goalanda', '2024-05-08 09:01:59', NULL),
(215, 'Dhaka Division', 'Rajbari', 'Kalukhali', '2024-05-08 09:01:59', NULL),
(216, 'Dhaka Division', 'Rajbari', 'Pangsha', '2024-05-08 09:01:59', NULL),
(217, 'Dhaka Division', 'Rajbari', 'Rajbari Sadar', '2024-05-08 09:01:59', NULL),
(218, 'Dhaka Division', 'Shariatpur', 'Bhedarganj', '2024-05-08 09:01:59', NULL),
(219, 'Dhaka Division', 'Shariatpur', 'Damuddya', '2024-05-08 09:01:59', NULL),
(220, 'Dhaka Division', 'Shariatpur', 'Goshairhat', '2024-05-08 09:01:59', NULL),
(221, 'Dhaka Division', 'Shariatpur', 'Janjira', '2024-05-08 09:01:59', NULL),
(222, 'Dhaka Division', 'Shariatpur', 'Naria', '2024-05-08 09:01:59', NULL),
(223, 'Dhaka Division', 'Shariatpur', 'Shariatpur Sadar', '2024-05-08 09:01:59', NULL),
(224, 'Dhaka Division', 'Tangail', 'Basail', '2024-05-08 09:01:59', NULL),
(225, 'Dhaka Division', 'Tangail', 'Bhuapur', '2024-05-08 09:01:59', NULL),
(226, 'Dhaka Division', 'Tangail', 'Delduar', '2024-05-08 09:01:59', NULL),
(227, 'Dhaka Division', 'Tangail', 'Dhanbari', '2024-05-08 09:01:59', NULL),
(228, 'Dhaka Division', 'Tangail', 'Ghatail', '2024-05-08 09:01:59', NULL),
(229, 'Dhaka Division', 'Tangail', 'Gopalpur', '2024-05-08 09:01:59', NULL),
(230, 'Dhaka Division', 'Tangail', 'Kalihati', '2024-05-08 09:01:59', NULL),
(231, 'Dhaka Division', 'Tangail', 'Madhupur', '2024-05-08 09:01:59', NULL),
(232, 'Dhaka Division', 'Tangail', 'Mirzapur', '2024-05-08 09:01:59', NULL),
(233, 'Dhaka Division', 'Tangail', 'Nagarpur', '2024-05-08 09:01:59', NULL),
(234, 'Dhaka Division', 'Tangail', 'Shakhipur', '2024-05-08 09:01:59', NULL),
(235, 'Dhaka Division', 'Tangail', 'Tangail Sadar', '2024-05-08 09:01:59', NULL),
(236, 'Khulna Division', 'Bagerhat', 'Bagerhat Sadar', '2024-05-08 09:01:59', NULL),
(237, 'Khulna Division', 'Bagerhat', 'Chitalmari', '2024-05-08 09:01:59', NULL),
(238, 'Khulna Division', 'Bagerhat', 'Fakirhat', '2024-05-08 09:01:59', NULL),
(239, 'Khulna Division', 'Bagerhat', 'Kachua', '2024-05-08 09:01:59', NULL),
(240, 'Khulna Division', 'Bagerhat', 'Mollahat', '2024-05-08 09:01:59', NULL),
(241, 'Khulna Division', 'Bagerhat', 'Mongla', '2024-05-08 09:01:59', NULL),
(242, 'Khulna Division', 'Bagerhat', 'Morrelganj', '2024-05-08 09:01:59', NULL),
(243, 'Khulna Division', 'Bagerhat', 'Rampal', '2024-05-08 09:01:59', NULL),
(244, 'Khulna Division', 'Bagerhat', 'Sharankhola', '2024-05-08 09:01:59', NULL),
(245, 'Khulna Division', 'Chuadanga', 'Alamdanga', '2024-05-08 09:01:59', NULL),
(246, 'Khulna Division', 'Chuadanga', 'Chuadanga Sadar', '2024-05-08 09:01:59', NULL),
(247, 'Khulna Division', 'Chuadanga', 'Damurhuda', '2024-05-08 09:01:59', NULL),
(248, 'Khulna Division', 'Chuadanga', 'Jibannagar', '2024-05-08 09:01:59', NULL),
(249, 'Khulna Division', 'Jashore', 'Abhoynagar', '2024-05-08 09:01:59', NULL),
(250, 'Khulna Division', 'Jashore', 'Bagherpara', '2024-05-08 09:01:59', NULL),
(251, 'Khulna Division', 'Jashore', 'Chowgacha', '2024-05-08 09:01:59', NULL),
(252, 'Khulna Division', 'Jashore', 'Jashore Sadar', '2024-05-08 09:01:59', NULL),
(253, 'Khulna Division', 'Jashore', 'Jhikargacha', '2024-05-08 09:01:59', NULL),
(254, 'Khulna Division', 'Jashore', 'Keshabpur', '2024-05-08 09:01:59', NULL),
(255, 'Khulna Division', 'Jashore', 'Monirampur', '2024-05-08 09:01:59', NULL),
(256, 'Khulna Division', 'Jashore', 'Sarsha', '2024-05-08 09:01:59', NULL),
(257, 'Khulna Division', 'Jhenaidah', 'Harinakunda', '2024-05-08 09:01:59', NULL),
(258, 'Khulna Division', 'Jhenaidah', 'Jhenaidah Sadar', '2024-05-08 09:01:59', NULL),
(259, 'Khulna Division', 'Jhenaidah', 'Kaliganj', '2024-05-08 09:01:59', NULL),
(260, 'Khulna Division', 'Jhenaidah', 'Kotchandpur', '2024-05-08 09:01:59', NULL),
(261, 'Khulna Division', 'Jhenaidah', 'Moheshpur', '2024-05-08 09:01:59', NULL),
(262, 'Khulna Division', 'Jhenaidah', 'Shailkupa', '2024-05-08 09:01:59', NULL),
(263, 'Khulna Division', 'Khulna', 'Batiaghata', '2024-05-08 09:01:59', NULL),
(264, 'Khulna Division', 'Khulna', 'Dacope', '2024-05-08 09:01:59', NULL),
(265, 'Khulna Division', 'Khulna', 'Dighalia', '2024-05-08 09:01:59', NULL),
(266, 'Khulna Division', 'Khulna', 'Dumuria', '2024-05-08 09:01:59', NULL),
(267, 'Khulna Division', 'Khulna', 'Koira', '2024-05-08 09:01:59', NULL),
(268, 'Khulna Division', 'Khulna', 'Paikgacha', '2024-05-08 09:01:59', NULL),
(269, 'Khulna Division', 'Khulna', 'Phultala', '2024-05-08 09:01:59', NULL),
(270, 'Khulna Division', 'Khulna', 'Rupsa', '2024-05-08 09:01:59', NULL),
(271, 'Khulna Division', 'Khulna', 'Terokhada', '2024-05-08 09:01:59', NULL),
(272, 'Khulna Division', 'Kushtia', 'Bheramara', '2024-05-08 09:01:59', NULL),
(273, 'Khulna Division', 'Kushtia', 'Daulatpur', '2024-05-08 09:01:59', NULL),
(274, 'Khulna Division', 'Kushtia', 'Khoksha', '2024-05-08 09:01:59', NULL),
(275, 'Khulna Division', 'Kushtia', 'Kumarkhali', '2024-05-08 09:01:59', NULL),
(276, 'Khulna Division', 'Kushtia', 'Kushtia Sadar', '2024-05-08 09:01:59', NULL),
(277, 'Khulna Division', 'Kushtia', 'Mirpur', '2024-05-08 09:01:59', NULL),
(278, 'Khulna Division', 'Magura', 'Mirpur Sadar', '2024-05-08 09:01:59', NULL),
(279, 'Khulna Division', 'Magura', 'Mohammadpur', '2024-05-08 09:01:59', NULL),
(280, 'Khulna Division', 'Magura', 'Salikha', '2024-05-08 09:01:59', NULL),
(281, 'Khulna Division', 'Magura', 'Sreepur', '2024-05-08 09:01:59', NULL),
(282, 'Khulna Division', 'Meherpur', 'Gangni', '2024-05-08 09:01:59', NULL),
(283, 'Khulna Division', 'Meherpur', 'Meherpur Sadar', '2024-05-08 09:01:59', NULL),
(284, 'Khulna Division', 'Meherpur', 'Mujib Nagar', '2024-05-08 09:01:59', NULL),
(285, 'Khulna Division', 'Narail', 'Kalia', '2024-05-08 09:01:59', NULL),
(286, 'Khulna Division', 'Narail', 'Lohagara', '2024-05-08 09:01:59', NULL),
(287, 'Khulna Division', 'Narail', 'Narail Sadar', '2024-05-08 09:01:59', NULL),
(288, 'Khulna Division', 'Satkhira', 'Assasuni', '2024-05-08 09:01:59', NULL),
(289, 'Khulna Division', 'Satkhira', 'Debhata', '2024-05-08 09:01:59', NULL),
(290, 'Khulna Division', 'Satkhira', 'Kalaroa', '2024-05-08 09:01:59', NULL),
(291, 'Khulna Division', 'Satkhira', 'Kaliganj', '2024-05-08 09:01:59', NULL),
(292, 'Khulna Division', 'Satkhira', 'Satkhira Sadar', '2024-05-08 09:01:59', NULL),
(293, 'Khulna Division', 'Satkhira', 'Shyamnagar', '2024-05-08 09:01:59', NULL),
(294, 'Khulna Division', 'Satkhira', 'Tala', '2024-05-08 09:01:59', NULL),
(295, 'Mymensingh Division', 'Jamalpur', 'Bakshiganj', '2024-05-08 09:01:59', NULL),
(296, 'Mymensingh Division', 'Jamalpur', 'Dewanganj', '2024-05-08 09:01:59', NULL),
(297, 'Mymensingh Division', 'Jamalpur', 'Islampur', '2024-05-08 09:01:59', NULL),
(298, 'Mymensingh Division', 'Jamalpur', 'Jamalpur Sadar', '2024-05-08 09:01:59', NULL),
(299, 'Mymensingh Division', 'Jamalpur', 'Madarganj', '2024-05-08 09:01:59', NULL),
(300, 'Mymensingh Division', 'Jamalpur', 'Melendah', '2024-05-08 09:01:59', NULL),
(301, 'Mymensingh Division', 'Jamalpur', 'Sarishabari', '2024-05-08 09:01:59', NULL),
(302, 'Mymensingh Division', 'Mymensingh', 'Bhaluka', '2024-05-08 09:01:59', NULL),
(303, 'Mymensingh Division', 'Mymensingh', 'Dhobaura', '2024-05-08 09:01:59', NULL),
(304, 'Mymensingh Division', 'Mymensingh', 'Fulbaria', '2024-05-08 09:01:59', NULL),
(305, 'Mymensingh Division', 'Mymensingh', 'Gaffargaon', '2024-05-08 09:01:59', NULL),
(306, 'Mymensingh Division', 'Mymensingh', 'Gouripur', '2024-05-08 09:01:59', NULL),
(307, 'Mymensingh Division', 'Mymensingh', 'Haluaghat', '2024-05-08 09:01:59', NULL),
(308, 'Mymensingh Division', 'Mymensingh', 'Ishwarganj', '2024-05-08 09:01:59', NULL),
(309, 'Mymensingh Division', 'Mymensingh', 'Muktagacha', '2024-05-08 09:01:59', NULL),
(310, 'Mymensingh Division', 'Mymensingh', 'Mymensingh Sadar', '2024-05-08 09:01:59', NULL),
(311, 'Mymensingh Division', 'Mymensingh', 'Nandail', '2024-05-08 09:01:59', NULL),
(312, 'Mymensingh Division', 'Mymensingh', 'Phulpur', '2024-05-08 09:01:59', NULL),
(313, 'Mymensingh Division', 'Mymensingh', 'Tarakanda', '2024-05-08 09:01:59', NULL),
(314, 'Mymensingh Division', 'Mymensingh', 'Trishal', '2024-05-08 09:01:59', NULL),
(315, 'Mymensingh Division', 'Netrokona', 'Atpara', '2024-05-08 09:01:59', NULL),
(316, 'Mymensingh Division', 'Netrokona', 'Barhatta', '2024-05-08 09:01:59', NULL),
(317, 'Mymensingh Division', 'Netrokona', 'Durgapur', '2024-05-08 09:01:59', NULL),
(318, 'Mymensingh Division', 'Netrokona', 'Kalmakanda', '2024-05-08 09:01:59', NULL),
(319, 'Mymensingh Division', 'Netrokona', 'Kendua', '2024-05-08 09:01:59', NULL),
(320, 'Mymensingh Division', 'Netrokona', 'Khaliajuri', '2024-05-08 09:01:59', NULL),
(321, 'Mymensingh Division', 'Netrokona', 'Madan', '2024-05-08 09:01:59', NULL),
(322, 'Mymensingh Division', 'Netrokona', 'Mohanganj', '2024-05-08 09:01:59', NULL),
(323, 'Mymensingh Division', 'Netrokona', 'Netrakona Sadar', '2024-05-08 09:01:59', NULL),
(324, 'Mymensingh Division', 'Netrokona', 'Purbadhala', '2024-05-08 09:01:59', NULL),
(325, 'Mymensingh Division', 'Sherpur', 'Jhenaigati', '2024-05-08 09:01:59', NULL),
(326, 'Mymensingh Division', 'Sherpur', 'Nakla', '2024-05-08 09:01:59', NULL),
(327, 'Mymensingh Division', 'Sherpur', 'Nalitabari', '2024-05-08 09:01:59', NULL),
(328, 'Mymensingh Division', 'Sherpur', 'Sherpur Sadar', '2024-05-08 09:01:59', NULL),
(329, 'Mymensingh Division', 'Sherpur', 'Sreebordi', '2024-05-08 09:01:59', NULL),
(330, 'Rajshahi Division', 'Bogura', 'Adamdighi', '2024-05-08 09:01:59', NULL),
(331, 'Rajshahi Division', 'Bogura', 'Bogura Sadar', '2024-05-08 09:01:59', NULL),
(332, 'Rajshahi Division', 'Bogura', 'Dhunot', '2024-05-08 09:01:59', NULL),
(333, 'Rajshahi Division', 'Bogura', 'Dhupchancia', '2024-05-08 09:01:59', NULL),
(334, 'Rajshahi Division', 'Bogura', 'Gabtali', '2024-05-08 09:01:59', NULL),
(335, 'Rajshahi Division', 'Bogura', 'Kahaloo', '2024-05-08 09:01:59', NULL),
(336, 'Rajshahi Division', 'Bogura', 'Nandigram', '2024-05-08 09:01:59', NULL),
(337, 'Rajshahi Division', 'Bogura', 'Sariakandi', '2024-05-08 09:01:59', NULL),
(338, 'Rajshahi Division', 'Bogura', 'Shajahanpur', '2024-05-08 09:01:59', NULL),
(339, 'Rajshahi Division', 'Bogura', 'Sherpur', '2024-05-08 09:01:59', NULL),
(340, 'Rajshahi Division', 'Bogura', 'Shibganj', '2024-05-08 09:01:59', NULL),
(341, 'Rajshahi Division', 'Bogura', 'Sonatala', '2024-05-08 09:01:59', NULL),
(342, 'Rajshahi Division', 'Chapainawabganj', 'Bholahat', '2024-05-08 09:01:59', NULL),
(343, 'Rajshahi Division', 'Chapainawabganj', 'Gomostapur', '2024-05-08 09:01:59', NULL),
(344, 'Rajshahi Division', 'Chapainawabganj', 'Nachol', '2024-05-08 09:01:59', NULL),
(345, 'Rajshahi Division', 'Chapainawabganj', 'Chapainawabganj Sadar', '2024-05-08 09:01:59', NULL),
(346, 'Rajshahi Division', 'Chapainawabganj', 'Shibganj', '2024-05-08 09:01:59', NULL),
(347, 'Rajshahi Division', 'Joypurhat', 'Akkelpur', '2024-05-08 09:01:59', NULL),
(348, 'Rajshahi Division', 'Joypurhat', 'Joypurhat Sadar', '2024-05-08 09:01:59', NULL),
(349, 'Rajshahi Division', 'Joypurhat', 'Kalai', '2024-05-08 09:01:59', NULL),
(350, 'Rajshahi Division', 'Joypurhat', 'Khetlal', '2024-05-08 09:01:59', NULL),
(351, 'Rajshahi Division', 'Joypurhat', 'Panchbibi', '2024-05-08 09:01:59', NULL),
(352, 'Rajshahi Division', 'Naogaon', 'Atrai', '2024-05-08 09:01:59', NULL),
(353, 'Rajshahi Division', 'Naogaon', 'Badalgachi', '2024-05-08 09:01:59', NULL),
(354, 'Rajshahi Division', 'Naogaon', 'Dhamoirhat', '2024-05-08 09:01:59', NULL),
(355, 'Rajshahi Division', 'Naogaon', 'Manda', '2024-05-08 09:01:59', NULL),
(356, 'Rajshahi Division', 'Naogaon', 'Mohadevpur', '2024-05-08 09:01:59', NULL),
(357, 'Rajshahi Division', 'Naogaon', 'Naogaon Sadar', '2024-05-08 09:01:59', NULL),
(358, 'Rajshahi Division', 'Naogaon', 'Niamatpur', '2024-05-08 09:01:59', NULL),
(359, 'Rajshahi Division', 'Naogaon', 'Patnitala', '2024-05-08 09:01:59', NULL),
(360, 'Rajshahi Division', 'Naogaon', 'Porsha', '2024-05-08 09:01:59', NULL),
(361, 'Rajshahi Division', 'Naogaon', 'Raninagar', '2024-05-08 09:01:59', NULL),
(362, 'Rajshahi Division', 'Naogaon', 'Shapahar', '2024-05-08 09:01:59', NULL),
(363, 'Rajshahi Division', 'Natore', 'Bagatipara', '2024-05-08 09:01:59', NULL),
(364, 'Rajshahi Division', 'Natore', 'Baraigram', '2024-05-08 09:01:59', NULL),
(365, 'Rajshahi Division', 'Natore', 'Gurudaspur', '2024-05-08 09:01:59', NULL),
(366, 'Rajshahi Division', 'Natore', 'Lalpur', '2024-05-08 09:01:59', NULL),
(367, 'Rajshahi Division', 'Natore', 'Naldanga', '2024-05-08 09:01:59', NULL),
(368, 'Rajshahi Division', 'Natore', 'Natore Sadar', '2024-05-08 09:01:59', NULL),
(369, 'Rajshahi Division', 'Natore', 'Singra', '2024-05-08 09:01:59', NULL),
(370, 'Rajshahi Division', 'Pabna', 'Atghoria', '2024-05-08 09:01:59', NULL),
(371, 'Rajshahi Division', 'Pabna', 'Bera', '2024-05-08 09:01:59', NULL),
(372, 'Rajshahi Division', 'Pabna', 'Bhangura', '2024-05-08 09:01:59', NULL),
(373, 'Rajshahi Division', 'Pabna', 'Chatmohar', '2024-05-08 09:01:59', NULL),
(374, 'Rajshahi Division', 'Pabna', 'Faridpur', '2024-05-08 09:01:59', NULL),
(375, 'Rajshahi Division', 'Pabna', 'Ishwardi', '2024-05-08 09:01:59', NULL),
(376, 'Rajshahi Division', 'Pabna', 'Pabna Sadar', '2024-05-08 09:01:59', NULL),
(377, 'Rajshahi Division', 'Pabna', 'Santhia', '2024-05-08 09:01:59', NULL),
(378, 'Rajshahi Division', 'Pabna', 'Sujanagar', '2024-05-08 09:01:59', NULL),
(379, 'Rajshahi Division', 'Rajshahi', 'Bagha', '2024-05-08 09:01:59', NULL),
(380, 'Rajshahi Division', 'Rajshahi', 'Bagmara', '2024-05-08 09:01:59', NULL),
(381, 'Rajshahi Division', 'Rajshahi', 'Charghat', '2024-05-08 09:01:59', NULL),
(382, 'Rajshahi Division', 'Rajshahi', 'Durgapur', '2024-05-08 09:01:59', NULL),
(383, 'Rajshahi Division', 'Rajshahi', 'Godagari', '2024-05-08 09:01:59', NULL),
(384, 'Rajshahi Division', 'Rajshahi', 'Mohanpur', '2024-05-08 09:01:59', NULL),
(385, 'Rajshahi Division', 'Rajshahi', 'Paba', '2024-05-08 09:01:59', NULL),
(386, 'Rajshahi Division', 'Rajshahi', 'Puthia', '2024-05-08 09:01:59', NULL),
(387, 'Rajshahi Division', 'Rajshahi', 'Tanore', '2024-05-08 09:01:59', NULL),
(388, 'Rajshahi Division', 'Sirajganj', 'Belkuchi', '2024-05-08 09:01:59', NULL),
(389, 'Rajshahi Division', 'Sirajganj', 'Chowhali', '2024-05-08 09:01:59', NULL),
(390, 'Rajshahi Division', 'Sirajganj', 'Kamarkhand', '2024-05-08 09:01:59', NULL),
(391, 'Rajshahi Division', 'Sirajganj', 'Kazipur', '2024-05-08 09:01:59', NULL),
(392, 'Rajshahi Division', 'Sirajganj', 'Raiganj', '2024-05-08 09:01:59', NULL),
(393, 'Rajshahi Division', 'Sirajganj', 'Shahzadpur', '2024-05-08 09:01:59', NULL),
(394, 'Rajshahi Division', 'Sirajganj', 'Sirajganj Sadar', '2024-05-08 09:01:59', NULL),
(395, 'Rajshahi Division', 'Sirajganj', 'Tarash', '2024-05-08 09:01:59', NULL),
(396, 'Rajshahi Division', 'Sirajganj', 'Ullapara', '2024-05-08 09:01:59', NULL),
(397, 'Rangpur Division', 'Dinajpur', 'Birampur', '2024-05-08 09:01:59', NULL),
(398, 'Rangpur Division', 'Dinajpur', 'Birganj', '2024-05-08 09:01:59', NULL),
(399, 'Rangpur Division', 'Dinajpur', 'Birol', '2024-05-08 09:01:59', NULL),
(400, 'Rangpur Division', 'Dinajpur', 'Bochaganj', '2024-05-08 09:01:59', NULL),
(401, 'Rangpur Division', 'Dinajpur', 'Chirirbandar', '2024-05-08 09:01:59', NULL),
(402, 'Rangpur Division', 'Dinajpur', 'Dinajpur Sadar', '2024-05-08 09:01:59', NULL),
(403, 'Rangpur Division', 'Dinajpur', 'Fulbari', '2024-05-08 09:01:59', NULL),
(404, 'Rangpur Division', 'Dinajpur', 'Ghoraghat', '2024-05-08 09:01:59', NULL),
(405, 'Rangpur Division', 'Dinajpur', 'Hakimpur', '2024-05-08 09:01:59', NULL),
(406, 'Rangpur Division', 'Dinajpur', 'Kaharol', '2024-05-08 09:01:59', NULL),
(407, 'Rangpur Division', 'Dinajpur', 'Khanshama', '2024-05-08 09:01:59', NULL),
(408, 'Rangpur Division', 'Dinajpur', 'Nawabganj', '2024-05-08 09:01:59', NULL),
(409, 'Rangpur Division', 'Dinajpur', 'Parbatipur', '2024-05-08 09:01:59', NULL),
(410, 'Rangpur Division', 'Gaibandha', 'Fulchari', '2024-05-08 09:01:59', NULL),
(411, 'Rangpur Division', 'Gaibandha', 'Gaibandha Sadar', '2024-05-08 09:01:59', NULL),
(412, 'Rangpur Division', 'Gaibandha', 'Gobindaganj', '2024-05-08 09:01:59', NULL),
(413, 'Rangpur Division', 'Gaibandha', 'Palashbari', '2024-05-08 09:01:59', NULL),
(414, 'Rangpur Division', 'Gaibandha', 'Sadullapur', '2024-05-08 09:01:59', NULL),
(415, 'Rangpur Division', 'Gaibandha', 'Saghata', '2024-05-08 09:01:59', NULL),
(416, 'Rangpur Division', 'Gaibandha', 'Sundarganj', '2024-05-08 09:01:59', NULL),
(417, 'Rangpur Division', 'Kurigram', 'Bhurungamari', '2024-05-08 09:01:59', NULL),
(418, 'Rangpur Division', 'Kurigram', 'Chilmari', '2024-05-08 09:01:59', NULL),
(419, 'Rangpur Division', 'Kurigram', 'Fulbari', '2024-05-08 09:01:59', NULL),
(420, 'Rangpur Division', 'Kurigram', 'Kurigram Sadar', '2024-05-08 09:01:59', NULL),
(421, 'Rangpur Division', 'Kurigram', 'Nageswari', '2024-05-08 09:01:59', NULL),
(422, 'Rangpur Division', 'Kurigram', 'Rajarhat', '2024-05-08 09:01:59', NULL),
(423, 'Rangpur Division', 'Kurigram', 'Rajibpur', '2024-05-08 09:01:59', NULL),
(424, 'Rangpur Division', 'Kurigram', 'Rowmari', '2024-05-08 09:01:59', NULL),
(425, 'Rangpur Division', 'Kurigram', 'Ulipur', '2024-05-08 09:01:59', NULL),
(426, 'Rangpur Division', 'Lalmonirhat', 'Aditmari', '2024-05-08 09:01:59', NULL),
(427, 'Rangpur Division', 'Lalmonirhat', 'Hatibandha', '2024-05-08 09:01:59', NULL),
(428, 'Rangpur Division', 'Lalmonirhat', 'Kaliganj', '2024-05-08 09:01:59', NULL),
(429, 'Rangpur Division', 'Lalmonirhat', 'Lalmonirhat Sadar', '2024-05-08 09:01:59', NULL),
(430, 'Rangpur Division', 'Lalmonirhat', 'Patgram', '2024-05-08 09:01:59', NULL),
(431, 'Rangpur Division', 'Nilphamari', 'Dimla', '2024-05-08 09:01:59', NULL),
(432, 'Rangpur Division', 'Nilphamari', 'Domar', '2024-05-08 09:01:59', NULL),
(433, 'Rangpur Division', 'Nilphamari', 'Jaldhaka', '2024-05-08 09:01:59', NULL),
(434, 'Rangpur Division', 'Nilphamari', 'Kishoreganj', '2024-05-08 09:01:59', NULL),
(435, 'Rangpur Division', 'Nilphamari', 'Nilphamari Sadar', '2024-05-08 09:01:59', NULL),
(436, 'Rangpur Division', 'Panchagarh', 'Sayedpur', '2024-05-08 09:01:59', NULL),
(437, 'Rangpur Division', 'Panchagarh', 'Atwari', '2024-05-08 09:01:59', NULL),
(438, 'Rangpur Division', 'Panchagarh', 'Boda', '2024-05-08 09:01:59', NULL),
(439, 'Rangpur Division', 'Panchagarh', 'Debiganj', '2024-05-08 09:01:59', NULL),
(440, 'Rangpur Division', 'Panchagarh', 'Panchagarh Sadar', '2024-05-08 09:01:59', NULL),
(441, 'Rangpur Division', 'Panchagarh', 'Tetulia', '2024-05-08 09:01:59', NULL),
(442, 'Rangpur Division', 'Rangpur', 'Badarganj', '2024-05-08 09:01:59', NULL),
(443, 'Rangpur Division', 'Rangpur', 'Gangachara', '2024-05-08 09:01:59', NULL),
(444, 'Rangpur Division', 'Rangpur', 'Kaunia', '2024-05-08 09:01:59', NULL),
(445, 'Rangpur Division', 'Rangpur', 'Mithapukur', '2024-05-08 09:01:59', NULL),
(446, 'Rangpur Division', 'Rangpur', 'Pirgacha', '2024-05-08 09:01:59', NULL),
(447, 'Rangpur Division', 'Rangpur', 'Pirganj', '2024-05-08 09:01:59', NULL),
(448, 'Rangpur Division', 'Rangpur', 'Rangpur Sadar', '2024-05-08 09:01:59', NULL),
(449, 'Rangpur Division', 'Rangpur', 'Taraganj', '2024-05-08 09:01:59', NULL),
(450, 'Rangpur Division', 'Thakurgaon', 'Baliadangi', '2024-05-08 09:01:59', NULL),
(451, 'Rangpur Division', 'Thakurgaon', 'Haripur', '2024-05-08 09:01:59', NULL),
(452, 'Rangpur Division', 'Thakurgaon', 'Pirganj', '2024-05-08 09:01:59', NULL),
(453, 'Rangpur Division', 'Thakurgaon', 'Ranisankail', '2024-05-08 09:01:59', NULL),
(454, 'Rangpur Division', 'Thakurgaon', 'Thakurgaon Sadar', '2024-05-08 09:01:59', NULL),
(455, 'Sylhet Division', 'Habiganj', 'Azmiriganj', '2024-05-08 09:01:59', NULL),
(456, 'Sylhet Division', 'Habiganj', 'Bahubal', '2024-05-08 09:01:59', NULL),
(457, 'Sylhet Division', 'Habiganj', 'Baniachong', '2024-05-08 09:01:59', NULL),
(458, 'Sylhet Division', 'Habiganj', 'Chunarughat', '2024-05-08 09:01:59', NULL),
(459, 'Sylhet Division', 'Habiganj', 'Habiganj Sadar', '2024-05-08 09:01:59', NULL),
(460, 'Sylhet Division', 'Habiganj', 'Lakhai', '2024-05-08 09:01:59', NULL),
(461, 'Sylhet Division', 'Habiganj', 'Madhabpur', '2024-05-08 09:01:59', NULL),
(462, 'Sylhet Division', 'Habiganj', 'Nabiganj', '2024-05-08 09:01:59', NULL),
(463, 'Sylhet Division', 'Habiganj', 'Sayestaganj', '2024-05-08 09:01:59', NULL),
(464, 'Sylhet Division', 'Moulvibazar', 'Barlekha', '2024-05-08 09:01:59', NULL),
(465, 'Sylhet Division', 'Moulvibazar', 'Juri', '2024-05-08 09:01:59', NULL),
(466, 'Sylhet Division', 'Moulvibazar', 'Kamalganj', '2024-05-08 09:01:59', NULL),
(467, 'Sylhet Division', 'Moulvibazar', 'Kulaura', '2024-05-08 09:01:59', NULL),
(468, 'Sylhet Division', 'Moulvibazar', 'Moulvibazar Sadar', '2024-05-08 09:01:59', NULL),
(469, 'Sylhet Division', 'Moulvibazar', 'Rajnagar', '2024-05-08 09:01:59', NULL),
(470, 'Sylhet Division', 'Moulvibazar', 'Sreemangal', '2024-05-08 09:01:59', NULL),
(471, 'Sylhet Division', 'Sunamganj', 'Biswamvarpur', '2024-05-08 09:01:59', NULL),
(472, 'Sylhet Division', 'Sunamganj', 'Chatak', '2024-05-08 09:01:59', NULL),
(473, 'Sylhet Division', 'Sunamganj', 'Dakhin Sunamganj', '2024-05-08 09:01:59', NULL),
(474, 'Sylhet Division', 'Sunamganj', 'Derai', '2024-05-08 09:01:59', NULL),
(475, 'Sylhet Division', 'Sunamganj', 'Dharmapasha', '2024-05-08 09:01:59', NULL),
(476, 'Sylhet Division', 'Sunamganj', 'Doarabazar', '2024-05-08 09:01:59', NULL),
(477, 'Sylhet Division', 'Sunamganj', 'Jagannathpur', '2024-05-08 09:01:59', NULL),
(478, 'Sylhet Division', 'Sunamganj', 'Jamalganj', '2024-05-08 09:01:59', NULL),
(479, 'Sylhet Division', 'Sunamganj', 'Sulla', '2024-05-08 09:01:59', NULL),
(480, 'Sylhet Division', 'Sunamganj', 'Sunamganj Sadar', '2024-05-08 09:01:59', NULL),
(481, 'Sylhet Division', 'Sunamganj', 'Tahirpur', '2024-05-08 09:01:59', NULL),
(482, 'Sylhet Division', 'Sylhet', 'Balaganj', '2024-05-08 09:01:59', NULL),
(483, 'Sylhet Division', 'Sylhet', 'Beanibazar', '2024-05-08 09:01:59', NULL),
(484, 'Sylhet Division', 'Sylhet', 'Biswanath', '2024-05-08 09:01:59', NULL),
(485, 'Sylhet Division', 'Sylhet', 'Companiganj', '2024-05-08 09:01:59', NULL),
(486, 'Sylhet Division', 'Sylhet', 'Dakshin Surma', '2024-05-08 09:01:59', NULL),
(487, 'Sylhet Division', 'Sylhet', 'Fenchuganj', '2024-05-08 09:01:59', NULL),
(488, 'Sylhet Division', 'Sylhet', 'Golapganj', '2024-05-08 09:01:59', NULL),
(489, 'Sylhet Division', 'Sylhet', 'Gowainghat', '2024-05-08 09:01:59', NULL),
(490, 'Sylhet Division', 'Sylhet', 'Jointiapur', '2024-05-08 09:01:59', NULL),
(491, 'Sylhet Division', 'Sylhet', 'Kanaighat', '2024-05-08 09:01:59', NULL),
(492, 'Sylhet Division', 'Sylhet', 'Osmaninagar', '2024-05-08 09:01:59', NULL),
(493, 'Sylhet Division', 'Sylhet', 'Sylhet Sadar', '2024-05-08 09:01:59', NULL),
(494, 'Sylhet Division', 'Sylhet', 'Zakiganj', '2024-05-08 09:01:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_02_07_110642_create_location_infos_table', 1),
(3, '2024_02_07_110716_create_department_infos_table', 1),
(4, '2024_02_07_110945_create_designations_table', 1),
(5, '2024_02_08_100605_create_transaction__types_table', 1),
(6, '2024_02_08_100606_create_transaction__withs_table', 1),
(7, '2024_02_11_081701_create_user__infos_table', 1),
(8, '2024_02_11_083248_create_transaction__groupes_table', 1),
(9, '2024_02_11_083256_create_transaction__heads_table', 1),
(10, '2024_02_12_061130_create_transaction__details_table', 1),
(11, '2024_02_12_072956_create_transaction__mains_table', 1),
(12, '2024_02_19_113033_create_party__payment__receives_table', 1),
(13, '2024_03_06_115612_create_admins_table', 1),
(14, '2024_03_27_064809_create_attendences_table', 1),
(15, '2024_03_28_060905_create_pay__roll__setups_table', 1),
(16, '2024_04_06_053340_create_pay__roll__middlewire_table', 1),
(17, '2024_04_06_092440_create_personal_details_table', 1),
(18, '2024_04_06_093252_create_education_details_table', 1),
(19, '2024_04_06_170752_create_training_details_table', 1),
(20, '2024_04_06_170948_create_experience_details_table', 1),
(21, '2024_04_06_171144_create_organization_details_table', 1),
(22, '2024_04_24_062844_create_transaction__with__groupes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organization_details`
--

CREATE TABLE `organization_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joining_date` date NOT NULL,
  `joining_location` bigint(20) UNSIGNED NOT NULL,
  `department` bigint(20) UNSIGNED NOT NULL,
  `designation` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 for Active 0 for Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_details`
--

INSERT INTO `organization_details` (`id`, `emp_id`, `joining_date`, `joining_location`, `department`, `designation`, `status`, `created_at`, `updated_at`) VALUES
(2, 'E000000101', '2024-05-01', 330, 1, 1, 1, '2024-05-08 10:03:51', NULL),
(3, 'E000000102', '2024-04-30', 426, 3, 6, 1, '2024-05-09 06:42:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `party__payment__receives`
--

CREATE TABLE `party__payment__receives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tran_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tran_type` bigint(20) UNSIGNED NOT NULL,
  `tran_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tran_type_with` bigint(20) UNSIGNED DEFAULT NULL,
  `tran_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tran_groupe_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tran_head_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` double(8,2) NOT NULL DEFAULT 1.00,
  `bill_amount` double(8,2) NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `net_amount` double(8,2) NOT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `rem_due` double(8,2) NOT NULL DEFAULT 0.00,
  `party_amount` double(8,2) DEFAULT NULL,
  `party_tran_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tran_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `party__payment__receives`
--

INSERT INTO `party__payment__receives` (`id`, `tran_id`, `tran_type`, `tran_method`, `invoice`, `loc_id`, `tran_type_with`, `tran_user`, `tran_groupe_id`, `tran_head_id`, `quantity`, `bill_amount`, `discount`, `net_amount`, `amount`, `rem_due`, `party_amount`, `party_tran_id`, `tran_date`, `updated_at`) VALUES
(1, 'PPR000000001', 2, 'Receive', NULL, 426, 7, 'C000000101', 2, 1, 1.00, 378.00, 50.00, 328.00, 328.00, 0.00, 378.00, 'REC000000001', '2024-05-09 09:29:23', NULL),
(2, 'PPP000000001', 2, 'Payment', NULL, 52, 12, 'S000000101', 2, 2, 1.00, 4905.00, 1000.00, 3905.00, 3000.00, 905.00, 3000.00, 'PAY000000001', '2024-05-09 09:30:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pay__roll__middlewires`
--

CREATE TABLE `pay__roll__middlewires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `head_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL,
  `date` date DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pay__roll__middlewires`
--

INSERT INTO `pay__roll__middlewires` (`id`, `emp_id`, `head_id`, `amount`, `date`, `added_at`, `updated_at`) VALUES
(1, 'E000000101', 13, 8000.00, '2024-05-08', '2024-05-08 09:03:49', NULL),
(2, 'E000000101', 17, 20000.00, '2024-05-08', '2024-05-08 09:03:56', NULL),
(3, 'E000000101', 17, 10000.00, '2024-04-07', '2024-05-08 09:10:16', NULL),
(4, 'E000000102', 21, 5000.00, '2024-05-09', '2024-05-09 09:31:50', NULL),
(5, 'E000000102', 20, 350.00, '2024-05-09', '2024-05-09 09:32:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pay__roll__setups`
--

CREATE TABLE `pay__roll__setups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `head_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pay__roll__setups`
--

INSERT INTO `pay__roll__setups` (`id`, `emp_id`, `head_id`, `amount`, `added_at`, `updated_at`) VALUES
(1, 'E000000101', 11, 10000.00, '2024-05-08 09:03:07', NULL),
(2, 'E000000101', 12, 48000.00, '2024-05-08 09:03:15', NULL),
(3, 'E000000102', 19, 8000.00, '2024-05-08 09:05:01', NULL),
(4, 'E000000102', 11, 2000.00, '2024-05-08 09:05:12', NULL),
(5, 'E000000101', 13, 3000.00, '2024-05-08 09:07:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

CREATE TABLE `personal_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fathers_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mothers_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nid_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phn_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `tran_user_type` bigint(20) UNSIGNED DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 for Active 0 for Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`id`, `employee_id`, `name`, `fathers_name`, `mothers_name`, `date_of_birth`, `gender`, `religion`, `marital_status`, `nationality`, `nid_no`, `phn_no`, `blood_group`, `email`, `location_id`, `tran_user_type`, `address`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'E000000101', 'Shagufta Sajid', 'Md. Sajid', 'Shahela Jabbar', '2024-05-06', 'female', 'Islam', 'Unmarried', 'Bangladeshi', '9786653', '01767940630', 'A+', 'ssajid3421@gmail.com', 249, 1, 'Shewrapara', 0x453030303030303130312853686167756674612053616a6964292e706e67, 1, '2024-05-08 09:02:31', '2024-05-08 03:02:43'),
(2, 'E000000102', 'Humayra Ashpiya', 'Md. Kobir', 'Hasanat Rehana', '2024-05-17', 'female', 'Islam', 'Unmarried', 'Bangladeshi', '78476453', '01457940630', 'AB+', 'arpee@gmail.com', 7, 1, 'Kazipara', 0x453030303030303130322848756d617972612041736870697961292e6a7067, 1, '2024-05-08 09:04:37', NULL),
(3, 'E000000103', 'Fardin', 'Zakir Hossen', 'Romana Akter', '2002-03-27', 'male', 'Islam', 'Married', 'Bangladeshi', '78476453', '01675454756', 'AB+', 'fardin01@gmail.com', 52, 3, 'Mirpur 2', 0x453030303030303130332846617264696e292e6a7067, 1, '2024-05-12 06:16:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `training_details`
--

CREATE TABLE `training_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `training_year` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 for Active 0 for Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_details`
--

INSERT INTO `training_details` (`id`, `emp_id`, `training_title`, `country`, `topic`, `institution_name`, `start_date`, `end_date`, `training_year`, `status`, `created_at`, `updated_at`) VALUES
(9, 'E000000102', 'Anatomy', 'Bangladesh', 'Animal', 'Sher e bangla', NULL, NULL, 2020, 1, '2024-05-09 00:31:45', '2024-05-09 00:31:45'),
(10, 'E000000102', 'Spoken English language', 'America', 'English language', 'Women College', NULL, NULL, 2024, 1, '2024-05-09 00:31:46', '2024-05-09 00:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `transaction__details`
--

CREATE TABLE `transaction__details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tran_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tran_type` bigint(20) UNSIGNED NOT NULL,
  `tran_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tran_type_with` bigint(20) UNSIGNED DEFAULT NULL,
  `tran_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tran_groupe_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tran_head_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` double(8,2) DEFAULT NULL,
  `quantity_issue` double NOT NULL DEFAULT 0,
  `amount` double(8,2) DEFAULT NULL,
  `tot_amount` double(8,2) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `tran_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction__details`
--

INSERT INTO `transaction__details` (`id`, `tran_id`, `tran_type`, `tran_method`, `invoice`, `loc_id`, `tran_type_with`, `tran_user`, `tran_groupe_id`, `tran_head_id`, `quantity`, `quantity_issue`, `amount`, `tot_amount`, `expiry_date`, `tran_date`, `updated_at`) VALUES
(1, 'PRP000000001', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 13, 1.00, 0, 8000.00, 8000.00, NULL, '2024-05-08 09:12:16', NULL),
(2, 'PRP000000001', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 11, 1.00, 0, 10000.00, 10000.00, NULL, '2024-05-08 09:12:16', NULL),
(3, 'PRP000000001', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 17, 1.00, 0, 20000.00, 20000.00, NULL, '2024-05-08 09:12:16', NULL),
(4, 'PRP000000001', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 12, 1.00, 0, 48000.00, 48000.00, NULL, '2024-05-08 09:12:16', NULL),
(5, 'PRP000000001', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 13, 1.00, 0, 3000.00, 3000.00, NULL, '2024-05-08 09:12:16', NULL),
(6, 'PRP000000002', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 19, 1.00, 0, 8000.00, 8000.00, NULL, '2024-05-08 09:12:16', NULL),
(7, 'PRP000000002', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 11, 1.00, 0, 2000.00, 2000.00, NULL, '2024-05-08 09:12:16', NULL),
(8, 'REC000000001', 1, 'Receive', NULL, 52, 5, 'C000000101', 7, 25, 1.00, 0, 10.00, 10.00, NULL, '2024-05-09 09:22:39', NULL),
(9, 'REC000000001', 1, 'Receive', NULL, 52, 5, 'C000000101', 7, 29, 3.00, 0, 56.00, 168.00, NULL, '2024-05-09 09:23:01', NULL),
(10, 'REC000000001', 1, 'Receive', NULL, 52, 5, 'C000000101', 7, 27, 10.00, 0, 60.00, 600.00, NULL, '2024-05-09 09:23:16', NULL),
(11, 'PAY000000001', 1, 'Payment', NULL, 171, 8, 'S000000101', 8, 41, 5.00, 0, 6.00, 30.00, NULL, '2024-05-09 09:26:16', NULL),
(12, 'PAY000000001', 1, 'Payment', NULL, 171, 8, 'S000000101', 8, 38, 2.00, 0, 5000.00, 10000.00, NULL, '2024-05-09 09:26:34', NULL),
(13, 'PAY000000001', 1, 'Payment', NULL, 171, 8, 'S000000101', 6, 22, 15.00, 0, 225.00, 3375.00, NULL, '2024-05-09 09:27:08', NULL),
(14, 'PRP000000003', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 13, 1.00, 0, 3000.00, 3000.00, NULL, '2024-05-09 09:33:25', NULL),
(15, 'PRP000000003', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 13, 1.00, 0, 8000.00, 8000.00, NULL, '2024-05-09 09:33:25', NULL),
(16, 'PRP000000003', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 11, 1.00, 0, 10000.00, 10000.00, NULL, '2024-05-09 09:33:25', NULL),
(17, 'PRP000000003', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 17, 1.00, 0, 20000.00, 20000.00, NULL, '2024-05-09 09:33:25', NULL),
(18, 'PRP000000003', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 12, 1.00, 0, 48000.00, 48000.00, NULL, '2024-05-09 09:33:25', NULL),
(19, 'PRP000000004', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 21, 1.00, 0, 5000.00, 5000.00, NULL, '2024-05-09 09:33:25', NULL),
(20, 'PRP000000004', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 20, 1.00, 0, 350.00, 350.00, NULL, '2024-05-09 09:33:25', NULL),
(21, 'PRP000000004', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 19, 1.00, 0, 8000.00, 8000.00, NULL, '2024-05-09 09:33:25', NULL),
(22, 'PRP000000004', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 11, 1.00, 0, 2000.00, 2000.00, NULL, '2024-05-09 09:33:25', NULL),
(23, 'PRP000000005', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 13, 1.00, 0, 3000.00, 3000.00, NULL, '2024-05-09 09:36:18', NULL),
(24, 'PRP000000005', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 13, 1.00, 0, 8000.00, 8000.00, NULL, '2024-05-09 09:36:18', NULL),
(25, 'PRP000000005', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 11, 1.00, 0, 10000.00, 10000.00, NULL, '2024-05-09 09:36:18', NULL),
(26, 'PRP000000005', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 17, 1.00, 0, 20000.00, 20000.00, NULL, '2024-05-09 09:36:18', NULL),
(27, 'PRP000000005', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 12, 1.00, 0, 48000.00, 48000.00, NULL, '2024-05-09 09:36:18', NULL),
(28, 'PRP000000006', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 21, 1.00, 0, 5000.00, 5000.00, NULL, '2024-05-09 09:36:18', NULL),
(29, 'PRP000000006', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 20, 1.00, 0, 350.00, 350.00, NULL, '2024-05-09 09:36:18', NULL),
(30, 'PRP000000006', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 19, 1.00, 0, 8000.00, 8000.00, NULL, '2024-05-09 09:36:18', NULL),
(31, 'PRP000000006', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 11, 1.00, 0, 2000.00, 2000.00, NULL, '2024-05-09 09:36:18', NULL),
(32, 'PRP000000007', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 13, 1.00, 0, 3000.00, 3000.00, NULL, '2024-05-09 11:36:58', NULL),
(33, 'PRP000000007', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 13, 1.00, 0, 8000.00, 8000.00, NULL, '2024-05-09 11:36:58', NULL),
(34, 'PRP000000007', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 11, 1.00, 0, 10000.00, 10000.00, NULL, '2024-05-09 11:36:58', NULL),
(35, 'PRP000000007', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 17, 1.00, 0, 20000.00, 20000.00, NULL, '2024-05-09 11:36:58', NULL),
(36, 'PRP000000007', 3, 'Payment', NULL, NULL, 1, 'E000000101', 1, 12, 1.00, 0, 48000.00, 48000.00, NULL, '2024-05-09 11:36:58', NULL),
(37, 'PRP000000008', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 20, 1.00, 0, 350.00, 350.00, NULL, '2024-05-09 11:36:59', NULL),
(38, 'PRP000000008', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 19, 1.00, 0, 8000.00, 8000.00, NULL, '2024-05-09 11:36:59', NULL),
(39, 'PRP000000008', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 11, 1.00, 0, 2000.00, 2000.00, NULL, '2024-05-09 11:36:59', NULL),
(40, 'PRP000000008', 3, 'Payment', NULL, NULL, 1, 'E000000102', 1, 21, 1.00, 0, 5000.00, 5000.00, NULL, '2024-05-09 11:36:59', NULL),
(41, 'REC000000002', 1, 'Receive', NULL, 152, 5, 'C000000101', 21, 71, 6.00, 0, 25.00, 150.00, NULL, '2024-05-12 06:40:50', NULL),
(42, 'REC000000002', 1, 'Receive', NULL, 152, 5, 'C000000101', 22, 82, 10.00, 0, 50.00, 500.00, NULL, '2024-05-12 06:41:10', NULL),
(43, 'REC000000002', 1, 'Receive', NULL, 152, 5, 'C000000101', 23, 85, 4.00, 0, 550.00, 2200.00, NULL, '2024-05-12 06:41:28', NULL),
(44, 'REC000000002', 1, 'Receive', NULL, 152, 5, 'C000000101', 24, 116, 15.00, 0, 125.00, 1875.00, NULL, '2024-05-12 06:41:45', NULL),
(45, 'REC000000002', 1, 'Receive', NULL, 152, 5, 'C000000101', 25, 121, 20.00, 0, 10.00, 200.00, NULL, '2024-05-12 06:42:00', NULL),
(46, 'REC000000002', 1, 'Receive', NULL, 152, 5, 'C000000101', 26, 126, 2.00, 0, 250.00, 500.00, NULL, '2024-05-12 06:42:24', NULL),
(47, 'REC000000003', 1, 'Receive', NULL, 353, 13, 'C000000102', 21, 72, 5.00, 0, 30.00, 150.00, NULL, '2024-05-12 06:45:00', NULL),
(48, 'REC000000003', 1, 'Receive', NULL, 353, 13, 'C000000102', 22, 111, 12.00, 0, 50.00, 600.00, NULL, '2024-05-12 06:45:21', NULL),
(49, 'REC000000003', 1, 'Receive', NULL, 353, 13, 'C000000102', 23, 84, 7.00, 0, 555.00, 3885.00, NULL, '2024-05-12 06:45:35', NULL),
(50, 'REC000000003', 1, 'Receive', NULL, 353, 13, 'C000000102', 24, 88, 9.00, 0, 60.00, 540.00, NULL, '2024-05-12 06:46:11', NULL),
(51, 'REC000000003', 1, 'Receive', NULL, 353, 13, 'C000000102', 26, 127, 15.00, 0, 60.00, 900.00, NULL, '2024-05-12 06:46:32', NULL),
(52, 'REC000000003', 1, 'Receive', NULL, 353, 13, 'C000000102', 25, 90, 16.00, 0, 10.00, 160.00, NULL, '2024-05-12 06:46:50', NULL),
(53, 'PAY000000002', 1, 'Payment', NULL, 1, 8, 'S000000101', 21, 73, 100.00, 0, 20.00, 2000.00, NULL, '2024-05-12 06:48:21', NULL),
(54, 'PAY000000002', 1, 'Payment', NULL, 1, 8, 'S000000101', 22, 110, 50.00, 0, 60.00, 3000.00, NULL, '2024-05-12 06:48:43', NULL),
(55, 'PAY000000002', 1, 'Payment', NULL, 1, 8, 'S000000101', 22, 82, 45.00, 0, 45.00, 2025.00, NULL, '2024-05-12 06:49:05', NULL),
(56, 'PAY000000002', 1, 'Payment', NULL, 1, 8, 'S000000101', 23, 86, 70.00, 0, 500.00, 35000.00, NULL, '2024-05-12 06:49:27', NULL),
(57, 'PAY000000002', 1, 'Payment', NULL, 1, 8, 'S000000101', 24, 89, 50.00, 0, 100.00, 5000.00, NULL, '2024-05-12 06:49:44', NULL),
(58, 'PAY000000002', 1, 'Payment', NULL, 1, 8, 'S000000101', 25, 119, 80.00, 0, 15.00, 1200.00, NULL, '2024-05-12 06:50:32', NULL),
(59, 'PAY000000002', 1, 'Payment', NULL, 1, 8, 'S000000101', 25, 92, 100.00, 0, 15.00, 1500.00, NULL, '2024-05-12 06:50:47', NULL),
(60, 'PAY000000002', 1, 'Payment', NULL, 1, 8, 'S000000101', 26, 124, 100.00, 0, 135.00, 13500.00, NULL, '2024-05-12 06:51:19', NULL),
(61, 'PAY000000003', 1, 'Payment', NULL, 152, 8, 'S000000103', 21, 74, 60.00, 0, 40.00, 2400.00, NULL, '2024-05-12 06:52:20', NULL),
(62, 'PAY000000003', 1, 'Payment', NULL, 152, 8, 'S000000103', 21, 76, 80.00, 0, 20.00, 1600.00, NULL, '2024-05-12 06:52:46', NULL),
(63, 'PAY000000003', 1, 'Payment', NULL, 152, 8, 'S000000103', 22, 108, 160.00, 0, 80.00, 12800.00, NULL, '2024-05-12 06:53:06', NULL),
(64, 'PAY000000003', 1, 'Payment', NULL, 152, 8, 'S000000103', 23, 83, 50.00, 0, 560.00, 28000.00, NULL, '2024-05-12 06:53:38', NULL),
(65, 'PAY000000003', 1, 'Payment', NULL, 152, 8, 'S000000103', 24, 115, 90.00, 0, 70.00, 6300.00, NULL, '2024-05-12 06:54:04', NULL),
(66, 'PAY000000003', 1, 'Payment', NULL, 152, 8, 'S000000103', 25, 119, 60.00, 0, 20.00, 1200.00, NULL, '2024-05-12 06:54:21', NULL),
(67, 'PAY000000003', 1, 'Payment', NULL, 152, 8, 'S000000103', 26, 128, 40.00, 0, 40.00, 1600.00, NULL, '2024-05-12 06:54:57', NULL),
(68, 'ITP000000001', 5, 'Payment', NULL, 245, 14, 'S000000108', 30, 137, 0.00, 10, 300.00, 3000.00, '2050-10-30', '2024-05-12 08:33:54', '2024-05-12 03:54:46'),
(69, 'ITP000000001', 5, 'Payment', NULL, 245, 14, 'S000000108', 30, 138, 5.00, 10, 500.00, 7500.00, '2050-10-10', '2024-05-12 08:34:24', '2024-05-12 03:55:18'),
(70, 'ITP000000001', 5, 'Payment', NULL, 426, 14, 'S000000108', 30, 137, 0.00, 10, 200.00, 2000.00, '2050-10-10', '2024-05-12 08:39:31', '2024-05-12 03:54:46'),
(71, 'ITP000000002', 5, 'Payment', NULL, 43, 18, 'S000000106', 5, 7, 10.00, 0, 35.00, 350.00, NULL, '2024-05-12 08:44:03', NULL),
(72, 'ITP000000002', 5, 'Payment', NULL, 43, 18, 'S000000106', 5, 10, 15.00, 0, 20.00, 300.00, NULL, '2024-05-12 08:44:11', NULL),
(73, 'ITP000000002', 5, 'Payment', NULL, 43, 18, 'S000000106', 5, 9, 20.00, 0, 15.00, 300.00, NULL, '2024-05-12 08:44:25', NULL),
(74, 'ITP000000002', 5, 'Payment', NULL, 43, 18, 'S000000106', 5, 9, 25.00, 0, 10.00, 250.00, NULL, '2024-05-12 08:44:38', NULL),
(75, 'ITR000000002', 5, 'Receive', NULL, 152, 19, 'C000000106', 30, 138, 10.00, 0, 300.00, 3000.00, NULL, '2024-05-12 09:55:18', NULL),
(76, 'ITP000000003', 5, 'Payment', NULL, 330, 14, 'S000000108', 30, 137, 0.00, 100, 250.00, 25000.00, NULL, '2024-05-12 10:03:25', '2024-05-12 04:05:20'),
(77, 'ITR000000002', 5, 'Receive', NULL, 249, 19, 'C000000106', 30, 137, 0.00, 10, 250.00, 2500.00, NULL, '2024-05-12 10:03:54', '2024-05-12 04:05:20'),
(78, 'REC000000004', 1, 'Receive', NULL, 426, 5, 'C000000102', 7, 25, 10.00, 0, 155.00, 1550.00, NULL, '2024-05-12 10:48:56', NULL),
(79, 'REC000000004', 1, 'Receive', NULL, 426, 5, 'C000000102', 7, 30, 10.00, 0, 115.00, 1150.00, NULL, '2024-05-12 10:49:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction__groupes`
--

CREATE TABLE `transaction__groupes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tran_groupe_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tran_groupe_type` bigint(20) UNSIGNED NOT NULL,
  `tran_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction__groupes`
--

INSERT INTO `transaction__groupes` (`id`, `tran_groupe_name`, `tran_groupe_type`, `tran_method`, `added_at`, `updated_at`) VALUES
(1, 'Salary', 3, 'Both', '2024-05-08 09:01:59', NULL),
(2, 'Party Payments', 2, 'Both', '2024-05-08 09:01:59', NULL),
(3, 'Deposit To Bank', 4, 'Payment', '2024-05-08 09:01:59', NULL),
(4, 'Withdraw From Bank', 4, 'Receive', '2024-05-08 09:01:59', NULL),
(5, 'Kitchen', 5, 'Payment', '2024-05-08 09:01:59', NULL),
(6, 'Printing Tools', 1, 'Payment', '2024-05-08 09:01:59', NULL),
(7, 'Advertisement', 1, 'Receive', '2024-05-08 09:01:59', NULL),
(8, 'Utility', 1, 'Payment', '2024-05-08 09:01:59', NULL),
(9, 'Miscellaneous', 1, 'Payment', '2024-05-08 09:01:59', NULL),
(15, 'Tablet', 7, 'Payment', '2024-05-08 09:01:59', NULL),
(16, 'Capsule', 7, 'Payment', '2024-05-08 09:01:59', NULL),
(17, 'Injection', 7, 'Payment', '2024-05-08 09:01:59', NULL),
(18, 'Shyrup', 7, 'Payment', '2024-05-08 09:01:59', NULL),
(19, 'Cloth', 1, 'Receive', '2024-05-09 10:00:15', '2024-05-09 04:01:52'),
(20, 'Food', 1, 'Receive', '2024-05-09 10:29:44', NULL),
(21, 'Drinks', 1, 'Both', '2024-05-09 10:31:59', NULL),
(22, 'Ice Cream', 1, 'Both', '2024-05-09 10:32:10', NULL),
(23, 'Oil', 1, 'Both', '2024-05-09 10:32:18', NULL),
(24, 'Rice', 1, 'Both', '2024-05-09 10:32:25', NULL),
(25, 'Biscuit', 1, 'Both', '2024-05-09 10:32:35', NULL),
(26, 'Others Food Items', 1, 'Both', '2024-05-09 10:32:53', NULL),
(27, 'Stationary', 1, 'Both', '2024-05-09 10:39:52', NULL),
(30, 'Furniture Item', 5, 'Both', '2024-05-12 08:11:02', NULL),
(31, 'Electric Item', 5, 'Both', '2024-05-12 08:11:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction__heads`
--

CREATE TABLE `transaction__heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tran_head_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction__heads`
--

INSERT INTO `transaction__heads` (`id`, `tran_head_name`, `groupe_id`, `added_at`, `updated_at`) VALUES
(1, 'Receive from client', 2, '2024-05-08 09:01:59', NULL),
(2, 'Payment To Supplier', 2, '2024-05-08 09:01:59', NULL),
(3, 'Cash Deposit To Bank', 3, '2024-05-08 09:01:59', NULL),
(4, 'Cheque Deposit to Bank', 3, '2024-05-08 09:01:59', NULL),
(5, 'Cash Withdraw from Bank', 4, '2024-05-08 09:01:59', NULL),
(6, 'Cheque Withdraw from Bank', 4, '2024-05-08 09:01:59', NULL),
(7, 'Alu', 5, '2024-05-08 09:01:59', NULL),
(8, 'Potol', 5, '2024-05-08 09:01:59', NULL),
(9, 'Korola', 5, '2024-05-08 09:01:59', NULL),
(10, 'Jhinga', 5, '2024-05-08 09:01:59', NULL),
(11, 'Basic', 1, '2024-05-08 09:01:59', NULL),
(12, 'House Rent', 1, '2024-05-08 09:01:59', NULL),
(13, 'Medical', 1, '2024-05-08 09:01:59', NULL),
(14, 'TA/DA', 1, '2024-05-08 09:01:59', NULL),
(15, 'Mobile', 1, '2024-05-08 09:01:59', NULL),
(16, 'Incentive', 1, '2024-05-08 09:01:59', NULL),
(17, 'Eid-Ul-Fitar Bonus', 1, '2024-05-08 09:01:59', NULL),
(18, 'Eid-Ul-Azha Bonus', 1, '2024-05-08 09:01:59', NULL),
(19, 'Provident Fund', 1, '2024-05-08 09:01:59', NULL),
(20, 'Gratuity', 1, '2024-05-08 09:01:59', NULL),
(21, 'Increament', 1, '2024-05-08 09:01:59', NULL),
(22, 'Color Touner', 6, '2024-05-08 09:01:59', NULL),
(23, 'Printing Paper', 6, '2024-05-08 09:01:59', NULL),
(24, 'Printing Colors', 6, '2024-05-08 09:01:59', NULL),
(25, '1 Inch Add', 7, '2024-05-08 09:01:59', NULL),
(26, '2 Inch Add', 7, '2024-05-08 09:01:59', NULL),
(27, '4 Inch Add', 7, '2024-05-08 09:01:59', NULL),
(28, 'Half Page Add', 7, '2024-05-08 09:01:59', NULL),
(29, 'Full Page Add', 7, '2024-05-08 09:01:59', NULL),
(30, '1 Col Add', 7, '2024-05-08 09:01:59', NULL),
(31, '2 Col Add', 7, '2024-05-08 09:01:59', NULL),
(32, '4 Col Add', 7, '2024-05-08 09:01:59', NULL),
(33, 'Gas Bill', 8, '2024-05-08 09:01:59', NULL),
(34, 'Water Bill', 8, '2024-05-08 09:01:59', NULL),
(35, 'Electricity Bill', 8, '2024-05-08 09:01:59', NULL),
(36, 'Telephone Bill', 8, '2024-05-08 09:01:59', NULL),
(37, 'Transportation Bill', 8, '2024-05-08 09:01:59', NULL),
(38, 'Furniture Bill', 8, '2024-05-08 09:01:59', NULL),
(39, 'Rollerball Pen', 8, '2024-05-08 09:01:59', NULL),
(40, 'Gel pen', 8, '2024-05-08 09:01:59', NULL),
(41, 'Ballpoint Pen', 8, '2024-05-08 09:01:59', NULL),
(42, 'Fountain pen', 8, '2024-05-08 09:01:59', NULL),
(43, 'Marker Pen', 8, '2024-05-08 09:01:59', NULL),
(60, 'Fluoxetine', 15, '2024-05-08 09:01:59', NULL),
(61, 'Esomeprazole', 15, '2024-05-08 09:01:59', NULL),
(62, 'Pregabalin', 15, '2024-05-08 09:01:59', NULL),
(63, 'Adrenaline', 16, '2024-05-08 09:01:59', NULL),
(64, 'Insulin', 16, '2024-05-08 09:01:59', NULL),
(65, 'Penicillin', 16, '2024-05-08 09:01:59', NULL),
(66, 'Heparin', 16, '2024-05-08 09:01:59', NULL),
(67, 'Paracetamol syrup', 17, '2024-05-08 09:01:59', NULL),
(68, 'Amoxicillin syrup', 17, '2024-05-08 09:01:59', NULL),
(69, 'Antacid syrup', 17, '2024-05-08 09:01:59', NULL),
(70, 'Shirt', 19, '2024-05-09 10:02:20', NULL),
(71, 'Coke', 21, '2024-05-09 10:33:20', NULL),
(72, 'Sprite', 21, '2024-05-09 10:33:31', NULL),
(73, '7up', 21, '2024-05-09 10:33:42', NULL),
(74, 'Speed', 21, '2024-05-09 10:33:51', NULL),
(75, 'String', 21, '2024-05-09 10:34:01', NULL),
(76, 'Mojo', 21, '2024-05-09 10:34:08', NULL),
(77, 'Fanta', 21, '2024-05-09 10:34:15', NULL),
(78, 'Orange Juice', 21, '2024-05-09 10:34:29', NULL),
(79, 'Vanilla Ice cream', 22, '2024-05-09 10:35:00', NULL),
(80, 'Mango Ice Cream', 22, '2024-05-09 10:35:16', NULL),
(81, 'Chocolate Ice Cream', 22, '2024-05-09 10:35:25', NULL),
(82, 'Butterscotch Ice Cream', 22, '2024-05-09 10:35:38', '2024-05-09 05:42:31'),
(83, 'Rupchada Oil', 23, '2024-05-09 10:36:05', NULL),
(84, 'Teer Oil', 23, '2024-05-09 10:36:17', NULL),
(85, 'Bashundhara Oil', 23, '2024-05-09 10:36:27', NULL),
(86, 'Pushti Oil', 23, '2024-05-09 10:36:34', NULL),
(87, 'Atop Rice', 24, '2024-05-09 10:36:53', NULL),
(88, 'Miniket Rice', 24, '2024-05-09 10:37:04', NULL),
(89, 'Fragrant Rice', 24, '2024-05-09 10:37:19', NULL),
(90, 'Energy Biscuit', 25, '2024-05-09 10:37:37', NULL),
(91, 'Potata Biscuit', 25, '2024-05-09 10:37:44', NULL),
(92, 'Fit Biscuit', 25, '2024-05-09 10:37:50', NULL),
(93, 'Lexux Biscuit', 25, '2024-05-09 10:37:59', NULL),
(94, 'Oreo Biscuit', 25, '2024-05-09 10:38:04', NULL),
(95, 'Lentil', 26, '2024-05-09 10:38:20', NULL),
(96, 'Spices', 26, '2024-05-09 10:38:29', NULL),
(97, 'Chocolate', 26, '2024-05-09 10:38:46', NULL),
(98, 'Pen', 27, '2024-05-09 10:40:07', NULL),
(99, 'Book', 27, '2024-05-09 10:40:16', NULL),
(100, 'Pencil', 27, '2024-05-09 10:40:23', NULL),
(101, 'Marker', 27, '2024-05-09 10:40:44', NULL),
(102, 'Ball Point Pen', 27, '2024-05-09 10:41:11', NULL),
(103, 'Highlighter', 27, '2024-05-09 10:41:20', NULL),
(104, 'Notebook', 27, '2024-05-09 10:41:35', NULL),
(105, 'Pepsi', 21, '2024-05-09 11:39:33', NULL),
(106, 'RC Cola', 21, '2024-05-09 11:39:44', NULL),
(107, 'Strawberry Ice Cream', 22, '2024-05-09 11:40:51', NULL),
(108, 'Cookies \'n cream Ice Cream', 22, '2024-05-09 11:41:11', NULL),
(109, 'PistachioIce Cream', 22, '2024-05-09 11:46:39', NULL),
(110, 'Butter pecan Ice Cream', 22, '2024-05-09 11:47:05', NULL),
(111, 'Caramel Ice Cream', 22, '2024-05-09 11:47:45', NULL),
(112, 'Mint Chocolate Chip', 22, '2024-05-12 06:22:06', NULL),
(113, 'Dalda Oil', 23, '2024-05-12 06:24:12', NULL),
(114, 'Bashmoti Rice', 24, '2024-05-12 06:24:44', NULL),
(115, 'Binni Rice', 24, '2024-05-12 06:24:57', NULL),
(116, 'Chinigura Rice', 24, '2024-05-12 06:25:21', NULL),
(117, 'Katari Bhog Rice', 24, '2024-05-12 06:25:41', NULL),
(118, 'Najir Shail Rice', 24, '2024-05-12 06:25:51', NULL),
(119, 'Danish Biscuit', 25, '2024-05-12 06:27:12', NULL),
(120, 'Nabisco Biscuit', 25, '2024-05-12 06:27:25', NULL),
(121, 'Cocola Biscuit', 25, '2024-05-12 06:27:47', NULL),
(122, 'Kishwan Biscuit', 25, '2024-05-12 06:28:52', NULL),
(123, 'Britannia Biscuit', 25, '2024-05-12 06:29:38', NULL),
(124, 'Noodles', 26, '2024-05-12 06:30:08', NULL),
(125, 'Pasta', 26, '2024-05-12 06:30:14', NULL),
(126, 'Cheese', 26, '2024-05-12 06:30:48', NULL),
(127, 'Butter', 26, '2024-05-12 06:30:55', NULL),
(128, 'Yoghurt', 26, '2024-05-12 06:31:04', NULL),
(129, 'Eraser', 27, '2024-05-12 06:34:16', NULL),
(130, 'Ruler', 27, '2024-05-12 06:34:24', NULL),
(131, 'Scotch Tape', 27, '2024-05-12 06:35:28', NULL),
(132, 'Wire', 9, '2024-05-12 06:36:28', NULL),
(133, 'Bulb', 9, '2024-05-12 06:36:36', NULL),
(134, 'Multiplug', 9, '2024-05-12 06:36:58', NULL),
(135, 'Computer Purchase', 9, '2024-05-12 06:37:35', NULL),
(136, 'Keyboard', 9, '2024-05-12 06:38:00', NULL),
(137, 'Chair', 30, '2024-05-12 08:15:58', NULL),
(138, 'Table', 30, '2024-05-12 08:16:04', NULL),
(139, 'Switch', 31, '2024-05-12 08:16:24', NULL),
(140, 'Light', 31, '2024-05-12 08:16:31', NULL),
(141, 'Fan', 31, '2024-05-12 08:16:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction__mains`
--

CREATE TABLE `transaction__mains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tran_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tran_type` bigint(20) UNSIGNED NOT NULL,
  `tran_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tran_type_with` bigint(20) UNSIGNED DEFAULT NULL,
  `tran_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_amount` double(8,2) DEFAULT NULL,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `net_amount` double(8,2) DEFAULT NULL,
  `receive` double(8,2) DEFAULT NULL,
  `payment` double(8,2) DEFAULT NULL,
  `due` double(8,2) DEFAULT NULL,
  `due_col` double(8,2) DEFAULT 0.00,
  `due_disc` double(8,2) DEFAULT 0.00,
  `tran_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction__mains`
--

INSERT INTO `transaction__mains` (`id`, `tran_id`, `tran_type`, `tran_method`, `invoice`, `loc_id`, `tran_type_with`, `tran_user`, `bill_amount`, `discount`, `net_amount`, `receive`, `payment`, `due`, `due_col`, `due_disc`, `tran_date`, `updated_at`) VALUES
(1, 'PRP000000001', 3, 'Payment', NULL, NULL, 1, 'E000000101', 89000.00, 0.00, 89000.00, NULL, 89000.00, 0.00, 0.00, 0.00, '2024-05-08 09:12:16', NULL),
(2, 'PRP000000002', 3, 'Payment', NULL, NULL, 1, 'E000000102', 10000.00, 0.00, 10000.00, NULL, 10000.00, 0.00, 0.00, 0.00, '2024-05-08 09:12:16', NULL),
(3, 'REC000000001', 1, 'Receive', NULL, 52, 5, 'C000000101', 778.00, 100.00, 678.00, 300.00, NULL, 0.00, 328.00, 50.00, '2024-05-09 09:23:53', '2024-05-09 03:29:23'),
(4, 'PAY000000001', 1, 'Payment', NULL, 171, 8, 'S000000101', 13405.00, 500.00, 12905.00, NULL, 8000.00, 905.00, 3000.00, 1000.00, '2024-05-09 09:27:21', '2024-05-09 03:30:26'),
(5, 'PRP000000003', 3, 'Payment', NULL, NULL, 1, 'E000000101', 89000.00, 0.00, 89000.00, NULL, 89000.00, 0.00, 0.00, 0.00, '2024-05-09 09:33:25', NULL),
(6, 'PRP000000004', 3, 'Payment', NULL, NULL, 1, 'E000000102', 15350.00, 0.00, 15350.00, NULL, 15350.00, 0.00, 0.00, 0.00, '2024-05-09 09:33:25', NULL),
(7, 'PRP000000005', 3, 'Payment', NULL, NULL, 1, 'E000000101', 89000.00, 0.00, 89000.00, NULL, 89000.00, 0.00, 0.00, 0.00, '2024-05-09 09:36:18', NULL),
(8, 'PRP000000006', 3, 'Payment', NULL, NULL, 1, 'E000000102', 15350.00, 0.00, 15350.00, NULL, 15350.00, 0.00, 0.00, 0.00, '2024-05-09 09:36:18', NULL),
(9, 'BMW000000001', 4, 'Receive', NULL, 335, 4, 'B000000101', 5000.00, 0.00, 5000.00, 5000.00, NULL, 0.00, 0.00, 0.00, '2024-05-09 10:05:38', NULL),
(10, 'BMD000000001', 4, 'Payment', NULL, 335, 4, 'B000000101', 100000.00, 0.00, 100000.00, NULL, 100000.00, 0.00, 0.00, 0.00, '2024-05-09 10:06:42', NULL),
(11, 'PRP000000007', 3, 'Payment', NULL, NULL, 1, 'E000000101', 89000.00, 0.00, 89000.00, NULL, 89000.00, 0.00, 0.00, 0.00, '2024-05-09 11:36:58', NULL),
(12, 'PRP000000008', 3, 'Payment', NULL, NULL, 1, 'E000000102', 15350.00, 0.00, 15350.00, NULL, 15350.00, 0.00, 0.00, 0.00, '2024-05-09 11:36:59', NULL),
(13, 'REC000000002', 1, 'Receive', NULL, 152, 5, 'C000000101', 5425.00, 25.00, 5400.00, 3000.00, NULL, 2400.00, 0.00, 0.00, '2024-05-12 06:42:51', NULL),
(14, 'REC000000003', 1, 'Receive', NULL, 353, 13, 'C000000102', 6235.00, 100.00, 6135.00, 3000.00, NULL, 3135.00, 0.00, 0.00, '2024-05-12 06:47:12', NULL),
(15, 'PAY000000002', 1, 'Payment', NULL, 1, 8, 'S000000101', 63225.00, 225.00, 63000.00, NULL, 10000.00, 53000.00, 0.00, 0.00, '2024-05-12 06:51:41', NULL),
(16, 'PAY000000003', 1, 'Payment', NULL, 152, 8, 'S000000103', 53900.00, 600.00, 53300.00, NULL, 25000.00, 28300.00, 0.00, 0.00, '2024-05-12 06:55:22', NULL),
(17, 'ITP000000001', 5, 'Payment', NULL, 426, 14, 'S000000108', 12500.00, 500.00, 12000.00, NULL, 6000.00, 6000.00, 0.00, 0.00, '2024-05-12 08:41:07', NULL),
(18, 'ITP000000002', 5, 'Payment', NULL, 43, 18, 'S000000106', 1200.00, 100.00, 1100.00, NULL, 500.00, 600.00, 0.00, 0.00, '2024-05-12 08:46:11', NULL),
(19, 'ITR000000001', 5, 'Receive', NULL, 240, 19, 'C000000106', 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, '2024-05-12 09:10:25', NULL),
(20, 'ITP000000003', 5, 'Payment', NULL, 330, 14, 'S000000108', 25000.00, 0.00, 25000.00, NULL, 0.00, 25000.00, 0.00, 0.00, '2024-05-12 10:03:27', NULL),
(21, 'ITR000000002', 5, 'Receive', NULL, 249, 19, 'C000000106', 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, '2024-05-12 10:07:26', NULL),
(22, 'REC000000004', 1, 'Receive', NULL, 426, 5, 'C000000102', 2700.00, 50.00, 2650.00, 2650.00, NULL, 0.00, 0.00, 0.00, '2024-05-12 10:52:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction__types`
--

CREATE TABLE `transaction__types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction__types`
--

INSERT INTO `transaction__types` (`id`, `type_name`, `added_at`, `updated_at`) VALUES
(1, 'General A/C', '2024-05-08 09:01:59', NULL),
(2, 'Party Payment', '2024-05-08 09:01:59', NULL),
(3, 'Payroll', '2024-05-08 09:01:59', NULL),
(4, 'Bank', '2024-05-08 09:01:59', NULL),
(5, 'Inventory', '2024-05-08 09:01:59', NULL),
(7, 'Pharmacy', '2024-05-08 09:01:59', NULL),
(8, 'Kitchen', '2024-05-08 09:01:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction__withs`
--

CREATE TABLE `transaction__withs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tran_with_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tran_type` bigint(20) UNSIGNED NOT NULL,
  `tran_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction__withs`
--

INSERT INTO `transaction__withs` (`id`, `tran_with_name`, `user_type`, `tran_type`, `tran_method`, `added_at`, `updated_at`) VALUES
(1, 'Regular Employee', 'Employee', 3, 'Both', '2024-05-08 09:01:59', NULL),
(2, 'Bit Pion', 'Employee', 3, 'Both', '2024-05-08 09:01:59', NULL),
(3, 'District Employee', 'Employee', 3, 'Both', '2024-05-08 09:01:59', NULL),
(4, 'Bank', 'Bank', 4, 'Both', '2024-05-08 09:01:59', NULL),
(5, 'Client', 'Client', 1, 'Receive', '2024-05-08 09:01:59', '2024-05-12 01:24:12'),
(6, 'Advertisement Client', 'Client', 1, 'Receive', '2024-05-08 09:01:59', NULL),
(7, 'Newspaper Client', 'Client', 1, 'Receive', '2024-05-08 09:01:59', NULL),
(8, 'General Supplier', 'Supplier', 1, 'Payment', '2024-05-08 09:01:59', NULL),
(9, 'Printing tools Supplier', 'Supplier', 1, 'Payment', '2024-05-08 09:01:59', NULL),
(10, 'Neewspaper Supplier', 'Supplier', 1, 'Payment', '2024-05-08 09:01:59', NULL),
(11, 'Food Supplier', 'Supplier', 8, 'Payment', '2024-05-08 09:01:59', '2024-05-12 01:37:01'),
(12, 'Stationary Supplier', 'Supplier', 5, 'Payment', '2024-05-08 09:01:59', '2024-05-12 01:36:50'),
(13, 'Due Client', 'Client', 1, 'Receive', '2024-05-09 10:43:44', NULL),
(14, 'Furniture Supplier', 'Supplier', 5, 'Payment', '2024-05-12 07:38:26', NULL),
(15, 'Electric Supplier', 'Supplier', 5, 'Payment', '2024-05-12 07:38:48', NULL),
(16, 'Sanitary Supplier', 'Supplier', 5, 'Payment', '2024-05-12 07:39:08', NULL),
(17, 'Inventory Client', 'Client', 5, 'Receive', '2024-05-12 07:42:55', NULL),
(18, 'Kitchen Supplier', 'Supplier', 5, 'Payment', '2024-05-12 07:54:22', '2024-05-12 02:43:23'),
(19, 'Furniture Client', 'Client', 5, 'Receive', '2024-05-12 08:48:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction__with__groupes`
--

CREATE TABLE `transaction__with__groupes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `with_id` bigint(20) UNSIGNED NOT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction__with__groupes`
--

INSERT INTO `transaction__with__groupes` (`id`, `with_id`, `groupe_id`, `added_at`, `updated_at`) VALUES
(1, 1, 19, '2024-05-09 10:00:40', NULL),
(2, 5, 20, '2024-05-09 10:31:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user__infos`
--

CREATE TABLE `user__infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tran_user_type` bigint(20) UNSIGNED DEFAULT NULL,
  `dept_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 for Active 0 for Inactive',
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user__infos`
--

INSERT INTO `user__infos` (`id`, `user_id`, `user_name`, `user_email`, `user_phone`, `gender`, `loc_id`, `user_type`, `tran_user_type`, `dept_id`, `designation_id`, `dob`, `nid`, `address`, `image`, `status`, `added_at`, `updated_at`) VALUES
(1, 'E000000101', 'Shagufta Sajid', 'ssajid3421@gmail.com', '01767940630', 'female', 249, 'employee', 1, NULL, NULL, '2024-05-06', '9786653', 'Shewrapara', 'E000000101(Shagufta Sajid).png', 1, '2024-05-08 09:02:31', '2024-05-08 03:02:43'),
(2, 'E000000102', 'Humayra Ashpiya', 'arpee@gmail.com', '01457940630', 'female', 7, 'employee', 1, NULL, NULL, '2024-05-17', '78476453', 'Kazipara', 'E000000102(Humayra Ashpiya).jpg', 1, '2024-05-08 09:04:37', NULL),
(3, 'C000000101', 'Fardin', 'fardin@gmail.com', '01325899384', 'male', 347, 'client', 5, NULL, NULL, NULL, NULL, 'Mirpur 2', NULL, 1, '2024-05-09 09:22:03', NULL),
(4, 'S000000101', 'Md. Sajid', 'sajid@gmail.com', '01856715365', 'male', 487, 'supplier', 8, NULL, NULL, NULL, NULL, 'Shewrapara', NULL, 1, '2024-05-09 09:25:23', NULL),
(5, 'C000000102', 'Tasin', 'tasin@gmail.com', '01314353560', 'male', 437, 'client', 5, NULL, NULL, NULL, NULL, 'Cumilla', NULL, 1, '2024-05-09 10:03:24', '2024-05-12 01:23:27'),
(6, 'B000000101', 'Jonota Bank', 'jonota@gmail.com', '0161544215', NULL, 288, 'bank', 4, NULL, NULL, NULL, NULL, 'Mirpur 10', NULL, 1, '2024-05-09 10:04:39', NULL),
(7, 'S000000102', 'Mozib', 'mozib@gmail.com', '0143542154', 'male', 152, 'supplier', 8, NULL, NULL, NULL, NULL, 'Farmgate', NULL, 1, '2024-05-09 10:42:23', NULL),
(8, 'S000000103', 'Shila', 'Shila@gmail.com', '019353641', 'female', 1, 'supplier', 8, NULL, NULL, NULL, NULL, 'Kazipara', NULL, 1, '2024-05-09 10:42:52', NULL),
(9, 'E000000103', 'Fardin', 'fardin01@gmail.com', '01675454756', 'male', 52, 'employee', 3, NULL, NULL, '2002-03-27', '78476453', 'Mirpur 2', 'E000000103(Fardin).jpg', 1, '2024-05-12 06:16:42', NULL),
(10, 'S000000104', 'Aco Sanitary', 'aco421@gmail.com', '01678736', 'male', 426, 'supplier', 16, NULL, NULL, NULL, NULL, 'Farmgate', NULL, 1, '2024-05-12 07:40:18', '2024-05-12 02:38:03'),
(11, 'S000000105', 'Bco Sanitary', 'Bco@gmail.com', '0155434', 'male', 426, 'supplier', 16, NULL, NULL, NULL, NULL, 'Kazipara', NULL, 1, '2024-05-12 07:40:43', '2024-05-12 02:38:11'),
(12, 'C000000103', 'General Client', 'general@gmail.com', '0163544', 'male', 330, 'client', 17, NULL, NULL, NULL, NULL, 'Cumilla', NULL, 1, '2024-05-12 07:45:01', NULL),
(13, 'C000000104', 'Abdul Rahman and Co.', 'abdul@gmail.com', '01254364', 'male', 43, 'client', 17, NULL, NULL, NULL, NULL, 'Mirpur 10', NULL, 1, '2024-05-12 07:45:40', NULL),
(14, 'C000000105', 'Akkas Ali and Brothers', 'akkas@gmail.com', '0192634654', 'male', 152, 'client', 17, NULL, NULL, NULL, NULL, 'Banani', NULL, 1, '2024-05-12 07:46:43', NULL),
(15, 'B000000102', 'City Bank', 'citybank@gmail.com', '018345641', NULL, 52, 'bank', 4, NULL, NULL, NULL, NULL, 'Gulshan', NULL, 1, '2024-05-12 07:52:30', NULL),
(16, 'B000000103', 'AB Bank', 'abbank@gmail.com', '0168744', NULL, 19, 'bank', 4, NULL, NULL, NULL, NULL, 'Shewrapara', NULL, 1, '2024-05-12 07:53:11', NULL),
(17, 'S000000106', 'Bazar Supplier', 'bazar@gmail.com', '01946354', 'male', 437, 'supplier', 18, NULL, NULL, NULL, NULL, 'Mirpur 2', NULL, 1, '2024-05-12 07:57:05', '2024-05-12 01:58:35'),
(18, 'S000000107', 'Zaman Shop', 'zaman@gmail.com', '014645544', 'male', 7, 'supplier', 18, NULL, NULL, NULL, NULL, 'Farmgate', NULL, 1, '2024-05-12 07:57:28', '2024-05-12 01:59:14'),
(19, 'S000000108', 'Sojib Furnitures', 'sojib@gmail.com', '016975453', 'male', 8, 'supplier', 14, NULL, NULL, NULL, NULL, 'Kazipara', NULL, 1, '2024-05-12 08:18:57', NULL),
(20, 'C000000106', 'Farin Furnitures', 'farin@gmail.com', '01864541', 'female', 353, 'client', 19, NULL, NULL, NULL, NULL, 'Agargaon', NULL, 1, '2024-05-12 08:49:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `attendences`
--
ALTER TABLE `attendences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department__infos`
--
ALTER TABLE `department__infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_dept_id_foreign` (`dept_id`);

--
-- Indexes for table `education_details`
--
ALTER TABLE `education_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `education_details_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `experience_details`
--
ALTER TABLE `experience_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experience_details_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `location__infos`
--
ALTER TABLE `location__infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_details`
--
ALTER TABLE `organization_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_details_emp_id_foreign` (`emp_id`),
  ADD KEY `organization_details_joining_location_foreign` (`joining_location`),
  ADD KEY `organization_details_department_foreign` (`department`),
  ADD KEY `organization_details_designation_foreign` (`designation`);

--
-- Indexes for table `party__payment__receives`
--
ALTER TABLE `party__payment__receives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party__payment__receives_tran_type_foreign` (`tran_type`),
  ADD KEY `party__payment__receives_loc_id_foreign` (`loc_id`),
  ADD KEY `party__payment__receives_tran_type_with_foreign` (`tran_type_with`),
  ADD KEY `party__payment__receives_tran_groupe_id_foreign` (`tran_groupe_id`),
  ADD KEY `party__payment__receives_tran_head_id_foreign` (`tran_head_id`),
  ADD KEY `party__payment__receives_tran_user_foreign` (`tran_user`);

--
-- Indexes for table `pay__roll__middlewires`
--
ALTER TABLE `pay__roll__middlewires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pay__roll__middlewires_emp_id_foreign` (`emp_id`),
  ADD KEY `pay__roll__middlewires_head_id_foreign` (`head_id`);

--
-- Indexes for table `pay__roll__setups`
--
ALTER TABLE `pay__roll__setups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pay__roll__setups_emp_id_foreign` (`emp_id`),
  ADD KEY `pay__roll__setups_head_id_foreign` (`head_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_details_employee_id_unique` (`employee_id`),
  ADD KEY `personal_details_location_id_foreign` (`location_id`),
  ADD KEY `personal_details_tran_user_type_foreign` (`tran_user_type`);

--
-- Indexes for table `training_details`
--
ALTER TABLE `training_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_details_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `transaction__details`
--
ALTER TABLE `transaction__details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction__details_tran_type_foreign` (`tran_type`),
  ADD KEY `transaction__details_loc_id_foreign` (`loc_id`),
  ADD KEY `transaction__details_tran_type_with_foreign` (`tran_type_with`),
  ADD KEY `transaction__details_tran_groupe_id_foreign` (`tran_groupe_id`),
  ADD KEY `transaction__details_tran_head_id_foreign` (`tran_head_id`),
  ADD KEY `transaction__details_tran_user_foreign` (`tran_user`);

--
-- Indexes for table `transaction__groupes`
--
ALTER TABLE `transaction__groupes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction__groupes_tran_groupe_type_foreign` (`tran_groupe_type`);

--
-- Indexes for table `transaction__heads`
--
ALTER TABLE `transaction__heads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction__heads_groupe_id_foreign` (`groupe_id`);

--
-- Indexes for table `transaction__mains`
--
ALTER TABLE `transaction__mains`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction__mains_tran_id_unique` (`tran_id`),
  ADD KEY `transaction__mains_tran_type_foreign` (`tran_type`),
  ADD KEY `transaction__mains_loc_id_foreign` (`loc_id`),
  ADD KEY `transaction__mains_tran_type_with_foreign` (`tran_type_with`),
  ADD KEY `transaction__mains_tran_user_foreign` (`tran_user`);

--
-- Indexes for table `transaction__types`
--
ALTER TABLE `transaction__types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction__withs`
--
ALTER TABLE `transaction__withs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction__withs_tran_type_foreign` (`tran_type`);

--
-- Indexes for table `transaction__with__groupes`
--
ALTER TABLE `transaction__with__groupes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction__with__groupes_with_id_foreign` (`with_id`),
  ADD KEY `transaction__with__groupes_groupe_id_foreign` (`groupe_id`);

--
-- Indexes for table `user__infos`
--
ALTER TABLE `user__infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user__infos_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `user__infos_user_email_unique` (`user_email`),
  ADD UNIQUE KEY `user__infos_user_phone_unique` (`user_phone`),
  ADD KEY `user__infos_loc_id_foreign` (`loc_id`),
  ADD KEY `user__infos_dept_id_foreign` (`dept_id`),
  ADD KEY `user__infos_designation_id_foreign` (`designation_id`),
  ADD KEY `user__infos_tran_user_type_foreign` (`tran_user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendences`
--
ALTER TABLE `attendences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department__infos`
--
ALTER TABLE `department__infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `education_details`
--
ALTER TABLE `education_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `experience_details`
--
ALTER TABLE `experience_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `location__infos`
--
ALTER TABLE `location__infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=495;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `organization_details`
--
ALTER TABLE `organization_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `party__payment__receives`
--
ALTER TABLE `party__payment__receives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pay__roll__middlewires`
--
ALTER TABLE `pay__roll__middlewires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pay__roll__setups`
--
ALTER TABLE `pay__roll__setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `training_details`
--
ALTER TABLE `training_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaction__details`
--
ALTER TABLE `transaction__details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `transaction__groupes`
--
ALTER TABLE `transaction__groupes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `transaction__heads`
--
ALTER TABLE `transaction__heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `transaction__mains`
--
ALTER TABLE `transaction__mains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transaction__types`
--
ALTER TABLE `transaction__types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction__withs`
--
ALTER TABLE `transaction__withs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transaction__with__groupes`
--
ALTER TABLE `transaction__with__groupes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user__infos`
--
ALTER TABLE `user__infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_dept_id_foreign` FOREIGN KEY (`dept_id`) REFERENCES `department__infos` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `education_details`
--
ALTER TABLE `education_details`
  ADD CONSTRAINT `education_details_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `personal_details` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `experience_details`
--
ALTER TABLE `experience_details`
  ADD CONSTRAINT `experience_details_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `personal_details` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organization_details`
--
ALTER TABLE `organization_details`
  ADD CONSTRAINT `organization_details_department_foreign` FOREIGN KEY (`department`) REFERENCES `department__infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organization_details_designation_foreign` FOREIGN KEY (`designation`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organization_details_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `personal_details` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organization_details_joining_location_foreign` FOREIGN KEY (`joining_location`) REFERENCES `location__infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `party__payment__receives`
--
ALTER TABLE `party__payment__receives`
  ADD CONSTRAINT `party__payment__receives_loc_id_foreign` FOREIGN KEY (`loc_id`) REFERENCES `location__infos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `party__payment__receives_tran_groupe_id_foreign` FOREIGN KEY (`tran_groupe_id`) REFERENCES `transaction__groupes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `party__payment__receives_tran_head_id_foreign` FOREIGN KEY (`tran_head_id`) REFERENCES `transaction__heads` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `party__payment__receives_tran_type_foreign` FOREIGN KEY (`tran_type`) REFERENCES `transaction__types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `party__payment__receives_tran_type_with_foreign` FOREIGN KEY (`tran_type_with`) REFERENCES `transaction__withs` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `party__payment__receives_tran_user_foreign` FOREIGN KEY (`tran_user`) REFERENCES `user__infos` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `pay__roll__middlewires`
--
ALTER TABLE `pay__roll__middlewires`
  ADD CONSTRAINT `pay__roll__middlewires_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `user__infos` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pay__roll__middlewires_head_id_foreign` FOREIGN KEY (`head_id`) REFERENCES `transaction__heads` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pay__roll__setups`
--
ALTER TABLE `pay__roll__setups`
  ADD CONSTRAINT `pay__roll__setups_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `user__infos` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pay__roll__setups_head_id_foreign` FOREIGN KEY (`head_id`) REFERENCES `transaction__heads` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD CONSTRAINT `personal_details_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `location__infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personal_details_tran_user_type_foreign` FOREIGN KEY (`tran_user_type`) REFERENCES `transaction__withs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `training_details`
--
ALTER TABLE `training_details`
  ADD CONSTRAINT `training_details_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `personal_details` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction__details`
--
ALTER TABLE `transaction__details`
  ADD CONSTRAINT `transaction__details_loc_id_foreign` FOREIGN KEY (`loc_id`) REFERENCES `location__infos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction__details_tran_groupe_id_foreign` FOREIGN KEY (`tran_groupe_id`) REFERENCES `transaction__groupes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction__details_tran_head_id_foreign` FOREIGN KEY (`tran_head_id`) REFERENCES `transaction__heads` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction__details_tran_type_foreign` FOREIGN KEY (`tran_type`) REFERENCES `transaction__types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction__details_tran_type_with_foreign` FOREIGN KEY (`tran_type_with`) REFERENCES `transaction__withs` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction__details_tran_user_foreign` FOREIGN KEY (`tran_user`) REFERENCES `user__infos` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaction__groupes`
--
ALTER TABLE `transaction__groupes`
  ADD CONSTRAINT `transaction__groupes_tran_groupe_type_foreign` FOREIGN KEY (`tran_groupe_type`) REFERENCES `transaction__types` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaction__heads`
--
ALTER TABLE `transaction__heads`
  ADD CONSTRAINT `transaction__heads_groupe_id_foreign` FOREIGN KEY (`groupe_id`) REFERENCES `transaction__groupes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction__mains`
--
ALTER TABLE `transaction__mains`
  ADD CONSTRAINT `transaction__mains_loc_id_foreign` FOREIGN KEY (`loc_id`) REFERENCES `location__infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction__mains_tran_type_foreign` FOREIGN KEY (`tran_type`) REFERENCES `transaction__types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction__mains_tran_type_with_foreign` FOREIGN KEY (`tran_type_with`) REFERENCES `transaction__withs` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction__mains_tran_user_foreign` FOREIGN KEY (`tran_user`) REFERENCES `user__infos` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaction__withs`
--
ALTER TABLE `transaction__withs`
  ADD CONSTRAINT `transaction__withs_tran_type_foreign` FOREIGN KEY (`tran_type`) REFERENCES `transaction__types` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaction__with__groupes`
--
ALTER TABLE `transaction__with__groupes`
  ADD CONSTRAINT `transaction__with__groupes_groupe_id_foreign` FOREIGN KEY (`groupe_id`) REFERENCES `transaction__groupes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction__with__groupes_with_id_foreign` FOREIGN KEY (`with_id`) REFERENCES `transaction__withs` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user__infos`
--
ALTER TABLE `user__infos`
  ADD CONSTRAINT `user__infos_dept_id_foreign` FOREIGN KEY (`dept_id`) REFERENCES `department__infos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user__infos_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user__infos_loc_id_foreign` FOREIGN KEY (`loc_id`) REFERENCES `location__infos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user__infos_tran_user_type_foreign` FOREIGN KEY (`tran_user_type`) REFERENCES `transaction__withs` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
