<?php
// Include database connection
include 'db_connect.php';

// Check if the turf_id is set and not empty
if(isset($_POST['turf_id']) && !empty($_POST['turf_id'])) {
    // Sanitize the input to prevent SQL injection
    $turf_id = mysqli_real_escape_string($conn, $_POST['turf_id']);

    // Delete the turf from the database
    $sql = "DELETE FROM turfs WHERE turf_id = '$turf_id'";
    if(mysqli_query($conn, $sql)) {
        // Turf deleted successfully
        echo "<script>alert('Turf Deleted successful!');window.location.href='manage_turf.php';</script>";
        //header('Location: manage_turf.php?success=true');
        exit();
    } else {
        // Error occurred while deleting the turf
        header('Location: manage_turf.php?error=true');
        exit();
    }
} else {
    // Redirect the user back to the manage turf page if the turf_id is not provided
    header('Location: manage_turf.php');
    exit();
}

// Close database connection
mysqli_close($conn);
?>
