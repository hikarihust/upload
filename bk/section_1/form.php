<?php
require_once './connect.php';

$type = 'add';
if(isset($_GET['id'])){
    $type = 'edit';
    $id = $_GET['id'];
    $product = $obj->get($id);
}

$elements = [
    [
        'label'   => Form::label('Name'),
        'element' => Form::input('text', 'name', @$product['name'])
    ],
    [
        'label'   => Form::label('Price'),
        'element' => Form::input('number', 'price', @$product['price'])
    ],
    [
        'label'   => Form::label('Description', false),
        'element' => Form::textArea('description', @$product['description'])
    ],
    [
        'label'   => Form::label('Hình ảnh chính', false),
        'element' => Form::inputImage('image_main') . 
                    Form::imageOld(@$product['image_main'], @$id)
    ],
    [
        'label'   => Form::label('Hình ảnh phụ 1', false),
        'element' => Form::inputImage('image_extra[]') . 
                    Form::imageOld(@$product['image_extra'][0], @$id)
    ],
    [
        'label'   => Form::label('Hình ảnh phụ 2', false),
        'element' => Form::inputImage('image_extra[]') . 
                    Form::imageOld(@$product['image_extra'][1], @$id)
    ],
    [
        'label'   => Form::label('Hình ảnh phụ 3', false),
        'element' => Form::inputImage('image_extra[]') . 
                    Form::imageOld(@$product['image_extra'][2], @$id)
    ],
    [
        'element' => Form::button('Lưu').
                    Form::input('hidden', 'type', $type) . 
                    Form::input('hidden', 'id', @$id),
        'type'    => 'btn-submit'
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once PATH_HTML . '/head.php' ?>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php require_once PATH_HTML . '/sidebar.php' ?>

            <?php require_once PATH_HTML . '/top-nav.php' ?>

            <!-- page content -->
            <div class="right_col" role="main" style="min-height: 2436px;">
                <?php require_once PATH_HTML . '/page-header.php' ?>

                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <?php require_once PATH_HTML . '/x-title.php' ?>

                            <div class="x_content">
                                <form action="./handle.php" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left" autocomplete="off">
                                    <?= Form::show($elements) ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
            <?php require_once PATH_HTML . '/footer.php' ?>

        </div>
        
        <?php require_once PATH_HTML . '/script.php' ?>   
</body>
</html>