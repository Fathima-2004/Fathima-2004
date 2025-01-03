<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must be logged in to view your bookings.'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "driver_booking_system");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch pending bookings from the `requests` table
$requests_sql = "SELECT r.request_id, r.driver_id, r.from_place, r.destination, r.booking_date, r.booking_time, r.price, r.status, r.user_status, d.username 
                 FROM requests r
                 JOIN drivers d ON r.driver_id = d.driver_id 
                 WHERE r.user_id = '$user_id'";
$requests_result = mysqli_query($conn, $requests_sql);

// Fetch confirmed bookings from the `bookings` table
$bookings_sql = "SELECT b.booking_id, b.driver_id, b.from_place, b.destination, b.booking_date, b.payment_status, d.username 
                 FROM bookings b
                 JOIN drivers d ON b.driver_id = d.driver_id 
                 WHERE b.user_id = '$user_id'";
$bookings_result = mysqli_query($conn, $bookings_sql);

// Reject the booking if the Reject button is pressed
if (isset($_POST['reject_booking'])) {
    $request_id = $_POST['request_id'];
    $update_sql = "UPDATE requests SET user_status = 'rejected' WHERE request_id = '$request_id' AND user_id = '$user_id'";
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Booking has been rejected.'); window.location.href='mybookings.php';</script>";
    } else {
        echo "<script>alert('Failed to reject the booking.');</script>";
    }
}

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
        <a class="hdng" href="">DRIVER BOOKING SYSTEM</a>
        <div class="link">
            <a href="userdashboard.php">Home</a>
            <a href="mybookings.php">Manage bookings</a>
            <a href="driverprofile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <h1>Pending Bookings</h1>

    <?php if (mysqli_num_rows($requests_result) > 0): ?>
        <table>
            <tr>
                <th>Driver</th>
                <th>Booking Date</th>
                <th>From</th>
                <th>Destination</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($requests_result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['from_place']); ?></td>
                    <td><?php echo htmlspecialchars($row['destination']); ?></td>
                    <td><?php echo htmlspecialchars($row['price']); ?></td>
                    <td>
                        <?php if ($row['user_status'] == 'rejected'): ?>
                            <p>Booking Rejected</p>
                        <?php elseif ($row['user_status'] == 'requested' && $row['status'] == 'approved'): ?>
                            <form action="payment.php" method="POST">
                                <input type="hidden" name="driver_id" value="<?php echo htmlspecialchars($row['driver_id']); ?>">
                                <input type="hidden" name="booking_date" value="<?php echo htmlspecialchars($row['booking_date']); ?>">
                                <input type="hidden" name="from_place" value="<?php echo htmlspecialchars($row['from_place']); ?>">
                                <input type="hidden" name="destination" value="<?php echo htmlspecialchars($row['destination']); ?>">
                                <input type="hidden" name="amount" value="<?php echo htmlspecialchars($row['price']); ?>">
                                <input type="hidden" name="rid" value="<?php echo htmlspecialchars($row['request_id']); ?>">
                                <input type="submit" value="Pay Now">
                            </form>
                            <form method="POST">
                                <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['request_id']); ?>">
                                <input type="submit" name="reject_booking" value="Reject" onclick="return confirm('Are you sure you want to reject this booking?');">
                            </form>
                        <?php elseif ($row['status'] == 'paid'): ?>
                            <p>Payment Done</p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You have no pending requests.</p>
    <?php endif; ?>

    <h1>Confirmed Bookings</h1>

    <?php if (mysqli_num_rows($bookings_result) > 0): ?>
        <table>
            <tr>
                <th>Driver</th>
                <th>Booking Date</th>
                <th>From</th>
                <th>Destination</th>
                <th>Payment Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($bookings_result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['from_place']); ?></td>
                    <td><?php echo htmlspecialchars($row['destination']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment_status'] == 'done' ? 'Paid' : 'Pending'); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You have no confirmed bookings.</p>
    <?php endif; ?>

</div>
</body>
</html>

<?php
mysqli_close($conn);
?>
