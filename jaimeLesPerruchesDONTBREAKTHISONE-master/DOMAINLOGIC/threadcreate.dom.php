<?php
    include "../CLASSES/ALBUM/album.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
      header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
      die();
    }

    $title = $_POST["threadcreation"];

    if(empty("$title")){
      header("Location: ../error.php?ErrorMSG=bad%20request!");
      die();
    }

    $album = new album();
    if(!$album->add_album($title)){
      header("Location: ../error.php?ErrorMSG=Bad%20request!");
      die();
    }

    $album->load_album_by_title($title);
    $albumID = $album->get_id();
    header("Location: ../displaythread.php?threadID=$albumID&threadTitle=$title");
    die();

?>
