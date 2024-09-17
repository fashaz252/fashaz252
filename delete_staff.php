<?php
require 'config.php';

if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];

    // Delete the staff member
    $stmt = $pdo->prepare("DELETE FROM staff WHERE id = ?");
    if ($stmt->execute([$staff_id])) {
        echo "Staff member deleted successfully!";
        header("Location: manage_staff.php");
    } else {
        echo "Error deleting staff member.";
    }
} else {
    die("Invalid staff ID.");
}
?>
