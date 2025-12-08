CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(255) UNIQUE NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255),
  `phone` varchar(20),
  `role` varchar(20) DEFAULT 'student' COMMENT 'student/teacher/admin',
  `avatar` varchar(255),
  `is_active` boolean DEFAULT true,
  `email_verified` boolean DEFAULT false,
  `created_at` timestamp DEFAULT (now()),
  `updated_at` timestamp DEFAULT (now())
);

CREATE TABLE `user_profiles` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int UNIQUE,
  `bio` text,
  `education` text,
  `expertise` varchar(255)
);

CREATE TABLE `student_profiles` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int UNIQUE,
  `points` int DEFAULT 0,
  `level` varchar(50) DEFAULT 'beginner',
  `total_courses` int DEFAULT 0
);

CREATE TABLE `categories` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) UNIQUE NOT NULL,
  `description` text,
  `parent_id` int COMMENT 'for sub-categories',
  `is_active` boolean DEFAULT true,
  `created_at` timestamp DEFAULT (now())
);

CREATE TABLE `courses` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) UNIQUE NOT NULL,
  `description` text,
  `short_description` text,
  `price` decimal(10,2) DEFAULT 0,
  `discounted_price` decimal(10,2) DEFAULT 0,
  `category_id` int,
  `teacher_id` int,
  `thumbnail` varchar(255),
  `preview_video` varchar(255),
  `language` varchar(50) DEFAULT 'English',
  `level` varchar(20) DEFAULT 'beginner' COMMENT 'beginner/intermediate/advanced',
  `duration` int DEFAULT 0 COMMENT 'in minutes',
  `total_lessons` int DEFAULT 0,
  `total_students` int DEFAULT 0,
  `avg_rating` decimal(3,2) DEFAULT 0,
  `is_published` boolean DEFAULT false,
  `is_free` boolean DEFAULT false,
  `is_featured` boolean DEFAULT false,
  `learning_outcomes` text,
  `access_period` int COMMENT 'NULL = lifetime access, number = days',
  `created_at` timestamp DEFAULT (now()),
  `updated_at` timestamp DEFAULT (now())
);

CREATE TABLE `course_sections` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `course_id` int,
  `title` varchar(255) NOT NULL,
  `description` text,
  `order_index` int DEFAULT 0,
  `created_at` timestamp DEFAULT (now())
);

CREATE TABLE `lessons` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `section_id` int,
  `title` varchar(255) NOT NULL,
  `description` text,
  `content_type` varchar(20) DEFAULT 'video' COMMENT 'video/article/quiz/assignment',
  `video_url` varchar(500) COMMENT 'YouTube URL or local path',
  `video_duration` int DEFAULT 0 COMMENT 'seconds',
  `video_source` varchar(20) DEFAULT 'youtube' COMMENT 'youtube/vimeo/local',
  `lesson_order` int DEFAULT 0,
  `is_preview` boolean DEFAULT false,
  `is_published` boolean DEFAULT true,
  `created_at` timestamp DEFAULT (now()),
  `updated_at` timestamp DEFAULT (now())
);

CREATE TABLE `enrollments` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `student_id` int,
  `course_id` int,
  `enrollment_date` timestamp DEFAULT (now()),
  `access_expiry` date,
  `is_active` boolean DEFAULT true
);

CREATE TABLE `payment_methods` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'bKash, Nagad, Rocket',
  `type` varchar(20) NOT NULL COMMENT 'mobile_banking/card/bank',
  `account_number` varchar(100),
  `account_name` varchar(255),
  `is_active` boolean DEFAULT true,
  `instructions` text
);

CREATE TABLE `payments` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `transaction_id` varchar(100) UNIQUE,
  `student_id` int,
  `course_id` int,
  `amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) DEFAULT 0,
  `payment_method_id` int,
  `mobile_number` varchar(20),
  `transaction_number` varchar(100) COMMENT 'bKash/Nagad transaction ID',
  `payment_status` varchar(20) DEFAULT 'pending' COMMENT 'pending/completed/failed/refunded',
  `paid_at` timestamp,
  `verified_at` timestamp,
  `verified_by` int,
  `created_at` timestamp DEFAULT (now())
);

CREATE TABLE `cart` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `student_id` int,
  `course_id` int,
  `added_at` timestamp DEFAULT (now())
);

CREATE TABLE `quizzes` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `lesson_id` int UNIQUE,
  `title` varchar(255) NOT NULL,
  `description` text,
  `passing_score` int DEFAULT 60,
  `time_limit` int DEFAULT 0 COMMENT 'minutes, 0 = no limit',
  `max_attempts` int DEFAULT 1,
  `is_active` boolean DEFAULT true,
  `created_at` timestamp DEFAULT (now())
);

CREATE TABLE `quiz_questions` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `quiz_id` int,
  `question` text NOT NULL,
  `question_type` varchar(20) DEFAULT 'multiple_choice' COMMENT 'multiple_choice/true_false/short_answer',
  `points` int DEFAULT 1,
  `order_index` int DEFAULT 0
);

CREATE TABLE `quiz_options` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `question_id` int,
  `option_text` text NOT NULL,
  `is_correct` boolean DEFAULT false
);

CREATE TABLE `quiz_attempts` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `student_id` int,
  `quiz_id` int,
  `score` decimal(5,2),
  `total_questions` int,
  `correct_answers` int,
  `started_at` timestamp DEFAULT (now()),
  `completed_at` timestamp,
  `time_taken` int DEFAULT 0 COMMENT 'seconds',
  `status` varchar(20) DEFAULT 'in_progress' COMMENT 'in_progress/completed/abandoned'
);

CREATE TABLE `quiz_answers` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `attempt_id` int,
  `question_id` int,
  `selected_option_id` int,
  `answer_text` text,
  `is_correct` boolean DEFAULT false
);

CREATE TABLE `assignments` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `lesson_id` int UNIQUE,
  `title` varchar(255) NOT NULL,
  `description` text,
  `instructions` text,
  `max_points` int DEFAULT 100,
  `due_date` date,
  `attachment` varchar(255) COMMENT 'PDF with instructions',
  `created_at` timestamp DEFAULT (now())
);

CREATE TABLE `assignment_submissions` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `student_id` int,
  `assignment_id` int,
  `submission_text` text,
  `attachment_url` varchar(500),
  `submitted_at` timestamp DEFAULT (now()),
  `grade` decimal(5,2),
  `feedback` text,
  `graded_at` timestamp,
  `graded_by` int,
  `status` varchar(20) DEFAULT 'submitted' COMMENT 'submitted/graded/late'
);

CREATE TABLE `reviews` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `student_id` int,
  `course_id` int,
  `rating` int COMMENT '1-5',
  `comment` text,
  `is_approved` boolean DEFAULT false,
  `created_at` timestamp DEFAULT (now())
);

CREATE TABLE `announcements` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `course_id` int,
  `teacher_id` int,
  `title` varchar(255) NOT NULL,
  `content` text,
  `is_pinned` boolean DEFAULT false,
  `created_at` timestamp DEFAULT (now())
);

CREATE TABLE `settings` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `setting_key` varchar(100) UNIQUE NOT NULL,
  `setting_value` text,
  `setting_type` varchar(20) DEFAULT 'string' COMMENT 'string/number/boolean/json',
  `category` varchar(50) DEFAULT 'general',
  `description` text
);

CREATE TABLE `notifications` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `title` varchar(255) NOT NULL,
  `message` text,
  `type` varchar(20) DEFAULT 'info' COMMENT 'info/success/warning/error',
  `is_read` boolean DEFAULT false,
  `related_url` varchar(500),
  `created_at` timestamp DEFAULT (now())
);

CREATE TABLE `activity_logs` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `activity_type` varchar(100),
  `description` text,
  `ip_address` varchar(45),
  `user_agent` text,
  `created_at` timestamp DEFAULT (now())
);

CREATE INDEX `users_index_0` ON `users` (`email`);

CREATE INDEX `users_index_1` ON `users` (`role`);

CREATE INDEX `categories_index_2` ON `categories` (`slug`);

CREATE INDEX `categories_index_3` ON `categories` (`parent_id`);

CREATE INDEX `categories_index_4` ON `categories` (`is_active`);

CREATE INDEX `courses_index_5` ON `courses` (`slug`);

CREATE INDEX `courses_index_6` ON `courses` (`category_id`);

CREATE INDEX `courses_index_7` ON `courses` (`teacher_id`);

CREATE INDEX `courses_index_8` ON `courses` (`is_published`);

CREATE INDEX `courses_index_9` ON `courses` (`is_featured`);

CREATE INDEX `courses_index_10` ON `courses` (`price`);

CREATE INDEX `courses_index_11` ON `courses` (`created_at`);

CREATE INDEX `course_sections_index_12` ON `course_sections` (`course_id`);

CREATE INDEX `course_sections_index_13` ON `course_sections` (`order_index`);

CREATE INDEX `lessons_index_14` ON `lessons` (`section_id`);

CREATE INDEX `lessons_index_15` ON `lessons` (`lesson_order`);

CREATE INDEX `lessons_index_16` ON `lessons` (`is_preview`);

CREATE INDEX `lessons_index_17` ON `lessons` (`is_published`);

CREATE UNIQUE INDEX `enrollments_index_18` ON `enrollments` (`student_id`, `course_id`);

CREATE INDEX `enrollments_index_19` ON `enrollments` (`student_id`);

CREATE INDEX `enrollments_index_20` ON `enrollments` (`course_id`);

CREATE INDEX `enrollments_index_21` ON `enrollments` (`is_active`);

CREATE INDEX `enrollments_index_22` ON `enrollments` (`enrollment_date`);

CREATE UNIQUE INDEX `payments_index_23` ON `payments` (`transaction_id`);

CREATE INDEX `payments_index_24` ON `payments` (`student_id`);

CREATE INDEX `payments_index_25` ON `payments` (`course_id`);

CREATE INDEX `payments_index_26` ON `payments` (`payment_status`);

CREATE INDEX `payments_index_27` ON `payments` (`created_at`);

CREATE INDEX `payments_index_28` ON `payments` (`transaction_number`);

CREATE INDEX `cart_index_29` ON `cart` (`student_id`);

CREATE UNIQUE INDEX `cart_index_30` ON `cart` (`student_id`, `course_id`);

CREATE INDEX `quiz_questions_index_31` ON `quiz_questions` (`quiz_id`);

CREATE INDEX `quiz_questions_index_32` ON `quiz_questions` (`order_index`);

CREATE INDEX `quiz_options_index_33` ON `quiz_options` (`question_id`);

CREATE INDEX `quiz_options_index_34` ON `quiz_options` (`is_correct`);

CREATE INDEX `quiz_attempts_index_35` ON `quiz_attempts` (`student_id`);

CREATE INDEX `quiz_attempts_index_36` ON `quiz_attempts` (`quiz_id`);

CREATE INDEX `quiz_attempts_index_37` ON `quiz_attempts` (`status`);

CREATE INDEX `quiz_attempts_index_38` ON `quiz_attempts` (`started_at`);

CREATE INDEX `quiz_answers_index_39` ON `quiz_answers` (`attempt_id`);

CREATE INDEX `quiz_answers_index_40` ON `quiz_answers` (`question_id`);

CREATE INDEX `assignment_submissions_index_41` ON `assignment_submissions` (`student_id`);

CREATE INDEX `assignment_submissions_index_42` ON `assignment_submissions` (`assignment_id`);

CREATE INDEX `assignment_submissions_index_43` ON `assignment_submissions` (`status`);

CREATE INDEX `assignment_submissions_index_44` ON `assignment_submissions` (`submitted_at`);

CREATE UNIQUE INDEX `reviews_index_45` ON `reviews` (`student_id`, `course_id`);

CREATE INDEX `reviews_index_46` ON `reviews` (`course_id`);

CREATE INDEX `reviews_index_47` ON `reviews` (`rating`);

CREATE INDEX `reviews_index_48` ON `reviews` (`is_approved`);

CREATE INDEX `reviews_index_49` ON `reviews` (`created_at`);

CREATE INDEX `announcements_index_50` ON `announcements` (`course_id`);

CREATE INDEX `announcements_index_51` ON `announcements` (`created_at`);

CREATE INDEX `announcements_index_52` ON `announcements` (`is_pinned`);

CREATE UNIQUE INDEX `settings_index_53` ON `settings` (`setting_key`);

CREATE INDEX `settings_index_54` ON `settings` (`category`);

CREATE INDEX `notifications_index_55` ON `notifications` (`user_id`);

CREATE INDEX `notifications_index_56` ON `notifications` (`is_read`);

CREATE INDEX `notifications_index_57` ON `notifications` (`created_at`);

CREATE INDEX `activity_logs_index_58` ON `activity_logs` (`user_id`);

CREATE INDEX `activity_logs_index_59` ON `activity_logs` (`activity_type`);

CREATE INDEX `activity_logs_index_60` ON `activity_logs` (`created_at`);

ALTER TABLE `user_profiles` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `student_profiles` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `categories` ADD FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);

ALTER TABLE `courses` ADD FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

ALTER TABLE `courses` ADD FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

ALTER TABLE `course_sections` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `lessons` ADD FOREIGN KEY (`section_id`) REFERENCES `course_sections` (`id`);

ALTER TABLE `enrollments` ADD FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

ALTER TABLE `enrollments` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `payments` ADD FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

ALTER TABLE `payments` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `payments` ADD FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

ALTER TABLE `payments` ADD FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`);

ALTER TABLE `cart` ADD FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

ALTER TABLE `cart` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `quizzes` ADD FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`);

ALTER TABLE `quiz_questions` ADD FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

ALTER TABLE `quiz_options` ADD FOREIGN KEY (`question_id`) REFERENCES `quiz_questions` (`id`);

ALTER TABLE `quiz_attempts` ADD FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

ALTER TABLE `quiz_attempts` ADD FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

ALTER TABLE `quiz_answers` ADD FOREIGN KEY (`attempt_id`) REFERENCES `quiz_attempts` (`id`);

ALTER TABLE `quiz_answers` ADD FOREIGN KEY (`question_id`) REFERENCES `quiz_questions` (`id`);

ALTER TABLE `quiz_answers` ADD FOREIGN KEY (`selected_option_id`) REFERENCES `quiz_options` (`id`);

ALTER TABLE `assignments` ADD FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`);

ALTER TABLE `assignment_submissions` ADD FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

ALTER TABLE `assignment_submissions` ADD FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`);

ALTER TABLE `assignment_submissions` ADD FOREIGN KEY (`graded_by`) REFERENCES `users` (`id`);

ALTER TABLE `reviews` ADD FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

ALTER TABLE `reviews` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `announcements` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `announcements` ADD FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

ALTER TABLE `notifications` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `activity_logs` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
