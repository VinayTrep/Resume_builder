<?php
session_start();
include('../includes/connect.php');
$name = $_SESSION['u_name'];
$u_id = $_SESSION['u_id'];
$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($_SESSION['u_name'])) {
   header('LOCATION:../sign_in.php');
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
      <script src="//cdn.ckeditor.com/4.17.1/basic/ckeditor.js"></script>
      <title> EDIT Project Work</title>
   </head>

   <body>
      <?php
      include('../dashboard/includes/sidebar.php');
      ?>
      <?php
      if (isset($_POST['submit'])) {
         $id = $_GET['id'];
         $u_project_name = $_POST['u_project_name'];
         $u_project_link = $_POST['u_project_link'];
         $u_project_description = $_POST['u_project_description'];

         $project = "UPDATE user_project_works SET u_id=$u_id,u_project_name='$u_project_name',u_project_link='$u_project_link',u_project_description='$u_project_description' Where id = $id";

         $stmp = $con->prepare($project);
         $stmp->execute();
         $msg = "Updated Succesufully";
         header('location:project_work.php?msg='.$msg);
      } else {
         $err = "something went wrong";
      }
      ?>
      <div class="main">
         <div class="my-4">
            <div class="row">
               <div class="col-md-6 text-center">
               </div>
               <div class="col-md-6 text-right">
                  <span class="text-blue py-3 px-4 rounded text-white"><a href="../index.php" class="text-white">RESUME BUILDER</a></span>
                  <a href="logout.php" class="text-blue px-4 py-3 text-white rounded">
                     Logout &nbsp; <i class="fas fa-sign-out-alt"></i>
                  </a>
               </div>
            </div>
         </div>
         <div class="container">
            <form id="showdiv" method="POST">
               <h3 class="my-4">Edit project works</h3>
               <!-- fetch data to edit  -->
               <?php
               $sql = "SELECT * FROM user_project_works WHERE id=$id";
               $result = $con->query($sql);
               $row = $result->fetch(PDO::FETCH_ASSOC);
               ?>
               <div class="form-group">
                  <label>Project Name</label>
                  <input type="text" class="form-control" placeholder="project name" name="u_project_name" value="<?php echo $row['u_project_name']; ?>">
               </div>
               <div class="form-group">
                  <label>Project URL</label>
                  <input type="text" class="form-control" placeholder="Eg: git link, website link" name="u_project_link" value="<?php echo $row['u_project_link']; ?>">
               </div>
               <div class="py-4">
                  <label for="">Project discription</label>
                  <textarea name="u_project_description"><?php echo $row['u_project_description']; ?></textarea>
               </div>
               <a href="project_work.php" class="btn btn-success px-4">Back</a>
               <button type="submit" class="btn btn-primary" name="submit">Submit</button>
               
            </form>
         </div>
      </div>


      <?php
      include('../dashboard/includes/endsidebar.php');
      ?>
      <script>
         CKEDITOR.replace('u_project_description');
      </script>
   </body>

   </html>
<?php
}
?>