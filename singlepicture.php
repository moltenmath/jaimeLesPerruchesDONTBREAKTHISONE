<?php
    session_start();
    
    include "CLASSES/MEDIA/media.php";
    include "UTILS/sessionhandler.php";
    $content = array();

    $module = "singlepictureview.php";
    array_push($content, $module);

    

    require_once __DIR__ . "/HTML/masterpage.php";

?>