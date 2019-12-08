<?php
    include "CLASSES/ALBUM/album.php";
    $album = new Album();
    $album->load_album_by_id($_GET["albumID"]);
    $album->load_media();

?>

<h3 class="mb-4"><?php echo $_GET["albumTitle"]; ?></h3>

<?php $album->display_album(); ?>
