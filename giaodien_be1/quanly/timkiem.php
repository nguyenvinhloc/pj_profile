<?php
if (isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
}
// Câu truy vấn SQL
$sql = "SELECT * FROM products WHERE products.name LIKE '%" . $tukhoa . "%'";
$query = mysqli_query($connect, $sql);
?>

<?php
//phan trang
if(isset($_GET['trang'])){
    $page = $_GET['trang'];
} else{
    $page = '';
}
if($page == '' || $page == 1){
    $begin = 0;
} else{
    $begin = ($page*3)-3;
}

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                    <!--tim kiem -->
                <form class="d-flex me-5" method="POST" action="index.php?page_layout=timkiem">
                    <input class="form-control me-2" name="tukhoa" type="search" placeholder="Tìm sản phẩm...">
                    <button class="btn btn-outline-success" name="timkiem" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php
                while ($row = mysqli_fetch_assoc($query)) { ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="public/image/<?php echo $row["image"] ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row["name"] ?></h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                      <!-- Product description-->
                                      <p><?php echo $row["description"]?></p>
                                    <!-- Product price-->
                                    <?php echo $row["price"] ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="item.php">Detail</a></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>


            </div>
        </div>
    </section>
        
                <!-- phan trang-->
    <style>
    .list-trang {
        text-align: center;
        margin-bottom: 10px;
    }

    .list-trang ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .list-trang ul li {
        display: inline-block;
        margin: 0 5px;
    }

    .list-trang ul li a {
        text-decoration: none;
        padding: 8px 16px;
        background-color:rgb(255, 145, 145);
        color: black;
        border-radius: 5px;
    }

    .list-trang ul li a:hover {
        background-color: #ddd;
    }
</style>
<?php
    //lay so luong san pham
    $sql_trang = mysqli_query($connect ,"SELECT*FROM products");
    $row_count = mysqli_num_rows($sql_trang);
    $trang = ceil($row_count/3);//bao nhieu san pham 1 trang
?>
    <div class="list-trang">
        <ul>
            Trang: 
          <?php for($i =1;$i<=$trang;$i++) {?>
            <li><a href="index.php?trang=<?php echo $i?>"><?php echo $i?></a></li>
            <?php }?>
        </ul>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>