<?php

include_once __DIR__ . "/mediaTDG.php";
include_once __DIR__ . "/../USER/user.php";

class Media
{

    private $id;
    private $type;
    private $URL;
    private $title;
    private $authorID;
    private $albumID;
    private $timeStamp;
    private $description;

    //GET AND SET SOME DAMN MEDIA
    public function set_id($id)
    {
        $this->id = $id;
    }
    public function set_type($type)
    {
        $this->type = $type;
    }
    public function set_title($title)
    {
        $this->title = $title;
    }
    public function set_authorID($authorID)
    {
        $this->authorID = $authorID;
    }
    public function set_albumID($albumID)
    {
        $this->albumID = $albumID;
    }
    public function set_URL($URL)
    {
        $this->URL = $URL;
    }
    public function set_timeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }
    public function set_desc($description)
    {
        $this->description = $description;
    }
    //GET
    public function get_timeStamp(){
        return $this->timeStamp;
    }

    public function get_URL(){
        return $this->URL;
    }
    public function get_desc(){
        return $this->description;
    }


    public function __construct()
    {
    }

    public function display()
    {
        $id = $this->id;
        $type = $this->type;
        $url = $this->URL;
        $title = $this->title;
        $authorID = $this->authorID;
        $timeStamp = $this->timeStamp;

        include __DIR__ . "/../../Templates/mediaTemplate.php";

        
    }
    
    public static function create_entry($type, $url, $title, $albumID, $authorID, $description)
    {
        $TDG = mediaTDG::get_instance();
        $res = $TDG->add_media($type, $url, $title, $albumID, $authorID, $description);
        return $res;
    }

    public function get_by_media_URL($url)
    {
        $mediaTDG = new MediaTDG();

        return $mediaTDG->get_by_url($url);

    }

    public function load_media_by_id($id)
    {
        $TDG = new mediaTDG();
        $res = $TDG->get_by_ID($id);

        $res2 = User::get_username_by_ID($res["authorID"]);

        $TDG = null;
        $this->set_id($res["id"]);
        $this->set_type($res["type"]);
        $this->set_title($res["title"]);
        $this->set_authorID($res["authorID"]);
        $this->set_albumID($res["albumID"]);
        $this->set_URL($res["URL"]);
        $this->set_timeStamp($res["timeStamp"]);
        $this->set_desc($res["description"]);

        return $res;
    }

    public static function get_all_media()
    {
        $TDG = mediaTDG::get_instance();
        $res = $TDG->get_all_media();

        $obj_list = self::arr_to_obj($res);

        return $obj_list;
    }

    public static function arr_to_obj($arr)
    {
        $obj_arr = array();
        foreach ($arr as $k) {
            $temp_m = new Media($k["id"], $k["type"], $k["URL"], $k["title"]);
            array_push($obj_arr, $temp_m);
        }
        return $obj_arr;
    }

    public static function create_media_list($albumID){

        $TDG = mediaTDG::get_instance();

        $info_array=$TDG->get_by_albumID($albumID);
        $media_list = array();

        foreach($info_array as $ia){

            $res = User::get_username_by_ID($ia["authorID"]);
            $temp_media = new Media();
            $temp_media->set_id($ia["id"]);
            $temp_media->set_type($ia["type"]);
            $temp_media->set_title($ia["title"]);
            $temp_media->set_authorID($ia["authorID"]);
            $temp_media->set_albumID($ia["albumID"]);
            $temp_media->set_URL($ia["URL"]);
            $temp_media->set_timeStamp($ia["timeStamp"]);
            
            array_push($media_list, $temp_media);
        }

        return $media_list;
    }

    public function get_username_by_media_ID($mediaID)
    {
        $media = new Media();

        $tempRes = $media->load_media_by_id($mediaID);
       
        
        $res = User::get_username_by_ID($tempRes["authorID"]);
    }

    public static function remove_media_by_id($id)
    {
        $TDG = mediaTDG::get_instance();

        $TDG->rm_media_by_mediaID($id);

    }

    public static function search_media($recherche)
    {
        
        $TDG = mediaTDG::get_instance();
        $res = $TDG->search_media($recherche);
        $arrayMedia = [];
        foreach($media as $res)
        {
            $media = self::arr_to_obj($res);
            $arrayMedia += $media;
        }
        
        return $arrayMedia;
    }

}
