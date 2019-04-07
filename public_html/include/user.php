<?php
    class user
    {
        private $con;
        function __construct()
        {
            include_once("../database/db.php");
            $db = new Database();
            $this->con = $db->connect();

        }

        private function emailExist($email){

            $pre_st = $this->con->prepare("SELECT id FROM user WHERE email = ?");
            $pre_st->bind_param("s",$email);
            $pre_st->execute() or die($this->con->error);
            $result = $pre_st->get_result();

            if($result->num_rows >0){
                return 1;
            }else{
                return 0;
            }
        }
        public function userCreateAccount($userName,$email,$password,$type){

            if($this->emailExist($email)){

                return "ALREADY EXISTS";
            }else{
                $pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost-"=>8]); 
                $date = date("Y-m-d");
                $notes ="";
                $pre_st = $this->con->prepare("INSERT INTO `user`(`name`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES (?,?,?,?,?,?,?)");
                $pre_st->bind_param("sssssss",$userName,$email,$pass_hash,$type,$date,$date,$notes);
                $result = $pre_st->execute() or die($this->con->error);

                if($result){
                    return $this->con->insert_id;
                }else{
                    return "ERROR";
                }
            }

        }

        public function userLogin($email,$password){

            $date = date("Y-m-d");
          
            $pre_st = $this->con->prepare("SELECT * FROM user WHERE email = ?");
            $pre_st->bind_param("s",$email);
            $result = $pre_st->execute() or die($this->con->error);
            $result = $pre_st->get_result();
            if($result->num_rows<1){
                return "NO REGISTER";
            }else{
                $row = $result->fetch_assoc();
                if(password_verify($password,$row["password"])){
                    $_SESSION["userid"] = $row["id"];
                    $_SESSION["username"] = $row["name"];
                    $_SESSION["last_login"] = $row["last_login"];

                    $last_login = date("Y-m-d h:m:s");
                    $pre_st = $this->con->prepare("UPDATE user SET last_login = ? WHERE email = ? ");
                    $pre_st->bind_param("ss",$last_login,$email);

                    $result = $pre_st->execute() or die($this->con->error);

                    if($result){
                        return "LOGIN COMLEATE";
                    }else{
                        return "CONNECTION ERROR";
                    }
                }else{
                    return "PASSWORD_NOT_MATCH";
                }

            }

        }
    }
    
// $obj = new user();
// //echo $obj->userCreateAccount("test","test@gmail.com","12345","Admin");
// echo $obj->userLogin("test@gmail.com","12345");
// echo $_SESSION["username"];
?>