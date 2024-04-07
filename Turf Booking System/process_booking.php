<?php
session_start();

// Connect to the database
include 'db_connect.php';

// Get the user ID from the session variable
$user_id = $_SESSION['user_id'];


// Get the turf ID, name, email, phone, date, start_time, and end_time inputs from the booking form
$turf_id = $_POST['turf_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$duration = $_POST['duration'];
$amount = $duration * 1000;

$stmt = $conn->prepare("INSERT INTO bookings (user_id, turf_id, name, email, phone, date, start_time, end_time, duration, amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssssdd", $user_id, $turf_id, $name, $email, $phone, $date, $start_time, $end_time, $duration, $amount);
$stmt->execute();

$booking_id = $stmt->insert_id;

// Store the booking ID in the session
$_SESSION['booking_id'] = $booking_id;

// Close the statement and the database connection
$stmt->close();
$conn->close();

// Redirect the user to the booking confirmation page
//echo "Booking Sucessfully";
header('Location: booking_confirmation.php');
exit();
?>