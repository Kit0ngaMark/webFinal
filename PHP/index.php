<?php
session_start();
require_once('constant.php');
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['username'];
    $password = $_POST['password'];

    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT userId, UserType, Password FROM users WHERE User_Name=?");
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $stmt->bind_result($user_id, $user_type, $hashed_password);
    
    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_type'] = $user_type;

        switch ($user_type) {
            case 'Super_User':
                header("Location: reception.php");
                break;
            case 'Administrator':
                header("Location: reception.php");
                break;
            case 'Author':
                header("Location: reception.php");
                break;
            default:
                
                break;
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form action="index.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
