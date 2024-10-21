<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "driver_booking_system");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'] ?? null; 
$user = null;

if ($user_id) {
    $user_sql = "SELECT * FROM users WHERE user_id = '$user_id'"; 
    $user_result = mysqli_query($conn, $user_sql);
    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $user = mysqli_fetch_assoc($user_result);
    }
}

$edit_mode = false; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user) {
    $old_email = $user['email'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $update_sql = "UPDATE users SET username = '$name', email = '$email', phno = '$phone' WHERE user_id = '$user_id'";
    mysqli_query($conn, $update_sql);

    $update_login_sql = "UPDATE login SET email = '$email' WHERE email = '$old_email'";
    mysqli_query($conn, $update_login_sql);

    $user['username'] = $name;
    $user['email'] = $email;
    $user['phno'] = $phone;
} elseif (isset($_GET['edit'])) {
    $edit_mode = true; 
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="userprofile.css"> 
    <title>User Profile</title>
</head>
<body>
<nav class="nanbar">
    <div class="navbar">
        <h2 class="hdng">DRIVER BOOKING SYSTEM</h2>
        <div class="link">
            <a href="userdashboard.html">Home</a>
            <a href="">My bookings</a>
            <a href="view_drivers.php">View Drivers</a>
            <a href="feedback.php">Feedback</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <h1>User Profile</h1>

    <?php if ($user): ?>
        <div class="profile-info">
            <p><strong>Name:</strong> <span id="userName"><?php echo htmlspecialchars($user['username']); ?></span></p>
            <p><strong>Email:</strong> <span id="userEmail"><?php echo htmlspecialchars($user['email']); ?></span></p>
            <p><strong>Phone:</strong> <span id="userPhone"><?php echo htmlspecialchars($user['phno']); ?></span></p>
        </div>
        
        <a href="?edit=true">Edit Profile</a> 
        
        <?php if ($edit_mode): ?>
            <div id="editForm">
                <h2>Edit Profile</h2>
                <form method="POST" action="">
                    <label for="editName">Name:</label>
                    <input type="text" id="editName" name="name" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    <label for="editEmail">Email:</label>
                    <input type="email" id="editEmail" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    <label for="editPhone">Phone:</label>
                    <input type="tel" id="editPhone" name="phone" value="<?php echo htmlspecialchars($user['phno']); ?>" required>
                    <input type="submit" value="Save">
                    <a href="profile.php">Cancel</a>
                </form>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
</div>
</body>
</html>
