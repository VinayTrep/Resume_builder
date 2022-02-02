<?php
session_start();
include('../includes/connect.php');
$name = $_SESSION['u_name'];
$u_id = $_SESSION['u_id'];
if (empty($_SESSION['u_name'])) {
    header('LOCATION:../sign_in.php');
} else {
    $sql = "SELECT * from user_info where u_id=$u_id";
    $result = $con->query($sql);
    if ($result->rowCount() == 1) {
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <script src="//cdn.ckeditor.com/4.17.1/basic/ckeditor.js"></script>
            <title>EDIT PERSONAL INFO</title>
            <style>
                .text-blue {
                    background-color: #0F2027;
                }
            </style>
        </head>

        <body>
            <?php
            include("includes/sidebar.php");
            ?>
            <!-- code to update data into user_info table  -->
            <?php
            if (isset($_POST['submit'])) {
                    try {
                        $user_info = $con->prepare("UPDATE user_info SET u_id=:u_id,first_name=:first_name,last_name=:last_name,user_email=:user_email,user_state=:user_state,user_country=:user_country,user_address=:user_address,user_mobile_number=:user_mobile_number,user_discription=:user_discription WHERE u_id=$u_id");

                        $user_info->bindParam(':u_id', $u_id);
                        $user_info->bindParam(':first_name', $_POST['firstname']);
                        $user_info->bindParam(':last_name', $_POST['lastname']);
                        $user_info->bindParam(':user_email', $_POST['e_mail']);
                        $user_info->bindParam(':user_state', $_POST['state']);
                        $user_info->bindParam(':user_country', $_POST['country']);
                        $user_info->bindParam(':user_address', $_POST['address']);
                        $user_info->bindParam(':user_mobile_number', $_POST['mobile_number']);
                        $user_info->bindParam(':user_discription', $_POST['user_discription']);

                        $user_info->execute();
                        $msg = "successfully Updated";
                    }catch (PDOException $e) {
                        $err = "error: " . $e->getMessage();
                    }
                } 
            ?>
            <div class="main">
                <!-- <?php
                        echo $name;
                        ?> -->
                <div class="my-4">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <!-- display success and error message  -->
                            <?php
                            if (isset($msg)) {
                                echo "<span class='alert alert-success'>" . $msg . "</span>";
                            }
                            if (isset($err)) {
                                echo "<span class='alert alert-danger'>" . $err . "   <a href='edit_personal_info.php'>edit</a></span>";
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
                <!-- code to fetch existing data from the user_info table  -->
                <?php
                $sql1= "SELECT * FROM user_info WHERE u_id=$u_id";
                $result1=$con->query($sql1);
                $row=$result1->fetch(PDO::FETCH_ASSOC);
                ?>
                <!-- end  -->
                <h3>EDIT PERSONAL INFO</h3>
                <p class="text-muted">Employers will use this information to contact you.</p>
                <form class="col-md-8" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="row">
                        <div class="form-group col">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php print $row['first_name'];?>" required>
                        </div>
                        <div class="form-group col">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php print $row['last_name'];?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" size="50" value="<?php print $row['user_address'];?>" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control" size="20" value="<?php print $row['user_state'];?>" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" class="form-control" size="20" value="<?php print $row['user_country'];?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="e_mail">E-mail address</label>
                            <input type="email" name="e_mail" id="e_mail" class="form-control" size="50" value="<?php print $row['user_email'];?>" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="mobile_number">Phone no</label>
                            <input type="text" name="mobile_number" id="mobile_number" class="form-control" size="10" value="<?php print $row['user_mobile_number'];?>" required>
                        </div>
                    </div>
                    <div class="py-4">
                        <label for="">About Yourself (in less than 50 words)</label>
                        <textarea name="user_discription"><?php print $row['user_discription'];?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <a href="work_experiance.php" class="btn btn-primary">Next</a>
                </form>
            </div>

            <?php
            include("includes/endsidebar.php");
            ?>
            <script>
                CKEDITOR.replace('user_discription');
            </script>
        </body>

        </html>
<?php
    } else {
        header('location:edit_personal_info.php');
    }
}
?>