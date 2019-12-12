<div class="Container">
    
    <?php         
        //get's the file extension to distinguish between video and images
        $ext = pathinfo($url ,PATHINFO_EXTENSION);

        echo "<div class='card mt-4 mb-4' style='width: 30rem; align:center; display:inline-block; border-color:black'>";

        if($type == "image"){
            echo "<img class='card-img-top' src='./MEDIA/$url' alt='$title#$id'>";
        }
        else if($type == "video"){
            echo "<video class='card-img-top' width='320' height='240' controls>
            <source src='$url' type='video/$ext'>
            </video>";
        }

        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $title . "</h5>";
        //displays username 
        echo "<p class='card-text'>Uploaded by: ";
        $user = new User();
        $user->load_user_id($authorID);
        echo $user->get_username();

        echo "</p>";
        echo "<p>Uploaded on: " . $_SESSION["lastTimeStamp"] . "</p>";
        
        echo "</div>";

        echo "</div>";
    ?>
</div>