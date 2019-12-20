<?php
    include "../CLASSES/USER/user.php";
    include "../CLASSES/ALBUM/album.php";
    include "../CLASSES/MEDIA/media.php";
    $userListe = User::search_user($_GET["search"]);
    $albumListe = Album::search_album($_GET["search"]);
    $mediaListe = Media::search_media($_GET["search"]);
?>

<h1 class="my-4">Search results for user:</h1>
<?php
  foreach($userListe as $user){
    $user->display_user();
  }
?>


<h1 class="my-4">Search results for album:</h1>
<?php
  foreach($albumListe as $album){
    $user->display_album();
  }
?>


<h1 class="my-4">Search results for media:</h1>
<?php
  foreach($mediaListe as $media){
    $media->display();
  }
?>
