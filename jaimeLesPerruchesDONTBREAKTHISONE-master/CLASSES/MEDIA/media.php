<?php

include_once __DIR__ . "/mediaTDG.php";

class Media
{

    private $id;
    private $type;
    private $URL;
    private $title;
    private $authorID;
    private $albumID;

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



    public function __construct($id, $type, $URL, $title)
    {
        $this->id = $id;
        $this->type = $type;
        $this->URL = $URL;
        $this->title = $title;
    }

    public function display()
    {
        $id = $this->id;
        $type = $this->type;
        $url = $this->URL;
        $title = $this->title;
        include __DIR__ . "/../Templates/mediaTemplate.php";
    }

    public static function create_entry($type, $url, $title)
    {
        $TDG = mediaTDG::get_instance();
        $res = $TDG->add_media($type, $url, $title);
        return $res;
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
        $this->set_albumID($res["threadID"]);
        $this->set_URL($res["URL"]);

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
}
