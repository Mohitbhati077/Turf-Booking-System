<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Turf</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Delete Turf</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Back to Dashboard</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <h2>Delete Turf</h2>
            <form action="delete_turf.php" method="post">
                <label for="turf_id">Select Turf to Delete:</label>
                <select id="turf_id" name="turf_id" required>
                    <?php
                    // Include database connection
                    include 'db_connect.php';

                    // Fetch turfs from database
                    $sql = "SELECT * FROM turfs";
                    $result = $conn->query($sql);

                    // Display turfs in dropdown menu
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['turf_id'] . "'>" . $row['turf_type'] . " - " . $row['location'] . "</option>";
                    }

                    // Close database connection
                    $conn->close();
                    ?>
                </select>
                <button type="submit">Delete Turf</button>
            </form>
        </div>
    </main>
    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
