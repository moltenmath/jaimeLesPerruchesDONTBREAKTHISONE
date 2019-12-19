<?php
    
    
    $postID = $_GET["mediaID"];
    
    $media = new Media();
    
    $media->load_media_by_id($postID);

    $media->display();


?>