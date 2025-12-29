-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2025 at 02:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity_type` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `is_pinned` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `course_id`, `teacher_id`, `title`, `content`, `is_pinned`, `created_at`) VALUES
(2, 1, 2, 'Today off day', 'Today off day caz hadi issue', 1, '2025-12-19 16:04:41'),
(3, 1, 2, 'Today off day', 'Today off day caz hadi issue', 1, '2025-12-19 16:05:04'),
(4, 1, 2, 'Today off day', 'Today off day caz hadi issue', 1, '2025-12-19 16:05:10'),
(5, 1, 2, 'Today off day', 'Today off day caz hadi issue', 1, '2025-12-19 16:05:33'),
(6, 1, 2, 'Today off day ok', 'Today off day caz hadi issue', 1, '2025-12-19 16:05:59'),
(11, NULL, NULL, 'ok', 'todat class off', 0, '2025-12-21 03:14:55'),
(12, NULL, NULL, 'ok', 'todat class off', 0, '2025-12-21 03:15:02'),
(15, NULL, NULL, 'yes', 'gfhhgkhjg', 0, '2025-12-21 03:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `max_points` int(11) DEFAULT 100,
  `due_date` date DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL COMMENT 'PDF with instructions',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `categories_id`, `title`, `description`, `instructions`, `max_points`, `due_date`, `attachment`, `created_at`) VALUES
(6, 2, 'java', 'java', 'do it', 100, '2026-01-01', '1766153538_angular_200x168.png', '2025-12-19 14:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `assignment_id` int(11) DEFAULT NULL,
  `submission_text` text DEFAULT NULL,
  `attachment_url` varchar(500) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `grade` decimal(5,2) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `graded_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `graded_by` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'submitted' COMMENT 'submitted/graded/late'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `thumbnail`, `description`, `created_at`) VALUES
(1, 'WebDevelopment', '1766943842_angular_64x64.svg', ' WebDevelopment with php and leraval', '2025-12-08 20:47:35'),
(2, 'WebDevelopment', '1766943861_craft_40x40@2x.png', ' WebDevelopment with php and leraval', '2025-12-08 20:49:14'),
(8, 'WebDevelopment', '1766943771_256_rsz_dex-ezekiel-761373-unsplash.jpg', '     Laravel and react', '2025-12-08 20:53:39'),
(11, 'WebDevelopment', '1766943786_256_rsz_clem-onojeghuo-193397-unsplash.jpg', ' Laravel and react', '2025-12-08 20:57:23'),
(13, 'Web Development', '1766940858_devops_200x168.png', 'WebDevelopment', '2025-12-28 16:54:18'),
(14, 'WebDevelopment with php and leraval', '1766943073_256_rsz_ross-sneddon-798476-unsplash.jpg', 'WebDevelopment with php and leraval', '2025-12-28 17:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `generated_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `discounted_price` decimal(10,2) DEFAULT 0.00,
  `category_id` int(11) DEFAULT NULL,
  `teacher_name` varchar(11) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `level` varchar(20) DEFAULT 'beginner' COMMENT 'beginner/intermediate/advanced',
  `duration` int(11) DEFAULT 0 COMMENT 'in minutes',
  `avg_rating` decimal(3,2) DEFAULT 0.00,
  `is_published` tinyint(1) DEFAULT 0,
  `is_featured` tinyint(1) DEFAULT 0,
  `access_period` int(11) DEFAULT NULL COMMENT 'NULL = lifetime access, number = days',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `description`, `short_description`, `price`, `discounted_price`, `category_id`, `teacher_name`, `thumbnail`, `level`, `duration`, `avg_rating`, `is_published`, `is_featured`, `access_period`, `created_at`, `updated_at`) VALUES
(21, 'PHP & MySQL Web Development', 'php--mysql-web-development', 'The PHP & MySQL Web Development course is designed for beginners to intermediate learners who want to create dynamic and secure web applications. This course focuses on server-side programming and database management, which are essential skills for modern web development.\n\nYou will learn PHP to handle server-side logic such as form processing, authentication, and session management. You will also learn MySQL to design, store, retrieve, and manage data efficiently using databases.', 'Learn how to build dynamic, database-driven websites using PHP and MySQL from scratch.', 5000.00, 2500.00, 1, 'Hafsa', '1765747563_OIP.webp', 'beginner', 6, 0.00, 1, 0, NULL, '2025-12-14 21:26:03', '2025-12-14 21:26:03'),
(22, 'PHP & MySQL Web Development', 'php-mysql-web-development-1765981319', 'The PHP & MySQL Web Development course is designed for beginners to intermediate learners who want to create dynamic and secure web applications. This course focuses on server-side programming and database management, which are essential skills for modern web development.', 'Learn how to build dynamic, database-driven websites using PHP and MySQL from scratch.', 4000.00, 2000.00, 11, 'Fariha', '1765981319_angular_96x96.png', 'beginner', 5, 0.00, 1, 0, NULL, '2025-12-17 14:21:59', '2025-12-17 14:21:59'),
(32, 'Artificial Intelligence & Data Science', 'artificial-intelligence-data-science-1766306005', 'Short courses (often on Udemy or LinkedIn Learning) focused on maximizing AI output.', 'Short courses (often on Udemy or LinkedIn Learning) focused on maximizing AI output.', 15000.00, 1000.00, 1, '0', '1766306005_angular_96x96.png', 'beginner', 0, 0.00, 1, 0, NULL, '2025-12-21 08:33:25', '2025-12-21 08:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `access_expiry` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `course_id`, `enrollment_date`, `access_expiry`, `is_active`) VALUES
(1, 1, 21, '2025-12-20 17:36:21', NULL, 1),
(2, 1, 31, '2025-12-20 17:40:37', NULL, 1),
(4, 1, 22, '2025-12-20 17:44:52', NULL, 0),
(7, 1, 27, '2025-12-20 17:51:37', NULL, 1),
(8, 1, 28, '2025-12-20 17:53:29', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `order_index` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `title`, `content`, `order_index`, `created_at`, `updated_at`) VALUES
(1, 1, 'Introduction to PHP', 'This lesson covers basics of PHP.', 1, '2025-12-28 17:36:17', '2025-12-28 17:36:17'),
(2, 1, 'Variables in PHP', 'Learn about PHP variables starting with $.', 2, '2025-12-28 17:36:17', '2025-12-28 17:36:17'),
(3, 1, 'Loops in PHP', 'For loop, while loop explained.', 3, '2025-12-28 17:36:17', '2025-12-28 17:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 1, 'Your quiz PHP Basics result is available', 0, '2025-12-28 17:48:37'),
(2, 2, 'New lesson added in PHP Basics', 0, '2025-12-28 17:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `payment_method_id` int(11) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `transaction_number` varchar(100) DEFAULT NULL COMMENT 'bKash/Nagad transaction ID',
  `payment_status` varchar(20) DEFAULT 'pending' COMMENT 'pending/completed/failed/refunded',
  `paid_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `verified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `transaction_id`, `student_id`, `course_id`, `amount`, `discount_amount`, `payment_method_id`, `mobile_number`, `transaction_number`, `payment_status`, `paid_at`, `verified_at`, `verified_by`, `created_at`) VALUES
(2, 'TRX1766252692', 1, 22, 2000.00, 0.00, 1, '01734667676', '1234', 'pending', '2025-12-20 17:44:52', '0000-00-00 00:00:00', NULL, '2025-12-20 17:44:52'),
(3, 'TRX1766253059', 1, 21, 2500.00, 0.00, 1, '01734667676', '1234', 'completed', '2025-12-20 17:57:49', '2025-12-20 17:57:49', NULL, '2025-12-20 17:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'bKash, Nagad, Rocket',
  `type` varchar(20) NOT NULL COMMENT 'mobile_banking/card/bank',
  `account_number` varchar(100) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `instructions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `type`, `account_number`, `account_name`, `is_active`, `instructions`) VALUES
(1, 'bKash', 'mobile_banking', '017XXXXXXXX', 'Your Company Name', 1, 'Send money to this bKash number and enter transaction ID'),
(2, 'Nagad', 'mobile_banking', '018XXXXXXXX', 'Your Company Name', 1, 'Send money to this Nagad number and enter transaction ID'),
(3, 'Bank Transfer', 'bank', '1234567890', 'Your Company Name', 1, 'Transfer to our bank account and enter transaction number'),
(4, 'Credit/Debit Card', 'card', NULL, NULL, 1, 'Secure payment via cards');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL COMMENT '1-5',
  `comment` text DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_progress`
--

CREATE TABLE `student_progress` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `is_completed` tinyint(1) DEFAULT 0,
  `completed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_progress`
--

INSERT INTO `student_progress` (`id`, `student_id`, `course_id`, `lesson_id`, `is_completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2025-12-28 17:37:05', '2025-12-28 17:37:05', '2025-12-28 17:37:05'),
(2, 1, 1, 2, 0, NULL, '2025-12-28 17:37:05', '2025-12-28 17:37:05'),
(3, 2, 1, 1, 1, '2025-12-28 17:37:05', '2025-12-28 17:37:05', '2025-12-28 17:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz`
--

CREATE TABLE `tbl_quiz` (
  `tbl_quiz_id` int(11) NOT NULL,
  `quiz_question` text NOT NULL,
  `option_a` text NOT NULL,
  `option_b` text NOT NULL,
  `option_c` text NOT NULL,
  `option_d` text NOT NULL,
  `correct_answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_quiz`
--

INSERT INTO `tbl_quiz` (`tbl_quiz_id`, `quiz_question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`) VALUES
(1, 'What is HTML stands for?', 'How To Make Lumpia', 'Hyper Tronic Mongo Logic', 'Hard To Make Love', 'HyperText Markup Language', 'D'),
(2, 'What is the original acronym of PHP?', 'Hypertext Preprocessor', 'Personal Home Page', 'Programming Happy Pill', 'None of the above', 'B'),
(3, 'CSS is fundamental to?', 'Databases', 'Web design', 'Server-side', 'None of the above', 'B'),
(4, 'What is PHP?', 'P', 'H', 'K', 'L', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_result`
--

CREATE TABLE `tbl_result` (
  `tbl_result_id` int(11) NOT NULL,
  `quiz_taker` text NOT NULL,
  `year_section` text NOT NULL,
  `total_score` int(11) NOT NULL,
  `date_taken` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_result`
--

INSERT INTO `tbl_result` (`tbl_result_id`, `quiz_taker`, `year_section`, `total_score`, `date_taken`) VALUES
(2, 'student@gmail.com', '', 0, '2025-12-19 21:00:00'),
(3, 'student@gmail.com', '', 1, '2025-12-19 21:00:00'),
(4, 'student@gmail.com', '', 2, '2025-12-19 21:00:00'),
(5, 'student@gmail.com', '', 2, '2025-12-19 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` varchar(20) DEFAULT '3' COMMENT '1/2/3',
  `avatar` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `email_verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `full_name`, `phone`, `role`, `avatar`, `is_active`, `email_verified`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Hafsa Ifti', '0145755876', '1', '256_michael-dam-258165-unsplash.jpg', 1, 0, '2025-12-07 05:54:50', '2025-12-07 05:54:50'),
(2, 'student@gmail.com', 'cd73502828457d15655bbd7a63fb0bc8', NULL, NULL, '3', NULL, 1, 0, '2025-12-08 04:26:20', '2025-12-08 04:26:20'),
(5, 'hafsa09876@gmail.com', '$2y$10$aJfMamdShl5ApUVu96IxcuXUA', 'Hafsa Akter', '01943365442', '3', '1766163918', 1, 0, '2025-12-19 17:05:18', '2025-12-19 17:05:18'),
(10, 'fariha2@gmail.com', '$2y$10$6h1rRYvYoKhBeC0/acOR5utSw', 'Fariha', '01743565442', '3', '1766166341', 1, 0, '2025-12-19 17:45:42', '2025-12-19 17:45:42'),
(13, 'hamid@gmail.com', '$2y$10$gZ1o1QNdakqYEIAkIaqNgOccn', 'Hamid Hasan', '01743365442', '3', '1766271175', 1, 0, '2025-12-20 22:52:55', '2025-12-20 22:52:55'),
(14, 'nima@gmail.com', 'db088d7fd61422d0dd9f2152fd550127', 'Nima Islam', '0145755876', '2', '1766271175_2358.jpg', 1, 0, '2025-12-28 15:37:39', '2025-12-28 15:37:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_index_58` (`user_id`),
  ADD KEY `activity_logs_index_59` (`activity_type`),
  ADD KEY `activity_logs_index_60` (`created_at`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_index_50` (`course_id`),
  ADD KEY `announcements_index_51` (`created_at`),
  ADD KEY `announcements_index_52` (`is_pinned`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lesson_id` (`categories_id`);

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment_submissions_index_41` (`student_id`),
  ADD KEY `assignment_submissions_index_42` (`assignment_id`),
  ADD KEY `assignment_submissions_index_43` (`status`),
  ADD KEY `assignment_submissions_index_44` (`submitted_at`),
  ADD KEY `graded_by` (`graded_by`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `courses_index_5` (`slug`),
  ADD KEY `courses_index_6` (`category_id`),
  ADD KEY `courses_index_7` (`teacher_name`),
  ADD KEY `courses_index_8` (`is_published`),
  ADD KEY `courses_index_9` (`is_featured`),
  ADD KEY `courses_index_10` (`price`),
  ADD KEY `courses_index_11` (`created_at`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enrollments_index_18` (`student_id`,`course_id`),
  ADD KEY `enrollments_index_19` (`student_id`),
  ADD KEY `enrollments_index_20` (`course_id`),
  ADD KEY `enrollments_index_21` (`is_active`),
  ADD KEY `enrollments_index_22` (`enrollment_date`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD UNIQUE KEY `payments_index_23` (`transaction_id`),
  ADD KEY `payments_index_24` (`student_id`),
  ADD KEY `payments_index_25` (`course_id`),
  ADD KEY `payments_index_26` (`payment_status`),
  ADD KEY `payments_index_27` (`created_at`),
  ADD KEY `payments_index_28` (`transaction_number`),
  ADD KEY `payment_method_id` (`payment_method_id`),
  ADD KEY `verified_by` (`verified_by`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_index_45` (`student_id`,`course_id`),
  ADD KEY `reviews_index_46` (`course_id`),
  ADD KEY `reviews_index_47` (`rating`),
  ADD KEY `reviews_index_48` (`is_approved`),
  ADD KEY `reviews_index_49` (`created_at`);

--
-- Indexes for table `student_progress`
--
ALTER TABLE `student_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  ADD PRIMARY KEY (`tbl_quiz_id`);

--
-- Indexes for table `tbl_result`
--
ALTER TABLE `tbl_result`
  ADD PRIMARY KEY (`tbl_result_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_index_0` (`email`),
  ADD KEY `users_index_1` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_progress`
--
ALTER TABLE `student_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  MODIFY `tbl_quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_result`
--
ALTER TABLE `tbl_result`
  MODIFY `tbl_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD CONSTRAINT `assignment_submissions_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `assignment_submissions_ibfk_2` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`),
  ADD CONSTRAINT `assignment_submissions_ibfk_3` FOREIGN KEY (`graded_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `payments_ibfk_4` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
