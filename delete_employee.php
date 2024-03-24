<?php
require_once("entitiess/nhanvienQL.php");

// Kiểm tra xem có tham số ID được truyền qua URL hay không
if(isset($_GET['id'])) {
    // Lấy ID của nhân viên từ tham số trong URL
    $employeeId = $_GET['id'];

    // Gọi phương thức xóa nhân viên từ lớp NhanVien
    $deleted = NhanVien::deleteEmployee($employeeId);

    // Kiểm tra xem xóa nhân viên có thành công hay không
    if($deleted) {
        // Nếu thành công, chuyển hướng người dùng về trang danh sách nhân viên
        header("Location: admin_page.php");
        exit(); // Dừng kịch bản sau khi chuyển hướng
    } else {
        // Nếu không thành công, hiển thị thông báo lỗi
        echo "Failed to delete employee.";
    }
} else {
    // Nếu không có tham số ID, hiển thị thông báo lỗi
    echo "Employee ID not provided.";
}
?>
