<?php
session_start();
require_once("entitiess/userclass.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty");
        exit;
    }
    $user = new User();
    $login_result = $user->login($username, $password);
    if ($login_result !== false) {
        $_SESSION['user'] = $login_result;
        $user->redirectToDashboard($login_result['Role']);
    } else {
        header("Location: login.php?error=login_failed");
        exit;
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit">Login</button>
    <a href="register.php">New account?</a>
</form>
<style>
    
    body {
       font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    form {
        background-color: #ccc;
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label,
    input[type="text"],
    input[type="password"],
    button[type="submit"],
    a {
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"] {
        padding: 10px;
        border: 1px solid #0056b3;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        background-color: #0056b3;
        color: #fff;
        border: sandybrown;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

button[type="submit"]:hover {
background-color: #0056b3;
}

a {
    text-align: center;
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
    </style>