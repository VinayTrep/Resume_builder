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
   <title>Review</title>
   <style>
      *{
         box-sizing: border-box;
      }
      .col-6{
         position: relative;
               }
      .ps{
         position: absolute;
         top: 10;
         left:0;
      }
   </style>
</head>

<body>
   <?php
   include('../dashboard/includes/sidebar.php');
   ?>
   <div class="main">
      <div class="container-fluid">
         <div class="row">
            <div class="col-4 text-center p-0 m-0">
               <form action=""  method="$_POST"></form>
               <input type="image" src="../images/main1.jpg" alt="" width="100%;" height="600px;">
               <a href="#" class="pos bg-warning p-2 rounded text-dark text-center">Submit</a>
            </div>
            <div class="col-4 text-center p-0 m-0">
               <input type="image" src="../images/work2.png" alt="" width="100%;" height="600px">
               <a href="#" class="bg-warning p-2 rounded text-dark text-center">Submit</a>
            </div>
            <div class="col-4 text-center m-0 p-0">
               <input type="image" src="../images/work4.png" alt="" width="100%;"height="600px">
               <a href="#" class="bg-warning p-2 rounded text-dark text-center">Submit</a>
            </div>
            
      
      </div>
   </div>
   <?php
   include('../dashboard/includes/endsidebar.php');
   ?>
</body>

</html>