 <!-- Sidebar Content -->

                                  <div class="d-flex align-items-center navbar-height">
                            <form action="index.html"
                                  class="search-form search-form--black mx-16pt pr-0 pl-16pt">
                                <input type="text"
                                       class="form-control pl-0"
                                       placeholder="Search">
                                <button class="btn"
                                        type="submit"><i class="material-icons">search</i></button>
                            </form>
                        </div>

                        <?php
// Session logic: Jodi full_name na thake tobe email er prothom tuku dekhabe
$display_name = !empty($_SESSION['full_name']) ? $_SESSION['full_name'] : ($_SESSION['email'] ?? 'User');

// Avatar logic
$avatar_path = (!empty($_SESSION['avatar'])) ? "uploads/" . $_SESSION['avatar'] : "public/images/people/110/guy-1.jpg";
?>

<div class="sidebar-p-a border-bottom shadow-sm mb-2" style="background: rgba(255,255,255,0.03);">
    <a href="profile.php" class="d-flex align-items-center text-decoration-none py-1">
        <div class="position-relative mr-3">
            <img src="<?= $avatar_path ?>" 
                 class="rounded-circle border border-2 border-primary" 
                 width="42" height="42" 
                 style="object-fit: cover; padding: 2px;">
            <span class="position-absolute border border-white rounded-circle bg-success" 
                  style="bottom: 2px; right: 2px; width: 10px; height: 10px;"></span>
        </div>

        <div class="flex">
            <div class="text-white font-weight-bold mb-0 text-truncate" style="max-width: 120px;">
                <?= htmlspecialchars($display_name) ?>
            </div>
            <small class="text-muted d-block" style="font-size: 10px; letter-spacing: 0.5px; text-transform: uppercase;">
                <?= ($_SESSION['role'] == 1) ? 'Administrator' : (($_SESSION['role'] == 2) ? 'Instructor' : 'Student') ?>
            </small>
        </div>
        
        <i class="material-icons text-muted ml-auto" style="font-size: 18px;">keyboard_arrow_right</i>
    </a>
</div>

                        <div class="sidebar-heading">Student</div>
                        <ul class="sidebar-menu">

                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button"
                                   href="student_dashboard.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                                    <span class="sidebar-menu-text">Home</span>
                                </a>
                            </li>
                           
                        
                           
                            
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="my-courses.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">search</span>
                                    <span class="sidebar-menu-text">My Courses</span>
                                </a>
                            </li>
                            
                            
                
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="student-take-course.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                                    <span class="sidebar-menu-text">Take Course</span>
                                    <span class="sidebar-menu-badge badge badge-accent badge-notifications ml-auto">PRO</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="quiz.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dvr</span>
                                    <span class="sidebar-menu-text">Take Quiz</span>
                                </a>
                            </li>
                            

                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="quiz-result.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">live_help</span>
                                    <span class="sidebar-menu-text">Quiz Result</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="st_announce.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">live_help</span>
                                    <span class="sidebar-menu-text">Announcements</span>
                                </a>
                            </li>
                            
                           
                        
 
                         
                            

                                
                            
                        </ul>
