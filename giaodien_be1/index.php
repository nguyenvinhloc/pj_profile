<?php
include "connect/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chu</title>
</head>

<body>
    <?php
    if (isset($_GET['page_layout'])) {
        switch ($_GET['page_layout']) {
                //hien thị ra danh sach
            case 'danhsach':
                require_once 'quanly/danhsach.php';
                break;

                //them san pham
            case 'them':
                require_once 'quanly/them.php';
                break;
            case 'trangchu':
                require_once 'quanly/trangchu.php';
                break;
                //xoa san pham
            case 'xoa':
                require_once 'quanly/xoa.php';
                break;

                //sua san pham
            case 'sua':
                require_once 'quanly/sua.php';
                break;

                //tim kiem san pham
            case 'timkiem':
                require_once 'quanly/timkiem.php';
                break;
            case 'item':
                require_once 'item.php';
                break;
            default:
                require_once 'quanly/danhsach.php';
                break;
        }
    } else {
        require_once 'quanly/danhsach.php';
    }
    ?>
</body>

</html>