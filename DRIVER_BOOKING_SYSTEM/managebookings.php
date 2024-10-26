<?php
include("./auth/staffauth.php");
?>
<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "driver_booking_system");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$driver_id = $_SESSION['driver_id'] ?? null; // Assuming driver_id is stored in session

$bookings = [];

if ($driver_id) {
    $booking_sql = "SELECT b.*, u.username, u.email, u.phno FROM bookings b 
                    JOIN users u ON b.user_id = u.user_id 
                    WHERE b.driver_id = '$driver_id'"; // Fetch bookings for the logged-in driver
    $booking_result = mysqli_query($conn, $booking_sql);
    
    if ($booking_result && mysqli_num_rows($booking_result) > 0) {
        while ($row = mysqli_fetch_assoc($booking_result)) {
            $bookings[] = $row;
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="managebooking.css"> 
    <title>Manage Bookings</title>
</head>
<body>
<nav class="nanbar">
    <div class="navbar">
        <h2 class="hdng">DRIVER BOOKING SYSTEM</h2>
        <div class="link">
            <a href="staffdashboard.php">Home</a>
            <a href="managebookings.php">Manage Bookings</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <h1>Manage Bookings</h1>

    <?php if ($bookings): ?>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>From</th>
                    <th>Destination</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['booking_id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['username']); ?></td>
                        <td><?php echo htmlspecialchars($booking['email']); ?></td>
                        <td><?php echo htmlspecialchars($booking['phno']); ?></td>
                        <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                        <td><?php echo htmlspecialchars($booking['from_place']); ?></td>
                        <td><?php echo htmlspecialchars($booking['destination']); ?></td>
                        <td><?php echo htmlspecialchars($booking['payment_status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No bookings found.</p>
    <?php endif; ?>
</div>
</body>
</html>
