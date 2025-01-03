<?php
session_start();

// Retrieve booking details from the previous page
$driver_id = $_POST['driver_id'] ?? null;
$booking_date = $_POST['booking_date'] ?? null;
$from_place = $_POST['from_place'] ?? null;
$destination = $_POST['destination'] ?? null;
$amount = $_POST['amount'] ?? null;
$rid = $_POST['rid'] ?? null;

if (!$driver_id || !$booking_date || !$from_place || !$destination || !$amount) {
    echo "<p>No booking information available.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <link rel="stylesheet" href="payment.css">
    <script>
        function togglePaymentFields() {
            const onlineFields = document.getElementById("onlinePaymentFields");
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

            if (paymentMethod === "online") {
                onlineFields.style.display = "block";
            } else {
                onlineFields.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <h1>Payment Page</h1>

    <h2>Booking Confirmation</h2>
    <p>You have booked the driver with ID: <?php echo htmlspecialchars($driver_id); ?></p>
    <p>Booking Date: <?php echo htmlspecialchars($booking_date); ?></p>
    <p>From: <?php echo htmlspecialchars($from_place); ?></p>
    <p>Destination: <?php echo htmlspecialchars($destination); ?></p>
    <p>Total Amount: <?php echo htmlspecialchars($amount); ?></p>
    
    <form method="POST" action="payment_processing.php">
        <input type="hidden" name="driver_id" value="<?php echo htmlspecialchars($driver_id); ?>">
        <input type="hidden" name="booking_date" value="<?php echo htmlspecialchars($booking_date); ?>">
        <input type="hidden" name="from_place" value="<?php echo htmlspecialchars($from_place); ?>">
        <input type="hidden" name="destination" value="<?php echo htmlspecialchars($destination); ?>">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
        <input type="hidden" name="rid" value="<?php echo htmlspecialchars($rid); ?>">

        <label for="payment_method">Select Payment Method:</label><br>
        <input type="radio" name="payment_method" value="cash" onclick="togglePaymentFields()" required> Cash (Direct Payment)<br>
        <input type="radio" name="payment_method" value="online" onclick="togglePaymentFields()" required> Online Payment<br>
        
        <div id="onlinePaymentFields" style="display:none;">
            <h3>Online Payment</h3>
            <label for="card_number">Card Number:</label>
            <input type="text" name="card_number" ><br>
            <label for="expiry_date">Expiry Date:</label>
            <input type="text" name="expiry_date" placeholder="MM/YY"><br>
            <label for="cvv">CVV:</label>
            <input type="text" name="cvv" ><br>
            <label for="amount">Payment Amount:</label>
            <input type="text" name="amount" value="<?php echo htmlspecialchars($amount); ?>" readonly> 
            <input type="hidden" name="payment_status" value="done"> 
        </div>

        <input type="submit" value="Proceed">
    </form>
</body>
</html>
