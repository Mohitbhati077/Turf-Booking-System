<?php
session_start(); // Start the session (if not already started)
include 'db_connect.php'; // Include database connection

// Retrieve form data from payment page
$userId = $_POST['id']; // Assuming you have a form field for user ID
$bookingId = $_POST['booking_id']; // Assuming you have a form field for booking ID
$paymentAmount = $_POST['payment_amount']; // Assuming you have a form field for payment amount

// Prepare INSERT statement
$sql = "INSERT INTO payments (id, booking_id, payment_amount) VALUES (?, ?, ?)";

// Bind parameters and execute the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("idd", $userId, $bookingId, $paymentAmount);

// Execute the statement
if ($stmt->execute()) {
    // Payment recorded successfully, redirect to thank you page
    header("Location: thank_you_page.php");
    exit;
} else {
    // Handle payment insertion error
    echo "Error: " . $stmt->error;
}

// Close statement and database connection
$stmt->close();
$conn->close();
?>
