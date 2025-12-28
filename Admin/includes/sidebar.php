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
// Session start thakte hobe jate email/name pawa jay
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Admin er fixed image path
$avatar_path = "../public/images/256_michael-dam-258165-unsplash.jpg";

// 2. Name logic (Jodi session e name thake seta, na hole email)
$display_name = !empty($_SESSION['full_name']) ? $_SESSION['full_name'] : ($_SESSION['email'] ?? 'Admin');
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

                       
                           
                            
                           
                            
                            
                            
                           
                        
                        <div class="sidebar-heading">Admin</div>
                        <ul class="sidebar-menu">
                                
                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button"
                                   href="dashboard.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                                    <span class="sidebar-menu-text">Home</span>
                                </a>
                            </li>
                           
                             <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   data-toggle="collapse"
                                   href="#layouts_menu">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">view_compact</span>
                                    Categories
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse sm-indent"
                                    id="layouts_menu">
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button"
                                           href="category_new.php">
                                            <span class="sidebar-menu-text">New Category</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button"
                                           href="category_manage.php">
                                            <span class="sidebar-menu-text">Manage Category</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                            
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="instructor-courses.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
                                    <span class="sidebar-menu-text">Manage Courses</span>
                                </a>
                            </li>
                           <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   data-toggle="collapse"
                                   href="#layouts_menu">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">view_compact</span>
                                    Manage Quiz
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse sm-indent"
                                    id="layouts_menu">
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button"
                                           href="quize_add.php">
                                            <span class="sidebar-menu-text">New Quiz</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button"
                                           href="instructor-edit-quiz.php">
                                            <span class="sidebar-menu-text">Manage Quiz</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a class="sidebar-menu-button"
                                           href="admin_results.php">
                                            <span class="sidebar-menu-text">Quiz Result</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                            
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="announce.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">help</span>
                                    <span class="sidebar-menu-text">Manage Announcements</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="admin-payments.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">receipt</span>
                                    <span class="sidebar-menu-text">Manage Enrollment</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="instructor-edit-quiz.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">format_shapes</span>
                                    <span class="sidebar-menu-text">Edit Quiz</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="student_list.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">post_add</span>
                                    <span class="sidebar-menu-text">Student List</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"
                                   href="teachers_list.php">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">post_add</span>
                                    <span class="sidebar-menu-text">Teachers List</span>
                                </a>
                            </li>


                           
                        </ul>

                        
                                </ul>
                            </li>
                        </ul>

                        
                                    
                                    
                                    
                                    
                                    
                                </ul>
                            </li>
                            
                        </ul>
