<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function validateForm() {
            var name = document.forms["registrationForm"]["name"].value;
            var phone = document.forms["registrationForm"]["phone"].value;
            var email = document.forms["registrationForm"]["email"].value;
            var password = document.forms["registrationForm"]["password"].value;

            var nameRegex = /^[a-zA-Z\s]*$/;
            if (!name.match(nameRegex)) {
                alert("Name can only contain alphabets.");
                return false;
            }

            // Check if phone number is 10 digits and starts with 6, 7, 8, or 9
            var phoneRegex = /^[6-9]\d{9}$/;
            if (!phone.match(phoneRegex)) {
                alert("Phone number should be 10 digits and start with 6, 7, 8, or 9.");
                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.match(emailRegex)) {
                alert("Enter a valid email address.");
                return false;
            }

            return true; 
        }
    </script>
</head>
<body>
    <div class="container">
        <form name="registrationForm" action="register_process.php" method="post" onsubmit="return validateForm()">
            <h2>Register</h2>
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" required>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="testlogin.php">Login here</a></p>
    </div>
</body>
</html>
