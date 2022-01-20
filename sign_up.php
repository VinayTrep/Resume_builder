<?php
include('includes/connect.php');
?>
<?php
if (isset($_POST['signup'])) {
    $u_name = $_POST['u_name'];
    $u_email = $_POST['u_email'];
    $u_password = $_POST['u_password'];
    $confirm_password = $_POST['confirm_password'];
    $sql1 = "SELECT u_name FROM user_login_details WHERE u_name='$u_name'";
    $result = $con->query($sql1);
    if ($result->rowCount() == 0) {
        if ($u_password == $confirm_password) {
            try {
                $sql2 = "INSERT INTO user_login_details (u_name,u_email,u_password) VALUES('$u_name','$u_email','$u_password')";
                $con->exec($sql2);
                $msg = "Your Account is Succesfully Created";
            } catch (PDOException $e) {
                $err = "Error" . $e->getMessage();
            }
        } else {
            $err = "Confirm password Doesnot Match";
        }
    } else {
        $err = "Oops! User name is already taken";
    }
}
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
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Sign up</title>
    <style>
        .bg-0F2027 {
            background-color: #0F2027;
        }

        .text-0F2027 {
            color: #0F2027;
        }

        .font-xl {
            font-size: 44px;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1 class="p-3 rounded bg-0F2027 text-white text-center">BUILD YOUR RESUME</h1>
                <div class="form">
                    <?php
                    if (!empty($msg)) {
                        echo "<div class='alert alert-success text-center'>" . $msg . "</div>";
                    }
                    if (!empty($err)) {
                        echo "<div class='alert alert-danger text-center'>" . $err . "</div>";
                    }
                    ?>
                    <h2 class="text-0F2027 text-center mt-5 font-xl">SIGN UP</h2>
                    <p class="text-center"><b>Create a account</b></p>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="TRUE">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="User name" name="u_name" value="<?php if (isset($_POST['u_name'])) echo $_POST['u_name']; ?>" required>
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your email " name="u_email" value="<?php if (isset($_POST['u_email'])) echo $_POST['u_email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Your password" name="u_password" value="<?php if (isset($_POST['u_password'])) echo $_POST['u_password']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" value="<?php if (isset($_POST['confirm_password'])) echo $_POST['confirm_password']; ?>" required>
                        </div>
                        <button type="submit" name="signup" class="btn btn-success d-block w-50 mx-auto">Sign Up</button>
                    </form>
                    <p class="text-center mt-2">Already have an account? <a href="sign_in.php" class="text-warning">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>