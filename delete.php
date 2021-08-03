<?php
require_once './connect.php';

$result = $obj->delete($_GET['id']);

unlink(PATH_UPLOAD . $result['image_main']);  

foreach ($result['image_extra'] as $key => $value) {
    unlink(PATH_UPLOAD . $value);  
}

MyHelper::redirect('index.php');
