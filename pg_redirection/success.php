<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

# আপনার ডাটাবেজ কানেকশন ফাইল
include_once(__DIR__ . "/../Admin/includes/db_config.php");
require_once(__DIR__ . "/../lib/SslCommerzNotification.php");

use SslCommerz\SslCommerzNotification;

# SSLCommerz থেকে পাঠানো ডাটা রিসিভ করা
$tran_id = $_POST['tran_id'] ?? '';
$amount  = $_POST['amount'] ?? '';
$currency = $_POST['currency'] ?? '';

if (empty($tran_id) || empty($amount)) {
    die("Invalid Access");
}

$sslc = new SslCommerzNotification();

# ১. ডাটাবেজ থেকে অর্ডার তথ্য সংগ্রহ
$sql = "SELECT * FROM orders WHERE transaction_id = '$tran_id'";
$result = $db->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .success-card {
            max-width: 600px;
            margin: 60px auto;
            border: none;
            border-radius: 20px;
        }

        .icon-box {
            font-size: 70px;
            color: #198754;
        }

        .info-table {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);

            
            if ($row['status'] == 'Pending') {

                $validated = $sslc->orderValidate($_POST, $tran_id, $amount, $currency);

                if ($validated) {
                
                    $update_order_query = "UPDATE orders SET status = 'Success' WHERE transaction_id = '$tran_id'";

                    if ($db->query($update_order_query) === TRUE) {

                        
                        $user_email = $row['email'];
                        $course_id  = $row['course_id'];
                        $enroll_date = date('Y-m-d H:i:s');

                        $user_find_query = "SELECT id FROM users WHERE email = '$user_email' AND role = 3 LIMIT 1";
                        $user_res = $db->query($user_find_query);

                        if ($user_res && $user_res->num_rows > 0) {
                            $user_data = $user_res->fetch_assoc();
                            $student_id = $user_data['id'];

                            
                            if (!empty($course_id)) {
                                $check_enroll = "SELECT id FROM enrollments WHERE student_id = '$student_id' AND course_id = '$course_id'";
                                $enroll_result = $db->query($check_enroll);

                                if ($enroll_result && $enroll_result->num_rows == 0) {
                                    $insert_enroll = "INSERT INTO enrollments (student_id, course_id, enrollment_date, is_active) 
                          VALUES ('$student_id', '$course_id', '$enroll_date', 1)";
                                    $db->query($insert_enroll);
                                }
                            }

        $bank_tran_id = $_POST['bank_tran_id'] ?? ''; 
        $card_type = $_POST['card_type'] ?? 'SSLCommerz'; 
        $mobile_no = $row['phone'] ?? ''; 
        
        $payment_sql = "INSERT INTO payments (
            transaction_id, 
            student_id, 
            course_id, 
            amount, 
            discount_amount, 
            payment_method_id, 
            mobile_number, 
            transaction_number, 
            payment_status, 
            paid_at, 
            created_at
        ) VALUES (
            '$tran_id', 
            '$student_id', 
            '$course_id', 
            '$amount', 
            '0.00', 
            '1', 
            '$mobile_no', 
            '$bank_tran_id', 
            'completed', 
            NOW(), 
            NOW()
        )";

        $db->query($payment_sql);
        // --- পেমেন্ট ইনসার্ট শেষ ---
    
                            

                           
        ?>
                            <div class="card success-card shadow-lg p-4 text-center">
                                <div class="card-body">
                                    <div class="icon-box mb-3">
                                        <i class="bi bi-check-circle-fill">✔</i>
                                    </div>
                                    <h2 class="text-success fw-bold">Payment Successful!</h2>
                                    <p class="text-muted lead">Congratulations! Your enrollment is now active.</p>

                                    <div class="info-table text-start">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-secondary">Transaction ID:</span>
                                            <span class="fw-bold"><?= $tran_id ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-secondary">Amount Paid:</span>
                                            <span class="fw-bold text-dark"><?= $amount ?> <?= $currency ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-secondary">Course ID:</span>
                                            <span class="fw-bold">#<?= $course_id ?></span>
                                        </div>
                                    </div>

                                    <div class="mt-4 d-grid gap-2">
                                        <a href="../my-courses.php" class="btn btn-success btn-lg shadow">Start Learning Now</a>
                                        <a href="../index.php" class="btn btn-link text-decoration-none">Go back to Home</a>
                                    </div>
                                </div>
                            </div>
        <?php
                        } else {
                            echo "<div class='alert alert-danger mt-5'>User account not found for email: $user_email</div>";
                        }
                    }
                } else {
                    echo "<div class='alert alert-danger mt-5 text-center'>Payment Validation Failed!</div>";
                }
            } else {
                echo "<div class='alert alert-info mt-5 text-center'>This transaction has already been processed.</div>";
            }
        } else {
            echo "<div class='alert alert-warning mt-5 text-center'>Transaction ID not found in our records.</div>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>