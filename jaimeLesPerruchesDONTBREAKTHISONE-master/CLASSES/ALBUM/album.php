<?php

include_once __DIR__ . "/albumTDG.php";
include_once __DIR__ . "/../POSTS/post.php";

class Album{

    private $id;
    private $title;
    private $posts;

    public function __construct(){
      $this->posts = array();
    }

    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_title(){
        return $this->title;
    }

    public function get_posts(){
        return $this->posts;
    }


    //setters
    public function set_id($id){
        $this->id = $id;
    }

    public function set_title($title){
        $this->title = $title;
    }

    public function set_posts($posts){
        $this->posts = $posts;
    }


    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function load_album_by_id($id){
        $TDG = new AlbumTDG();
        $res = $TDG->get_by_ID($id);

        if(!$res){
            return false;
        }

        $this->id = $res["id"];
        $this->title = $res["title"];

        return true;
    }

    public function load_album_by_title($title){
        $TDG = new AlbumTDG();
        $res = $TDG->get_by_title($title);

        if(!$res){
            return false;
        }

        $this->id = $res["id"];
        $this->title = $res["title"];

        return true;
    }


    public function add_album($title){
        $TDG = new AlbumTDG();
        $res = $TDG->add_album($title);
        $TDG = null;
        if(!$res)
        {
            return $res;
        }
        return $res;
    }

    public function display_album(){
        $title = $this->title;
        $id = $this->id;
  
        echo "<div class='card bg-dark mb-4'>";
        echo "<div class='card-header text-left '><a href='displayalbum.php?albumID=$id&albumTitle=$title'><h5>$title</h5></a>";
        echo "</div>";
        echo "</div>";
    }

    /*
    Post related functions
    */
    public function load_posts(){
        $res = Post::create_post_list($this->id);

        if(!$res)
        {
            return false;
        }

        $this->posts = $res;
    }

    public function display_posts(){
        if(empty($this->posts)){
            $this->load_posts();
        }

        if(empty($this->posts))
        {
            echo "<h3 class='mb-4'>No Post found in this album</h3>";
        }
        else{

            foreach($this->posts as $posts => $post){
                $post->display();
              }
        }
    }

    /*
    STATIC FUNCTIONS
    */
    private static function list_all_albums(){
        $TDG = new AlbumTDG();
        $res = $TDG->get_all_albums();
        $TDG = null;
        if(!$res)
        {
          return $res;
        }
        return $res;
    }

    public static function create_album_list(){
        $TDG_res = Album::list_all_albums();
        $album_list = array();

        foreach($TDG_res as $r){
            $album = new Album();
            $album->set_id($r["id"]);
            $album->set_title($r["title"]);
            array_push($album_list, $album);
        }

        return $album_list;
    }

    public static function search_album($title){
        $TDG = new AlbumTDG();
        $res = $TDG->search_album_title_like($title);
        $album_list = array();

        foreach($res as $r){
            $album = new Album();
            $album->set_id($r["id"]);
            $album->set_title($r["title"]);
            array_push($album_list, $album);
        }
        
        return $album_list;
    }

}
