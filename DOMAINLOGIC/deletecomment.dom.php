<?php
    include __DIR__ . "/../CLASSES/MEDIACOMMENTS/mediacomment.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }
    
    MediaComment::remove_mediacomment_by_id($_GET["commentid"]);

    header("Location: ../billboard.php");
    die();
