<?php
require_once 'define.php';
// define absolute folder path
$storeFolder = PATH_ROOT . DS . 'tmp/';
// if folder doesn't exists, create it
if(!file_exists($storeFolder) && !is_dir($storeFolder)) {
    mkdir($storeFolder);
}
  
// upload files to $storeFolder
if (!empty($_FILES)) {
    
   /**
     *  uploadMultiple = true
     *  When uploading multiple files in a single request.
     *  Way to go if using dropzone in a form with other fields,
     *  and when uploading files on form submit via button... myDropzone.processQueue(); 
     *
     *  $_FILES['file']['tmp_name'] is an array so have to use loop
     *
     */
    foreach($_FILES['file']['tmp_name'] as $key => $value) {
        $tempFile = $_FILES['file']['tmp_name'][$key];
        $targetFile =  $storeFolder. $_FILES['file']['name'][$key];
        move_uploaded_file($tempFile,$targetFile);
    }
}
?>