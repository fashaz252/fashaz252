<?php
// Include database configuration
require 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Check if passwords match
    if ($password != $confirm_password) {
        echo "Passwords do not match!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert admin into the database
        $sql = "INSERT INTO admins (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if (mysqli_query($conn, $sql)) {
            echo "Admin registered successfully!";
            header('Location: admin_login.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
</head>
<body>
    <h2>Register Admin</h2>
    <form method="post" action="admin_register.php">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <label>Confirm Password:</label><br>
        <input type="password" name="confirm_password" required><br><br>
        
        <button type="submit">Register</button>
    </form>
</body>
</html>
