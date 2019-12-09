<?php

    $mediaInstance = new Media();

    $media_arr = $mediaInstance->create_media_list($_GET["albumID"]);
    foreach ($media_arr as $media) {
        $media->display();
    }

?>
