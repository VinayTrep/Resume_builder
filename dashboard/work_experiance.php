<?php
session_start();
include('../includes/connect.php');
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <script src="//cdn.ckeditor.com/4.17.1/basic/ckeditor.js"></script>
      <title>Work Experience</title>
      <style>
         #showdiv {
            display: none;
         }
      </style>
   </head>

   <body>
      <?php
      if (isset($_POST['submit'])) {
         try {
            $work = $con->prepare("INSERT INTO user_experience (u_id,u_employer,u_jobtitle,u_job_start,u_job_end,u_job_discription) VALUES(:u_id,:u_employer,:u_jobtitle,:u_job_start,:u_job_end,:job_discription)");
            $work->bindParam(':u_id', $u_id);
            $work->bindParam(':u_employer', $_POST['u_employer']);
            $work->bindparam(':u_jobtitle', $_POST['u_jobtitle']);
            $work->bindparam(':u_job_start', $_POST['u_job_start']);
            $work->bindparam(':u_job_end', $_POST['u_job_end']);
            $work->bindparam(':job_discription', $_POST['job_discription']);
            $work->execute();
            $msg = "Inserted successfully";
         } catch (PDOException $e) {
            $err = "error" . $e->getmessage();
         }
      }
      ?>
      <?php
      include('../dashboard/includes/sidebar.php');
      ?>
      <div class="main">
         <div class="my-4 text-right">
            <span class="text-blue py-3 px-4 rounded text-white">
               <a href="../index.php" class="text-white">RESUME BUILDER</a></span>
            <a href="logout.php" class="text-blue px-4 py-3 text-white rounded">
               Logout &nbsp; <i class="fas fa-sign-out-alt"></i>
            </a>
         </div>
         <?php
         $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
         if (isset($msg) && !empty($msg)) {
            echo "<span class='alert alert-success text-center d-block'>" . $msg . "</span>";
         }
         if (isset($err)) {
            echo "<span class='alert alert-success text-center d-block'>" . $err . "</span>";
         }
         ?>
         <!-- already exiting data -->
         <div class="container-fluid my-3">
            <?php
            $sql = "SELECT * FROM user_experience WHERE u_id=$u_id";
            $result = $con->query($sql);
            if ($result->rowCount() > 0) {
               while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                  <div class="row border p-3 align-items-center bg-light mt-2">
                     <div class="col-md-8">
                        <p class="mb-0"><?php print $row['u_jobtitle']; ?></p>
                     </div>
                     <div class="col-md-4 text-right">
                        <a href="edit_work_experiance.php?id=<?php print $row['id']; ?>"><i class="fas fa-edit px-2 text-dark"></i></a>
                        <a href="delete_work_experience.php?id=<?php print $row['id']; ?>"><i class="fas fa-trash-alt px-2 text-dark"></i></a>
                     </div>
                  </div>
            <?php }
            }
            ?>
         </div>
         <div class="row">
            <div class="col-md-4 text-center"><a href="index.php" class="btn btn-success px-4">Back</a></div>

            <div class="col-md-4 text-center"><button onclick="show()" class="btn btn-warning">Add Experiance</button></div>
            <div class="col-md-4 text-center"><a href="education.php" class="btn btn-success px-4">next</a></div>
         </div>
         <!-- form to accept new experience  -->
         <div class="container-fluid" id="showdiv">
            <h3>EXPERIENCE</h3>
            <p class="text-muted">List your work experience, from the most recent to the oldest.</p>
            <form class="col-md-8" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
               <!-- <?php echo $_SERVER['PHP_SELF']; ?> -->
               <div class="">
                  <div class="form-group col">
                     <label for="employer">Employer</label>
                     <input type="text" class="form-control" id="employer" name="u_employer">
                  </div>
                  <div class="form-group col">
                     <label for="job_title">Job Title</label>
                     <input type="text" class="form-control" id="job_title" name="u_jobtitle">
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <label for="start_date">Start Date</label>
                     <div class="">
                        <input type="month" name="u_job_start" id="month">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label for="end_date">End Date</label>
                     <div class="">
                        <input type="month" name="u_job_end" id="month">
                     </div>
                  </div>
               </div>
               <div class="py-4">
                  <label for="">Job Description</label>
                  <textarea name="job_discription"></textarea>
               </div>
               <div class="row">
                  <div class="col-md-6"><a href="index.php" class="btn text-dark border">Back</a></div>
                  <div class="col-md-6"><button type="submit" class="btn btn-primary mx-auto" name="submit">Submit</button></div>
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
      <script>
         function show() {
            x = document.getElementById('showdiv');
            if (x.style.display === "none") {
               x.style.display = "block";
            } else {
               x.style.display = "none";
            }
         }
      </script>
   </body>

   </html>
<?php
}
?>