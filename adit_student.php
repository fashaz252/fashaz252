<?php
require 'config.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Fetch the student to edit
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$student_id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        die("Student not found!");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $course_id = $_POST['course_id'];
        $nta_level = $_POST['nta_level'];

        // Update student details
        $stmt = $pdo->prepare("UPDATE students SET first_name = ?, last_name = ?, email = ?, course_id = ?, nta_level = ? WHERE id = ?");
        if ($stmt->execute([$first_name, $last_name, $email, $course_id, $nta_level, $student_id])) {
            echo "Student updated successfully!";
            header("Location: manage_students.php");
        } else {
            echo "Error updating student.";
        }
    }
} else {
    die("Invalid student ID.");
}
?>

<!-- Edit Student Form -->
<form method="POST">
    <label>First Name:</label>
    <input type="text" name="first_name" value="<?php echo htmlspecialchars($student['first_name']); ?>" required>
    
    <label>Last Name:</label>
    <input type="text" name="last_name" value="<?php echo htmlspecialchars($student['last_name']); ?>" required>
    
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
    
    <label>Course ID:</label>
    <input type="number" name="course_id" value="<?php echo htmlspecialchars($student['course_id']); ?>" required>
    
    <label>NTA Level:</label>
    <input type="number" name="nta_level" value="<?php echo htmlspecialchars($student['nta_level']); ?>" required>
    
    <button type="submit">Update Student</button>
</form>
