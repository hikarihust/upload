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
        'label'   => Form::label('Description', null, false),
        'element' => Form::textArea('description', @$product['description'])
    ],
    [
        'label'   => Form::label('Hình ảnh', null, false),
        'element' => Form::inputDropzone()
    ],
    [
        'element' => Form::button('submit', 'Lưu', 'success d-block mx-auto') .
                    Form::input('hidden', 'type', @$type) .
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

        <script>
            // Dropzone class:
            Dropzone.autoDiscover = false;
            $(document).ready(function () {
                var myDropzone = new Dropzone("div#dropzone", { 
                    url: "./upload.php",
                    paramName: "file",
                    maxFiles: 10,
                    maxFilesize: 2,
                    uploadMultiple: true, // uplaod files in a single request
                    parallelUploads: 100, // use it with uploadMultiple
                    acceptedFiles: ".jpg, .jpeg, .png",
                    addRemoveLinks: true,
                    // Language Strings
                    dictFileTooBig: "File is to big ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
                    dictInvalidFileType: "Invalid File Type",
                    dictCancelUpload: "Cancel",
                    dictRemoveFile: "Remove",
                    dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed",
                    dictDefaultMessage: "Drop files here to upload",
                    init: function () {
                        let myDropzone = this
                        <?php if(isset($id)){ ?>
                            $.get("./get_data.php?id=<?= $id ?>", function (data) {
                                $.each(JSON.parse(data), function (index, mockFile) { 
                                    let url = 'uploads/' + mockFile.image;
                                    mockFile.name = mockFile.image;   
                                    myDropzone.options.addedfile.call(myDropzone, mockFile);
                                    myDropzone.options.thumbnail.call(myDropzone, mockFile, url);
                                    mockFile.previewElement.classList.add('dz-success');
                                    mockFile.previewElement.classList.add('dz-complete'); 

                                    mockFile._captionBox = Dropzone.createElement("<input type='text' name='alts[]' value="+mockFile.alt+" >");
                                    mockFile._image = Dropzone.createElement("<input type='hidden' name='images[]' value="+mockFile.image+" >");
                                    mockFile._size = Dropzone.createElement("<input type='hidden' name='size[]' value="+mockFile.size+" >");

                                    mockFile.previewElement.appendChild(mockFile._captionBox);
                                    mockFile.previewElement.appendChild(mockFile._image);
                                    mockFile.previewElement.appendChild(mockFile._size);
                                }); 
                            });
                        <?php } ?>
                    }
                });

                myDropzone.on("addedfile", function(file) {
                    caption = file.caption == undefined ? "" : file.caption;
                    file._captionBox = Dropzone.createElement("<input type='text' name='alts[]' value="+caption+" >");
                    file._image = Dropzone.createElement("<input type='hidden' name='images[]' value="+file.name+" >");
                    file._size = Dropzone.createElement("<input type='hidden' name='size[]' value="+file.size+" >");

                    file.previewElement.appendChild(file._captionBox);
                    file.previewElement.appendChild(file._image);
                    file.previewElement.appendChild(file._size);
                });
            });
        </script>
</body>
</html>