<!DOCTYPE html>
<html>
    <head>
        <title>Turf Selection</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="container">
            <h2>Select a Turf to Book</h2>
            <?php
                session_start();
                include 'db_connect.php';

                $sql = "SELECT * FROM turfs WHERE available = TRUE";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='turf'>";
                    echo "<h3>" . $row['turf_type'] . "</h3>";
                    echo "<p>Address: " . $row['location'] . "</p>";
                    echo "<p>Price: " . $row['rate_per_hour'] . "</p>";
                    echo "<form action='booking.php' method='post'>";
                    echo "<input type='hidden' name='turf_id' value='" . $row['turf_id'] . "'>";                    ;
                    echo "<button type='submit' name='book'>Book</button>";
                    echo "</form>";
                    echo "</div>";
                }
            ?>
        </div>
    </body>
</html>