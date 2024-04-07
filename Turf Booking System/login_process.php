<?php
// Start session
session_start();
include 'db_connect.php'; // Assuming this file contains the database connection

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];

// Retrieve user data from database
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];  
        echo "<script>alert('Login successful!');window.location.href='turf_selection.php';</script>";
        //echo "Login successful";
    } else {
        echo "<script>alert('Incorrect Password');window.location.href='login.php';</script>";
    }
} else {
    echo "User not found";
}

// Close database connection
mysqli_close($conn);
?>
