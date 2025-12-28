<?php
include_once("includes/db_config.php");

if (isset($_GET['pay_id'])) {
    $pay_id = $_GET['pay_id'];
    $course_id = $_GET['c_id'];
    $student_id = $_GET['s_id'];

    // 1. Payment status 'completed' kora
    $update_pay = $db->query("UPDATE payments SET payment_status = 'completed', verified_at = NOW() WHERE id = $pay_id");

    // 2. Enrollment 'is_active' kora
    $update_enroll = $db->query("UPDATE enrollments SET is_active = 1 WHERE student_id = $student_id AND course_id = $course_id");

    if ($update_pay && $update_enroll) {
        echo "<script>
                alert('Payment and Enrollment Verified Successfully!');
                window.location.href='admin-payments.php';
              </script>";
    } else {
        echo "Error: " . $db->error;
    }
}
?>