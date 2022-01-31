<?php 
session_start();
include('../includes/connect.php');
   $u_name=$_SESSION['u_name'];
   $u_id=$_SESSION['u_id'];
   if(empty($_SESSION['u_name'])){
      header('location:../sign_in.php');
   }else{
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
   if(isset($_POST['submit'])){
      $skill=$_POST['skill'];
      echo $skill;
      try{
         $skills = $con->prepare("UPDATE skills_and_language SET skill_name='$skill' WHERE $u_id=u_id");   
          $skills->execute();
      }catch(PDOException $e){
         $err = "error: " . $e->getMessage();
      }
   }
   ?>
   <?php
   include('../dashboard/includes/sidebar.php');
   ?>
   <div class="main">
     <div class="my-4 text-right">
<?php echo $_SERVER['PHP_SELF'];
?>
         <span class="text-blue py-3 px-4 rounded text-white">RESUME BUILDER</span>
         <a href="logout.php" class="text-blue px-4 py-3 text-white rounded">
            Logout &nbsp; <i class="fas fa-sign-out-alt"></i>
         </a>
      </div>
      <h1>Skills</h1>
      <p>highlight 6-8 of your top Skills</p>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
         <div class="form-group align-items-center">
            <label for="skills"><b></b></label>
            <input type="text" class="w-50 border border-dark form-control" id="language" name="skill">
         </div>
         <div class="row mt-6">
            <div class="col-2 text-center">
               <input class="p-3 rounded bg-success" type="submit" name="submit" value="submit">
            </div>
            <div class="col-7 text-center">
               <a href="" class="p-3  text-dark  rounded bg-success d-inline-block">Save and Next</a>
            </div>
         </div>
      </form>
   </div>
   <?php
   include('../dashboard/includes/endsidebar.php');
   ?>
</body>
</html>
<?php   }
?>