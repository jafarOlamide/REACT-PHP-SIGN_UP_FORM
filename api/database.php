<?php
class Database {
    public $conn;

    private $db_server = "";
    private $db_name =  "";
    private $db_user = "";
    private $db_password = "";

    public function getConnection(){
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->db_server . ";dbname=" . $this->db_name, $this->db_user, $this->db_password);      
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        return $this->conn;
    }

}
?>
