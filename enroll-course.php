<?php
session_start();
include_once("Admin/includes/db_config.php");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php?redirect=enroll&course_id=" . $_GET['course_id']);
//     exit();
// }

// $user_id = $_SESSION['user_id'];
// $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Debug: Print course_id

$course_id = $_REQUEST['course_id'];
// Get course details with error handling
$course_sql = "SELECT * FROM courses WHERE id = '$course_id'";
$course_stmt = $db->query($course_sql);

if (!$course_stmt) {
    die("Prepare failed: " . $db->error);
}

//$course_result = $course_stmt->fetch_assoc();

// Debug: Print number of rows

if ($course_stmt->num_rows< 1) {
    die("Course not found. Course ID: " . $course_id . ". Check if course exists in database.");
}

$course = $course_stmt->fetch_object();


// Check if already enrolled
$check_sql = "SELECT * FROM enrollments WHERE student_id = ? AND course_id = ?";
$check_stmt = $db->prepare($check_sql);
$check_stmt->bind_param("ii", $user_id, $course_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // Already enrolled
    header("Location: my-courses.php?message=already_enrolled");
    exit();
}

// Get payment methods
$payment_methods_sql = "SELECT * FROM payment_methods WHERE is_active = 1";
$payment_methods_result = $db->query($payment_methods_sql);

if (!$payment_methods_result) {
    die("Payment methods query failed: " . $db->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll in <?php echo htmlspecialchars($course->title); ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: none;
        }
        
        .card-header {
            border-radius: 15px 15px 0 0 !important;
            background: linear-gradient(45deg, #007bff, #6610f2);
        }
        
        .course-img {
            border-radius: 10px;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .course-img:hover {
            transform: scale(1.02);
        }
        
        .price-highlight {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .payment-method-card {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .payment-method-card:hover,
        .payment-method-card.selected {
            border-color: #007bff;
            background-color: #e7f1ff;
        }
        
        .btn-success {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }
        
        .terms-link {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }
        
        .terms-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg">
                    <div class="card-header py-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-graduation-cap fa-2x me-3 text-white"></i>
                            <div>
                                <h2 class="h3 mb-0 text-white">Enroll in Course</h2>
                                <p class="mb-0 text-white-50">Complete your enrollment process</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <!-- Course Summary -->
                        <div class="row align-items-center mb-5 pb-3 border-bottom">
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <img src="uploads/<?php echo htmlspecialchars($course->thumbnail); ?>" 
                                     alt="<?php echo htmlspecialchars($course->title); ?>" 
                                     class="course-img img-fluid w-100">
                            </div>
                            <div class="col-md-8">
                                <h3 class="h4 mb-3 text-primary"><?php echo htmlspecialchars($course->title); ?></h3>
                                <p class="text-muted mb-4"><?php echo htmlspecialchars($course->description); ?></p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-clock text-primary me-3"></i>
                                            <div>
                                                <small class="text-muted d-block">Duration</small>
                                                <strong><?php echo htmlspecialchars($course->duration); ?> hours</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-chart-line text-primary me-3"></i>
                                            <div>
                                                <small class="text-muted d-block">Level</small>
                                                <strong><?php echo htmlspecialchars($course->level); ?></strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="bg-light p-4 rounded text-center">
                                            <?php if (!empty($course->discounted_price) && $course->discounted_price < $course->price): ?>
                                                <div class="mb-2">
                                                    <small class="text-muted d-block">Original Price</small>
                                                    <del class="text-danger">$<?php echo number_format($course->price, 2); ?></del>
                                                </div>
                                                <div class="mb-2">
                                                    <small class="text-muted d-block">Discounted Price</small>
                                                    <h4 class="text-success mb-0">$<?php echo number_format($course->discounted_price, 2); ?></h4>
                                                </div>
                                                <div>
                                                    <small class="text-success">
                                                        <i class="fas fa-save me-1"></i>
                                                        Save $<?php echo number_format(($course->price - $course->discounted_price), 2); ?>
                                                    </small>
                                                </div>
                                            <?php else: ?>
                                                <div>
                                                    <small class="text-muted d-block">Course Fee</small>
                                                    <h4 class="text-primary mb-0">$<?php echo number_format($course->price, 2); ?></h4>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Form -->
<!-- Line 109 পরিবর্তন করুন: -->
<form id="paymentForm" action="process-payment.php" method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                            <input type="hidden" name="student_id" value="<?php echo $user_id; ?>">
                            <input type="hidden" name="amount" value="<?php echo !empty($course->discounted_price) ? $course->discounted_price : $course->price; ?>">
                            
                            <!-- Payment Methods -->
                            <div class="mb-5">
                                <h4 class="mb-4">
                                    <i class="fas fa-credit-card me-2 text-primary"></i>
                                    Select Payment Method
                                </h4>
                                
                                <div class="row g-3">
                                    <?php 
                                    // Reset pointer to beginning
                                    $payment_methods_result->data_seek(0);
                                    while($method = $payment_methods_result->fetch_object()): 
                                    ?>
                                    <div class="col-md-6">
                                        <div class="payment-method-card" onclick="selectPaymentMethod(<?php echo $method->id; ?>, '<?php echo $method->type; ?>')">
                                            <div class="form-check">
                                                <input class="form-check-input payment-method-radio" 
                                                       type="radio" 
                                                       name="payment_method_id" 
                                                       id="method_<?php echo $method->id; ?>" 
                                                       value="<?php echo $method->id; ?>"
                                                       data-type="<?php echo $method->type; ?>"
                                                       required>
                                                <label class="form-check-label w-100" for="method_<?php echo $method->id; ?>">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <?php if($method->name == 'bKash'): ?>
                                                                <i class="fas fa-mobile-alt fa-2x text-success me-3"></i>
                                                            <?php elseif($method->name == 'Nagad'): ?>
                                                                <i class="fas fa-wallet fa-2x text-warning me-3"></i>
                                                            <?php elseif($method->name == 'Bank Transfer'): ?>
                                                                <i class="fas fa-university fa-2x text-info me-3"></i>
                                                            <?php else: ?>
                                                                <i class="fas fa-credit-card fa-2x text-primary me-3"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1"><?php echo htmlspecialchars($method->name); ?></h6>
                                                            <?php if($method->instructions): ?>
                                                                <small class="text-muted"><?php echo htmlspecialchars($method->instructions); ?></small>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endwhile; ?>
                                </div>
                                
                                <div class="invalid-feedback">
                                    Please select a payment method
                                </div>
                            </div>

                            <!-- Mobile Banking Fields -->
                            <div id="mobileBankingFields" class="mb-4" style="display: none;">
                                <div class="bg-light p-4 rounded">
                                    <h5 class="mb-3">
                                        <i class="fas fa-mobile-alt me-2 text-success"></i>
                                        Mobile Banking Details
                                    </h5>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="mobile_number" class="form-label">
                                                <i class="fas fa-phone me-1"></i>
                                                Mobile Number *
                                            </label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="mobile_number" 
                                                   name="mobile_number" 
                                                   placeholder="01XXXXXXXXX"
                                                   pattern="01[3-9]\d{8}">
                                            <div class="invalid-feedback">
                                                Please enter a valid Bangladeshi mobile number (01XXXXXXXXX)
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="transaction_number" class="form-label">
                                                <i class="fas fa-receipt me-1"></i>
                                                Transaction Number *
                                            </label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="transaction_number" 
                                                   name="transaction_number" 
                                                   placeholder="Enter transaction number"
                                                   required>
                                            <div class="invalid-feedback">
                                                Please enter transaction number
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="bkash_nagad_id" class="form-label">
                                                <i class="fas fa-id-card me-1"></i>
                                                bKash/Nagad Transaction ID *
                                            </label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="bkash_nagad_id" 
                                                   name="bkash_nagad_id" 
                                                   placeholder="Enter transaction ID from app"
                                                   required>
                                            <div class="invalid-feedback">
                                                Please enter bKash/Nagad transaction ID
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="agree_terms" required>
                                    <label class="form-check-label" for="agree_terms">
                                        I agree to the 
                                        <a href="#" class="terms-link" data-bs-toggle="modal" data-bs-target="#termsModal">
                                            Terms and Conditions
                                        </a>
                                        *
                                    </label>
                                    <div class="invalid-feedback">
                                        You must agree to the terms and conditions
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between pt-4 border-top">
                                <a href="courses.php" class="btn btn-outline-secondary px-4">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Back to Courses
                                </a>
                                
                                <button type="submit" class="btn btn-success px-5">
                                    <i class="fas fa-lock me-2"></i>
                                    Complete Enrollment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="termsModalLabel">
                        <i class="fas fa-file-contract me-2"></i>
                        Terms and Conditions
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">1. Payment Terms</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Payment is required for course access</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> All payments are in US Dollars (USD)</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Payment verification may take up to 24 hours</li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">2. Refund Policy</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Refunds available within 7 days of purchase</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> No refund after accessing course content</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Refund processing time: 5-7 business days</li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">3. Course Access</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Access granted for 1 year from enrollment</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Course content is for personal use only</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> We reserve the right to update course content</li>
                        </ul>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Note:</strong> By proceeding with payment, you agree to all terms and conditions mentioned above.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        <i class="fas fa-check me-2"></i>
                        I Understand
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Payment method selection
        function selectPaymentMethod(methodId, methodType) {
            // Remove selected class from all cards
            document.querySelectorAll('.payment-method-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked card
            const card = document.querySelector(`#method_${methodId}`).closest('.payment-method-card');
            card.classList.add('selected');
            
            // Trigger radio button click
            document.getElementById(`method_${methodId}`).checked = true;
            
            // Show/hide mobile banking fields
            const mobileBankingFields = document.getElementById('mobileBankingFields');
            if (methodType === 'mobile_banking') {
                mobileBankingFields.style.display = 'block';
                
                // Add required attributes
                document.getElementById('mobile_number').required = true;
                document.getElementById('transaction_number').required = true;
                document.getElementById('bkash_nagad_id').required = true;
            } else {
                mobileBankingFields.style.display = 'none';
                
                // Remove required attributes
                document.getElementById('mobile_number').required = false;
                document.getElementById('transaction_number').required = false;
                document.getElementById('bkash_nagad_id').required = false;
            }
        }
        
        // Form validation
        (function () {
            'use strict'
            
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')
            
            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        
                        // Additional validation for mobile banking
                        const selectedMethod = document.querySelector('input[name="payment_method_id"]:checked');
                        if (selectedMethod) {
                            const methodType = selectedMethod.getAttribute('data-type');
                            
                            if (methodType === 'mobile_banking') {
                                const mobileNumber = document.getElementById('mobile_number').value;
                                const mobileRegex = /^01[3-9]\d{8}$/;
                                
                                if (!mobileRegex.test(mobileNumber)) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                    document.getElementById('mobile_number').classList.add('is-invalid');
                                }
                            }
                        }
                        
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        
        // Real-time mobile number validation
        document.getElementById('mobile_number')?.addEventListener('input', function() {
            const mobileRegex = /^01[3-9]\d{0,8}$/;
            if (!mobileRegex.test(this.value) && this.value.length > 0) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
        
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
</body>
</html>