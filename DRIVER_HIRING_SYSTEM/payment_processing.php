<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "driver_booking_system");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve booking details and payment method
$driver_id = $_POST['driver_id'] ?? null;
$booking_date = $_POST['booking_date'] ?? null;
$from_place = $_POST['from_place'] ?? null;
$destination = $_POST['destination'] ?? null;
$payment_method = $_POST['payment_method'] ?? null;
$rid = $_POST['rid'] ?? null;

// Determine payment status based on payment method
$payment_status = $payment_method === 'online' ? 'done' : 'cash';

// Insert booking into the database and update user_status
if ($driver_id && $booking_date && $from_place && $destination && $rid) {
    $user_id = $_SESSION['user_id']; // Assuming you have the user ID in session

    // Insert booking
    $sql = "INSERT INTO bookings (user_id, driver_id, from_place, destination, booking_date, payment_status) 
            VALUES ('$user_id', '$driver_id', '$from_place', '$destination', '$booking_date', '$payment_status')";
    
    if (mysqli_query($conn, $sql)) {
        // Update the user_status of the request to 'paid'
        $update_sql = "UPDATE requests SET user_status = 'paid' WHERE request_id = '$rid'";
        if (mysqli_query($conn, $update_sql)) {
            echo "<script>
                    alert('Booking confirmed and payment status updated!');
                    window.location.href='userdashboard.php';
                  </script>";
        } else {
            echo "Error updating payment status: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Incomplete booking information.";
}

mysqli_close($conn);
?>
