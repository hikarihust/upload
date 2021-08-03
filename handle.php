<?php
require_once 'connect.php';
$objUpload = new Upload();

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $imageMain = $_FILES['image_main'];
    $imageExtra = $_FILES['image_extra'];
    
    $fileNameMain = $objUpload->uploadFile($imageMain);  // upload image main
    
    $item = [
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'image_main' => $fileNameMain
    ];
    
    $obj->add($item);
    
    MyHelper::redirect('index.php');    
}
