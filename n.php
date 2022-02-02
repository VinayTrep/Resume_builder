<?php
$name = $_GET['n'];
include('./includes/connect.php');
$sql = "SELECT id FROM user_login_details WHERE u_name='$name'";
$result = $con->query($sql);
if ($result->rowCount() > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    // fetch data from user info table 
    $sql1 = "SELECT * FROM user_info WHERE u_id = $id";
    $result1 = $con->query($sql1);
    $user_info = $result1->fetch(PDO::FETCH_ASSOC);
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
        <link rel="stylesheet" href="css/<?php echo $user_info['u_selected_css']; ?>">
        <title>resume</title>
    </head>

    <body>

        <div class="conatiner w-75 mx-auto mt-4 border">
            <div class="row">
                <div class="col-md-4">
                    <div class="p-3 secondary-background ternary-color">
                        <div class="text-center">
                            <h2><?php echo $user_info['first_name'] . " " . $user_info['last_name']; ?></h2>
                        </div>
                        <?php if (!empty($user_info['user_discription'])) { ?>
                            <p class="pt-3 text-justify"><?php echo $user_info['user_discription']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="p-3 primary-background">
                        <h6 class="ternary-color"><i class="fas fa-user-check"></i>&nbsp; PERSONAL INFO</h6>
                        <div class="pl-1 pt-2">
                            <span class="d-block"><i class="fas fa-phone"></i>&nbsp; <?php echo $user_info['user_mobile_number']; ?></span>
                            <span class="d-block"><i class="fas fa-envelope-square"></i>&nbsp; <?php echo $user_info['user_email']; ?></span>
                            <span class="d-block"><i class="fas fa-map-marker-alt"></i>&nbsp; <?php echo $user_info['user_address'] . "," . $user_info['user_state'] . "," . $user_info['user_country']; ?></span>

                        </div>
                        <!-- Professional skills  -->
                        <h6 class="ternary-color pt-3"><i class="fas fa-tools"></i>&nbsp; PROFESSIONAL SKILLS</h6>
                        <div class="pl-1 pt-2">
                            <?php
                            $sql3 = "SELECT * FROM skills_and_language WHERE u_id = $id";
                            $result3 = $con->query($sql3);
                            $lang_skills = $result3->fetch(PDO::FETCH_ASSOC);
                            $skill = explode(",", $lang_skills['skill_name']);
                            $skill_len = count($skill);
                            ?>
                            <ul>
                                <?php for ($i = 0; $i < $skill_len; $i++) { ?>
                                    <li><?php echo $skill[$i]; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- language  -->
                        <h6 class="ternary-color pt-3"><i class="fas fa-pen"></i>&nbsp; Language</h6>
                        <div class="pl-1 pt-2">
                            <?php
                            $lang = explode(",", $lang_skills['language_name']);
                            $len = count($lang);
                            ?>
                            <ul>
                                <?php for ($i = 0; $i < $len; $i++) { ?>
                                    <li><?php echo $lang[$i]; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- project works  -->
                        <h6 class="ternary-color pt-3"><i class="fas fa-laptop"></i>&nbsp; PROJECT WORK</h6>
                        <?php
                        $sql2 = "SELECT * FROM user_project_works WHERE u_id = $id ORDER BY id ASC";
                        $result2 = $con->query($sql2);
                        if ($result2->rowCount() > 0) {
                            while ($user_project = $result2->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                <p class="card-title m-0 pt-3"><a href="<?php echo $user_project['u_project_link']; ?>" class="secondary-color" target="_blank"><strong><?php echo $user_project['u_project_name']; ?></strong></a></p>
                                <small><?php echo $user_project['u_project_description']; ?></small>
                        <?php }
                        } ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="p-3">
                        <h3 class="primary-color"><i class="fas fa-briefcase secondary-color circle"></i>&nbsp; WORK EXPERIANCE</h3>
                        <div class="pt-3">
                            <?php
                            // fetch data from user experience table 
                            $sql4 = "SELECT * FROM user_experience WHERE u_id = $id";
                            $result4 = $con->query($sql4);
                            if ($result4->rowCount() > 0) {
                                while ($user_experiance = $result4->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <h5><?php echo $user_experiance['u_jobtitle']; ?></h5>
                                    <p class="card-title m-0"><?php echo $user_experiance['u_employer']; ?></p>
                                    <small class="card-title primary-color"><?php echo $user_experiance['u_job_start'] . "-" . $user_experiance['u_job_end']; ?></small>
                                    <p><?php echo $user_experiance['u_job_discription']; ?></p>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="primary-color"><i class="fas fa-graduation-cap circle"></i>&nbsp; EDUCATION ATTAINMENT</h3>
                        <!-- school info  -->
                        <?php
                        //Fetch school education details
                        $school_sql = "SELECT * FROM user_school_education WHERE u_id = $id";
                        $school_result = $con->query($school_sql);
                        $school_details = $school_result->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <h5 class="pt-3"><?php echo $school_details['u_board']; ?></h5>
                        <p class="card-title m-0"><b>School name: <?php echo $school_details['u_school_name']; ?></b> </p>
                        <small class="card-title primary-color"><b>YOP: <?php echo $school_details['u_year_of_passing']; ?></b></small>
                        <p> Marks:<strong><?php echo $school_details['u_marks']; ?>/625</strong> Percent: <strong><?php echo $school_details['u_percentage']; ?>%</strong></p>

                        <!-- puc  -->
                        <?php
                        //Fetch PUC education details
                        $pu_sql = "SELECT * FROM user_college_education WHERE u_id = $id";
                        $pu_result = $con->query($pu_sql);
                        $pu_details = $pu_result->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <h5 class="pt-3"><?php echo $pu_details['u_pu_board']; ?></h5>
                        <p class="card-title m-0"><b>College name: <?php echo $pu_details['u_college_name']; ?></b> </p>
                        <p class="card-title m-0"><b>Branch: <?php echo $pu_details['u_branch']; ?></b> </p>
                        <p class="card-title m-0"><b>Course: <?php echo $pu_details['u_course']; ?></b> </p>
                        <small class="card-title primary-color"><b>YOP: </b><?php echo $pu_details['u_yop']; ?></small>
                        <p> Marks: <strong><?php echo $pu_details['u_pu_marks']; ?>/600</strong> Percent: <strong><?php echo $pu_details['u_pu_percent']; ?>%</strong></p>

                        <!-- UG -->
                        <?php
                        //Fetch UG education details
                        $ug_sql = "SELECT * FROM user_degree WHERE u_id = $id";
                        $ug_result = $con->query($ug_sql);
                        $ug_details = $ug_result->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <h5 class="pt-3"><?php echo $ug_details['u_college_university']; ?></h5>
                        <p class="card-title m-0"><b>College name: </b><?php echo $ug_details['u_ug_name']; ?> </p>
                        <p class="card-title m-0"><b>Course: </b><?php echo $ug_details['u_ug_course']; ?> </p>
                        <small class="card-title primary-color"><b>YOP: </b> <?php echo $ug_details['u_ug_yop']; ?></small>
                        <p> CGPA: <strong>&nbsp; <?php echo $ug_details['u_ug_cgpa']; ?></strong></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>

    </html>
<?php
} else {
    echo "User Doesnot Exist";
}
?>