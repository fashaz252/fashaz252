<?php
session_start();
require 'config.php';

// Check if the user is a department head
if ($_SESSION['role'] !== 'department_head') {
    header('Location: no_access.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $department_id = $_SESSION['department_id']; // Get department from session

    $stmt = $pdo->prepare("INSERT INTO announcements (title, body, audience_type, target_id, created_by) VALUES (?, ?, 'department', ?, ?)");
    $stmt->execute([$title, $body, $department_id, $_SESSION['user_id']]);

    echo "Announcement created successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Announcement</title>
</head>
<body>
    <h2>Create Announcement for Your Department</h2>
    <form method="POST">
        <label>Title</label>
        <input type="text" name="title" required>
        
        <label>Body</label>
        <textarea name="body" required></textarea>

        <button type="submit">Create</button>
    </form>
</body>
</html>
