<?php
require 'config.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Delete the student
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    if ($stmt->execute([$student_id])) {
        echo "Student deleted successfully!";
        header("Location: manage_students.php");
    } else {
        echo "Error deleting student.";
    }
} else {
    die("Invalid student ID.");
}
?>
