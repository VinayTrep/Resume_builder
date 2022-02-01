<?php
session_start();
include('./includes/connect.php');
?>
<?php
    if (isset($_POST['submit'])) {
      $u_email = $_POST['u_email'];
      $u_pass = $_POST['u_password'];
      //sql to check if the user exist
      $sql = "SELECT * FROM user_login_details WHERE u_email='$u_email' && u_password='$u_pass'";
      $result = $con->query($sql);
      $row = $result->fetch(PDO::FETCH_ASSOC);
      if ($row['u_email'] == $u_email) {
        if ($u_pass == $row['u_password']) {
          $suc="login successfull";
          $_SESSION['u_name']=$row['u_name'];
          $_SESSION['u_id']=$row['id'];
          $_SESSION['is_active']='TRUE';
          header('location:dashboard');
        } else {
          $err= "password doesn't match";
        }
      } else {
        $err= "email id doesn't exist";
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
  <title>Document</title>
  <style>
    .bg-0F2027 {
      background-color: #0F2027;
    }

    .font-xl {
      font-size: 40px;
    }

    .f-4 {
      font-size: 20px;
    }
    span{
      color: black;
    }
    a {
      color: yellow;
      opacity: 0.6;
    }

    a:hover {
      color: yellow;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <h1 class="bg-0F2027 text-white text-center p-3 rounded ">BUILD YOUR RESUME</h1>
        <?php
        if (!empty($suc)) {
          echo "<div class='alert alert-success text-center'>".$suc."</div>";
        }
        if (!empty($err)){
          echo "<div class='alert alert-danger text-center'>".$err."</div>";
        }
         ?>
          <h2 class="text-center  mt-5 font-xl">SIGN IN</h2>
        <h5 class="text-center mt-1">Log in to your account</h5>
        <div class="form">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group mt-3">
              <input type="email" class="form-control" placeholder="Enter email" name="u_email" value="<?php if (isset($_POST['u_email'])) echo $_POST['u_email']; ?>" required>
            </div>
            <div class="form-group mt-3">
              <input type="password" class="form-control" placeholder="Enter password" name="u_password" value="<?php if (isset($_POST['u_password'])) echo $_POST['u_password']; ?>" required>
            </div>
            <button name="submit" type="submit" class="btn d-block bg-success w-50 mx-auto text-white mt-4">Sign in</button>
          </form>
          <h6 class="text-center mt-4"><a href="reset.php"><span>I forgot my password</span></a></h6>
          <div class="mt-3 text-center f-4 c-warning">Don't have an account? <a href="sign_up.php">Sign Up</a></div>
        </div>
      </div>
    </div>
    
</body>

</html>