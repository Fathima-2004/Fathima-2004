<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="nanbar">
        <div class="navbar">
        <a href="#">DRIVER BOOKING SYSTEM</a>
        <div class="link">
            <a href="home.html">Home</a>
        </div>
</div>
    </nav>
    <div class="login-container">
         <form class="log" action="login.php" method="POST">
                <img src="login.jpg" alt="Logo" class="logo">
               <input class="word1"  type="email" name="email" placeholder="Email" required>
               <input class="word2" type="password" name="password" placeholder="Password" required>
             <input class="submit" type="submit" name="login" value="Login">
            </form>
        </div>
    </body>
    </html>
    

<?php

$conn = mysqli_connect("localhost", "root", "", "driver_booking_system");


if (!$conn) {
    echo "Database not connected.";
    exit(); 
}

if (isset($_POST['login'])) {
    // Get user inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `login` WHERE `email`='$email' AND `password`='$password'";
    $data = mysqli_query($conn, $sql);

    if ($data) {
        if (mysqli_num_rows($data) > 0) {
            $value= mysqli_fetch_assoc($data);
            if($value['user_type']== 0){
            header('Location: userdashboard.html');
            echo $value['user_type'];
            exit();
        }
            elseif($value['user_type']== 1){
                header('Location: staffdashboard.html');
                echo $value['user_type'];
                exit();
            }
            else{
                header('Location: admindashboard.html');
                echo $value['user_type'];
                exit();
         }
                     
        } else {
            echo "<script>alert('Invalid user');</script>";
        }
    }
}

mysqli_close($conn);
?>
