<?php
    session_start();
    include "UTILS/sessionhandler.php";

    $title = "Comment";

    $content = array();

    $module = "commentView.php";
    array_push($content, $module);

    

    require_once __DIR__ . "/HTML/masterpage.php";

?>