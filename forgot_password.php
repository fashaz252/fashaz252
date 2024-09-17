<?php
// Include database configuration
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Check if the email exists
    $sql = "SELECT * FROM admins WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $token = bin2hex(random_bytes(50));  // Generate a secure token

        // Save the token in the database or email it (for demo purposes, we can send it via email)
        $reset_link = "http://yourdomain.com/reset_password.php?token=" . $token;

        // Send the reset email
        $subject = "Password Reset Request";
        $message = "Hello, \n\nClick the link below to reset your password:\n" . $reset_link;
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Password reset email sent. Please check your inbox.";
        } else {
            echo "There was an error sending the password reset email.";
        }
    } else {
        echo "No account found with this email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="post" action="forgot_password.php">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html>
