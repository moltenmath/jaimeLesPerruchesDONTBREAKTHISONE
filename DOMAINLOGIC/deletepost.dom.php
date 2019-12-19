<?php
    include __DIR__ . "/../CLASSES/MEDIA/media.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    Media::remove_media_by_id($_GET["mediaID"]);

    header("Location: ../billboard.php");
    die();
