<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
  .text-blue{
    background-color: #0F2027;
  }
  </style>
</head>

<body>

  <?php
  include("includes/sidebar.php");
  ?>

  <div class="main">
    <div class="my-4 text-right">
      <span class="text-blue py-3 px-4 rounded text-white">RESUME BUILDER</span>
    </div>
    <h3>COMPLETE YOUR PERSONAL INFO</h3>
    <p class="text-muted">Employers will use this information to contact you.</p>
    <form class="col-md-8" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <!-- <?php echo $_SERVER['PHP_SELF']; ?> -->
      <div class="row">
        <div class="form-group col">
          <label for="firstname">First Name</label>
          <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>
        <div class="form-group col">
          <label for="lastname">Last Name</label>
          <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="form-control" size="50" required>
      </div>
      <div class="row">
        <div class="form-group col-6">
          <label for="city">City</label>
          <input type="text" name="city" id="city" class="form-control" size="20" required>
        </div>
        <div class="form-group col-3">
          <label for="country">Country</label>
          <input type="text" name="country" id="country" class="form-control" size="20" required>
        </div>
        <div class="form-group col-3">
          <label for="zip_code">zip Code</label>
          <input type="text" name="zip_code" id="zip_code" class="form-control" size="6" required>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-6">
          <label for="e_mail">E-mail address</label>
          <input type="email" name="e_mail" id="e_mail" class="form-control" size="50" required>
        </div>
        <div class="form-group col-6">
          <label for="mobile_number">Phone no</label>
          <input type="text" name="mobile_number" id="mobile_number" class="form-control" size="10" required>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
  </div>
  <?php
  include("includes/endsidebar.php");
  ?>
</body>

</html>