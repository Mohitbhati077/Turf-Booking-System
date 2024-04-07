<?php
session_start();
$user_id = $_SESSION['user_id'];
$turf_id = isset($_POST['turf_id']) ? $_POST['turf_id'] : '';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function validateForm() {
            var name = document.getElementById('name').value;
            var phone = document.getElementById('phone').value;
            var email = document.getElementById('email').value;

            if (!/^[a-zA-Z]+$/.test(name)) {
                alert("Name should only contain alphabets.");
                return false;
            }

            if (!/^[6-9]\d{9}$/.test(phone)) {
                alert("Phone number should start with 6, 7, 8, or 9 and should be 10 digits long.");
                return false;
            }

            if (!document.getElementById('email').checkValidity()) {
                alert("Please enter a valid email address.");
                return false;
            }

            return true; 
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Booking Form</h2>
        <form action="process_booking.php" method="post" onsubmit="return validateForm()">

        <input type="hidden" id="turf_id" name="turf_id" value="<?php echo $turf_id; ?>">
           
            
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" pattern="[a-zA-Z]+" title="Name should only contain alphabets." required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" pattern="[6-9]\d{9}" title="Phone number should start with 6, 7, 8, or 9 and should be 10 digits long." required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <!-- <label for="turf_id">Turf ID:</label> -->
           

            <label for="start_time">Start Time:</label>
            <input type="time" name="start_time" min="06:00" max="23:59" required>

            <label for="end_time">End Time:</label>
            <input type="time" name="end_time" min="06:00" max="23:59" required>

            <label for="duration">Duration (hours):</label>
            <input type="number" id="duration" name="duration" step="1" min="0" required>

            <input type="hidden" name="user_id" value='<?php echo $_GET['user_id']; ?>'>
            

            <button type="submit">Book Now</button>
        </form>
    </div>
</body>
</html>