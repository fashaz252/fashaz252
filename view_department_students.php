<?php
session_start();
require 'config.php';

// Check if the user is a department head
if ($_SESSION['role'] !== 'department_head') {
    header('Location: no_access.php');
    exit();
}

$department_id = $_SESSION['department_id'];

// Fetch students in the department
$stmt = $pdo->prepare("SELECT * FROM students WHERE department_id = ?");
$stmt->execute([$department_id]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Department Students</title>
</head>
<body>
    <h2>Students in Your Department</h2>

    <?php foreach ($students as $student): ?>
        <div>
            <h3><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h3>
            <p><?php echo $student['email']; ?></p>
            <a href="edit_student.php?id=<?php echo $student['id']; ?>">Edit</a>
            <a href="delete_student.php?id=<?php echo $student['id']; ?>">Delete</a>
        </div>
    <?php endforeach; ?>
</body>
</html>
