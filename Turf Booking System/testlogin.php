<!DOCTYPE html>
<html>
    <head>
        <title>User Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="container">
            <?php
                session_start();
                include 'db_connect.php';

               

                if (isset($_POST['login'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows == 1) {
                        $user = $result->fetch_assoc();
                        if (password_verify($password, $user['password'])) { // verify the hashed password
                            $user_id = $user['user_id']; // assuming the column name is 'user_id'
                            $_SESSION['email'] = $email;
                            $_SESSION['user_id'] = $user_id;
                            header('Location: turf_selection.php');
                        } else {
                            echo "<p style='color:red;'>Invalid email or password</p>";
                        }
                    } else {
                        echo "<p style='color:red;'>Invalid email or password</p>";
                    }
                }
            ?>

            <form action="testlogin.php" method="post">
                <h2>Login</h2>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <button type="submit" name="login">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </body>
</html>