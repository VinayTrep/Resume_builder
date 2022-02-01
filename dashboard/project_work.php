<?php
session_start();
include('../includes/connect.php');
$name = $_SESSION['u_name'];
$u_id = $_SESSION['u_id'];
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
   <title>Project Work</title>
   <style>
      #showdiv {
         display: none;
      }
   </style>
</head>

<body>
   <?php
   include('../dashboard/includes/sidebar.php');
   ?>
   <?php
   if (isset($_POST['submit'])) {
      try {
         $project = $con->prepare("INSERT INTO  user_project_works (u_id,u_project_name,u_project_link,u_project_description) VALUES 
        (:u_id,:u_project_name,:u_project_link,:u_project_description)");
         $project->bindParam(':u_id', $u_id);
         $project->bindParam(':u_project_name', $_POST['u_project_name']);
         $project->bindParam(':u_project_link', $_POST['u_project_link']);
         $project->bindParam(':u_project_description', $_POST['u_project_description']);
         $project->execute();
         $msg = "Inserted Succesufully";
      } catch (PDOException $e) {
         $err = "Error" . $e->getMessage();
      }
   }
   ?>
   <div class="main">
      <div class="my-4">
         <div class="row">
            <div class="col-md-6 text-center">
               <?php
               $msg= isset($_GET['msg'])? $_GET['msg']:'';
               if (isset($msg)  && !empty($msg)) {
                  echo "<span class='alert alert-success'>" . $msg . "</span>";
               }
               if (isset($err)) {
                  echo "<span class='alert alert-danger'>" . $err . "</span>";
               }
               ?>
            </div>
            <div class="col-md-6 text-right">
               <span class="text-blue py-3 px-4 rounded text-white">RESUME BUILDER</span>
               <a href="logout.php" class="text-blue px-4 py-3 text-white rounded">
                  Logout &nbsp; <i class="fas fa-sign-out-alt"></i>
               </a>
            </div>
         </div>
      </div>
      <div class="container">
         <?php
         $sql = "SELECT * from user_project_works Where u_id = $u_id";
         $result = $con->query($sql);
         if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
               <!-- already exiting data -->
               <div class="container-fluid my-3">
                  <div class="row border p-3 align-items-center bg-light">
                     <div class="col-md-8">
                        <p class="mb-0"><?php echo $row['u_project_name']; ?></p>
                     </div>
                     <div class="col-md-4 text-right">
                        <a href="edit_project_work?id=<?php print $row['id']; ?>"><i class="fas fa-edit px-2 text-dark"></i></a>
                        <a href="delete_project_work.php?id=<?php print $row['id']; ?>"><i class="fas fa-trash-alt px-2 text-dark"></i></a>
                     </div>
                  </div>
               </div>
         <?php }
         }
         ?>
         <div class="row">
            <div class="col-md-6 text-right"><button class="btn btn-warning" onclick="show()">Add Experiance</button></div>
            <div class="col-md-6 text-right"><a href="preview.php" class="btn btn-success px-4">Next</a></div>
         </div>
         <form id="showdiv" method="POST" action="<?php print $_SERVER['PHP_SELF']; ?>">
            <h3 class="my-4">Project Works</h3>
            <div class="form-group">
               <label>Project Name</label>
               <input type="text" class="form-control" placeholder="project name" name="u_project_name">
            </div>
            <div class="form-group">
               <label>Project URL</label>
               <input type="text" class="form-control" placeholder="Eg: git link, website link" name="u_project_link">
            </div>
            <div class="py-4">
               <label for="">Project discription</label>
               <textarea name="u_project_description"></textarea>
            </div>
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
   <script>
      function show() {
         x = document.getElementById('showdiv');
         if (x.style.display === 'none') {
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