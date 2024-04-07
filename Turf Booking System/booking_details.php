<?php
session_start();
include 'db_connect.php'; // Include database connection

// Retrieve booking ID and user ID from URL parameters
$bookingId = $_GET['booking_id'];
$userId = $_GET['id'];
$selectedTurf = isset($_GET['selected_turf']) ? $_GET['selected_turf'] : '';

// Retrieve booking details from database
$sql = "SELECT *, turf_id FROM bookings WHERE booking_id='$bookingId'";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Details</title>
    <link rel="stylesheet" type="text/css" href="details.css">
</head>
<body>
    <h2>Booking Details</h2>
    <?php
    // Check if the query executed successfully
    if ($result) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Display booking details
    ?>
            <p><strong>Selected Turf:</strong> <?php echo $selectedTurf; ?></p>
            <p><strong>Booking ID:</strong> <?php echo $row['booking_id']; ?></p>
            <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
            <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
            <p><strong>Start Time:</strong> <?php echo $row['start_time']; ?></p>
            <p><strong>End Time:</strong> <?php echo $row['end_time']; ?></p>
            <p><strong>Amount:</strong> <?php echo 'Rs. ' . $row['amount']; ?></p>

            <!-- Proceed to Payment button -->
            <a href="payment.php?booking_id=<?php echo $bookingId; ?>&id=<?php echo $userId; ?>&amount=<?php echo $row['amount']; ?>">Proceed to Payment</a>
    <?php
        } else {
            echo "Booking not found";
        }
    } else {
        // Display error message if the query failed
        echo "Error: " . mysqli_error($conn);
    }
    ?>
</body>
</html>
<?php
// Close database connection
mysqli_close($conn);
?>
