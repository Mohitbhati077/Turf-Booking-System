<?php
// Include database connection
include 'db_connect.php';

// Fetch turf details from the database
$sql = "SELECT * FROM turfs";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Turf</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Choose Turf</h2>
        <div class="turf-list">
            <?php
            // Check if there are turfs available
            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="turf">
                        <h3><?php echo $row['turf_type']; ?></h3>
                        <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                        <p><strong>Price per Hour:</strong> <?php echo $row['rate_per_hour']; ?></p>
                        <p><strong>Availability:</strong> <?php echo $row['available'] ? 'Available' : 'Not Available'; ?></p>
                        <p><strong>Time Slot:</strong> <?php echo $row['start_time'] . ' - ' . $row['end_time']; ?></p>
                        <?php if ($row['available']) { ?>
                            <a href="booking.php?turf_id=<?php echo $row['turf_id']; ?>" class="book-now-btn">Book Now</a>
                        <?php } ?>
                    </div>
                    <?php
                }
            } else {
                echo "No turfs available.";
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php
// Close database connection
mysqli_close($conn);
?>
