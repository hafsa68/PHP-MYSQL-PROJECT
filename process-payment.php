<?php
session_start();
include_once("Admin/includes/db_config.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') die("Invalid request");

$student_id = intval($_POST['student_id']);
$course_id = intval($_POST['course_id']);
$amount = floatval($_POST['amount']);
$discount_amount = floatval($_POST['discount_amount'] ?? 0);
$payment_method_id = intval($_POST['payment_method_id']);
$mobile_number = $_POST['mobile_number'] ?? '';
$transaction_number = $_POST['transaction_number'] ?? '';
$bkash_nagad_id = $_POST['bkash_nagad_id'] ?? '';

$transaction_id = 'TXN'.time().rand(1000,9999);

$db->begin_transaction();

try {
    // Insert payment
    $payment_sql = "INSERT INTO payments (
        transaction_id, student_id, course_id, amount, discount_amount, payment_method_id, mobile_number, transaction_number, bkash/nagad/id, payment_status, paid_at, created_at
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW(), NOW())";

    $stmt = $db->prepare($payment_sql);
    $stmt->bind_param(
        "siidiiiss",
        $transaction_id, $student_id, $course_id, $amount, $discount_amount, $payment_method_id, $mobile_number, $transaction_number, $bkash_nagad_id
    );
    if (!$stmt->execute()) throw new Exception($stmt->error);

    $payment_id = $db->insert_id;

    // Insert enrollment
    $enroll_sql = "INSERT INTO enrollments (student_id, course_id, enrollment_date, access_expiry, is_active) 
                   VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 1 YEAR), 1)";
    $stmt2 = $db->prepare($enroll_sql);
    $stmt2->bind_param("ii", $student_id, $course_id);
    if (!$stmt2->execute()) throw new Exception($stmt2->error);

    // Update payment to completed
    $update_sql = "UPDATE payments SET payment_status='completed' WHERE id=?";
    $stmt3 = $db->prepare($update_sql);
    $stmt3->bind_param("i", $payment_id);
    if (!$stmt3->execute()) throw new Exception($stmt3->error);

    $db->commit();
    header("Location: student_dashboard.php?enrollment_success=1&course_id=$course_id");
    exit();

} catch (Exception $e) {
    $db->rollback();
    error_log("Payment Error: ".$e->getMessage());
    header("Location: payment-error.php?error=".urlencode($e->getMessage()));
    exit();
}
?>
