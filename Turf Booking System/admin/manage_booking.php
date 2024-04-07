<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Manage Bookings</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="manage_turf.php">Manage Turf</a></li>
                <li><a href="manage_booking.php">Manage booking</a></li>
                <li><a href="#" id="logout">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <h2>All Bookings</h2>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Turf ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Duration (hours)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include database connection
                    include 'db_connect.php';

                    // Fetch bookings from database
                    $sql = "SELECT * FROM bookings";
                    $result = $conn->query($sql);

                    // Display bookings in table
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['turf_id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['start_time'] . "</td>";
                        echo "<td>" . $row['end_time'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>";
                        echo "<form action='delete_booking.php' method='post'>";
                        echo "<input type='hidden' name='booking_id' value='" . $row['booking_id'] . "'>";
                        echo "<button class='delete-button' type='submit'>Delete Booking</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }

                    // Close database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
