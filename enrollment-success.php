<?php
session_start();
include_once("Admin/includes/db_config.php");

$transaction_id = $_GET['transaction_id'] ?? '';
$course_id = $_GET['course_id'] ?? 0;

// Get course details
$course_sql = "SELECT title FROM courses WHERE id = ?";
$course_stmt = $db->prepare($course_sql);
$course_stmt->bind_param("i", $course_id);
$course_stmt->execute();
$course_result = $course_stmt->get_result();
$course = $course_result->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-success">
                    <div class="card-header bg-success text-white text-center">
                        <h3 class="mb-0"><i class="fas fa-check-circle"></i> Enrollment Successful</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="fas fa-party-horn fa-5x text-success mb-3"></i>
                            <h4>Welcome to the Course!</h4>
                        </div>
                        
                        <div class="alert alert-success">
                            <h5>Course: <?php echo htmlspecialchars($course->title); ?></h5>
                            <p class="mb-0">Transaction ID: <strong><?php echo htmlspecialchars($transaction_id); ?></strong></p>
                        </div>
                        
                        <div class="mb-4">
                            <p>Your enrollment has been confirmed. You now have access to:</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-video text-primary me-2"></i> All course videos</li>
                                <li><i class="fas fa-file-download text-primary me-2"></i> Downloadable resources</li>
                                <li><i class="fas fa-certificate text-primary me-2"></i> Course certificate upon completion</li>
                                <li><i class="fas fa-comments text-primary me-2"></i> Access to discussion forum</li>
                            </ul>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="my-courses.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-play-circle me-2"></i> Start Learning Now
                            </a>
                            <a href="course-content.php?course_id=<?php echo $course_id; ?>" class="btn btn-outline-primary">
                                <i class="fas fa-book-open me-2"></i> Go to Course Content
                            </a>
                            <a href="invoice.php?transaction_id=<?php echo urlencode($transaction_id); ?>" class="btn btn-outline-success" target="_blank">
                                <i class="fas fa-receipt me-2"></i> Download Invoice
                            </a>
                        </div>
                        
                        <div class="mt-4 text-muted">
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                Need help? <a href="support.php">Contact Support</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>