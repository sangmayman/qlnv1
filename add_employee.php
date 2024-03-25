<?php
require_once("config/connection.class.php");

// Function to generate the next unique employee ID
function generateUniqueEmployeeID($maxID) {
    // Extract the numeric part of the maximum ID
    $numericPart = (int) substr($maxID, 1);
    // Increment the numeric part by 1
    $nextID = $numericPart + 1;
    // Format the new ID as 'A' followed by the incremented numeric part
    return 'A0' . str_pad($nextID, strlen($maxID) - 1, '0', STR_PAD_LEFT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthPlace = $_POST['birth_place'];
    $departmentId = $_POST['department_id'];
    $salary = $_POST['salary'];

    // Kiểm tra dữ liệu hợp lệ (ở đây bạn có thể thêm các kiểm tra khác như kiểm tra kiểu dữ liệu, giá trị tối đa, v.v.)
    if (!empty($name) && !empty($gender) && !empty($birthPlace) && !empty($departmentId) && !empty($salary)) {
        // Thực hiện truy vấn SQL để lấy mã nhân viên lớn nhất
        $db = new Db();
        $maxIDQuery = "SELECT MAX(Ma_NV) AS maxID FROM NHANVIEN";
        $maxIDResult = $db->query_execute($maxIDQuery);
        $maxIDRow = mysqli_fetch_assoc($maxIDResult);
        $maxID = $maxIDRow['maxID'];

        // Generate the next unique employee ID
        $nextEmployeeID = generateUniqueEmployeeID($maxID);

        // Check if the generated ID already exists, if so, generate a new one
        while (true) {
            $checkQuery = "SELECT COUNT(*) AS count FROM NHANVIEN WHERE Ma_NV = '$nextEmployeeID'";
            $checkResult = $db->query_execute($checkQuery);
            $checkRow = mysqli_fetch_assoc($checkResult);
            if ($checkRow['count'] == 0) {
                // Found a unique ID
                break;
            }
            // Increment the numeric part and try again
            $nextID = (int) substr($nextEmployeeID, 1);
            $nextEmployeeID = generateUniqueEmployeeID($nextID);
        }

        // Thực hiện truy vấn SQL để thêm nhân viên mới
        $queryString = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES ('$nextEmployeeID', '$name', '$gender', '$birthPlace', '$departmentId', '$salary')";
        $result = $db->query_execute($queryString);

        if ($result) {
            // Redirect về trang danh sách nhân viên sau khi thêm thành công
            header("Location: admin_page.php");
            exit();
        } else {
            echo "Thêm nhân viên thất bại.";
        }
    } else {
        echo "Vui lòng điền đầy đủ thông tin.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
</head>
<body>
    <h1>Thêm Nhân Viên</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="gender">Gender:</label><br>
        <input type="radio" id="male" name="gender" value="Male">
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="Female">
        <label for="female">Female</label><br>
        <label for="birth_place">Birth Place:</label><br>
        <input type="text" id="birth_place" name="birth_place"><br>
        <label for="department_id">Department ID:</label><br>
        <input type="text" id="department_id" name="department_id"><br>
        <label for="salary">Salary:</label><br>
        <input type="text" id="salary" name="salary"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
