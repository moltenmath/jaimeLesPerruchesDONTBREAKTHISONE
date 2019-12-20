<?php
    include __DIR__ . "/../CLASSES/MEDIACOMMENTS/mediacomment.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    $mediaComment = new MediaComment();

    $mediaComment->add_comment($_POST["comment"], $_SESSION["lastMediaID"], $_SESSION["userID"]);

    
    header("Location: ../Billboard.php");
    die();




?>