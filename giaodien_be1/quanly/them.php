<?php
include "../connect/db.php";

// Lấy danh mục sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM category";
$query = mysqli_query($connect, $sql);

// Kiểm tra và xử lý khi người dùng gửi form
if (isset($_POST['sbm'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    // Kiểm tra và xử lý ảnh
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    if ($image) {
        // ảnh được tải lên, chuyển file ảnh vào thư mục mong muốn
        move_uploaded_file($image_tmp, '../public/image/' . $image);
    } else {
        //  chọn ảnh mặc định hoặc thông báo lỗi
        $image = 'default.jpg'; // Dùng ảnh mặc định nếu không có ảnh được tải lên
    }

    // Thêm sản phẩm vào cơ sở dữ liệu
    $sql = "INSERT INTO products (name, price, description, image, category_id)
            VALUES ('$name', $price, '$description', '$image', $category_id)";

    // Kiểm tra nếu câu lệnh SQL thành công
    if (mysqli_query($connect, $sql)) {
        header('Location: ../crud.php');
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Thêm Sản Phẩm</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container my-5">
        <h2 class="text-center">Thêm Sản Phẩm</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Tên sản phẩm -->
            <div class="mb-3">
                <label for="name" class="form-label">Tên Sản Phẩm</label>
                <input type="text" class="form-control" id="name" name="name" required />
            </div>

            <!-- Giá sản phẩm -->
            <div class="mb-3">
                <label for="price" class="form-label">Giá Sản Phẩm</label>
                <input type="number" class="form-control" id="price" name="price" required />
            </div>

            <!-- Mô tả sản phẩm -->
            <div class="mb-3">
                <label for="description" class="form-label">Mô Tả Sản Phẩm</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <!-- Hình ảnh sản phẩm -->
            <div class="mb-3">
                <label for="image" class="form-label">Hình Ảnh Sản Phẩm</label>
                <input type="file" class="form-control" id="image" name="image" />
            </div>

            <!-- Danh mục sản phẩm -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh Mục Sản Phẩm</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <?php
                    // Hiển thị các danh mục từ cơ sở dữ liệu
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                        }
                    } else {
                        echo "<option>Không có danh mục nào</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Nút submit -->
            <button type="submit" name="sbm" class="btn btn-primary">Thêm Sản Phẩm</button>
        </form>
    </div>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
