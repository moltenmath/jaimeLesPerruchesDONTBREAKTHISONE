<?php
    include "./CLASSES/USER/user.php";
    include "./CLASSES/ALBUM/album.php";
    include "./CLASSES/MEDIA/media.php";
    $userListe = User::search_user($_GET["search"]);
    $albumListe = Album::search_album($_GET["search"]);
    $mediaListe = Media::search_media($_GET["search"]);


  echo "<h1 class="my-4">Search results for user:</h1>";

  foreach($userListe as $user){
    $user->display_user();
  }



  echo "<h1 class="my-4">Search results for album:</h1>";

  foreach($albumListe as $album){
    $user->display_album();
  }



  echo "<h1 class="my-4">Search results for media:</h1>";

  foreach($mediaListe as $media){
    $media->display();
  }
?>