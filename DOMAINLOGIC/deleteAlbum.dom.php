<?php
    include __DIR__ . "/../CLASSES/ALBUM/album.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    Album::rm_album($_SESSION["albumID"]);
    
    header("Location: ../billboard.php");






?>