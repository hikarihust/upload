<?php
session_start();
require_once 'connect.php';
$objUpload = new Upload();

$id = null;
$product = null;

if(isset($_POST)) {
    if(isset($_POST['type']) == 'edit'){
        $type = $_POST['type'];
        $id   = $_POST['id'];
        $product = $obj->get($id);
    }

    $name = $_POST['name'];
    $price = $_POST['price'];
    $alts     = $_POST['alt'];
    $ordering    = $_POST['ordering'];
    $description = $_POST['description'];
    $images = $_FILES['images'];
    
    $arrImage    = $objUpload->uploadFileMulty($images, $alts, $ordering, @$product['images']);  // upload image extra
    
    $item = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'images' => $arrImage
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
