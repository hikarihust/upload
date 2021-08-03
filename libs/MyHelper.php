<?php

class MyHelper{

    public static function redirect($link){
        header("location: $link");
        exit();
    }
}
