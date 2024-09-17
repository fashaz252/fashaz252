<?php
// Include the database connection file
require 'config.php'; // This connects to the database

// Fetch all announcements from the database
try {
    $stmt = $pdo->query("SELECT * FROM announcements ORDER BY created_at DESC");
    $announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching announcements: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Announcements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .announcement {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
        }
        .announcement h3 {
            margin: 0;
            font-size: 1.5em;
        }
        .announcement p {
            margin: 10px 0;
        }
        .announcement small {
            color: #666;
        }
        hr {
            border: 0;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>

<h2>All Announcements</h2>

<?php if ($announcements): ?>
    <?php foreach ($announcements as $announcement): ?>
        <div class="announcement">
            <h3><?php echo htmlspecialchars($announcement['title']); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($announcement['content'])); ?></p>
            <small>Posted on: <?php echo htmlspecialchars($announcement['created_at']); ?></small>
        </div>
        <hr>
    <?php endforeach; ?>
<?php else: ?>
    <p>No announcements found.</p>
<?php endif; ?>

</body>
</html>


