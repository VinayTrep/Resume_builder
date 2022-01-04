<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js">
    </script>
    <title>Edit Work Experiance</title>
</head>

<body>
    <?php
    include("includes/sidebar.php");
    ?>
    <div class="main">
        <div class="my-4 text-right">
            <span class="text-blue py-3 px-4 rounded text-white">RESUME BUILDER</span>
        </div>
        <!-- already exiting data -->
        <div class="container-fluid my-3">
            <div class="row border p-3 align-items-center bg-light">
                <div class="col-md-8">
                    <p class="mb-0">All job details should appear her</p>
                </div>
                <div class="col-md-4 text-right">
                    <a href="#"><i class="fas fa-edit px-2 text-dark"></i></a>
                    <a href="#"><i class="fas fa-trash-alt px-2 text-dark"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-right"><a href="#" class="btn btn-warning ">Add Experiance</a></div>
            <div class="col-md-6 text-right"><a href="education.php" class="btn btn-success px-4">next</a></div>
        </div>
        <!-- form to accept new experience  -->
        <div class="container-fluid">
            <h3>EXPERIENCE</h3>
            <p class="text-muted">List your work experience, from the most recent to the oldest.</p>
            <form class="col-md-8" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <!-- <?php echo $_SERVER['PHP_SELF']; ?> -->
                <div class="row">
                    <div class="form-group col">
                        <label for="employer">Employer</label>
                        <input type="text" class="form-control" id="employer" name="employer">
                    </div>
                    <div class="form-group col">
                        <label for="job_title">Job Title</label>
                        <input type="text" class="form-control" id="job_title" name="job_title">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="start_date">Start Date</label>
                        <div class="">
                            <input type="month" name="start_date" id="month">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="end_date">End Date</label>
                        <div class="">
                            <input type="month" name="end_date" id="month">
                        </div>
                    </div>
                </div>
                <div class="py-4">
                    <label for="">Job Description</label>
                    <textarea name="editor2"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6"><a href="index.php" class="btn text-dark border">Back</a></div>
                    <div class="col-md-6"><button type="submit" class="btn btn-primary mx-auto" name="submit">Submit</button></div>
                </div>
            </form>
        </div>
    </div>
    <?php
    include("includes/endsidebar.php");
    ?>
    <script>
        CKEDITOR.replace('editor2');
    </script>
</body>

</html>