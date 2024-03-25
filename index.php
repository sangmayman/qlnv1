<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Nhân Viên</title>
    <style>
        table {
            
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); 
            font-family: Arial, sans-serif;
          }
          
          th {
            background-color: #f8f9fa; 
            color: #007bff;
            font-weight: bold;
            font-size: 14px;
            text-align: left;
            padding: 12px 16px; 
            border-bottom: 1px solid #007bff; 
          }
          
          td {
            padding: 8px 12px;
            border: 1px solid #007bff;
            text-align: left;
          }
          
          .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
          }
          
          .pagination a {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            text-decoration: none;
            color: #333;
            background-color: #e0e0e0;
            font-size: 14px;
            cursor: pointer;
          }
          
          .pagination a.active {
            background-color: #007bff;
            color: #fff;
          }
          
          .pagination a:hover:not(.active) {
            background-color: #fff;
          }
          
          .login-button {
            margin-top: 20px;
            text-align: center;
          }
          
          .login-button a {
            display: inline-block;
            padding: 12px 20px;
            background-color: #007bff;
            color: #f8f9fa;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.2s ease-in-out;
          }
          
          .login-button a:hover {
            background-color: #007bff;
          }
    </style>
</head>
<body>
    <?php
    require_once("config/connection.class.php");
    require_once("entitiess/nhanvien.class.php");
    $employeesPerPage = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    NhanVien::displayEmployees($page, $employeesPerPage);
    $totalEmployees = NhanVien::getTotalEmployees();
    $totalPages = ceil($totalEmployees / $employeesPerPage);
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = $i == $page ? "active" : "";
        echo "<a href='index.php?page=$i' class='$activeClass'>$i</a>";
    }
    echo "</div>";
    echo "<div class='current-page-button'>";
    echo "<form action='index.php' method='get'>";
    echo "<input type='hidden' name='page' value='$page'>";
    echo "<button type='submit'>Go to Page $page</button>";
    echo "</form>";
    echo "</div>";
    echo "<div class='login-button'>";
    echo "<a href='login.php'>Login</a>";
    echo "</div>";
    ?>
</body>
</html>
