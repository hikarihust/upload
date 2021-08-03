<?php
session_start();
require_once 'connect.php';
$objUpload = new Upload();

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $imageMain = $_FILES['image_main'];
    $imageExtra = $_FILES['image_extra'];
    
    $fileNameMain = $objUpload->uploadFile($imageMain);  // upload image main

    $arrExtra    = $objUpload->uploadFileMulty($imageExtra);  // upload image extra
    
    $item = [
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'image_main' => $fileNameMain,
        'image_extra' => $arrExtra,
    ];
    
    $obj->add($item);
    
    $_SESSION['message']['success'] = 'Thêm mới sản phẩm thành công!';

    MyHelper::redirect('index.php');    
}
