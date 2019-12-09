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

    //Validation Posts
    if(!Validator::validate_email($email) || !Validator::validate_password($pw))
    {
        http_response_code(400);
        header("Location: ../error.php?ErrorMSG=invalid email or password");
        die();
    }

    $aUser = new User();

    //validateLogin
    if(!$aUser->register($email, $username, $pw, $pwv))
    {

       
        http_response_code(400);
        header("Location: ../error.php?ErrorMSG=invalid email or password");
        die();
    }
    $media_file_type = pathinfo($_FILES['Media']['name'] ,PATHINFO_EXTENSION);
    
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


    $imagePath  =  "../MEDIA/PP/" . $auser->get_id() .  $media_file_type;
    move_uploaded_file($_FILES['Media']['tmp_name'],$imagePath);
    
    $_SESSION["file"] = $imagePath;
    header("Location: ../login.php");
    die();
?>
