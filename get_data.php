<?php
require_once './connect.php';

$product = $obj->get($_GET['id']);

$images = $product['images'];

echo json_encode($images);
