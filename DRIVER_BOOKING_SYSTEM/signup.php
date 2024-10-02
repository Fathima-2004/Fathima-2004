<!DOCTYPE html>
<html>
<head>
    
    <link rel="stylesheet" href="signup.css">
    <!-- <link rel="stylesheet" href="login.css"> -->
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
        <h1 class="hdng">Register  </h1>
        <form class="form1" action="" method="post">
            <input class="input1" type="text" name="username" placeholder="username" required>
            <input class="input1" type="number" name="phno" placeholder="phone number" required>
            <input class="input1" type="email" name="email" placeholder="email" required>
            <select name="usertype" id="" class="input1">
            <option value="" disabled selected>Select user type.</option>
            <option value="user">User</option>
            <option value="driver">Driver</option>
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
    $usertype= $_POST['usertype'];
    if($usertype == 'user'){
        $type= 0;
    }
    else{
       $type= 1;
   }

    if ($password == $confirmpassword){
        $sql ="INSERT INTO `users`(`username`, `phno`, `email`, `pwd`, `user_type`) VALUES ('$name','$phoneno','$email','$password','$usertype')";
       $sql1="INSERT INTO `login`(`email`, `password`, `user_type`) VALUES ('$email','$password','$type')";
        $data = mysqli_query($conn, $sql);
        $data1 = mysqli_query($conn, $sql1);
        if ($data) {
            echo "<script>alert('Record added');</script>";
        } else {
            echo "<script>alert('Record invalid');</script>";
        }
    }
     else {
        echo "<script>alert('Passwords do not match');</script>";
    }
}
 else {
    echo "Form not submitted";
}

mysqli_close($conn); 
?>
