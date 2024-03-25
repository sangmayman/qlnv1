<?php
require_once("config/connection.class.php");

class NhanVien {
    public static function displayEmployees($page, $employeesPerPage) {
        $db = new Db();
        $offset = ($page - 1) * $employeesPerPage; 
        $queryString = "SELECT * FROM NHANVIEN LIMIT $employeesPerPage OFFSET $offset"; 
        $employees = $db->select_to_array($queryString);
        return $employees; 
    }

    public static function getTotalEmployees() {
        $db = new Db();
        $queryString = "SELECT COUNT(*) AS total FROM NHANVIEN"; 
        $result = $db->query_execute($queryString);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public static function deleteEmployee($employeeId) {
        $db = new Db();
        $queryString = "DELETE FROM NHANVIEN WHERE Ma_NV = '$employeeId'";
        return $db->query_execute($queryString);
    }
    
}
?>
