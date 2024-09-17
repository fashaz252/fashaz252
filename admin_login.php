<?php
// Include database configuration
require 'config.php';

session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Fetch admin from database
    $sql = "SELECT * FROM admins WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $admin['password'])) {
            // Start a session for the admin
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: admin_dashboard.php');
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form method="post" action="admin_login.php">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>
