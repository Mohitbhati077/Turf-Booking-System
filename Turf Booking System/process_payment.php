<?php
// Start the session
session_start();

// Connect to the database
include 'db_connect.php';

// Retrieve data from the payment form
$user_id = $_POST['user_id'];
$booking_id = $_POST['booking_id'];
$amount = $_POST['amount'];

// Validate user existence
$user_check_query = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $user_check_query);

// Check for errors in the query execution
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}

$user_exists = mysqli_num_rows($result) > 0;

if (!$user_exists) {
    // Handle case where user does not exist
    echo "Error: User does not exist.";
    exit();
}

// Insert payment into the payments table
$stmt = $conn->prepare("INSERT INTO payments (user_id, booking_id, amount, payment_date, status) VALUES (?, ?, ?, NOW(), 'pending')");
$stmt->bind_param("iid", $user_id, $booking_id, $amount);

if ($stmt->execute()) {
    // Payment successfully processed
    header("Location: thank_you.php");
    exit();
} else {
    // Error processing payment
    echo "Error: Unable to process payment. Please try again later.";
}

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
