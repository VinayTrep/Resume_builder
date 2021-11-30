<?php
include('./includes/connect.php');
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
  <title>document</title>
  <style>
    .bg-0F2027 {
      background-color: #0F2027;
    }

    .mt-7 {
      margin-top: 70px;
    }

    p {
      font-size: 21px;
    }

    b {
      position: absolute;
      top: 170px;
      left: 30px;
      margin-top: 30px;
    }
  </style>
</head>

<body>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <h1 class="bg-0F2027 text-white text-center p-3 rounded ">BUILD YOUR RESUME</h1>
        <h2 class="text-center  mt-7 font-xl">RESET YOUR PASSWORD</h2>
        <b>Enter your email address</b>
        <br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <input type="email" class="form-control rounded mt-4" placeholder="Enter email" name="u_email" required>
          <button type="submit" name="submit" class="text-center bg-success rounded text-white p-2 d-block mx-auto w-50 mt-5 ">send password</button>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $email = $_POST['u_email'];
          $sql = "SELECT * FROM user_login_details WHERE u_email='$email'";
          $result = $con->query($sql);
          if ($result->rowCount() != 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            // mail function
            $to = $email;
            $subject = "Forgot Password";
            $txt = "Your password is".$row['u_password'];
            $headers = "From: vinayljtrep@gmail.com" . "\r\n";
            if(mail($to, $subject, $txt, $headers)){
              echo "Check your email";
            }else{
              echo "Something went wrong";
            }
          } else {
            echo "invalid email";
          }
        }
        ?>
      </div>
    </div>
  </div>
</body>

</html>