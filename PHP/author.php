<?php
session_start();
require_once('constant.php');
require_once('database.php');

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Author') {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Dashboard</title>
</head>
<body>
    <h2>Welcome, Author!</h2><ul>
        <li><a href="update_profile.php">Update Profile</a></li>
        <li><a href="add_article.php">Manage Articles</a></li>
        <li><a href="view_articles.php">View Articles</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
