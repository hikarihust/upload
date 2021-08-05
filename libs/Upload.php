<?php

class Upload{

    public function uploadFileMulty($fileObj, $alts, $size = null){
        $arrImage = [];
        foreach ($fileObj as $key => $value) { 
            $this->checkExtension($value, EXTENTION_VALID);  // check type image   
            $fileNameImage = $this->randomFileName($value);
            copy('./tmp/' . $value, PATH_UPLOAD . $fileNameImage);
            $arrImage[$key]['image'] = $fileNameImage;
            $arrImage[$key]['alt']      = !empty($alts[$key]) ? $alts[$key] : '';
            $arrImage[$key]['size']      = !empty($size[$key]) ? $size[$key] : '';
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
