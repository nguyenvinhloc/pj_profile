<?php
include "../connect/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin sản phẩm từ database
    $sql = "SELECT * FROM products WHERE id = $id";
    $query = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($query);
}

// Cập nhật sản phẩm
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Xử lý ảnh nếu có thay đổi
    if ($_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $target = "public/image/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        // Giữ nguyên ảnh cũ nếu không có ảnh mới được upload
        $image = $row['image'];
    }

    $sql = "UPDATE products SET name='$name', price='$price', description='$description', image='$image' WHERE id=$id";
    if (mysqli_query($connect, $sql)) {
        header("Location: ../crud.php");
    } else {
        echo "Cập nhật thất bại: " . mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Sửa Sản Phẩm</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo $row['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="public/image/<?php echo $row['image']; ?>" alt="" width="150px" class="mt-2">
            </div>
            <button type="submit" class="btn btn-primary" name="update">Cập nhật</button>
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html>
