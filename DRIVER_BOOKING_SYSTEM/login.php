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
        <a class="hdng"  href="#">DRIVER BOOKING SYSTEM</a>
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
session_start(); // Start the session

$conn = mysqli_connect("localhost", "root", "", "driver_booking_system");

if (!$conn) {
    die("Database not connected.");
}

if (isset($_POST['login'])) {
    // Get user inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `login` WHERE `email`='$email' AND `password`='$password'";
    $data = mysqli_query($conn, $sql);

    if ($data && mysqli_num_rows($data) > 0) {
        $value = mysqli_fetch_assoc($data);
        // Store user type in session
        $_SESSION['user_type'] = $value['user_type'];
        $_SESSION['email'] = $value['email']; // Store email for reference

        // Determine user type and fetch user/driver ID
        if ($value['user_type'] == 0) { // User
            $user_sql = "SELECT * FROM `users` WHERE `email`='$email'";
            $user_data = mysqli_query($conn, $user_sql);
            if ($user_data && mysqli_num_rows($user_data) > 0) {
                $user_info = mysqli_fetch_assoc($user_data);
                $_SESSION['user_id'] = $user_info['user_id']; // Store user ID
            $_SESSION["userauth"] = true;
                header('Location: userdashboard.php');
                exit();
            }
        } elseif ($value['user_type'] == 1) { // Driver
            $driver_sql = "SELECT * FROM `drivers` WHERE `email`='$email'";
            $driver_data = mysqli_query($conn, $driver_sql);
            if ($driver_data && mysqli_num_rows($driver_data) > 0) {
                $driver_info = mysqli_fetch_assoc($driver_data);
                $_SESSION['driver_id'] = $driver_info['driver_id']; // Store driver ID
            $_SESSION["staffauth"] = true;
                header('Location: staffdashboard.php');
                exit();
            }
        } else { 
            $_SESSION["adminauth"] = true;
            header('Location: admindashboard.php');
            exit();
        }
    } else {
        echo "<script>alert('Invalid user');</script>";
    }
}

mysqli_close($conn);
?>
