<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Turf</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Manage Turf</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="manage_turf.php">Manage Turf</a></li>
                <li><a href="manage_booking.php">Manage booking</a></li>
                <li><a href="#" id="logout">Log Out</a></li>
            </ul>
        </nav>
        <button class="add-turf-button"><a href="add_turf.html">Add Turf</a></button>

    </header>
    <main>
        <div class="container">
            <h2>All Turfs</h2>
            <table>
                <thead>
                    <tr>
                        <th>Turf Type</th>
                        <th>Rate per Hour</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include database connection
                    include 'db_connect.php';

                    // Fetch turfs from database
                    $sql = "SELECT * FROM turfs";
                    $result = $conn->query($sql);

                    // Display turfs in table
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['turf_type'] . "</td>";
                        echo "<td>" . $row['rate_per_hour'] . "</td>";
                        echo "<td>" . $row['location'] . "</td>";
                        echo "<td>";
                        echo "<form action='delete_turf.php' method='post'>";
                        echo "<input type='hidden' name='turf_id' value='" . $row['turf_id'] . "'>";
                        echo "<button class='delete-button' type='submit'>Delete Turf</button>";
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
