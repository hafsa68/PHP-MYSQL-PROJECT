<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("Admin/includes/db_config.php");
session_start();

header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");

// Auth Check
if (!isset($_SESSION['email']) || $_SESSION['role'] != 3) {
    header("Location:login.php");
    exit;
}

// Result Save Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['questions'])) {
    $score = 0;
    $questions = $_POST['questions'];
    $quiz_taker = $_SESSION['email']; 
    
    foreach ($questions as $id => $user_ans) {
        $id = intval($id);
        $res = $db->query("SELECT correct_answer FROM tbl_quiz WHERE tbl_quiz_id = $id");
        if ($row = $res->fetch_assoc()) {
            if (trim($row['correct_answer']) == trim($user_ans)) {
                $score++;
            }
        }
    }
    
    $date = date('Y-m-d');
    $db->query("INSERT INTO tbl_result (quiz_taker, total_score, date_taken) VALUES ('$quiz_taker', '$score', '$date')");
    echo "<script>alert('Well Done! Your Score: $score'); window.location='quiz-result.php';</script>";
}

$quizzes = $db->query("SELECT * FROM tbl_quiz");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quiz Dashboard</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    <link type="text/css" href="public/vendor/spinkit.css" rel="stylesheet">
    <link type="text/css" href="public/css/material-icons.css" rel="stylesheet">
    <link type="text/css" href="public/css/fontawesome.css" rel="stylesheet">
    <link type="text/css" href="public/css/app.css" rel="stylesheet">

    <style>
        :root { --primary-color: #5567ff; --bg-light: #f4f7fb; }
        .page-content { background-color: var(--bg-light); }
        .quiz-container { max-width: 900px; margin: 0 auto; }
        .q-card { 
            background: #fff; border-radius: 15px; border: none; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 25px; 
        }
        .q-number { 
            background: var(--primary-color); color: #fff; padding: 4px 12px; 
            border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase;
        }
        .option-box {
            display: block; cursor: pointer; padding: 15px; margin-bottom: 12px;
            border: 2px solid #edf2f7; border-radius: 10px; transition: all 0.2s ease;
            font-weight: 500; color: #4a5568; position: relative;
        }
        .option-box:hover { border-color: var(--primary-color); background: #f8faff; }
        .option-box input { display: none; }
        .option-box.active { border-color: var(--primary-color); background: #f0f3ff; color: var(--primary-color); }

        .submit-btn {
            background: var(--primary-color); border: none; padding: 12px 35px;
            border-radius: 10px; font-weight: bold; color: white; transition: 0.3s;
        }
        .submit-btn:hover { opacity: 0.9; transform: translateY(-2px); }
    </style>
</head>

<body class="layout-app">

    <div class="preloader">
        <div class="sk-chase">
            <?php for($i=0; $i<6; $i++): ?><div class="sk-chase-dot"></div><?php endfor; ?>
        </div>
    </div>

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">

            <?php include_once("inc/st_nav.php") ?>

            <div class="container page__container page-section">
                <div class="quiz-container">
                    
                    <div class="text-center mb-5">
                        <h2 class="font-weight-bold">Active Quiz</h2>
                        <p class="text-muted">Test your knowledge and track your progress</p>
                    </div>

                    <form method="POST" id="quizForm">
                        <?php $count = 1; while($q = $quizzes->fetch_assoc()): ?>
                            <div class="card q-card">
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <span class="q-number">Question <?= $count++; ?></span>
                                    </div>
                                    <h5 class="mb-4 text-dark font-weight-bold"><?= htmlspecialchars($q['quiz_question']); ?></h5>
                                    
                                    <div class="row">
                                        <?php 
                                        $options = ['A' => $q['option_a'], 'B' => $q['option_b'], 'C' => $q['option_c'], 'D' => $q['option_d']];
                                        foreach($options as $key => $value): 
                                        ?>
                                        <div class="col-md-6">
                                            <label class="option-box" onclick="highlightOption(this)">
                                                <input type="radio" name="questions[<?= $q['tbl_quiz_id']; ?>]" value="<?= $key; ?>" required>
                                                <span><strong><?= $key; ?>.</strong> <?= htmlspecialchars($value); ?></span>
                                            </label>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>

                        <div class="text-center mt-4">
                            <button type="submit" class="submit-btn shadow-lg">
                                Submit All Answers <i class="material-icons align-middle ml-2">check_circle</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php include_once("inc/st_footer.php") ;?>
        </div>

        <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content">
                <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left" data-perfect-scrollbar>
                    <?php include_once("inc/st_sidebar.php"); ?>
                </div>
            </div>
        </div>
    </div>

    <script src="public/vendor/jquery.min.js"></script>
    <script src="public/vendor/popper.min.js"></script>
    <script src="public/vendor/bootstrap.min.js"></script>
    <script src="public/vendor/perfect-scrollbar.min.js"></script>
    <script src="public/vendor/dom-factory.js"></script>
    <script src="public/vendor/material-design-kit.js"></script>
    <script src="public/js/app.js"></script>
    <script src="public/js/preloader.js"></script>

    <script>
        function highlightOption(element) {
            const name = element.querySelector('input').getAttribute('name');
            const allOptions = document.querySelectorAll(`input[name="${name}"]`);
            allOptions.forEach(opt => opt.parentElement.classList.remove('active'));
            element.classList.add('active');
        }
    </script>
</body>
</html>