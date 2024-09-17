<?php
session_start();
require 'config.php';

// Check if the user is a department head
if ($_SESSION['role'] !== 'department_head') {
    header('Location: no_access.php');
    exit();
}

$department_id = $_SESSION['department_id'];

// Fetch announcements for the department
$stmt = $pdo->prepare("SELECT * FROM announcements WHERE target_id = ? AND audience_type = 'department'");
$stmt->execute([$department_id]);
$announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Department Announcements</title>
</head>
<body>
    <h2>Your Department's Announcements</h2>

    <?php foreach ($announcements as $announcement): ?>
        <div>
            <h3><?php echo $announcement['title']; ?></h3>
            <p><?php echo $announcement['body']; ?></p>
            <a href="edit_announcement.php?id=<?php echo $announcement['id']; ?>">Edit</a>
            <a href="delete_announcement.php?id=<?php echo $announcement['id']; ?>">Delete</a>
        </div>
    <?php endforeach; ?>
</body>
</html>
