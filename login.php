<?php
session_start();
$conn = new mysqli('http://api.8t33n.cfd', 'aa', '11223344', 'ecommerce');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $user_id = $user['id'];

            // Redirect based on role
            if (str_starts_with($user_id, 'A')) {
                $_SESSION['role'] = 'admin';
                header("Location: admin_dashboard.php");
            } elseif (str_starts_with($user_id, 'S')) {
                $_SESSION['role'] = 'seller';
                header("Location: seller_dashboard.php");  // Corrected this redirect
            } elseif (str_starts_with($user_id, 'C')) {
                $_SESSION['role'] = 'customer';
                header("Location: customer_dashboard.php");
            }
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Invalid username!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
