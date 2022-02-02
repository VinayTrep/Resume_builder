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
      <link rel="stylesheet" href="../dashboard/assets/sidebar.css">
      <title>Preview</title>
      <style>
         * {
            box-sizing: border-box;
         }

         .col-6 {
            position: relative;
         }

         .ps {
            position: absolute;
            top: 10;
            left: 0;
         }
      </style>
   </head>

   <body>
      <?php
      if (isset($_POST['submit'])) {
         $value = $_POST['css_name'];
         try {
            $css = $con->prepare("UPDATE user_info SET u_selected_css='$value' WHERE u_id=$u_id");
            $css->execute();
            $msg = "CSS UPDATED SUCCESSFULLY";
         } catch (PDOException $e) {
            $err = "error" . $e->getMessage();
         }
      }
      ?>
      <?php
      include('../dashboard/includes/sidebar.php');
      ?>
      <div class="main">
         <?php
         if (isset($msg)) {
            echo "<span class='alert alert-success text-center d-block '>" . $msg . "</span>";
         }
         if (isset($err)) {
            echo "<span class='alert alert-danger text-center d-block'>" . $err . "   <a href='edit_personal_info.php'>edit</a></span>";
         }
         ?>
         <div class="container-fluid ">
            <form action="" method="POST">
               <div class="row">
               <div class="col-3 text-center p-0 m-0">
                        <label for="radio1">
                           <img src="../images/work3.png" style="cursor: pointer;" width="100%;">
                           <input id="radio1" type="radio" name="css_name" value="css1.css">
                        </label>
                     </div>
                     <div class="col-3 text-center m-0 p-0">
                        <label for="radio2">
                           <img src="../images/work4.png" style="cursor: pointer;" width="100%;">
                           <input id="radio2" type="radio" name="css_name" value="css2.css">
                        </label>
                     </div>
                  <div class="col-3 text-center p-0 m-0">
                     <label for="radio3">
                        <img src="../images/main1.jpg" style="cursor: pointer;" width="100%;">
                        <input id="radio3" type="radio" name="css_name" value="css4.css">
                     </label>
                     </div>
                     <div class="col-3 text-center p-0 m-0">
                        <label for="radio4">
                           <img src="../images/work2.png" style="cursor: pointer;" width="100%;">
                           <input id="radio4" type="radio" name="css_name" value="css3.css">
                        </label>
                     </div>
                     
                     
                  <input type="submit" class="text-white border rounded bg-primary p-2 m-2" name="submit">
            </form>
            <a href="link.php" class="text-white border rounded bg-primary p-2 m-2" >Next</a>
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