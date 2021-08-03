<?php

class Upload{

    public function uploadFile($fileObj, $imgOld = null){
        if(!empty($fileObj['tmp_name'])){
            $this->checkExtension($fileObj['name'], EXTENTION_VALID);
            $this->removeFile(@$imgOld);
            $fileNameMain = $this->randomFileName($fileObj['name']);
            move_uploaded_file($fileObj['tmp_name'], PATH_UPLOAD . $fileNameMain);
        } else {
            $fileNameMain = !empty($imgOld) ? $imgOld : '';
        }
        
        return $fileNameMain;
    }

    public function uploadFileMulty($fileObj, $imgOld = null){
        $arrExtra = [];
        foreach ($fileObj['name'] as $key => $value) { 
            if(!empty($fileObj['tmp_name'][$key])){
                $this->checkExtension($value, EXTENTION_VALID);  // check type image
                $this->removeFile(@$imgOld[$key]);   // remove image old     
                $fileNameExtra = $this->randomFileName($value);
                move_uploaded_file($fileObj['tmp_name'][$key], PATH_UPLOAD . $fileNameExtra);
                $arrExtra[$key] = $fileNameExtra;
            }else{
                $arrExtra[$key] = !empty($imgOld[$key]) ? $imgOld[$key] : '';
            }
        }
        return $arrExtra;
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
            unlink($fileName);
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
