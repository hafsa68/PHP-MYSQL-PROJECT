<?php
include_once("Admin/includes/db_config.php");
session_start();

$course_id = isset($_GET['id']) ? $_GET['id'] : 0;
$student_id = $_SESSION['user_id'];

// ১. চেক করুন স্টুডেন্ট আসলেই এনরোলড কি না
$check_enroll = $db->query("SELECT * FROM enrollments WHERE course_id = '$course_id' AND student_id = '$student_id' AND is_active = 1");

if($check_enroll->num_rows == 0) {
    die("You are not enrolled in this course or your account is pending.");
}

// ২. কোর্সের তথ্য এবং লেসনগুলো আনা
$course_info = $db->query("SELECT title FROM courses WHERE id = '$course_id'")->fetch_object();
$lessons = $db->query("SELECT * FROM lessons WHERE course_id = '$course_id' ORDER BY id ASC");

// ৩. বর্তমান লেসন (যদি কেউ নির্দিষ্ট লেসনে ক্লিক না করে তবে প্রথম লেসনটি দেখাবে)
$current_lesson_id = isset($_GET['lesson']) ? $_GET['lesson'] : 0;
if($current_lesson_id == 0) {
    $first_lesson = $db->query("SELECT * FROM lessons WHERE course_id = '$course_id' LIMIT 1")->fetch_object();
    $current_lesson = $first_lesson;
} else {
    $current_lesson = $db->query("SELECT * FROM lessons WHERE id = '$current_lesson_id'")->fetch_object();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $course_info->title; ?> - Study Center</title>
    <link type="text/css" href="public/css/app.css" rel="stylesheet">
    <style>
        .study-container { display: flex; min-height: 100vh; }
        .lesson-sidebar { width: 300px; background: #f8f9fa; border-right: 1px solid #ddd; padding: 20px; }
        .content-area { flex: 1; padding: 40px; background: #fff; }
        .lesson-link { display: block; padding: 10px; color: #333; text-decoration: none; border-bottom: 1px solid #eee; }
        .lesson-link:hover, .lesson-link.active { background: #007bff; color: #fff; }
        .reading-text { font-size: 18px; line-height: 1.8; color: #444; }
    </style>
</head>
<body>

<div class="study-container">
    <div class="lesson-sidebar">
        <h4>Course Content</h4>
        <hr>
        <?php while($l = $lessons->fetch_object()): ?>
            <a href="view-course.php?id=<?= $course_id; ?>&lesson=<?= $l->id; ?>" 
               class="lesson-link <?= ($current_lesson->id == $l->id) ? 'active' : ''; ?>">
               <?= htmlspecialchars($l->title); ?>
            </a>
        <?php endwhile; ?>
        <br>
        <a href="student-dashboard.php" class="btn btn-outline-secondary btn-block">Back to Dashboard</a>
    </div>

    <div class="content-area">
        <?php if($current_lesson): ?>
            <h1><?= htmlspecialchars($current_lesson->title); ?></h1>
            <hr>
            <div class="reading-text">
                <?= nl2br($current_lesson->content); ?>
            </div>
        <?php else: ?>
            <p>No lessons found for this course.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>