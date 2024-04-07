<?php
include 'db_connect.php';
// Assuming you have already connected to your database

// Total Revenue
$stmt = $conn->prepare("SELECT SUM(amount) AS total_revenue FROM bookings");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_revenue = $row['total_revenue'];

// Total Turf Available
$stmt = $conn->prepare("SELECT COUNT(*) AS total_turf_available FROM turfs WHERE available = TRUE");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_turf_available = $row['total_turf_available'];

// Total Number of Bookings
$stmt = $conn->prepare("SELECT COUNT(*) AS total_bookings FROM bookings");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_bookings = $row['total_bookings'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="manage_turf.php">Manage Turf</a></li>
                <li><a href="manage_booking.php">Manage booking</a></li>
                <li><a href="#" id="logout">Log Out</a></li>
                <!-- <li><a href="logout.php">Logout</a></li> -->
            </ul>
        </nav>
    </header>
    <main>
    <section class="dashboard_stats">
                <h2>Dashboard Overview</h2>
                <div class="stat">
                <h3>Total Revenue: 
                    RS: <?php echo $total_revenue; ?></h3>               
                </div>
                <div class="stat">
                <h3>Total Turf Available: <?php echo $total_turf_available; ?></h3>
                 
                </div>
                <div class="stat">
                <h3>Total Number of Bookings: <?php echo $total_bookings; ?></h3>
                </div>
              
             </section>
    
    </main>
    <script>
        document.addEventListener('DOMContentLoaded',function(){
            var logoutbutton=document.getElementById('logout');
            logoutbutton.addEventListener('click',function(event){
                event.preventDefault();
                var confirmLogout=confirm("Are you sure you want to log out?");
                if(confirmLogout){
                    window.location.href='logout.php';
                }
            });
        });
    </script>
    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
