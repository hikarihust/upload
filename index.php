<?php
require_once './libs/Json.php';
require_once './libs/Form.php';
$columns = ['id', 'name', 'price', 'description', 'image_main', 'image_extra'];
$obj = new Json('./data/product.json', $columns);
$data = $obj->list();
$xhtml = '';
if(!empty($data)){
    foreach ($data as $key => $value) {
        $name = $value['name'];
        $price = number_format($value['price']);
        $imgMain = $value['image_main'];
        $btnView = Form::showButtonAction('info.php?id='.$value['id'].'', 'primary', 'View', 'eye');
        $btnEdit = Form::showButtonAction('edit.html', 'success', 'Edit', 'pencil');
        $btnDelete = Form::showButtonAction('delete.html', 'danger btn-delete', 'Delete', 'trash-o');

        $xhtml .= '
                <tr class="even pointer">
                    <td class="a-centre">1</td>
                    <td>' . $name . '</td>
                    <td>
                        <img src="./uploads/' . $imgMain . '" width="100px" alt="img_main">
                    </td>
                    <td>' . $price . 'đ</td>
                    <td class="last">
                    ' . $btnView . $btnEdit . $btnDelete . '
                    </td>
                </tr>
                ';
    }
}else{
    $xhtml .= '<tr><td colspan="5" class="text-center">Dữ liệu hiện rỗng</td></tr>';
}
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
                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title">STT</th>
                                                <th class="column-title">Tên sản phẩm</th>
                                                <th class="column-title">Hình ảnh</th>
                                                <th class="column-title">Giá sản phẩm</th>
                                                <th class="column-title no-link last"><span class="nobr">Hành động</span></th>
                                                <th class="bulk-actions" colspan="7">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions (
                                                        <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?= $xhtml ?>
                                        </tbody>
                                    </table>
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