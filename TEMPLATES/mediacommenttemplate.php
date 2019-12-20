<?php
    $mediacomments = new MediaComment();

    $mediacomments->load_mediacomment_by_id($id);



    $username = User::get_username_by_ID($mediacomments->get_userID());


echo "<div class='card mt-4 mb-4' style='width: 30rem; align:center; display:inline-block; border-color:black'>
        <div class='card-body'>";
    
         echo $mediacomments->get_comment();
echo"   </div>
        <div class='card-body'>";

        echo "Commentateur: " . $username . "</div>";

    echo "</div>";

?>