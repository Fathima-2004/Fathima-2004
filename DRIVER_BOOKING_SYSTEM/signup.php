<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="signup.css">
    <title>LOGIN</title>
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
    
    <div class="div1">
        <h1 class="hdng">Register</h1>
        <form class="form1" action="" method="post">
            <input class="input1" type="text" name="username" placeholder="username" required>
            <input class="input1" type="number" name="phno" placeholder="phone number" required>
            <input class="input1" type="email" name="email" placeholder="email" required>
            <select name="usertype" class="input1" required>
                <option value="" disabled selected>Select user type</option>
                <option value="user">User</option>
                <option value="driver">Driver</option>
            </select>
            <select name="district" class="input1" required>
                <option value="" disabled selected>Select district</option>
                <option value="Trivandrum">Trivandrum</option>
                <option value="Kollam">Kollam</option>
                <option value="Pathanamthitta">Pathanamthitta</option>
                <option value="Allapuzha">Allapuzha</option>
                <option value="Kottayam">Kottayam</option>
                <option value="Idukki">Idukki</option>
                <option value="Ernakulam">Ernakulam</option>
                <option value="Thrissur">Thrissur</option>
                <option value="Palakkad">Palakkad</option>
                <option value="Malappuram">Malappuram</option>
                <option value="Kozhikode">Kozhikode</option>
                <option value="Wayanad">Wayanad</option>
                <option value="Kannur">Kannur</option>
                <option value="Kasargod">Kasargod</option>
            </select>
            <input class="input1" type="password" name="pwd" placeholder="password" required>
            <input class="input1" type="password" name="confirmpwd" placeholder="confirm password" required>
            <input class="sub2" type="submit" name="sign_up" value="sign up">
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

if (isset($_POST['sign_up'])) {
    $name = $_POST['username'];
    $phoneno = $_POST['phno'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $confirmpassword = $_POST['confirmpwd']; 
    $usertype = $_POST['usertype'];
    $district = $_POST['district'];

    if (!preg_match('/^[6789]\d{9}$/', $phoneno)) {
        echo "<script>alert('Please enter a valid 10-digit Indian phone number starting with 6, 7, 8, or 9.');</script>";
    } 
    else if (strlen($password) < 8 || 
             !preg_match('/[A-Z]/', $password) || 
             !preg_match('/[a-z]/', $password) || 
             !preg_match('/\d/', $password) || 
             !preg_match('/[@$!%*?&]/', $password)) {
        echo "<script>alert('Password must be at least 8 characters long, and include at least one uppercase letter, one lowercase letter, one number, and one special character.');</script>";
    } 
    else if ($password !== $confirmpassword) {
        echo "<script>alert('Passwords do not match.');</script>";
    }
    else {
        if ($usertype == 'user') {
            $type = 0;
            $sql = "INSERT INTO `users`(`username`, `phno`, `email`, `pwd`, `user_type`, `district`) VALUES ('$name','$phoneno','$email','$password','$usertype','$district')";
            $sql1 = "INSERT INTO `login`(`email`, `password`, `user_type`) VALUES ('$email','$password','$type')";
        } else {
            $type = 1;
            $sql = "INSERT INTO `drivers`(`username`, `phno`, `email`, `pwd`, `user_type`, `district`) VALUES ('$name','$phoneno','$email','$password','$usertype','$district')";
            $sql1 = "INSERT INTO `login`(`email`, `password`, `user_type`) VALUES ('$email','$password','$type')";
        }

        $data = mysqli_query($conn, $sql);
        $data1 = mysqli_query($conn, $sql1);
        if ($data) {
            echo "<script>alert('Record added');</script>";
        } else {
            echo "<script>alert('Record invalid');</script>";
        }
    }
}

mysqli_close($conn); 
?>
