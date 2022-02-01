<?php
session_start();
include('../includes/connect.php');
$u_id = $_SESSION['u_id'];
if (empty($_SESSION['u_id'])) {
   header('location:../sign_in.php');
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
    <link rel="stylesheet" href="assets/css/style.css">
    <title>link
    </title>
    <style>
        .mt-5 {
            margin-top: 190px;
            margin-left: 100px;
        }

        .mt-7 {
            margin-top: 190px;
            margin-left: 100px;
        }
    </style>
</head>

<body>
    <?php 
    $link="SELECT u_name FROM user_login_details WHERE id=$u_id";
    $result=$con->query($link);
    $row=$result->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="alert alert-success text-center">YOU HAVE SUCCESSFULLY CREATED YOUR RESUME</div>
    <div class="container w-50 mx-auto">
        <!-- The text field -->
        <div class="form-group">
        <label for="myInput">Copy the URL to ur Resume</label>
        <input type="text" value="<?php echo $_SERVER['HTTP_HOST']."/resume/".$row['u_name']; ?>" id="myInput" class="form-control">
        </div>
        <a href="preview.php" class="btn btn-primary">Prevoius Page</a>

        <!-- The button used to copy the text -->
        <button onclick="myFunction()" class="btn btn-primary">Copy text</button>
        <a href="logout.php" class="btn btn-primary">Back to HOME</a>
    </div>
    <script>
        function myFunction() {
            /* Get the text field */
            var copyText = document.getElementById("myInput");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

        }
    </script>
</body>

</html>
<?php }
?>