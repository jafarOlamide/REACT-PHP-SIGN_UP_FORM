<?php

class User {
    public $id;
    public $user_name;
    public $user_email;
    public $user_password;

    private $conn;
    private $table_name = "added_users";

    public function __construct($db){
        $this->conn = $db;
    }
    public function add_user(){
        $i_query = "INSERT INTO " . $this->table_name .
                    " (user_name, user_email, user_password )
                    VALUES (:user_name, :user_email, :user_password)";

        $insert_query = $this->conn->prepare($i_query);

        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $this->user_password = password_hash($this->user_password,  PASSWORD_BCRYPT);

        $insert_query->bindParam(":user_name", $this->user_name);
        $insert_query->bindParam(":user_email", $this->user_email);
        $insert_query->bindParam(":user_password", $this->user_password);

        if ($insert_query->execute()) {
            return true;    
        } else{
            return false;
        }
    }
}
?>