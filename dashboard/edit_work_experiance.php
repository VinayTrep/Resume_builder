<?php
session_start();
include('../includes/connect.php');
$u_id = $_SESSION['u_id'];
$id = isset($_GET['id'])? $_GET['id']: '';
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
   <link rel="stylesheet" href="../dashboard/assets/sidebar.css">
   <script src="//cdn.ckeditor.com/4.17.1/basic/ckeditor.js"></script>
   <title>Edit Work Expreance</title>
</head>

<body>
   <?php
   if (isset($_POST['submit'])) {
         $u_employer= $_POST['u_employer'];
         $u_jobtitle=$_POST['u_jobtitle'];
         $u_job_start=$_POST['u_job_start'];
         $u_job_end=$_POST['u_job_end'];
         $job_discription=$_POST['job_discription'];
         $work = "UPDATE user_experience SET u_id=$u_id,u_employer='$u_employer',u_jobtitle='$u_jobtitle',u_job_start='$u_job_start',u_job_end='$u_job_end',u_job_discription='$job_discription' WHERE id=$id";
         $smtp=$con->prepare($work);
         $smtp->execute();
         $msg = "Updated successfully";
         header('location:work_experiance.php?msg='.$msg);
      }
   ?>
   <?php
   include('../dashboard/includes/sidebar.php');
   ?>
   <div class="main">
      <div class="my-4 text-right">
         <span class="text-blue py-3 px-4 rounded text-white">RESUME BUILDER</span>
         <a href="logout.php" class="text-blue px-4 py-3 text-white rounded">
            Logout &nbsp; <i class="fas fa-sign-out-alt"></i>
         </a>
      </div>
      <?php
      if (isset($msg)) {
         echo "<span class='alert alert-success text-center d-block'>" . $msg . "</span>";
      }
      if (isset($err)) {
         echo "<span class='alert alert-danger text-center d-block'>" . $err . "</span>";
      }
      ?>
      <!-- already exiting data -->
      <div class="container-fluid my-3">

      </div>
      <div class="row">
         <div class="col-md-6 text-right"><a href="education.php" class="btn btn-success px-4">Next</a></div>
      </div>
        <?php
      
      $sql="SELECT * FROM user_experience WHERE id=$id";
      $result=$con->query($sql);
      $row=$result->fetch(PDO::FETCH_ASSOC);
      ?>
      <!-- form to accept new experience  -->
      <div class="container-fluid">
         <h3>EDIT EXPERIENCE</h3>
         <p class="text-muted">List your work experience, from the most recent to the oldest.</p>
         <form class="col-md-8" method="POST">
            <!-- <?php echo $_SERVER['PHP_SELF']; ?> -->
            <div class="row">
               <div class="form-group col">
                  <label for="employer">Employer</label>
                  <input type="text" class="form-control" id="employer" name="u_employer" value="<?php  print $row['u_employer']; ?>">
               </div>
               <div class="form-group col">
                  <label for="job_title">Job Title</label>
                  <input type="text" class="form-control" id="job_title" name="u_jobtitle" value="<?php  print $row['u_jobtitle']; ?>">
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label for="start_date">Start Date</label>
                  <div class="">
                     <input type="month" name="u_job_start" id="month" value="<?php  print $row['u_job_start']; ?>">
                  </div>
               </div>
               <div class="col-md-6">
                  <label for="end_date">End Date</label>
                  <div class="">
                     <input type="month" name="u_job_end" id="month" value="<?php  print $row['u_job_end']; ?>">
                  </div>
               </div>
            </div>
            <div class="py-4">
               <label for="">Job Description</label>
               <textarea name="job_discription"><?php print $row['u_job_discription'];?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6"><input type="submit" value="Submit" name="submit"></div>
               <div class="col-md-6"><a href="index.php" class="btn text-dark border">Back</a></div>
            </div>
         </form>
      </div>
   </div>

   <?php
   include('../dashboard/includes/endsidebar.php');
   ?>
   <script>
      CKEDITOR.replace('job_discription');
   </script>
</body>

</html>
<?php }
?>