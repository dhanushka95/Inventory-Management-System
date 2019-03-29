<?php

class Database{

    private $con;

    public function connect(){

        include_once("constant.php");
        $this->con =new Mysqli(HOST,USER,PASSWORD,DATABASE);

        if($this->con){
           
            return $this->con;
        }
        return "Database connection fail";
    }


}

// $db = new Database();
// $db->connect();

?>