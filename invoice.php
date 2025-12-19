<?php
session_start();
include_once("Admin/includes/db_config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$transaction_id = $_GET['transaction_id'] ?? '';

// Get payment details with user and course info
$sql = "SELECT p.*, c.title as course_title, c.price, 
               u.name as student_name, u.email as student_email,
               pm.name as payment_method
        FROM payments p
        JOIN courses c ON p.course_id = c.id
        JOIN users u ON p.student_id = u.id
        JOIN payment_methods pm ON p.payment_method_id = pm.id
        WHERE p.transaction_id = ? AND p.student_id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("si", $transaction_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$payment = $result->fetch_object();

if (!$payment) {
    die("Invoice not found");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?php echo $transaction_id; ?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-container { max-width: 800px; margin: auto; padding: 20px; }
        .header { border-bottom: 2px solid #333; margin-bottom: 30px; }
        .company-info { float: right; text-align: right; }
        .details { margin: 30px 0; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 10px; border: 1px solid #ddd; }
        .text-right { text-align: right; }
        .total { font-size: 18px; font-weight: bold; }
        @media print {
            .no-print { display: none; }
            body { font-size: 12px; }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h1>INVOICE</h1>
            <div class="company-info">
                <h3>Your Company Name</h3>
                <p>Address Line 1<br>Address Line 2<br>Phone: +880 XXXX XXXXXX</p>
            </div>
            <div style="clear: both;"></div>
        </div>
        
        <div class="details">
            <div style="float: left; width: 50%;">
                <h4>Bill To:</h4>
                <p><strong><?php echo htmlspecialchars($payment->student_name); ?></strong><br>
                <?php echo htmlspecialchars($payment->student_email); ?></p>
            </div>
            <div style="float: right; width: 50%; text-align: right;">
                <p><strong>Invoice No:</strong> <?php echo htmlspecialchars($payment->transaction_id); ?><br>
                <strong>Date:</strong> <?php echo date('d M Y', strtotime($payment->paid_at)); ?><br>
                <strong>Payment Method:</strong> <?php echo htmlspecialchars($payment->payment_method); ?></p>
            </div>
            <div style="clear: both;"></div>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($payment->course_title); ?></td>
                    <td>1</td>
                    <td class="text-right">$<?php echo number_format($payment->amount, 2); ?></td>
                    <td class="text-right">$<?php echo number_format($payment->amount, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                    <td class="text-right total">$<?php echo number_format($payment->amount, 2); ?></td>
                </tr>
            </tbody>
        </table>
        
        <div class="footer mt-4">
            <p>Thank you for your business!</p>
            <p><strong>Terms & Conditions:</strong></p>
            <p>1. This is a computer generated invoice.<br>
            2. Access will be granted within 24 hours of payment verification.<br>
            3. For any queries, contact: support@yourcompany.com</p>
        </div>
        
        <div class="no-print text-center mt-4">
            <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
            <button onclick="window.close()" class="btn btn-secondary">Close</button>
        </div>
    </div>
</body>
</html>