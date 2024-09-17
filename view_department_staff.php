<?php
session_start();
require 'config.php';

// Check if the user is a department head
if ($_SESSION['role'] !== 'department_head') {
    header('Location: no_access.php');
    exit();
}

$department_id = $_SESSION['department_id'];

// Fetch staff in the same department as the department head
$stmt = $pdo->prepare("SELECT * FROM users WHERE role_id = 3 AND department_id = ?");
$stmt->execute([$department_id]);
$staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Department Staff</title>
</head>
<body>
    <h2>Staff Members in Your Department</h2>

    <?php foreach ($staff as $member): ?>
        <div>
            <h3><?php echo $member['first_name'] . ' ' . $member['last_name']; ?></h3>
            <p><?php echo $member['email']; ?></p>
            <a href="edit_staff.php?id=<?php echo $member['id']; ?>">Edit</a>
            <a href="delete_staff.php?id=<?php echo $member['id']; ?>">Delete</a>
        </div>
    <?php endforeach; ?>
</body>
</html>
