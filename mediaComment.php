<?php
    session_start();
    include "UTILS/sessionhandler.php";

    $title = "Comment";

    $content = array();

    $module = "mediaCommentView.php";
    array_push($content, $module);

    $_SESSION["lastMediaID"] = $_GET["mediaID"];

    

    require_once __DIR__ . "/HTML/masterpage.php";

?>