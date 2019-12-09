<?php

include_once __DIR__ . "/../CLASSES/MEDIA/media.php";

session_start();

if(!validate_session()){
    header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
    die();
}

if(isset($_FILES['Media']) && !empty($_POST['Name'])){
 
    $title = $_POST['Name'];
    $target_dir = "MEDIA/";

    //obtenir l'extention du fichier uploader
    $media_file_type = pathinfo($_FILES['Media']['name'] ,PATHINFO_EXTENSION);
    //$media_file_ext = strtolower(end(explode('.',$_FILES['Media']['name'])));
  
    // Valid file extensions
    $img_extensions_arr = array("jpg","jpeg","png","gif");
    $vid_extensions_arr = array("webm", "avi", "wmv", "rm", "rmvb", "mp4", "mpeg");

    if(in_array($media_file_type, $img_extensions_arr)){
        $type = "image";
        echo "image";
    }
    else if(in_array($media_file_type, $vid_extensions_arr)){
        $type = "video";
        echo "video";
    }
    else{
        echo "INVALID FILE TYPE";
        die();
    }

    //creation d'un nom unique pour la "PATH" du fichier
    $path = tempnam("../MEDIA", '');
    unlink($path);
    $file_name = basename($path, ".tmp");
    
    //creation de l'url pour la DB
    $url = $target_dir . $file_name . "." . $media_file_type;
    $file_url = $file_name . "." . $media_file_type;
    
    //deplacement du fichier uploader vers le bon repertoire (Medias)
    move_uploaded_file($_FILES['Media']['tmp_name'], "../" . $url);


    //create entry in database
    //MUST DEFINE ALBUMID
    Media::create_entry($type, $file_url, $title, $_SESSION["lastVisitedAlbumID"], $_SESSION["userID"]);

    //redirection
    header("Location: ../billboard.php");
    die();
}
