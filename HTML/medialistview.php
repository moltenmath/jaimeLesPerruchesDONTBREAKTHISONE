<?php
    include "CLASSES/ALBUM/album.php";
    $album = new Album();
    $album->load_album_by_id($_GET["albumID"]);
    $album->load_media();

?>

<h3 class="mb-4"><?php echo $_GET["albumTitle"]; ?></h3>

<?php 
include_once "CLASSES/MEDIA/media.php";

$mediaInstance = new Media();

$media_arr = $mediaInstance->create_media_list($_GET["albumID"]);
foreach ($media_arr as $media) {
    $media->display();
}

?>
