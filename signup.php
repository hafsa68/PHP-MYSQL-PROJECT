<?php include_once("Admin/includes/db_config.php");


session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $role = $_POST['role'] ?? 3;

    if (!isset($_POST['terms'])) {
        die("Error: You must accept the Terms and Conditions.");
    }

    if ($password !== $confirm_password) {
        die("Error: Passwords do not match.");
    }

    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("Error: Email already registered.");
    }
    $stmt->close();

    // Avatar upload
    $avatar_name = NULL;
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $allowed_types = ['image/jpeg','image/png','image/gif'];
        if (!in_array($_FILES['avatar']['type'], $allowed_types)) {
            die("Error: Only JPG, PNG, GIF allowed for avatar.");
        }
        if ($_FILES['avatar']['size'] > 2*1024*1024) {
            die("Error: Avatar file too large (max 2MB).");
        }
        $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $avatar_name = time() . "_" . rand(1000,9999) . "." . $ext;
        move_uploaded_file($_FILES['avatar']['tmp_name'], "uploads/" . $avatar_name);
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (email, password, full_name, phone, role, avatar, is_active, email_verified, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, 0, NOW(), NOW())");
    $stmt->bind_param("ssssiis", $email, $hashed_password, $full_name, $phone, $role, $avatar_name, $is_active);

    if ($stmt->execute()) {
        // ✅ Redirect to student dashboard after signup
        $_SESSION['student_email'] = $email;
        $_SESSION['student_name'] = $full_name;
        header("Location:student_dashboard.php");
        exit;
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
    $db->close();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Registration (No JS)</title>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .registration-container {
        max-width: 900px;
        margin: 2rem auto;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        border-radius: 15px;
        overflow: hidden;
        background-color: white;
    }
    .registration-header {
        background: #4e73df;
        color: white;
        padding: 1.5rem 2rem;
        text-align: center;
    }
    .registration-header h2 {
        margin: 0;
        font-weight: 700;
    }
    .registration-form {
        padding: 2rem;
    }
    .section-title {
        color: #4e73df;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }
    .required-field::after {
        content: " *";
        color: #e74a3b;
    }
</style>
</head>
<body>
<div class="registration-container">
    <div class="registration-header">
        <h2>User Registration</h2>
        <p>Create a new user account</p>
    </div>
    
<form class="registration-form" action="" method="POST" enctype="multipart/form-data">
        <!-- Personal Information -->
        <div class="mb-4">
            <h4 class="section-title">Personal Information</h4>
            <div class="mb-3">
                <label for="full_name" class="form-label required-field">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter full name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label required-field">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Upload Avatar</label>
                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                <div class="form-text">Optional, max size 2MB. Preview not available without JS.</div>
            </div>
        </div>

        <!-- Account Security -->
        <div class="mb-4">
            <h4 class="section-title">Account Security</h4>
            <div class="mb-3">
                <label for="password" class="form-label required-field">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label required-field">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
                <div class="form-text">Password matching will be validated on the server.</div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                <label class="form-check-label" for="is_active">Activate account immediately</label>
            </div>
        </div>

        <!-- Role Selection -->
        <div class="mb-4">
            <div class="mb-3">
        <input type="hidden" name="role" value="3">
    </div>
        </div>

        <!-- Terms & Submit -->
        <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
            <label class="form-check-label" for="terms">
                I agree to the <a href="#">Terms and Conditions</a>
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Register User</button>
        <button type="reset" class="btn btn-outline-secondary ms-2">Reset Form</button>
    </form>
</div>



</body>
</html>
