<?php
require 'config.php';

if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];

    // Fetch the staff member to edit
    $stmt = $pdo->prepare("SELECT * FROM staff WHERE id = ?");
    $stmt->execute([$staff_id]);
    $staff = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$staff) {
        die("Staff member not found!");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $role_id = $_POST['role_id'];

        // Update staff member
        $stmt = $pdo->prepare("UPDATE staff SET first_name = ?, last_name = ?, email = ?, role_id = ? WHERE id = ?");
        if ($stmt->execute([$first_name, $last_name, $email, $role_id, $staff_id])) {
            echo "Staff member updated successfully!";
            header("Location: manage_staff.php");
        } else {
            echo "Error updating staff member.";
        }
    }
} else {
    die("Invalid staff ID.");
}
?>

<!-- Edit Staff Form -->
<form method="POST">
    <label>First Name:</label>
    <input type="text" name="first_name" value="<?php echo htmlspecialchars($staff['first_name']); ?>" required>
    
    <label>Last Name:</label>
    <input type="text" name="last_name" value="<?php echo htmlspecialchars($staff['last_name']); ?>" required>
    
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($staff['email']); ?>" required>
    
    <label>Role ID:</label>
    <input type="number" name="role_id" value="<?php echo htmlspecialchars($staff['role_id']); ?>" required>
    
    <button type="submit">Update Staff</button>
</form>
