<?php

class Upload{

    public function uploadFileMulty($fileObj, $alts, $imgOld = null){
        $arrImage = [];
        foreach ($fileObj as $key => $value) { 
            // if(!empty($fileObj['tmp_name'][$key])){
                $this->checkExtension($value, EXTENTION_VALID);  // check type image
                $this->removeFile(@$imgOld[$key]['image']);   // remove image old     
                $fileNameImage = $this->randomFileName($value);
                // move_uploaded_file($fileObj['tmp_name'][$key], PATH_UPLOAD . $fileNameImage);
                $arrImage[$key]['image'] = $fileNameImage;
            // }else{
            //     $arrImage[$key]['image'] = !empty($imgOld[$key]['image']) ? $imgOld[$key]['image'] : '';
            // }
            $arrImage[$key]['alt']      = !empty($alts[$key]) ? $alts[$key] : '';
        }

        return $arrImage;
    }
    
    public function randomFileName($fileName, $length = 9){
        $arrCharacter = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        $arrCharacter = implode('', $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);

        $extension = '.' . pathinfo($fileName, PATHINFO_EXTENSION);
        $result = substr($arrCharacter, 0, $length) . $extension;

        return $result;
    }

    public function removeFile($fileName){
        $fileName   = PATH_UPLOAD . $fileName;
        if(file_exists($fileName)){
            @unlink($fileName);
        }
    }

	// Check file extensions
	public function checkExtension($fileName, $arrExtension){
		$ext = pathinfo($fileName, PATHINFO_EXTENSION);
		$flag = false;
		if(in_array(strtolower($ext), $arrExtension) == false){
            $_SESSION['message']['error'] = 'Không đúng định dạng';
            header('location: index.php');
            exit();
        }
		return $flag;
	}
}
