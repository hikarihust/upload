<?php

class Upload{

    public function uploadFile($fileObj){
        if(!empty($fileObj['tmp_name'])){
            $fileNameMain = $this->randomFileName($fileObj['name']);
            move_uploaded_file($fileObj['tmp_name'], PATH_UPLOAD . $fileNameMain);
        }
        
        return $fileNameMain;
    }

    public function uploadFileMulty($fileObj){
        $arrExtra = [];
        foreach ($fileObj['name'] as $key => $value) { 
            if(!empty($fileObj['tmp_name'][$key])){          
                $fileNameExtra = $this->randomFileName($value);
                move_uploaded_file($fileObj['tmp_name'][$key], PATH_UPLOAD . $fileNameExtra);
                $arrExtra[$key] = $fileNameExtra;
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
}
