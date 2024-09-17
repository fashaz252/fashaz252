<?php
require 'config.php';

// Fetch all staff from the database
$stmt = $pdo->query("SELECT * FROM staff ORDER BY created_at DESC");
$staff_members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
</head>
<body>

<h2>Manage Staff</h2>

<!-- Add Staff Form -->
<h3>Add New Staff</h3>
<form method="POST" action="add_staff.php">
    <label>First Name:</label>
    <input type="text" name="first_name" required>
    
    <label>Last Name:</label>
    <input type="text" name="last_name" required>
    
    <label>Email:</label>
    <input type="email" name="email" required>
    
    <label>Role ID:</label>
    <input type="number" name="role_id" required>
    
    <button type="submit">Add Staff</button>
</form>

<h3>Staff List</h3>
<?php if ($staff_members): ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role ID</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($staff_members as $staff): ?>
        <tr>
            <td><?php echo $staff['id']; ?></td>
            <td><?php echo htmlspecialchars($staff['first_name']); ?></td>
            <td><?php echo htmlspecialchars($staff['last_name']); ?></td>
            <td><?php echo htmlspecialchars($staff['email']); ?></td>
            <td><?php echo htmlspecialchars($staff['role_id']); ?></td>
            <td>
                <a href="edit_staff.php?id=<?php echo $staff['id']; ?>">Edit</a>
                <a href="delete_staff.php?id=<?php echo $staff['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No staff found.</p>
<?php endif; ?>

</body>
</html>
