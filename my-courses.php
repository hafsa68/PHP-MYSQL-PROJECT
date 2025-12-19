<?php
session_start();
include_once("Admin/includes/db_config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get enrolled courses
$sql = "SELECT c.*, e.enrollment_date, e.access_expiry 
        FROM enrollments e 
        JOIN courses c ON e.course_id = c.id 
        WHERE e.student_id = ? AND e.is_active = 1 
        ORDER BY e.enrollment_date DESC";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-graduation-cap text-primary"></i> My Courses</h1>
            <a href="courses.php" class="btn btn-outline-primary">
                <i class="fas fa-plus me-2"></i>Browse More Courses
            </a>
        </div>
        
        <?php if($result->num_rows > 0): ?>
            <div class="row">
                <?php while($row = $result->fetch_object()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="uploads/<?php echo htmlspecialchars($row->thumbnail); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo htmlspecialchars($row->title); ?>"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo htmlspecialchars($row->title); ?></h5>
                                <p class="card-text flex-grow-1"><?php echo substr(htmlspecialchars($row->description), 0, 100) . '...'; ?></p>
                                
                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        Enrolled: <?php echo date('d M Y', strtotime($row->enrollment_date)); ?>
                                    </small><br>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        Access until: <?php echo date('d M Y', strtotime($row->access_expiry)); ?>
                                    </small>
                                </div>
                                
                                <div class="progress mb-3" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;"></div>
                                </div>
                                <small class="text-muted mb-3">25% Complete</small>
                                
                                <div class="mt-auto">
                                    <a href="course-content.php?course_id=<?php echo $row->id; ?>" 
                                       class="btn btn-primary w-100">
                                        <i class="fas fa-play-circle me-2"></i>Continue Learning
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-book-open fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">No Courses Enrolled Yet</h3>
                <p class="text-muted">Start your learning journey by enrolling in a course</p>
                <a href="courses.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-search me-2"></i>Browse Courses
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>