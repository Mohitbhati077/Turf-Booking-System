<?php
// Include database connection
include 'db_connect.php';

// Check if booking_id is set and not empty
if(isset($_POST['booking_id']) && !empty($_POST['booking_id'])) {
    // Sanitize the input to prevent SQL injection
    $booking_id = $_POST['booking_id'];

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM bookings WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();

    // Check if the deletion was successful
    if($stmt->affected_rows > 0) {
        // Booking deleted successfully
        echo "<script>alert('Booking deleted successfully.'); window.location.href = 'manage_booking.php';</script>";
    } else {
        // Failed to delete booking
        echo "<script>alert('Failed to delete booking.'); window.location.href = 'manage_booking.php';</script>";
    }

    // Close statement
    $stmt->close();
} else {
    // Redirect if booking_id is not set or empty
    header("Location: manage_booking.php");
    exit();
}

// Close database connection
$conn->close();
?>
