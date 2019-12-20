<?php
    include "mediacommentTDG.php";

    class MediaComment{

        private $id;
        private $comment;
        private $userID;
        private $mediaID;
        private $timeStamp;

        /*
        public function __construct($id, $authorID, $threadID, $content){
            $this->id = $id;
            $this->authorID = $authorID;
            $this->threadID = $threadID;
            $this->content = $content;
        }
        */

        //getters
        public function get_id(){
            return $this->id;
        }

        public function get_comment(){
            return $this->comment;
        }

        public function get_userID(){
            return $this->userID;
        }

        public function get_mediaID(){
            return $this->mediaID;
        }

        public function get_timeStamp(){
            return $this->timeStamp;
        }

        //setters
        public function set_id($id){
            $this->id = $id;
        }

        public function set_comment($comment){
            $this->comment = $comment;
        }

        public function set_userID($userID){
            $this->userID = $userID;
        }

        public function set_mediaID($mediaID){
            $this->mediaID = $mediaID;
        }
        public function set_timestamp($timestamp){
            $this->timeStamp = $timestamp;
        }

        public function add_comment($comment, $mediaID, $userID)
        {
            $mediaCommentTDG = mediaCommentTDG::get_instance();
            
            $mediaCommentTDG->add_comment($comment, $userID, $mediaID);

        }

        public function display(){
            $id = $this->id;
            $comment = $this->comment;
            $userID = $this->userID;
            $mediaID = $this->mediaID;
            $timeStamp = $this->timeStamp;
            include "./TEMPLATES/mediacommenttemplate.php";
        }
        public static function create_mediacomment_list($mediaID){

            $TDG = mediacommentTDG::get_instance();
    
            $info_array=$TDG->get_by_media_ID($mediaID);
            $media_list = array();
    
            foreach($info_array as $ia){
    
                $temp_media = new MediaComment();
                $temp_media->set_id($ia["id"]);
                
                
                array_push($media_list, $temp_media);
            }
    
            return $media_list;
        }

        public function load_mediacomment_by_id($id)
        {
            $TDG = new mediacommentTDG();
            $res = $TDG->get_by_ID($id);

            $TDG = null;
            $this->set_id($res["id"]);
            $this->set_comment($res["comment"]);
            $this->set_userID($res["userID"]);
            $this->set_mediaID($res["mediaID"]);
            $this->set_timestamp($res["timeStamp"]);
            return $res;
        }

        
        public static function remove_mediacomment_by_id($commentID)
        {
            $TDG = mediaCommentTDG::get_instance();

            $TDG->delete_Comment($commentID);

        }     

    }

?>
