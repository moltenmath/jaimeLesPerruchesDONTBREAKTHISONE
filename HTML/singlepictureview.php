<?php
    include "./CLASSES/MEDIACOMMENTS/mediacomment.php";
    
    $postID = $_GET["mediaID"];
    
    $media = new Media();
    
    $media->load_media_by_id($postID);

    $media->display();

    $mediaComment = new MediaComment();

    echo "<h3>Comments:</h3>";

    $mediacomment_arr = $mediaComment->create_mediacomment_list($postID);
    foreach ($mediacomment_arr as $mediacomment_inst) {
        $mediacomment_inst->display();
    }


?>