<?php
require_once './libs/Json.php';
require_once './libs/Form.php';
$columns = ['id', 'name', 'price', 'description', 'image_main', 'image_extra'];
$obj = new Json('./data/product.json', $columns);

$product = $obj->get($_GET['id']);

$name = $product['name'];
$price = number_format($product['price']);
$description = $product['description'];
$imgMain = $product['image_main'];
$imgExtra = $product['image_extra'];

$xhtml = '';
$xhtml = '
<div class="col-md-7 col-sm-7">
    <div class="product-image">
        <img src="./uploads/' . $imgMain . '" alt="image_main" class="image_main">
    </div>
    <div class="product_gallery">
        <a><img src="./uploads/' . $imgMain . '" alt="image_main" class="image_extra active"></a>';
        foreach ($imgExtra as $key => $value) {
            if(!empty($value)){
                $xhtml .= '
                <a><img src="./uploads/' . $value . '" alt="image_extra1" class="image_extra"></a>
                ';
            }
        }
    $xhtml .= '</div>
</div>
<div class="col-md-5 col-sm-5 " style="border:0px solid #e5e5e5;">
    <h3 class="prod_title">' . $name . '</h3>
    <p>' . $description . '</p>
    <br>
    <div class="product_price">
        <h1 class="price">' . $price . 'đ</h1>
    </div>
</div>
'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once './html/head.php' ?>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php require_once './html/sidebar.php' ?>

            <?php require_once './html/top-nav.php' ?>

            <!-- page content -->
            <div class="right_col" role="main" style="min-height: 2436px;">
                <?php require_once './html/page-header.php' ?>

                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <?php require_once './html/x-title.php' ?>

                            <div class="x_content">
                                <?= $xhtml ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <?php require_once './html/footer.php' ?>

    </div>

    <?php require_once './html/script.php' ?>   
</body>
</html>