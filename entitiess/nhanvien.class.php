<?php
require_once("config/connection.class.php");

class NhanVien {
    public static function displayEmployees($page, $employeesPerPage) {
        $db = new Db();
        $offset = ($page - 1) * $employeesPerPage; 
        $queryString = "SELECT * FROM NHANVIEN LIMIT $employeesPerPage OFFSET $offset"; 
        $employees = $db->select_to_array($queryString);

        if ($employees === false) {
            echo "Error: Failed to retrieve employees.";
            return;
        }
        echo "<h2>Danh sách nhân viên</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Ma_NV</th><th>Ten_NV</th><th>Giới tính</th><th>Noi_Sinh</th><th>Ma_Phong</th><th>Luong</th></tr>";
        foreach ($employees as $employee) {
            echo "<tr>";
            echo "<td>" . $employee['Ma_NV'] . "</td>";
            echo "<td>" . $employee['Ten_NV'] . "</td>";
            echo "<td>";
            if ($employee['Phai'] === 'NU') {
                echo "<img src='img/woman.png' alt='Woman' style='width: 60px; height: 60px;'>";
            } else {
                echo "<img src='img/man.png' alt='Man' style='width: 60px; height: 60px;'>";
            }
            echo "</td>";
            echo "<td>" . $employee['Noi_Sinh'] . "</td>";
            echo "<td>" . $employee['Ma_Phong'] . "</td>";
            echo "<td>" . $employee['Luong'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    public static function getTotalEmployees() {
        $db = new Db();
        $queryString = "SELECT COUNT(*) AS total FROM NHANVIEN"; 
        $result = $db->query_execute($queryString);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
?>
