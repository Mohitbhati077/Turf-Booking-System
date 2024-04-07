<?php
session_start();

// Connect to the database
include 'db_connect.php';

// Get the booking ID from the session variable
$booking_id = $_SESSION['booking_id'];
function simulatePayment() {
    // Simulate processing time
    sleep(2);
    return true; // Payment simulation successful
}

// Handle payment simulation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pay_now'])) {
    // Simulate payment processing
    if (simulatePayment()) {
        // Payment successful
        $payment_message = "Payment simulation successful. Your booking is confirmed.";
    } else {
        // Payment failed
        $payment_message = "Payment simulation failed. Please try again.";
    }
}

// Get the booking details from the database
$stmt = $conn->prepare("SELECT * FROM bookings WHERE booking_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" type="text/css" href="booking.css">
</head>
<body>
<div class="container">
    <h1>Booking Confirmation</h1>
    <p>Your booking has been successfully made.</p>
    <p>Booking ID: <?php echo $booking['booking_id']; ?></p>
    <p>Turf ID: <?php echo $booking['turf_id']; ?></p>
    <p>Name: <?php echo $booking['name']; ?></p>
    <p>Email: <?php echo $booking['email']; ?></p>
    <p>Phone: <?php echo $booking['phone']; ?></p>
    <p>Date: <?php echo $booking['date']; ?></p>
    <p>Start Time: <?php echo $booking['start_time']; ?></p>
    <p>End Time: <?php echo $booking['end_time']; ?></p>
    <p>Duration: <?php echo $booking['duration']; ?></p>
    <p>Amount: <?php echo $booking['amount']; ?></p>

    <!-- Add your "Pay Now" button here -->
    <form action="payments.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id']; ?>">
            <input type="submit" value="Pay Now">
        </form>
    </div>
</body>
</html>
