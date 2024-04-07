<?php
// Include database connection
include 'db_connect.php';

// Retrieve form data
$turf_type = $_POST['turf_type'];
$rate_per_hour = $_POST['rate_per_hour'];
$location = $_POST['location'];

// Insert new turf into database
$sql = "INSERT INTO turfs (turf_type, rate_per_hour, location) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sds", $turf_type, $rate_per_hour, $location);
$stmt->execute();
$stmt->close();

// Close database connection
$conn->close();

// Redirect back to dashboard
echo "<script>alert('Turf Added successful!');window.location.href='manage_turf.php';</script>";
//header('Location: admin_dashboard.php');
exit();
?>
