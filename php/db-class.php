<?php

class Database
{
    
    public $conn = null;

    public function __construct() {

        $host = Credentials::$host;
        $dbname = Credentials::$dbname;
        $username = Credentials::$username;
        $password = Credentials::$password;

        $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    }

    public function Query($query) {

        try {

            $statement = $this->conn->query($query, PDO::FETCH_ASSOC);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (Exception $e) {
            
            echo var_dump($e);
            return false;
        }

    }

    public function GetAllNotifications() {

        $query = "SELECT * FROM Notifications ORDER BY ID DESC";
        $result = $this->Query($query);
        return $result;

    }

    public function GetHistoryForUser($userID) {

        $tables = ["GraphicDesignProjects", "InstagramContentProjects", 
        "LogoDesignProjects", "PhotographyProjects", "VideographyProjects", "WebDesignProjects"];

        $result = [];
        foreach ($tables as $key => $value) {

            $query = "SELECT * FROM $value WHERE USERID = ?";
            $result[$value] = $this->PreparedStatement($query, [$userID]);
        }

        return $result;

    }

    public function PreparedStatement($query, $params) {

        try {
            
            $statement = $this->conn->prepare($query);
            $statement->execute($params);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (Exception $e) {
            
            echo var_dump($e);
            return false;
        }

    }

}


?>