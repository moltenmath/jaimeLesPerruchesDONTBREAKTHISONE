<?php
    include "../CLASSES/USER/user.php";
    include "../UTILS/formvalidator.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(validate_session()){
        header("Location: ../error.php?ErrorMSG=Already%20logged!");
        die();
    }

    //prendre les variables du Post
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pw = $_POST["pw"];
    $pwv = $_POST["pwValidation"];
    $pp  = $_POST["profilePic"];
    //si on enleve ca ca explose
    var_dump($_FILES);
    //Validation Posts
    if(!Validator::validate_email($email) || !Validator::validate_password($pw))
    {
        http_response_code(400);
        header("Location: ../error.php?ErrorMSG=invalid email or password");
        die();
    }

    $aUser = new User();

    
    //mets limage de profil dans un dossier dans media (le dossier cest PP) et le nome : $idUser 
    $media_file_type = pathinfo($_FILES["profilePic"]["name"],PATHINFO_EXTENSION);

    //si on enleve ca ca explose
    echo $pp;
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
    $imagePath  =  "../MEDIA/PP/" .  $email . "." .  $media_file_type;
    move_uploaded_file($_FILES['profilePic']['tmp_name'],$imagePath);
    //mets le path de PP dans une session
    $_SESSION["file"] = $imagePath;
    //validateLogin
    if(!$aUser->register($email, $username, $pw, $pwv,$imagePath))
    {
        http_response_code(400);
        header("Location: ../error.php?ErrorMSG=invalid email or password");
        die();
    }
    header("Location: ../login.php");
    die();
?>
