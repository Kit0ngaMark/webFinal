<?php
session_start();
require_once('constant.php');
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $user_name = $_POST['user_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST['user_type'];
    $address = $_POST['address'];

   

    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("INSERT INTO users (Full_Name, email, phone_Number, User_Name, Password, UserType, Address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $full_name, $email, $phone_number, $user_name, $password, $user_type, $address);

    if ($stmt->execute()) {
        echo "User registered successfully.";
    } else {
        echo "Error registering user: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <h2>Signup</h2>
    <form action="signup.php" method="post">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br>

        <label for="user_name">Username:</label>
        <input type="text" name="user_name" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="user_type">User Type:</label>
        <select name="user_type">
            <option value="Super_User">Super User</option>
            <option value="Administrator">Administrator</option>
            <option value="Author">Author</option>
            <!-- Add other user types as needed -->
        </select><br>

        <label for="address">Address:</label>
        <textarea name="address" rows="3"></textarea><br>

        <button type="submit">Signup</button>
    </form>
</body>
</html>
