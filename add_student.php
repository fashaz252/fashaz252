<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $course_id = $_POST['course_id'];
    $nta_level = $_POST['nta_level'];

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "A student with this email already exists.";
    } else {
        // Insert the new student
        $stmt = $pdo->prepare("INSERT INTO students (first_name, last_name, email, course_id, nta_level) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$first_name, $last_name, $email, $course_id, $nta_level])) {
            echo "Student added successfully!";
            header("Location: manage_students.php");
        } else {
            echo "Error adding student.";
        }
    }
}
?>
