<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . "/lib/SslCommerzNotification.php");
include("Admin/includes/db_config.php");
// OrderTransaction.php আর দরকার নেই কারণ আমরা সরাসরি SQL লিখছি

use SslCommerz\SslCommerzNotification;

# ১. ফর্ম থেকে আসা ডাটা সাজানো
$post_data = array();
$post_data['total_amount'] = $_POST['amount'];
$post_data['currency'] = "BDT";
$post_data['tran_id'] = "SSLCZ_TEST_" . uniqid();

# ২. কোর্স আইডি রিসিভ করা (এটি অত্যন্ত গুরুত্বপূর্ণ)
$course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;

# কাস্টমার ইনফরমেশন
$post_data['cus_name'] = isset($_POST['customer_name']) ? $_POST['customer_name'] : "John Doe";
$post_data['cus_email'] = isset($_POST['customer_email']) ? $_POST['customer_email'] : "john.doe@email.com";
$post_data['cus_add1'] = "Dhaka";
$post_data['cus_phone'] = isset($_POST['customer_mobile']) ? $_POST['customer_mobile'] : "01711111111";

# শিপমেন্ট এবং অন্যান্য ডিফল্ট ডাটা
$post_data["shipping_method"] = "NO";
$post_data["product_category"] = "Course";
$post_data["product_profile"] = "general";
$post_data["product_name"] = "Online Course";
$post_data["num_of_item"] = "1";

# ৩. সরাসরি ডাটাবেজে সেভ করার কুয়েরি (এখানেই আপনার ভুল হচ্ছিল)
$sql = "INSERT INTO orders (course_id, name, email, phone, amount, address, status, transaction_id, currency) 
        VALUES (
            '$course_id', 
            '{$post_data['cus_name']}', 
            '{$post_data['cus_email']}', 
            '{$post_data['cus_phone']}', 
            '{$post_data['total_amount']}', 
            '{$post_data['cus_add1']}', 
            'Pending', 
            '{$post_data['tran_id']}', 
            'BDT'
        )";

# ৪. ডাটাবেজে সেভ হলে পেমেন্ট গেটওয়ে কল করা
if ($db->query($sql) === TRUE) {
    $sslcz = new SslCommerzNotification();
    $msg = $sslcz->makePayment($post_data, 'hosted');
    
    if (!is_array($msg)) {
        echo $msg;
    }
} else {
    echo "Database Error: " . $db->error;
}
?>