<style>
  /* Fixed sidenav, full height */
  .sidenav {
    height: 100%;
    width: 200px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #0F2027;
    overflow-x: hidden;
    padding-top: 20px;
  }

  /* Style the sidenav links and the dropdown button */
  .sidenav a,
  .dropdown-btn {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    color: #ffffff;
    display: block;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    outline: none;
  }

  /* On mouse-over */
  .sidenav a:hover,
  .dropdown-btn:hover {
    color: #f1f1f1;
  }

  /* Main content */
  .main {
    margin-left: 200px;
    /* Same as the width of the sidenav */
    padding: 0px 10px;
  }

  /* Add an active class to the active dropdown button */
  .active {
    background-color: green;
    color: white;
  }

  /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
  .dropdown-container {
    display: none;
    background-color: #262626;
    padding-left: 8px;
  }

  /* Optional: Style the caret down icon */
  .fa-caret-down {
    float: right;
    padding-right: 8px;
  }

  /* Some media queries for responsiveness */
  @media screen and (max-height: 450px) {
    .sidenav {
      padding-top: 15px;
    }

    .sidenav a {
      font-size: 18px;
    }
  }

  .active-tab {
    background-color: #2C5364 !important;
  }

  .text-blue {
    background-color: #0F2027;
  }
</style>
<div class="sidenav">
  <h4 class="text-white text-center">DASHBOARD</h4>

  <!-- personal info-->
  <button class="dropdown-btn">Personal Info
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="index.php" class="<?php if ($_SERVER['PHP_SELF'] == '/resume/dashboard/index.php') {
                                  echo "active-tab";
                                } else {
                                  echo " ";
                                }
                                ?>">Personal Info</a>
    <a href="edit_personal_info.php" class="<?php if ($_SERVER['PHP_SELF'] == '/resume/dashboard/edit_personal_info.php') {
                                              echo "active-tab";
                                            } else {
                                              echo " ";
                                            }
                                            ?>">Edit Personal Info</a>

  </div>
  <!-- work experience -->
  <button class="dropdown-btn">Work Experiance
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="work_experiance.php" class="<?php if ($_SERVER['PHP_SELF'] == '/resume/dashboard/work_experiance.php') {
                                            echo "active-tab";
                                          } else {
                                            echo " ";
                                          }
                                          ?>">Work Experiance</a>
    <a href="edit_work_experiance.php" class="<?php if ($_SERVER['PHP_SELF'] == '/resume/dashboard/edit_work_experiance.php') {
                                                echo "active-tab";
                                              } else {
                                                echo " ";
                                              }
                                              ?>">Edit Work Experiance</a>
  </div>
  <!-- Education -->
  <button class="dropdown-btn">Education
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="education.php" class="<?php if ($_SERVER['PHP_SELF'] == '/resume/dashboard/education.php') {
                                      echo "active-tab";
                                    } else {
                                      echo " ";
                                    }
                                    ?>">Education</a>
    <a href="edit_education.php" class="<?php if ($_SERVER['PHP_SELF'] == '/resume/dashboard/edit_education.php') {
                                          echo "active-tab";
                                        } else {
                                          echo " ";
                                        }
                                        ?>">Edit Education</a>
  </div>
  <!-- skills -->
  <a href="skills.php" class="<?php if ($_SERVER['PHP_SELF'] == '/resume/dashboard/skills.php') {
                                echo "active-tab";
                              } else {
                                echo " ";
                              }
                              ?>">Skills</a>
  <!-- language  -->
  <a href="language.php" class="<?php if ($_SERVER['PHP_SELF'] == '/resume/dashboard/language.php') {
                                  echo "active-tab";
                                } else {
                                  echo " ";
                                }
                                ?>">Language</a>
  <!-- Project -->
  <button class="dropdown-btn">Project Work
    <i class="fa fa-caret-down"></i>
  </button>
  <a href="preview.php" class="<?php if ($_SERVER['PHP_SELF'] == '/resume/dashboard/preview.php') {
                                  echo "active-tab";
                                } else {
                                  echo " ";
                                }
                                ?>">preview</a>
  </div>
  <div class="dropdown-container">
    <a href="project_work.php" class="<?php if ($_SERVER['PHP_SELF'] == '/resume/dashboard/project_work.php') {
                                        echo "active-tab";
                                      } else {
                                        echo " ";
                                      }
                                      ?>">Project Work</a>
    <a href="edit_project_work.php" class="<?php if ($_SERVER['PHP_SELF'] == '/resume/dashboard/edit_project_work.php') {
                                              echo "active-tab";
                                            } else {
                                              echo " ";
                                            }
                                            ?>">Edit Project Work</a>
 

</div>