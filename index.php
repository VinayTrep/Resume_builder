<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert db</title>
</head>

<body>
    <?php
    include("includes/connect.php");
    try{
    $name="arjun";
    $pass=2345;
    $mail="chiranth@gmail.com";
    $sql="INSERT INTO user_login_details (u_name,u_password,u_email) VALUES('$name','$pass','$mail')";
    $con->exec($sql);
    echo "inserted successfully";
    }
    catch(PDOException $e)
    {
        echo "wrong".$e->getMessage();
    }
    ?>
</body>

</html>