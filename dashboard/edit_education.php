<?php
session_start();
include('../includes/connect.php');
$u_id = $_SESSION['u_id'];
$u_name = $_SESSION['u_name'];
if (empty($_SESSION['u_name'])) {
    header('LOCATION:../sign_in.php');
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="Enter your description here" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <title>EDIT Education</title>
    </head>

    <body>
        <?php
        include('../dashboard/includes/sidebar.php');
        ?>
        <?php
        if (isset($_POST['submit'])) {
            try {
                //   query to insert data into school education table 
                $school = $con->prepare("UPDATE user_school_education SET u_id=:u_id,u_school_name=:u_school_name,u_board=:u_board,u_year_of_passing=:u_year_of_passing,u_percentage=:u_percentage,u_marks=:u_marks WHERE u_id = $u_id");
                $school->bindParam(':u_id', $u_id);
                $school->bindParam(':u_school_name', $_POST['u_school_name']);
                $school->bindParam(':u_board', $_POST['u_board']);
                $school->bindParam(':u_year_of_passing', $_POST['u_year_of_passing']);
                $school->bindParam('u_percentage', $_POST['u_percentage']);
                $school->bindParam('u_marks', $_POST['u_marks']);

                //   query to insert data into college education table 
                $college = $con->prepare("UPDATE user_college_education SET u_id=:u_id,u_college_name=:u_college_name,u_pu_percent=:u_pu_percent,u_pu_marks=:u_pu_marks,u_pu_board=:u_pu_board,u_yop=:u_yop,u_branch=:u_branch,u_course=:u_course");
                $college->bindParam(':u_id', $u_id);
                $college->bindParam(':u_college_name', $_POST['u_college_name']);
                $college->bindParam(':u_pu_percent', $_POST['u_pu_percent']);
                $college->bindParam(':u_pu_marks', $_POST['u_pu_marks']);
                $college->bindParam(':u_pu_board', $_POST['u_pu_board']);
                $college->bindParam(':u_yop', $_POST['u_yop']);
                $college->bindParam(':u_branch', $_POST['u_branch']);
                $college->bindParam(':u_course', $_POST['u_course']);

                //   query to insert data into UG education table 
                $ug = $con->prepare("UPDATE user_degree SET u_id=:u_id,u_ug_name=:u_ug_name,u_college_university=:u_college_university,u_ug_course=:u_ug_course,u_ug_cgpa=:u_ug_cgpa,u_ug_yop=:u_ug_yop");
                $ug->bindParam(':u_id', $u_id);
                $ug->bindParam(':u_ug_name', $_POST['u_ug_name']);
                $ug->bindParam(':u_college_university', $_POST['u_college_university']);
                $ug->bindParam(':u_ug_course', $_POST['u_ug_course']);
                $ug->bindParam(':u_ug_cgpa', $_POST['u_ug_cgpa']);
                $ug->bindParam(':u_ug_yop', $_POST['u_ug_yop']);

                $school->execute();
                $college->execute();
                $ug->execute();
                $msg = "Updated succesfully";
            } catch (PDOException $e) {
                $err = "Error:" . $e->getMessage();
            }
        }
        ?>
        <div class="main">
            <div class="my-4">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <?php
                        if (isset($msg)) {
                            echo "<span class='alert alert-success'>" . $msg . "</span>";
                        }
                        if (isset($err)) {
                            echo "<span class='alert alert-danger'>" . $err . "<a href='#'>edit</a></span>";
                        }
                        ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <span class="text-blue py-3 px-4 rounded text-white">RESUME BUILDER</span>
                        <a href="logout.php" class="text-blue px-4 py-3 text-white rounded">
                            Logout &nbsp; <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- fetch data from school education table  -->
            <?php
            $school_edu = "SELECT * from user_school_education where u_id=$u_id ";
            $result1 = $con->query($school_edu);
            $row_school = $result1->fetch(PDO::FETCH_ASSOC);
            ?>
            <!-- School Education  -->
            <div class="container">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h3>Edit School Education</h3>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>School Name</label>
                                <input type="text" class="form-control" placeholder="Enter school name" name="u_school_name" value="<?php print $row_school['u_school_name']; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>School Board</label>
                                <input type="text" class="form-control" placeholder="Enter school Board" name="u_board" value="<?php print $row_school['u_board']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Marks</label>
                                <input type="text" class="form-control" placeholder="Enter Scored marks" name="u_marks" value="<?php print $row_school['u_marks']; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Percentage</label>
                                <input type="text" class="form-control" placeholder="Enter obtained percentage" name="u_percentage" value="<?php print $row_school['u_percentage']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Year of passing</label>
                        <input type="date" class="form-control" name="u_year_of_passing" value="<?php print $row_school['u_year_of_passing']; ?>">
                    </div>
                    <!-- fetch data from Pu education table  -->
                    <?php
                    $pu_edu = "SELECT * from user_college_education where u_id=$u_id ";
                    $result2 = $con->query($pu_edu);
                    $row_pu = $result2->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <!-- PUC education  -->
                    <h3 class="pt-3">Edit PUC Education</h3>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>College Name</label>
                                <input type="text" class="form-control" placeholder="Enter PU college name" name="u_college_name" value="<?php print $row_pu['u_college_name']; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>College Board</label>
                                <input type="text" class="form-control" placeholder="Enter PU college Board" name="u_pu_board" value="<?php print $row_pu['u_pu_board']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Marks</label>
                                <input type="text" class="form-control" placeholder="Enter Scored marks" name="u_pu_marks" value="<?php print $row_pu['u_pu_marks']; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Percentage</label>
                                <input type="text" class="form-control" placeholder="Enter obtained percentage" name="u_pu_percent" value="<?php print $row_pu['u_pu_percent']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Branch of Study</label>
                                <input type="text" class="form-control" placeholder="Eg. Science,Commerce,Arts" name="u_branch" value="<?php print $row_pu['u_branch']; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Cource</label>
                                <input type="text" class="form-control" placeholder="Eg: PCMB,CEBA...." name="u_course" value="<?php print $row_pu['u_course']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Year of passing</label>
                        <input type="date" class="form-control" name="u_yop" value="<?php print $row_pu['u_yop']; ?>">
                    </div>
                    <!-- fetch data from Pu education table  -->
                    <?php
                    $ug_edu = "SELECT * from user_degree where u_id=$u_id ";
                    $result3 = $con->query($ug_edu);
                    $row_ug = $result3->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <!-- Degree college education  -->
                    <div class="container">
                        <form>
                            <h3 class="pt-3">Edit Under Graduation</h3>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>College Name</label>
                                        <input type="text" class="form-control" placeholder="Enter College name" name="u_ug_name" value="<?php print $row_ug['u_ug_name']; ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>College University</label>
                                        <input type="text" class="form-control" placeholder="Enter college university" name="u_college_university" value="<?php print $row_ug['u_college_university']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>UG Course</label>
                                        <input type="text" class="form-control" placeholder="Eg: B.com,BCA,BBA..." name="u_ug_course" value="<?php print $row_ug['u_ug_course']; ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Enter CGPA</label>
                                        <input type="text" class="form-control" placeholder="Enter obtained CGPA" name="u_ug_cgpa" value="<?php print $row_ug['u_ug_cgpa']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Year of passing</label>
                                <input type="date" class="form-control" name="u_ug_yop" value="<?php print $row_ug['u_ug_yop']; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <a href="skills.php" class="btn btn-primary">Next</a>
                        </form>
                    </div>
            </div>
            <?php
            include('../dashboard/includes/endsidebar.php');
            ?>
    </body>

    </html>
<?php
}
?>