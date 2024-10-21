<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "driver_booking_system");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must be logged in to view your bookings.'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch bookings for the logged-in user
$sql = "SELECT b.booking_id, b.booking_date, b.from_place, b.destination, b.payment_status, d.username 
        FROM bookings b 
        JOIN drivers d ON b.driver_id = d.driver_id 
        WHERE b.user_id = '$user_id'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <link rel="stylesheet" href="mybookings.css">
</head>
<body>
<nav class="nanbar">
        <div class="navbar">
            <a class="hdng"  href="">DRIVER BOOKING SYSTEM</a>
            <div class="link">
            <a href="userdashboard.php">Home</a>
                <a href="mybookings.php">Manage bookings</a>
                <a href="driverprofile.php">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
        </div>
    </nav>

<div class="container">
    <h1>My Bookings</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Driver</th>
                <th>Booking Date</th>
                <th>From</th>
                <th>Destination</th>
                <th>Payment Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['booking_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['from_place']); ?></td>
                    <td><?php echo htmlspecialchars($row['destination']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment_status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You have no bookings.</p>
    <?php endif; ?>

</div>
</body>
</html>

<?php
mysqli_close($conn);
?>
