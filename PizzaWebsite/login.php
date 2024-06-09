<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzawebsite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute statement
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            header("Location: welcome.php"); // Redirect to a welcome page
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No account found with that email.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }
        .login-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-form h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .login-form .box {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-form .remember {
            display: flex;
            align-items: center;
            margin-bottom: 15px; 
        }
        .login-form .remember input {
            margin-right: 5px;
        }
        .login-form .remember label {
            font-size: 14px;
            color: #555;
        }
        .login-form .btn {
            width: 100%;
            padding: 10px;
            background: #130f40;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .login-form .btn:hover {
            background: #130f40;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <form action="" method="post" class="login-form">
        <h3>LOGIN FORM</h3>
        <input type="email" name="email" placeholder="enter your email" class="box" required>
        <input type="password" name="password" placeholder="enter your password" class="box" required>
        <div class="remember">
            <input type="checkbox" name="remember" id="remember-me">
            <label for="remember-me">remember me</label>
        </div>
        <input type="submit" value="login" class="btn">
        <?php
        if (isset($error)) {
            echo '<div class="error">' . $error . '</div>';
        }
        ?>
    </form>
</body>
</html>
