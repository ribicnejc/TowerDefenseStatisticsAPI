<?php
include '../config/config.php';



$db = $config["db"]["dbTest"];
//$db = $config["db"]["dbRelease"];
$con = new mysqli($db["host"], $db["username"], $db["password"], $db["dbname"]);

$link = mysqli_connect($db["host"], $db["username"], $db["password"], $db["dbname"]);
mysqli_set_charset($link, 'utf8');

class Database{
    private $host = "localhost";
    private $db_name = "towerdefense";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}