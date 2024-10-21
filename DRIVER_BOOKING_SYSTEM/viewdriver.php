<?php
session_start(); 

$conn = mysqli_connect("localhost", "root", "", "driver_booking_system");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'] ?? null; 

$user_district = null;

if ($user_id) {
    $user_sql = "SELECT district FROM users WHERE user_id = '$user_id'"; 
    $user_result = mysqli_query($conn, $user_sql);
    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $user_info = mysqli_fetch_assoc($user_result);
        $user_district = $user_info['district'];
    }
}

$districts = [];

$result = mysqli_query($conn, "SELECT DISTINCT district FROM drivers");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $districts[] = $row['district'];
    }
}

$drivers = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $search_district = $_POST['district'];
    $query = "SELECT * FROM drivers WHERE district = '$search_district'";
} else {
    $query = "SELECT * FROM drivers WHERE district = '$user_district'";
}

$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $drivers[] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="viewdriver.css"> <!-- Link to your CSS file -->
    <title>View Drivers</title>
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
    <h1>Available Drivers</h1>

    <form method="post" action="">
        <label for="district">Select District:</label>
        <select name="district" required>
            <option value="" disabled selected>Select district</option>
            <?php foreach ($districts as $district): ?>
                <option value="<?php echo htmlspecialchars($district); ?>"><?php echo htmlspecialchars($district); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="search" value="Search">
    </form>

    <?php if ($drivers): ?>
        <h2>Drivers in "<?php echo htmlspecialchars($user_district ?: $search_district); ?>"</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($drivers as $driver): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($driver['username']); ?></td>
                        <td><?php echo htmlspecialchars($driver['phno']); ?></td>
                        <td><?php echo htmlspecialchars($driver['email']); ?></td>
                        <td>
                            <form action="book_driver.php" method="GET">
                                <input type="hidden" name="driver_id" value="<?php echo htmlspecialchars($driver['driver_id']); ?>">
                                <input type="submit" value="Book Driver">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No drivers found in this district.</p>
    <?php endif; ?>
</div>
</body>
</html>
