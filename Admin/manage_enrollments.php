<?php
// ১. ডাটাবেজ কানেকশন এবং সেশন চেক (আপনার প্রজেক্টের পাথ অনুযায়ী ঠিক করে নিন)
include_once("../Admin/includes/db_config.php"); 
session_start();

// অ্যাডমিন কি না তা চেক করার কোড এখানে থাকতে পারে (ঐচ্ছিক)
// if(!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

# ২. SQL কুয়েরি (JOIN ব্যবহার করে স্টুডেন্ট এবং কোর্সের নাম আনা হয়েছে)
# ২. SQL কুয়েরি (Updated with Role Filter)
$sql = "SELECT 
            e.id as enroll_id, 
            u.full_name as student_name, 
            u.email as student_email, 
            c.title as course_title, 
            e.enrollment_date, 
            e.is_active 
        FROM enrollments e
        INNER JOIN users u ON e.student_id = u.id
        INNER JOIN courses c ON e.course_id = c.id
        WHERE u.role = 3  -- এটি নিশ্চিত করবে এখানে অ্যাডমিন আসবে না
        ORDER BY e.enrollment_date DESC";

$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Enrollments - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/releases/v5.10.0/css/all.min.css">
    
    <style>
        body { background-color: #f4f7f6; }
        .card { border-radius: 15px; border: none; }
        .table thead { background-color: #4e73df; color: white; }
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; }
    </style>
</head>
<body>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark">Course Enrollment List</h2>
                <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-print"></i> Print Report
                </button>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th class="ps-4">#ID</th>
                                    <th>Student Details</th>
                                    <th>Enrolled Course</th>
                                    <th>Enroll Date</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if ($result && $result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td class="ps-4 fw-bold text-secondary">#<?= $row['enroll_id'] ?></td>
                                            <td>
                                                <div class="fw-bold"><?= $row['student_name'] ?></div>
                                                <small class="text-muted"><?= $row['student_email'] ?></small>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border fw-normal">
                                                    <?= $row['course_title'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?= date('d M, Y', strtotime($row['enrollment_date'])) ?><br>
                                                <small class="text-muted"><?= date('h:i A', strtotime($row['enrollment_date'])) ?></small>
                                            </td>
                                            <td>
                                                <?php if($row['is_active'] == 1): ?>
                                                    <span class="badge bg-success status-badge">Active</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger status-badge">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-light border" title="Edit Status">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </button>
                                                <button class="btn btn-sm btn-light border" title="Remove">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center py-5 text-muted'>No students have enrolled yet.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="mt-3 text-end">
                <p class="text-muted small">Total Enrollments: <strong><?= $result->num_rows ?></strong></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>