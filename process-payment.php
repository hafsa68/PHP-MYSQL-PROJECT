<?php
session_start();
include_once("Admin/includes/db_config.php");

$student_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; // Login logic onujayi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $amount = $_POST['amount'];
    $method_id = $_POST['payment_method_id'];
    $mobile = $_POST['mobile_number'];
    $trx_id = $_POST['transaction_number'];
    $t_id = "TRX" . time(); // Unique Transaction ID generate kora

    // Step 1: Payments table-e data insert
    $pay_sql = "INSERT INTO payments (transaction_id, student_id, course_id, amount, payment_method_id, mobile_number, transaction_number, payment_status) 
                VALUES ('$t_id', '$student_id', '$course_id', '$amount', '$method_id', '$mobile', '$trx_id', 'pending')";

    if ($db->query($pay_sql)) {
        // Step 2: Enrollments table-e entry deya (Status pending thakbe admin verify kora porjonto)
        $enroll_sql = "INSERT INTO enrollments (student_id, course_id, is_active) 
                       VALUES ('$student_id', '$course_id', 0)"; // 0 mane ekhono verify hoyni
        
        $db->query($enroll_sql);

        echo "<script>
                alert('Payment submitted! Please wait for admin verification.');
                window.location.href='my-courses.php';
              </script>";
    } else {
        echo "Payment Error: " . $db->error;
    }
}
?>