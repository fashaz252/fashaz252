<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $audience_type = $_POST['audience_type'];
    $department_id = $_POST['department_id'] ?? null;
    $course_id = $_POST['course_id'] ?? null;
    $posted_by = $_SESSION['admin_id'];

    // Insert announcement
    $stmt = $pdo->prepare("INSERT INTO announcements (title, content, audience_type, department_id, course_id, posted_by) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$title, $content, $audience_type, $department_id, $course_id, $posted_by])) {
        echo "Announcement created successfully!";
    } else {
        echo "Error: Could not create announcement.";
    }
}
?>

<!-- Announcement Creation Form -->
<form method="POST">
    <label>Title:</label>
    <input type="text" name="title" required>
    <label>Content:</label>
    <textarea name="content" required></textarea>
    <label>Audience:</label>
    <select name="audience_type" required>
        <option value="staff">Staff Only</option>
        <option value="students">Students Only</option>
        <option value="both">Both</option>
        <option value="department">Specific Department</option>
        <option value="course">Specific Course</option>
    </select>
    <label>Department (if applicable):</label>
    <input type="number" name="department_id">
    <label>Course (if applicable):</label>
    <input type="number" name="course_id">
    <button type="submit">Create Announcement</button>
</form>
