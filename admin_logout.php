<?php
session_start();

// Destroy the session and logout
session_destroy();

header('Location: admin_login.php');
exit();
