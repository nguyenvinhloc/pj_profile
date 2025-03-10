<?php
$connect = mysqli_connect('localhost', 'root', '','ontap');
if($connect){
    mysqli_query($connect, "SET NAMES 'UTF8'");
}
else{
    echo 'ket noi khong thanh cong';
}
?>