<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

echo "Welcome, " . $_SESSION['admin_username'];
?>

<!-- Admin Dashboard -->
<a href="create_announcement.php">Create Announcement</a>
<a href="view_announcements.php">View Announcements</a>
<a href="manage_students.php">Manage Students</a>
<a href="manage_staff.php">Manage Staff</a>
<a href="logout.php">Logout</a>

