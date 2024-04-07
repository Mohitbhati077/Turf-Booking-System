<?php
session_start();
// Connect to the database
include 'db_connect.php';

// Retrieve user ID and booking ID from the previous page
if (!isset($_POST['user_id']) || !isset($_POST['booking_id'])) {
    // Handle case where user ID or booking ID is not provided
    header("Location: booking_confirmation.php");
    exit();
}
$user_id = $_POST['user_id'];
$booking_id = $_POST['booking_id'];

// Retrieve the amount from the database
$stmt = $conn->prepare("SELECT amount FROM bookings WHERE booking_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();
$amount = $booking['amount'];

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a CSS file for styling -->
    <script>
        function validateForm() {
            var cardNumber = document.getElementById('card_number').value;
            var expiryDate = document.getElementById('expiry_date').value;
            var cvv = document.getElementById('cvv').value;
            var nameOnCard = document.getElementById('name_on_card').value;

            // Card number validation
            if (cardNumber.length !== 16) {
                alert("Please enter a valid 16-digit card number.");
                return false;
            }

            // Expiry date validation (MM/YYYY format)
            var datePattern = /^(0[1-9]|1[0-2])\/20[2-9][0-9]$/;
            if (!datePattern.test(expiryDate)) {
                alert("Please enter a valid expiry date in MM/YYYY format.");
                return false;
            }

            // CVV validation
            if (cvv.length !== 3) {
                alert("Please enter a valid 3-digit CVV.");
                return false;
            }

            // Name on card validation (only alphabetic characters)
            var namePattern = /^[a-zA-Z\s]*$/;
            if (!namePattern.test(nameOnCard)) {
                alert("Please enter a valid name containing alphabetic characters only.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Payment Details</h1>
        <form action="process_payment.php" method="post" onsubmit="return validateForm()">
            <p>Amount to Pay: RS.<?php echo $amount; ?></p>
            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" required>

            <label for="expiry_date">Expiry Date:</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YYYY" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>

            <label for="name_on_card">Name on Card:</label>
            <input type="text" id="name_on_card" name="name_on_card" required>

            <!-- You can add more fields for billing address, etc. if needed -->
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
            <input type="hidden" name="amount" value="<?php echo $amount; ?>"> <!-- Include the amount -->
            <input type="submit" value="Pay Now">
        </form>
    </div>
</body>
</html>
