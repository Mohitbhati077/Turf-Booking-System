<?php
session_start();
include 'db_connect.php'; // Include database connection

// Validate and sanitize form data
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$time = mysqli_real_escape_string($conn, $_POST['time']);
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$selectedTurf = isset($_POST['selected_turf']) ? $_POST['selected_turf'] : '';

// Validate form data (example)
if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($time) || empty($duration)) {
    // Handle empty fields
    echo "All fields are required";
    exit;
}

// Example calculation of end time based on selected duration
$startTime = strtotime($time);
$endTime = strtotime("+$duration hour", $startTime);
$endTimeFormatted = date("H:i", $endTime);

// Calculate amount
$perHourRate = 1000;
$amount = $duration * $perHourRate;

// Insert booking data into database
$sql = "INSERT INTO bookings (name, email, phone, date, start_time, end_time, duration, amount) 
        VALUES ('$name', '$email', '$phone', '$date', '$time', '$endTimeFormatted', '$duration', '$amount')";

if (mysqli_query($conn, $sql)) {
    // Get the booking ID
    $bookingId = mysqli_insert_id($conn);
    

    // Redirect to booking details page with booking ID
    header("Location: booking_details.php?booking_id=$bookingId&selected_turf=$selectedTurf&id=$userId");
    exit;
} else {
    // Handle database error
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
