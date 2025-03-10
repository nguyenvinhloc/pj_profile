<?php
// Kết nối cơ sở dữ liệu
include "../connect/db.php";

// Kiểm tra xem có ID trong URL không
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    // câu truy vấn xóa sản phẩm theo ID
    $sql = "DELETE FROM products WHERE id = $id";
    
    // Kiểm tra truy vấn có thành công không
    if(mysqli_query($connect, $sql)){
        // Sau khi xóa thành công, quay về trang danh sách sản phẩm
        header("Location: ../crud.php"); // hoặc trang quản lý sản phẩm
        exit();
    } else {
        echo "Lỗi: Không thể xóa sản phẩm.";
    }
} else {
    echo "Không có sản phẩm nào được chọn để xóa.";
}
?>
