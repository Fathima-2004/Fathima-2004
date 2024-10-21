<html>
<head>  
    <link rel="stylesheet" href="managestaff.css">
    <link rel="stylesheet" href="admindashboard.css">
    <title>LOGIN</title>
</head>
<body>
    <nav class="nanbar">
        <div class="navbar">
            <a href="#">DRIVER BOOKING SYSTEM</a>
            <div class="link">
                <a href="home.html">home</a>
                <a href="staffdashboard.html"></a>

            </div>
        </div>
    </nav>
    <div class="div2">
        <h1>MANAGE STAFF</h1>
        <?php
        // Check if 'staffedit' is set in the POST request
        if (isset($_POST['staffedit'])) {
            $id = $_POST['staffedit'];
            $conn = mysqli_connect("localhost", "root", "", "driver_booking_system");
             
                $sql = $conn->query("SELECT * FROM users WHERE user_id='$id'");
                $userDetails = $sql->fetch_assoc();
                
                if (isset($_POST['register'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $phno = $_POST['phno'];
                    $passwd = $_POST['password'];
                    $profileUpdateSql = $conn->query("UPDATE users SET username='$username',email='$email',phno='$phno',pwd='$passwd' WHERE user_id='$id'");
                    
                    if ($profileUpdateSql) {
                        echo "<script>alert('Update successful')</script>";
                        header("Location: managestaff.php");
                        exit();
                    } else {
                        echo "<script>alert('Update Failed')</script>";
                    }
                }
            } else {
                echo "Database connection failed.";
            }   
        ?>
        <form method="post">
            <input type="hidden" name="staffedit" value="<?php echo htmlspecialchars($id); ?>">
            <table>
                <tr>
                    <td>Staff Name:</td>
                    <td><input required class="inp" type="text" name="username" value="<?php echo htmlspecialchars($userDetails['username']); ?>" placeholder="Fullname"><br></td>
                </tr>
                <tr>
                    <td>Email-ID:</td>
                    <td><input required class="inp" type="email" name="email" value="<?php echo htmlspecialchars($userDetails['email']); ?>"><br></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input required class="inp" type="text" name="phno" value="<?php echo htmlspecialchars($userDetails['phno']); ?>"><br></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input required class="inp" type="password" name="password" value="<?php echo htmlspecialchars($userDetails['pwd']); ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button id="hero_bt" type="submit" name="register">Update</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>