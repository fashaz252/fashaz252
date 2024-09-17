<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT * FROM staff WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "A staff member with this email already exists.";
    } else {
        // Insert the new staff member
        $stmt = $pdo->prepare("INSERT INTO staff (first_name, last_name, email, role_id) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$first_name, $last_name, $email, $role_id])) {
            echo "Staff member added successfully!";
            header("Location: manage_staff.php");
        } else {
            echo "Error adding staff member.";
        }
    }
}
?>
