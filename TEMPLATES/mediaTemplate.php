<div class="Container">
    
    <?php         
        //get's the file extension to distinguish between video and images
        $ext = pathinfo($url ,PATHINFO_EXTENSION);

        $media = new Media();

        $media->load_media_by_id($id);

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
        echo "<h5 class='card-title'><a href='./singlepicture.php?mediaID=" . $id . "'>" . $title . "</a></h5>";
        //displays username 
        echo "<a href='' class='card-text'>Uploaded by: ";
        $user = new User();
        $user->load_user_id($authorID);
        echo $user->get_username();

        echo "</a>";
        echo "<p>Uploaded on: " . $media->get_timeStamp() . "</p>";

        echo "<div style='align:center; display:inline-block'>";


        echo "<div class='row'>";

        if(isset($_SESSION["userID"]))
        {
            if($_SESSION["userID"] == $authorID)
            {
                //method is set to post so taht it doesn't erase my DIY get variable lol
                echo    "<div class='col-xs-6'>
                            <form action='./DOMAINLOGIC/deletepost.dom.php?mediaID=" . $id ."' method='POST'>
                                <button>Delete Media</button>
                            </form>
                        </div>";

            }
        }

        echo "<div class='col-xs-6'>
                <form action='./comment.php?mediaID' method='POST'>
                    <button>Comment on post</button>
                </form>
                </div>
        </div>";
        
        echo "</div>";
        
        echo "</div>";

        echo "</div>";
    ?>
</div>