<?php
include('../includes/connect.php');
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
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Title</title>
    <style>
        .text-blue {
            background-color: #0F2027;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <span class="text-blue py-3 px-4 rounded text-white"><a href="../index.php" class="text-white">RESUME BUILDER</a></span>
            <a href="logout.php" class="text-blue px-4 py-3 text-white rounded ml-3">
                Logout &nbsp; <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
        <h2 class="text-center">Regestered People</h2>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Sl NO</th>
                    <th scope="col">First name</th>
                    <th scope="col">Email</th>
                    <th scope="col">User Link</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM user_login_details";
                $result = $con->query($sql);
                if ($result->rowCount() > 0) {
                    $i=1;
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row['u_name']; ?></td>
                            <td><?php echo $row['u_email']; ?></td>
                            <td><a href="../<?php echo $row['u_name']; ?>" target="_blank"><?php echo $row['user_link']; ?></a></td>
                        </tr>
                <?php
                $i=$i+1; }
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>