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
    $alts     = $_POST['alts'];
    $size     = $_POST['size'];
    $description = $_POST['description'];
    $images = $_POST['images'];

    if(isset($_POST['img_deleted'])){
        foreach ($_POST['img_deleted'] as $key => $value) {
            $objUpload->removeFile($value);
        }
    }
    
    $arrImage    = $objUpload->uploadFileMulty($images, $alts, $size);  // upload image extra

    // delete all file in tmp folder
    $files = glob('./tmp/*'); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file)) {
            unlink($file); // delete file
        }
    }
    
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
