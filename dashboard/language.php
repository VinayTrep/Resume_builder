<?php
session_start();
include('../includes/connect.php');
$u_name = $_SESSION['u_name'];
$u_id = $_SESSION['u_id'];
if (empty($_SESSION['u_name'])) {
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
      <title>Language</title>
      <style>
         .w-80 {
            width: 99%;
            padding: 4px;
         }

         .mt-6 {
            margin-top: 100px;
         }

         button {
            box-shadow: -4px 3px 30px -2px rgba(0, 0, 0, 0.36);
            -webkit-box-shadow: -4px 3px 30px -2px rgba(0, 0, 0, 0.36);
            -moz-box-shadow: -4px 3px 30px -2px rgba(0, 0, 0, 0.36);
         }

         .text-mark {
            color: #2EBE6E;
         }
      </style>
   </head>

   <body>
      <?php
      if (isset($_POST['submit'])) {
         $lang = $_POST['language'];
         try {
            $language = $con->prepare("UPDATE skills_and_language SET language_name='$lang' WHERE $u_id=u_id");
            $language->execute();
            $msg = "Data Updated Successfully";
         } catch (PDOException $e) {
            $err = "error: " . $e->getMessage();
         }
      }
      ?>
      <?php

      include('../dashboard/includes/sidebar.php');
      ?>
      <?php
      if (isset($msg)) {
         echo "<span class='alert alert-success d-block text-center'>" . $msg . "</span>";
      }
      if (isset($err)) {
         echo "<span class='alert alert-danger d-block text-center'>" . $err . "</span>";
      }
      ?>
      <!-- fetching the data from the skills and language -->
      <?php
      $lang1 = "SELECT * FROM skills_and_language WHERE u_id=$u_id";
      $result = $con->query($lang1);
      $row = $result->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="main">
         <div class="my-4 text-right">

            <span class="text-blue py-3 px-4 rounded text-white">
               <a href="../index.php" class="text-white">RESUME BUILDER</a></span>
            <a href="logout.php" class="text-blue px-4 py-3 text-white rounded">
               Logout &nbsp; <i class="fas fa-sign-out-alt"></i>
            </a>
         </div>
         <h1>Language</h1>
         <p>highlight 6-8 of your top language</p>
         <p>use comma while writing your skills</p>
         <form action="" method="POST">
            <div class="form-group align-items-center">
               <label><b></b></label>
               <input type="text" class="w-50 border border-dark form-control" id="language" name="language" placeholder="eg:- kannada,english,hindi" value="<?php echo $row['language_name']; ?>">
            </div>
            <div class="row mt-6 justify-content-center align-items-center">
               <div class="col-md-4 text-center"><a href="skills.php" class="btn btn-success px-4">Back</a>
               </div>
               <div class="col-md-4">
                  <input class="btn btn-primary" type="submit" name="submit" value="submit">
               </div>
               <div class="col-md-4">
                  <a href="project_work.php" class="btn btn-success">Next</a>
               </div>
            </div>
         </form>

      </div>
      <?php
      include('../dashboard/includes/endsidebar.php');
      ?>
   </body>

   </html>
<?php
}
?>