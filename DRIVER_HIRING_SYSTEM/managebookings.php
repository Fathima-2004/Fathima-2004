<?php
session_start();

// Ensure the driver is logged in
if (!isset($_SESSION['driver_id'])) {
    echo "<script>alert('You must be logged in to view requests.'); window.location.href='login.php';</script>";
    exit;
}

$driver_id = $_SESSION['driver_id'];

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "driver_booking_system");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch requests from the requests table
$sql_requests = "
    SELECT r.request_id, r.from_place, r.destination, r.booking_date, r.booking_time, r.price, r.status, u.username, r.user_status
    FROM requests r
    JOIN users u ON r.user_id = u.user_id 
    WHERE r.driver_id = '$driver_id'";
$result_requests = mysqli_query($conn, $sql_requests);

// Fetch confirmed trips from the bookings table
$sql_bookings = "
    SELECT b.booking_id, b.from_place, b.destination, b.booking_date, b.payment_status, u.username 
    FROM bookings b
    JOIN users u ON b.user_id = u.user_id 
    WHERE b.driver_id = '$driver_id'";
$result_bookings = mysqli_query($conn, $sql_bookings);

// Handle accept/reject for requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accept_request'])) {
        $request_id = $_POST['request_id'];
        $price = $_POST['price'];

        // Update request to 'accepted' and set the price
        $update_request = "UPDATE requests SET status = 'approved', price = '$price' WHERE request_id = '$request_id'";
        if (mysqli_query($conn, $update_request)) {
            echo "<script>alert('Request accepted successfully.'); window.location.href='managebookings.php';</script>";
        } else {
            echo "<script>alert('Failed to accept the request.');</script>";
        }
    } elseif (isset($_POST['reject_request'])) {
        $request_id = $_POST['request_id'];

        // Update request to 'rejected'
        $update_request = "UPDATE requests SET status = 'rejected' WHERE request_id = '$request_id'";
        if (mysqli_query($conn, $update_request)) {
            echo "<script>alert('Request rejected successfully.'); window.location.href='managebookings.php';</script>";
        } else {
            echo "<script>alert('Failed to reject the request.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Requests and Bookings</title>
    <link rel="stylesheet" href="managebooking.css">
</head>
<body>
<nav class="nanbar">
    <div class="navbar">
        <a class="hdng" href="">DRIVER BOOKING SYSTEM</a>
        <div class="link">
            <a href="staffdashboard.php">Dashboard</a>
            <a href="myrequests.php">My Requests</a>
            <a href="driverprofile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <!-- Requests Section -->
    <h1>Requests</h1>
    <?php if (mysqli_num_rows($result_requests) > 0): ?>
        <table>
            <tr>
                <th>Customer</th>
                <th>From</th>
                <th>Destination</th>
                <th>Date</th>
                <th>Time</th>
                <th>Price</th>
                <th>Status</th>
                <th>User Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result_requests)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['from_place']); ?></td>
                    <td><?php echo htmlspecialchars($row['destination']); ?></td>
                    <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['booking_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['price'] ?: 'Not Set'); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_status']); ?></td>
                    <td>
                        <?php if ($row['status'] == 'pending'): ?>
                            <form method="POST" style="display: inline-block;">
                                <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['request_id']); ?>">
                                <input type="text" name="price" placeholder="Set Price" required>
                                <button type="submit" name="accept_request">Accept</button>
                            </form>
                            <form method="POST" style="display: inline-block;">
                                <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['request_id']); ?>">
                                <button type="submit" name="reject_request" onclick="return confirm('Are you sure you want to reject this request?');">Reject</button>
                            </form>
                        <?php else: ?>
                            <p><?php echo ucfirst($row['status']); ?></p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No requests found.</p>
    <?php endif; ?>

    <!-- Bookings Section -->
    <h1 class="hng">Confirmed Trips</h1>
    <?php if (mysqli_num_rows($result_bookings) > 0): ?>
        <table>
            <tr>
                <th>Customer</th>
                <th>From</th>
                <th>Destination</th>
                <th>Date</th>
                <th>Payment Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result_bookings)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['from_place']); ?></td>
                    <td><?php echo htmlspecialchars($row['destination']); ?></td>
                    <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment_status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No confirmed trips found.</p>
    <?php endif; ?>
</div>
</body>
</html>

<?php
mysqli_close($conn);
?>
