<?php

include_once __DIR__ . "/../CLASSES/MEDIA/media.php";

session_start();
    $target_dir = "MEDIA/";

    $aUser = new User();

    
    //mets limage de profil dans un dossier dans media (le dossier cest PP) et le nome : $idUser 
    $media_file_type = pathinfo($_FILES["newImg"]["name"],PATHINFO_EXTENSION);

    //si on enleve ca ca explose
   
    var_dump($media_file_type) ;

    $img_extensions_arr = array("jpg","jpeg","png","gif");
    $vid_extensions_arr = array("webm", "avi", "wmv", "rm", "rmvb", "mp4", "mpeg");

    if(in_array($media_file_type, $img_extensions_arr)){
        $type = "image";
        echo "image";
    }
    //ici quon modifie si on veut des video en image profile
    else if(in_array($media_file_type, $vid_extensions_arr)){
        echo "INVALID FILE TYPE VIDEO IS NOT ACCEPTING";
        die();
    }
    else{
        
        
        echo "INVALID FILE TYPE";
        die();
    }

    //le path du folder PP
    $imagePath  =  "../MEDIA/PP/" .  $_SESSION["userEmail"] . "." .  $media_file_type;
    move_uploaded_file($_FILES['newImg']['tmp_name'],$imagePath);
    //mets le path de PP dans une session

    //validateLogin
    header("Location: ../billboard.php");
    die();
