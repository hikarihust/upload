<?php
session_start();
require_once 'connect.php';
$objUpload = new Upload();

$id = null;
$product = null;

if(isset($_POST['submit'])) {
    if(isset($_POST['type']) == 'edit'){
        $type = $_POST['type'];
        $id   = $_POST['id'];
        $product = $obj->get($id);
    }

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $imageMain = $_FILES['image_main'];
    $imageExtra = $_FILES['image_extra'];
    
    $fileNameMain = $objUpload->uploadFile($imageMain, @$product['image_main']);  // upload image main

    $arrExtra    = $objUpload->uploadFileMulty($imageExtra, @$product['image_extra']);  // upload image extra
    
    $item = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'image_main' => $fileNameMain,
        'image_extra' => $arrExtra,
    ];
    
    if($type == 'edit'){
        $obj->update($item);
        $_SESSION['message']['success'] = 'Cập nhật sản phẩm thành công!';
    }else{
        $obj->add($item);
        $_SESSION['message']['success'] = 'Thêm mới sản phẩm thành công!';
    }

    MyHelper::redirect('index.php');    
}
