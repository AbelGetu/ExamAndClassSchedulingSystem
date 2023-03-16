-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 07:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examandclassschedulingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_calendars`
--

CREATE TABLE `academic_calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_calendars`
--

INSERT INTO `academic_calendars` (`id`, `name`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, '2021', '2021-01-01', '2021-08-30', 0, '2022-06-17 01:04:35', '2022-06-17 01:04:35'),
(2, '2022', '2022-01-01', '2022-08-31', 0, '2022-06-17 01:05:01', '2022-06-17 01:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Block 100', '2022-06-19 06:16:10', '2022-06-19 06:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `class_section_allocations`
--

CREATE TABLE `class_section_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `student_class_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_section_allocations`
--

INSERT INTO `class_section_allocations` (`id`, `section_id`, `student_class_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-06-18 04:28:42', '2022-06-18 04:28:42'),
(2, 2, 1, '2022-06-20 03:28:03', '2022-06-20 03:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `class_years`
--

CREATE TABLE `class_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_years`
--

INSERT INTO `class_years` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'I', '2022-06-14 04:28:36', '2022-06-14 04:28:36'),
(2, 'II', '2022-06-17 00:59:16', '2022-06-17 00:59:16'),
(3, 'III', '2022-06-17 00:59:25', '2022-06-17 00:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institute_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `institute_id`, `name`, `phone`, `email`, `website`, `created_at`, `updated_at`) VALUES
(1, 1, 'College of Engineering and Technology', '+251919203993', 'collegeofengineeringandtechnology@du.et', NULL, '2022-06-17 01:08:02', '2022-06-17 01:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `name`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Monday', 1, '2022-06-18 23:47:35', '2022-06-18 23:47:35'),
(2, 'Tuesday', 2, '2022-06-18 23:50:41', '2022-06-18 23:50:41'),
(3, 'Wednesday', 3, '2022-06-18 23:51:07', '2022-06-18 23:51:37'),
(4, 'Thursday', 4, '2022-06-18 23:51:49', '2022-06-18 23:51:49'),
(5, 'Friday', 5, '2022-06-18 23:52:03', '2022-06-18 23:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `college_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `college_id`, `name`, `phone`, `email`, `website`, `created_at`, `updated_at`) VALUES
(1, 1, 'Electrical and Computer Engineering', '+251919203993', 'electricalandcomputerengineering@du.et', NULL, '2022-06-17 01:09:03', '2022-06-17 01:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `exam_allocations`
--

CREATE TABLE `exam_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_section_allocation_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `weight` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_allocations`
--

INSERT INTO `exam_allocations` (`id`, `class_section_allocation_id`, `subject_id`, `weight`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 40, '2022-06-18 05:05:48', '2022-06-18 05:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `exam_timetables`
--

CREATE TABLE `exam_timetables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_allocation_id` bigint(20) UNSIGNED NOT NULL,
  `exam_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_timetables`
--

INSERT INTO `exam_timetables` (`id`, `teacher_allocation_id`, `exam_date`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-06-27', '2022-06-21 13:16:12', '2022-06-21 13:16:12'),
(2, 2, '2022-06-29', '2022-06-21 13:16:12', '2022-06-21 13:16:12'),
(3, 3, '2022-07-01', '2022-06-21 13:16:12', '2022-06-21 13:16:12'),
(4, 4, '2022-06-27', '2022-06-21 13:16:12', '2022-06-21 13:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`id`, `name`, `address`, `city`, `state`, `zip`, `phone`, `email`, `website`, `created_at`, `updated_at`) VALUES
(1, 'Dilla University', 'Dilla, Ethiopia', 'Dilla', 'SNNP', '00001', '+251919203993', 'dillauniversity@gmail.com', NULL, '2022-06-17 01:07:03', '2022-06-17 01:07:03');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_10_050558_create_roles_table', 1),
(6, '2022_06_10_134301_create_user_roles_table', 1),
(7, '2022_06_10_142340_create_institutes_table', 1),
(8, '2022_06_10_142501_create_colleges_table', 1),
(9, '2022_06_10_142620_create_departments_table', 1),
(10, '2022_06_12_172051_create_academic_calendars_table', 1),
(11, '2022_06_12_172212_create_semesters_table', 1),
(12, '2022_06_12_173000_create_subjects_table', 1),
(13, '2022_06_13_033842_create_buildings_table', 1),
(14, '2022_06_13_033937_create_rooms_table', 1),
(18, '2022_06_14_062703_create_periods_table', 2),
(19, '2022_06_14_062747_create_class_years_table', 2),
(20, '2022_06_14_063001_create_student_classes_table', 2),
(31, '2022_06_16_170623_create_sections_table', 3),
(32, '2022_06_16_172837_create_class_section_allocations_table', 3),
(33, '2022_06_16_173144_create_section_allocations_table', 3),
(34, '2022_06_16_173357_create_exam_allocations_table', 3),
(35, '2022_06_16_173529_create_teacher_allocations_table', 3),
(37, '2022_06_19_023401_create_days_table', 4),
(40, '2022_06_19_025249_create_timetables_table', 5),
(41, '2022_06_21_152338_create_exam_timetables_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `name`, `order`, `created_at`, `updated_at`) VALUES
(1, 'P1', 1, '2022-06-17 01:01:38', '2022-06-17 01:01:38'),
(2, 'P2', 2, '2022-06-17 01:01:48', '2022-06-17 01:01:48'),
(3, 'P3', 3, '2022-06-17 01:01:59', '2022-06-17 01:01:59'),
(4, 'P4', 4, '2022-06-17 01:02:12', '2022-06-17 01:02:12'),
(5, 'P5', 5, '2022-06-17 01:02:26', '2022-06-17 01:02:26');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Teacher', '2022-06-18 04:41:11', '2022-06-18 04:41:11'),
(2, 'Admin', '2022-06-21 13:30:22', '2022-06-21 13:30:22'),
(3, 'Program Manager', '2022-06-21 13:33:53', '2022-06-21 13:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `building_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `building_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, '101', '2022-06-19 06:17:00', '2022-06-19 06:17:00'),
(2, 1, '102', '2022-06-19 06:17:10', '2022-06-19 06:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Section A', '2022-06-17 00:56:28', '2022-06-17 00:56:28'),
(2, 'Section B', '2022-06-17 00:56:36', '2022-06-17 00:56:36');

-- --------------------------------------------------------

--
-- Table structure for table `section_allocations`
--

CREATE TABLE `section_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_section_allocation_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_allocations`
--

INSERT INTO `section_allocations` (`id`, `class_section_allocation_id`, `room_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-06-19 06:18:02', '2022-06-19 06:18:02'),
(2, 2, 2, '2022-06-20 03:28:59', '2022-06-20 03:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'One', '2022-06-17 01:05:30', '2022-06-17 01:05:30'),
(2, 'Two', '2022-06-17 01:05:39', '2022-06-17 01:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `student_classes`
--

CREATE TABLE `student_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_year_id` bigint(20) UNSIGNED NOT NULL,
  `academic_calendar_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_classes`
--

INSERT INTO `student_classes` (`id`, `class_year_id`, `academic_calendar_id`, `semester_id`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, '2022-06-17 01:12:35', '2022-06-17 01:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_hour` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `credit_hour`, `created_at`, `updated_at`) VALUES
(1, 'Introduction to Programming', 'IP', 5, '2022-06-18 04:39:12', '2022-06-18 04:39:12'),
(2, 'Computer Science', 'CS', 4, '2022-06-19 05:10:36', '2022-06-19 05:10:36'),
(3, 'Introduction to Data Structure and Algorithm', 'IDSA', 4, '2022-06-20 03:26:57', '2022-06-20 03:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_allocations`
--

CREATE TABLE `teacher_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_section_allocation_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `period_per_week` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_allocations`
--

INSERT INTO `teacher_allocations` (`id`, `class_section_allocation_id`, `user_id`, `subject_id`, `period_per_week`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 5, '2022-06-18 05:29:04', '2022-06-18 05:29:04'),
(2, 1, 4, 2, 4, '2022-06-19 05:10:57', '2022-06-19 05:10:57'),
(3, 1, 5, 3, 3, '2022-06-20 03:29:30', '2022-06-20 03:29:30'),
(4, 2, 3, 2, 4, '2022-06-20 03:35:39', '2022-06-20 03:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_allocation_id` bigint(20) UNSIGNED NOT NULL,
  `day_id` bigint(20) UNSIGNED NOT NULL,
  `period_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `day_order` int(11) NOT NULL,
  `period_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `teacher_allocation_id`, `day_id`, `period_id`, `room_id`, `subject_id`, `day_order`, `period_order`, `created_at`, `updated_at`) VALUES
(124, 1, 1, 1, 1, 1, 1, 1, '2022-06-19 12:14:23', '2022-06-19 12:14:23'),
(125, 1, 2, 1, 1, 1, 2, 1, '2022-06-19 12:14:23', '2022-06-19 12:14:23'),
(126, 1, 3, 1, 1, 1, 3, 1, '2022-06-19 12:14:23', '2022-06-19 12:14:23'),
(127, 1, 4, 1, 1, 1, 4, 1, '2022-06-19 12:14:23', '2022-06-19 12:14:23'),
(128, 1, 5, 1, 1, 1, 5, 1, '2022-06-19 12:14:23', '2022-06-19 12:14:23'),
(129, 2, 1, 2, 1, 2, 1, 2, '2022-06-19 12:14:23', '2022-06-19 12:14:23'),
(130, 2, 2, 2, 1, 2, 2, 2, '2022-06-19 12:14:23', '2022-06-19 12:14:23'),
(131, 2, 3, 2, 1, 2, 3, 2, '2022-06-19 12:14:23', '2022-06-19 12:14:23'),
(132, 2, 4, 2, 1, 2, 4, 2, '2022-06-19 12:14:23', '2022-06-19 12:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `id_number`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'testuser@test.com', NULL, NULL, '$2y$10$f2u8I4GYBpErRp6qmuQGSubvGuBH9ocSFdC1460fKHfRWgx8jMZMO', NULL, '2022-06-13 01:47:41', '2022-06-13 01:47:41'),
(3, 'Abebe Kebede', 'abebe@gmail.com', NULL, NULL, '$2y$10$NUF.r.iRB2TeXDDiW6UbReTtciTUEqAkFe4KG1bjJkOL8vDGrk9DW', NULL, '2022-06-18 05:27:52', '2022-06-18 05:27:52'),
(4, 'Yegunawork Adane', 'yegu@gmail.com', NULL, NULL, '$2y$10$eiQy0i9tH6KtRCgBC/Wt/OI0iWajCi6sXV/uz0QgI3OzLaFXQa2eC', NULL, '2022-06-19 05:09:31', '2022-06-19 05:09:31'),
(5, 'Bereket Molla', 'bereketmolla@gmail.com', NULL, NULL, '$2y$10$GX4N1MyBa9vFSxWQwTMbe.6e3wXanJUkweEB3EYN6f2he7LYfMCuu', NULL, '2022-06-20 03:24:30', '2022-06-20 03:24:30'),
(6, 'Kebede Gezaw', 'kebedegezaw@gmai.com', NULL, NULL, '$2y$10$GmqfNrDsInvQqFA59WR7N.o1E2g6NRWLFbYUShYByk/TxwlMksPti', NULL, '2022-06-21 13:37:21', '2022-06-21 13:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(2, 3, 1, '2022-06-18 05:27:52', '2022-06-18 05:27:52'),
(3, 4, 1, '2022-06-19 05:09:31', '2022-06-19 05:09:31'),
(4, 5, 1, '2022-06-20 03:24:30', '2022-06-20 03:24:30'),
(5, 1, 2, NULL, NULL),
(6, 6, 3, '2022-06-21 13:37:21', '2022-06-21 13:37:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_calendars`
--
ALTER TABLE `academic_calendars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_section_allocations`
--
ALTER TABLE `class_section_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_section_allocations_section_id_foreign` (`section_id`),
  ADD KEY `class_section_allocations_student_class_id_foreign` (`student_class_id`);

--
-- Indexes for table `class_years`
--
ALTER TABLE `class_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `colleges_institute_id_foreign` (`institute_id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_college_id_foreign` (`college_id`);

--
-- Indexes for table `exam_allocations`
--
ALTER TABLE `exam_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_allocations_class_section_allocation_id_foreign` (`class_section_allocation_id`),
  ADD KEY `exam_allocations_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `exam_timetables`
--
ALTER TABLE `exam_timetables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_timetables_teacher_allocation_id_foreign` (`teacher_allocation_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
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
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_building_id_foreign` (`building_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_allocations`
--
ALTER TABLE `section_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_allocations_class_section_allocation_id_foreign` (`class_section_allocation_id`),
  ADD KEY `section_allocations_room_id_foreign` (`room_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_classes_class_year_id_foreign` (`class_year_id`),
  ADD KEY `student_classes_academic_calendar_id_foreign` (`academic_calendar_id`),
  ADD KEY `student_classes_semester_id_foreign` (`semester_id`),
  ADD KEY `student_classes_department_id_foreign` (`department_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_allocations`
--
ALTER TABLE `teacher_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_allocations_class_section_allocation_id_foreign` (`class_section_allocation_id`),
  ADD KEY `teacher_allocations_user_id_foreign` (`user_id`),
  ADD KEY `teacher_allocations_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timetables_teacher_allocation_id_foreign` (`teacher_allocation_id`),
  ADD KEY `timetables_day_id_foreign` (`day_id`),
  ADD KEY `timetables_period_id_foreign` (`period_id`),
  ADD KEY `timetables_room_id_foreign` (`room_id`),
  ADD KEY `timetables_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_id_number_unique` (`id_number`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_user_id_foreign` (`user_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_calendars`
--
ALTER TABLE `academic_calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_section_allocations`
--
ALTER TABLE `class_section_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_years`
--
ALTER TABLE `class_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_allocations`
--
ALTER TABLE `exam_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_timetables`
--
ALTER TABLE `exam_timetables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `section_allocations`
--
ALTER TABLE `section_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_classes`
--
ALTER TABLE `student_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_allocations`
--
ALTER TABLE `teacher_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_section_allocations`
--
ALTER TABLE `class_section_allocations`
  ADD CONSTRAINT `class_section_allocations_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `class_section_allocations_student_class_id_foreign` FOREIGN KEY (`student_class_id`) REFERENCES `student_classes` (`id`);

--
-- Constraints for table `colleges`
--
ALTER TABLE `colleges`
  ADD CONSTRAINT `colleges_institute_id_foreign` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`);

--
-- Constraints for table `exam_allocations`
--
ALTER TABLE `exam_allocations`
  ADD CONSTRAINT `exam_allocations_class_section_allocation_id_foreign` FOREIGN KEY (`class_section_allocation_id`) REFERENCES `class_section_allocations` (`id`),
  ADD CONSTRAINT `exam_allocations_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `exam_timetables`
--
ALTER TABLE `exam_timetables`
  ADD CONSTRAINT `exam_timetables_teacher_allocation_id_foreign` FOREIGN KEY (`teacher_allocation_id`) REFERENCES `teacher_allocations` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`);

--
-- Constraints for table `section_allocations`
--
ALTER TABLE `section_allocations`
  ADD CONSTRAINT `section_allocations_class_section_allocation_id_foreign` FOREIGN KEY (`class_section_allocation_id`) REFERENCES `class_section_allocations` (`id`),
  ADD CONSTRAINT `section_allocations_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD CONSTRAINT `student_classes_academic_calendar_id_foreign` FOREIGN KEY (`academic_calendar_id`) REFERENCES `academic_calendars` (`id`),
  ADD CONSTRAINT `student_classes_class_year_id_foreign` FOREIGN KEY (`class_year_id`) REFERENCES `class_years` (`id`),
  ADD CONSTRAINT `student_classes_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `student_classes_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);

--
-- Constraints for table `teacher_allocations`
--
ALTER TABLE `teacher_allocations`
  ADD CONSTRAINT `teacher_allocations_class_section_allocation_id_foreign` FOREIGN KEY (`class_section_allocation_id`) REFERENCES `class_section_allocations` (`id`),
  ADD CONSTRAINT `teacher_allocations_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `teacher_allocations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `timetables`
--
ALTER TABLE `timetables`
  ADD CONSTRAINT `timetables_day_id_foreign` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`),
  ADD CONSTRAINT `timetables_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`),
  ADD CONSTRAINT `timetables_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `timetables_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `timetables_teacher_allocation_id_foreign` FOREIGN KEY (`teacher_allocation_id`) REFERENCES `teacher_allocations` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
