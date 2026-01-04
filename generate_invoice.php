<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("Admin/includes/db_config.php");
session_start();


if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    die("Unauthorized access or missing ID.");
}

$enroll_id = $_GET['id'];
$student_id = $_SESSION['user_id'];

$sql = "SELECT 
            e.*, 
            c.title, c.price, c.discounted_price, c.teacher_name,
            u.full_name as student_name, u.email as student_email
        FROM enrollments e
        JOIN courses c ON e.course_id = c.id
        JOIN users u ON e.student_id = u.id
        WHERE e.id = ? AND e.student_id = ?";

$stmt = $db->prepare($sql);
$stmt->bind_param("ii", $enroll_id, $student_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Invoice not found!");
}


$final_price = ($data['discounted_price'] > 0) ? $data['discounted_price'] : $data['price'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?= $data['id']; ?></title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            background: #fff;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .btn-print {
            background: #2196F3;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        @media print {
            .btn-print {
                display: none;
            }

            .invoice-box {
                border: none;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

    <div style="text-align: center; margin-top: 20px;">
        <button class="btn-print" onclick="window.print()">Download / Print PDF</button>
    </div>

    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h2 style="margin:0; color: #1e3a8a;">CODIMU LMS</h2>
                            </td>
                            <td>
                                Invoice #: <?= 1000 + $data['id']; ?><br>
                                Created: <?= date('d M, Y', strtotime($data['enrollment_date'])); ?><br>
                                Status: <?= ($data['is_active'] == 1) ? 'Paid' : 'Pending'; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>Codium Academy</strong><br>
                                123 Learning St, Dhaka<br>
                                support@codium-lms.com
                            </td>
                            <td>
                                <strong>Customer Details:</strong><br>
                                Name: <?= htmlspecialchars($data['student_name']); ?><br>
                                Email: <?= htmlspecialchars($data['student_email']); ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Course Name</td>
                <td>Price</td>
            </tr>

            <tr class="item">
                <td>
                    <?= htmlspecialchars($data['title']); ?><br>
                    <small style="color:#777;">Instructor: <?= htmlspecialchars($data['teacher_name']); ?></small>
                </td>
                <td><?= number_format($final_price, 2); ?> BDT</td>
            </tr>

            <tr class="total">
                <td></td>
                <td>Total: <?= number_format($final_price, 2); ?> BDT</td>
            </tr>
        </table>

        <div style="margin-top: 50px; text-align: center; font-size: 12px; color: #999;">
            <p>Thank you for your purchase. If you have any questions, please contact us.</p>

        </div>
    </div>

</body>

</html>