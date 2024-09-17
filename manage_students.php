<?php
require 'config.php';

// Fetch all students from the database
$stmt = $pdo->query("SELECT * FROM students ORDER BY created_at DESC");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
</head>
<body>

<h2>Manage Students</h2>

<!-- Add Student Form -->
<h3>Add New Student</h3>
<form method="POST" action="add_student.php">
    <label>First Name:</label>
    <input type="text" name="first_name" required>
    
    <label>Last Name:</label>
    <input type="text" name="last_name" required>
    
    <label>Email:</label>
    <input type="email" name="email" required>
    
    <label>Course ID:</label>
    <input type="number" name="course_id" required>
    
    <label>NTA Level:</label>
    <input type="number" name="nta_level" required>
    
    <button type="submit">Add Student</button>
</form>

<h3>Student List</h3>
<?php if ($students): ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Course ID</th>
            <th>NTA Level</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo htmlspecialchars($student['id']); ?></td>
            <td><?php echo htmlspecialchars($student['first_name']); ?></td>
            <td><?php echo htmlspecialchars($student['last_name']); ?></td>
            <td><?php echo htmlspecialchars($student['email']); ?></td>
            <td><?php echo htmlspecialchars($student['course_id']); ?></td>
            <td><?php echo htmlspecialchars($student['nta_level']); ?></td>
            <td>
                <a href="edit_student.php?id=<?php echo $student['id']; ?>">Edit</a>
                <a href="delete_student.php?id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No students found.</p>
<?php endif; ?>

</body>
</html>
