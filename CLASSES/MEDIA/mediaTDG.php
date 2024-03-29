<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class mediaTDG extends DBAO{

    private $tableName;
    private static $instance = null;

    function __construct(){
        Parent::__construct();
        $this->tableName = "media";
    }
 
    public static function get_instance(){
        if(is_null(self::$instance)){
            self::$instance = new mediaTDG();
        }
        return self::$instance;
    }

    public function add_media($type, $url, $title, $albumID, $authorID, $description){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (type, URL, title, authorID, albumID, description) VALUES (:type, :URL, :title, :authorID, :albumID, :description)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':URL', $url);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':albumID', $albumID);
            $stmt->bindParam(':authorID', $authorID);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            $resp = true;
        }

        catch(PDOException $e)
        {
            $resp =  false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }

    public function get_all_media(){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM media";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            return false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function get_by_albumID($albumID){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM " . $this->tableName . " WHERE albumID = " . $albumID;
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            return false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function get_by_id($id){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM ". $this->tableName ." WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function get_by_url($url){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM ". $this->tableName ." WHERE URL=:url";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':url', $url);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function rm_media_by_albumID($albumID){

        try{
            $conn = $this->connect();
            $tableName = "media";
            $query = "DELETE FROM $tableName WHERE albumID = :albumID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':albumID', $albumID);
            $stmt->execute();
            $res = true;
        }
        catch(PDOException $e)
        {
            $res = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $res;
    }

    public function rm_media_by_mediaID($mediaID){

        try{
            $conn = $this->connect();
            $tableName = "media";
            $query = "DELETE FROM $tableName WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $mediaID);
            $stmt->execute();
            $res = true;
        }
        catch(PDOException $e)
        {
            $res = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $res;
    }

    //pour la barre search
    public function search_media($rechercher)
    {
        try{
            $conn = $this->connect();
            $query = "SELECT * FROM ". $this->tableName ." WHERE title LIKE :rechercher";
            $stmt = $conn->prepare($query);
            $rechercher = '%'.$rechercher.'%';
            $stmt->bindParam(':rechercher', $rechercher);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;

    }
}