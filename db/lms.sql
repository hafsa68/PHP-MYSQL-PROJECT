-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2025 at 11:12 PM
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
(6, 1, 2, 'Today off day ok', 'Today off day caz hadi issue', 1, '2025-12-19 16:05:59');

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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'WebDevelopment', 'WebDevelopment with php and leraval', '2025-12-08 20:47:35'),
(2, 'WebDevelopment', 'WebDevelopment with php and leraval', '2025-12-08 20:49:14'),
(8, 'WebDevelopment', 'Laravel and react', '2025-12-08 20:53:39'),
(11, 'WebDevelopment', 'Laravel and react', '2025-12-08 20:57:23'),
(12, 'WebDevelopment', 'Laravel and react', '2025-12-08 20:57:37');

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
(27, 'Web Development Bootcamp', 'web-development-bootcamp', 'Learn full-stack web development from scratch', NULL, 299.99, 199.99, NULL, 'Mim', 'webdev.jpg', 'Beginner', 60, 0.00, 0, 0, NULL, '2025-12-19 21:32:19', '2025-12-19 21:32:19'),
(28, 'Data Science Fundamentals', 'data-science-fundamentals', 'Introduction to data science and machine learning', NULL, 399.99, 349.99, NULL, 'Jitu', 'datascience.jpg', 'Intermediate', 80, 0.00, 0, 0, NULL, '2025-12-19 21:32:19', '2025-12-19 21:32:19'),
(31, 'Web Development Bootcamp', 'web-development-1', 'Learn full-stack web development', NULL, 299.99, 199.99, NULL, 'Fatema', 'webdev.jpg', 'Beginner', 60, 0.00, 0, 0, NULL, '2025-12-19 21:34:22', '2025-12-19 21:34:22');

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
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `passing_score` int(11) DEFAULT 60,
  `time_limit` int(11) DEFAULT 0 COMMENT 'minutes, 0 = no limit',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `description`, `passing_score`, `time_limit`, `is_active`, `created_at`) VALUES
(1, 'php', 'php', 30, 15, 1, '2025-12-19 11:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_text` text DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`id`, `question_id`, `answer_text`, `is_correct`) VALUES
(1, 1, 'PHP is a Hypertext Preprocessors.', 1),
(3, 2, 'Python is a Programming Language.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `question` text NOT NULL,
  `question_type` varchar(20) DEFAULT '' COMMENT 'true_false/short_answer',
  `points` int(11) DEFAULT 1,
  `order_index` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question`, `question_type`, `points`, `order_index`) VALUES
(1, 1, 'what is PHP?', 'true_false', 2, 0),
(2, 1, 'What is Python?', 'true_false', 2, 1);

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
-- Table structure for table `student_profiles`
--

CREATE TABLE `student_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT 0,
  `level` varchar(50) DEFAULT 'beginner',
  `total_courses` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, '1', NULL, 1, 0, '2025-12-07 05:54:50', '2025-12-07 05:54:50'),
(2, 'student@gmail.com', 'cd73502828457d15655bbd7a63fb0bc8', NULL, NULL, '3', NULL, 1, 0, '2025-12-08 04:26:20', '2025-12-08 04:26:20'),
(3, 'instructor@gmail.com', '175cca0310b93021a7d3cfb3e4877ab6', NULL, NULL, '2', NULL, 1, 0, '2025-12-08 05:09:12', '2025-12-08 05:09:12'),
(5, 'hafsa09876@gmail.com', '$2y$10$aJfMamdShl5ApUVu96IxcuXUA', 'Hafsa Akter', '01943365442', '3', '1766163918', 1, 0, '2025-12-19 17:05:18', '2025-12-19 17:05:18'),
(6, 'hafsa@gmail.com', '$2y$10$j0fui1nksHaFriurMLx60.9Ki', 'Hafsa Akter', '01943365442', '3', '1766164009', 1, 0, '2025-12-19 17:06:50', '2025-12-19 17:06:50'),
(7, 'fariha@gmail.com', '$2y$10$QrONoJ2yw4Gjci0ROLD.Q.ipD', 'Fariha Akter', '01743565442', '3', '1766164607', 1, 0, '2025-12-19 17:16:47', '2025-12-19 17:16:47'),
(8, 'fariha23@gmail.com', '$2y$10$ovGzaV/efr/cne9lNBXL/uDQQ', 'Fariha', '01743565442', '3', '1766165330', 1, 0, '2025-12-19 17:28:51', '2025-12-19 17:28:51'),
(9, 'fariha235@gmail.com', '$2y$10$q2k6yawaAnkVwP25raKLcu4pI', 'Fariha', '01743565442', '3', '1766165472', 1, 0, '2025-12-19 17:31:12', '2025-12-19 17:31:12'),
(10, 'fariha2@gmail.com', '$2y$10$6h1rRYvYoKhBeC0/acOR5utSw', 'Fariha', '01743565442', '3', '1766166341', 1, 0, '2025-12-19 17:45:42', '2025-12-19 17:45:42'),
(11, 'farih5@gmail.com', '$2y$10$B/jgCzze8k/KB.1bBSt9DOpZO', 'Fariha', '01743565442', '3', '1766166692', 1, 0, '2025-12-19 17:51:32', '2025-12-19 17:51:32'),
(12, 'farih8@gmail.com', '$2y$10$5heXA1j/MbLjcHTvkUtF7.YUV', 'Fariha', '01743565442', '3', '1766166894', 1, 0, '2025-12-19 17:54:54', '2025-12-19 17:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `expertise` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_index_30` (`student_id`,`course_id`),
  ADD KEY `cart_index_29` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_answers_index_40` (`question_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_questions_index_31` (`quiz_id`),
  ADD KEY `quiz_questions_index_32` (`order_index`);

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
-- Indexes for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_index_0` (`email`),
  ADD KEY `users_index_1` (`role`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

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
