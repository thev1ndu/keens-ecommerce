<?php
session_start();
$conn = new mysqli('http://api.8t33n.cfd', 'aa', '11223344', 'ecommerce');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (id, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $id, $username, $hashed_password);

    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form method="POST">
        <input type="text" name="id" placeholder="User ID (e.g., A001, S001)" required><br>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
