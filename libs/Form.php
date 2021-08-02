<?php

class Form {

    public static function showButtonAction($url, $class, $title, $icon){
        $xhtml = null;
        $xhtml .= sprintf('<a href="%s" type="button" class="btn btn-icon btn-%s"
                data-toggle="tooltip" data-placement="top"
                data-original-title="%s">
                <i class="fa fa-%s"></i>
            </a>', $url, $class, $title, $icon);
    
        return $xhtml;
    }
}