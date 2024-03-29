<?php
include_once __DIR__ . "/userTDG.PHP";

class User{

    private $id;
    private $email;
    private $username;
    private $password;
    private $PP_URL;

    /*
        utile si on utilise un factory pattern
    */
    public function __construct(){
        //$this->id = $id;
        //$this->email = $email;
        //$this->username = $username;
        //$this->password = $password;
        //$this->TDG = new UserTDG;
    }


    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_email(){
        return $this->email;
    }

    public function get_username(){
        return $this->username;
    }

    public function get_password(){
        return $this->password;
    }
    
    public function get_PP_URL(){
        return $this->PP_URL;
    }

    //setters
    private function set_id($id){
        $this->id = $id;
    }
    public function set_email($email){
        $this->email = $email;
    }

    public function set_username($username){
        $this->username = $username;
    }

    public function set_password($password){
        $this->password = $password;
    }

    public function set_PP_URL($PP_URL){
        $this->PP_URL = $PP_URL;
    }

    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function load_user($email){
        $TDG = new UserTDG();
        $res = $TDG->get_by_email($email);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->password = $res['password'];
        $this->PP_URL = $res['PP_URL'];
                
        $TDG = null;
        return true;
    }

    public function load_user_id($id){
        $TDG = new UserTDG();
        $res = $TDG->get_by_id($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->password = $res['password'];
        $this->PP_URL = $res['PP_URL'];

        $TDG = null;
        return true;
    }
    


    //Login Validation
    public function Login($email, $pw){

        // Regarde si l'utilisateur existes deja
        if(!$this->load_user($email))
        {
            return false;
        }

        // Regarde si le password est verifiable
        if(!password_verify($pw, $this->password))
        {
            return false;
        }

        return true;
    }

    //Register Validation
    public function validate_email_not_exists($email){
        $TDG = new UserTDG();
        $res = $TDG->get_by_email($email);
        $TDG = null;
        if($res)
        {
            return false;
        }

        return true;
    }

    public function register($email, $username, $pw, $vpw,$pp){

        //check is both password are equals
        if(!($pw === $vpw) || empty($pw) || empty($vpw))
        {
            return false;
        }

        //check if email is used
        if(!$this->validate_email_not_exists($email))
        {
            return false;
        }

        //add user to DB
        $TDG = new UserTDG();
        //ADD PROFILE PIC URL STEPHANE
        $res = $TDG->add_user($email, $username, password_hash($pw, PASSWORD_DEFAULT),$pp);
        $TDG = null;
        return true;
    }

    public function update_user_info($email, $newmail, $newname){

        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }

        if(empty($this->id) || empty($newmail) || empty($newname)){
          return false;
        }

        //check if email is already used
        if(!$this->validate_email_not_exists($newmail) && $email != $newmail)
        {
            return false;
        }

        $this->email = $newmail;
        $this->username = $newname;

        $TDG = new UserTDG();
        $res = $TDG->update_info($this->email, $this->username, $this->id);

        if($res){
          $_SESSION["userName"] = $this->username;
          $_SESSION["userEmail"] = $this->email;
        }

        $TDG = null;
        return $res;
    }

    /*
      @var: current $email, oldpw, new pw, newpw validation
    */
    public function update_user_pw($email, $oldpw, $pw, $pwv){

        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }

        //check if passed param are valids
        if(empty($pw) || $pw != $pwv){
          return false;
        }

        //verify password
        if(!password_verify($oldpw, $this->password))
        {
            return false;
        }

        //create TDG and update to new hash
        $TDG = new UserTDG();
        $NHP = password_hash($pw, PASSWORD_DEFAULT);
        $res = $TDG->update_password($NHP, $this->id);
        $this->password = $NHP;
        $TDG = null;
        //only return true if update_user_pw returned true
        return $res;
    }

    // Profile Picture

    public function update_picture($email,$pp){

        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }
        //create TDG
        $TDG = new UserTDG();
        $res = $TDG->update_picture($pp, $this->id);
        $TDG = null;
        //only return true if update_picture returned true
        return $res;
    }

    
    public static function get_username_by_ID($id){
        $TDG = new UserTDG();
        $res = $TDG->get_by_id($id);
        $TDG = null;
        return $res["username"];
    }

    public static function search_user($name){
        $TDG = new UserTDG();
        $res = $TDG->search_user($name);
        $TDG = null;
        $res = User::arr_to_user($res);
        return $res;
        
    }

    public static function arr_to_user($arr)
    {
        $obj_arr = array();
        foreach ($arr as $res) {
            $temp = new User();
            $temp->set_id($res['id']);
            $temp->set_email($res['email']);
            $temp->set_username( $res['username']);
            $temp->set_password( $res['password']);
            $temp->set_PP_URL($res['PP_URL']);
            array_push($obj_arr,$temp);
        }
        return $obj_arr;
    }

    public function display_user()
    {
        $username = $this->username;
  
        echo "<div class='card bg-dark mb-4'>";
        echo "<div style='color:white' class='card-header text-left '>$username";
        echo "</div>";
        echo "</div>";
    }
}