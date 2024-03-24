<?php
session_start();
require_once("entitiess/userclass.php");

// Kiểm tra xem biểu mẫu đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận tên người dùng và mật khẩu từ biểu mẫu
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate inputs
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty");
        exit;
    }

    // Tạo một đối tượng User mới
    $user = new User();

    // Thử đăng nhập
    $login_result = $user->login($username, $password);
    if ($login_result !== false) {
        // Đăng nhập thành công, hãy lưu thông tin người dùng vào session nếu cần
        $_SESSION['user'] = $login_result;

        // Chuyển hướng đến trang dashboard
        $user->redirectToDashboard($login_result['Role']);
    } else {
        // Đăng nhập không thành công, chuyển hướng trở lại trang đăng nhập với thông báo lỗi
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
            background-color: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>