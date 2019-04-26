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
        public function userCreateAccount($userName,$email,$password,$type,$phone){

            if($this->emailExist($email)){

                return "ALREADY EXISTS";
            }else{
                $pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost-"=>8]); 
                $date = date("Y-m-d");
                $notes ="";
                $pre_st = $this->con->prepare("INSERT INTO `user`(`name`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`, `phone_no`) VALUES (?,?,?,?,?,?,?,?)");
                $pre_st->bind_param("ssssssss",$userName,$email,$pass_hash,$type,$date,$date,$notes,$phone);
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

                    $_SESSION["uid"] = $row["id"];
                    $_SESSION["username"] = $row["name"];
                    $_SESSION["last_login"] = $row["last_login"];
                    $_SESSION["usertype"] = $row["usertype"];

                    $last_login = date("Y-m-d H:i:s");
                    
                    $pre_stl = $this->con->prepare("UPDATE user SET last_login = ? WHERE email = ? ");
                    $pre_stl->bind_param("ss",$last_login,$email);

                    $result = $pre_stl->execute() or die($this->con->error);

                    if($result){
                        return "LOGIN_COMPLETE";
                    }else{
                        return "CONNECTION ERROR";
                    }
                }else{
                    return "PASSWORD_NOT_MATCH";
                }

            }

        }

        public function UpdateUser($userName,$userId,$newP,$currentp,$phone){

            if($newP !=null){

               
                $pre_st = $this->con->prepare("SELECT * FROM user WHERE id = ?");
                $pre_st->bind_param("i",$userId);
                $result = $pre_st->execute() or die($this->con->error);
                $result = $pre_st->get_result();
                if($result->num_rows<1){
                    return "NO REGISTER";
                }else{
                    if($currentp !=null){
                                $row = $result->fetch_assoc();
                                if(password_verify($currentp,$row["password"])){

                                    $p_hash = password_hash($newP,PASSWORD_BCRYPT,["cost-"=>8]); 

                                    $sql="UPDATE user SET name = ? , phone_no = ? , password = ? WHERE id = ?"; 
                                    $pre_st = $this->con->prepare($sql);
                                    $pre_st->bind_param("sssi",$userName,$phone,$p_hash,$userId);
                                    $result = $pre_st->execute() or die($this->con->error);
                                    if($result){
                                        return "UPDATE_USER";
                                    }else{
                                    return "CANT_UPDATE_USER";
                                    }
                                    
                                }else{
                                    return "PASSWORD NOT MATCH";
                                }
                   }


                }

            }else{
               $sql="UPDATE user SET name = ? , phone_no =?  WHERE id = ?"; 
               $pre_st = $this->con->prepare($sql);
               $pre_st->bind_param("ssi",$userName,$phone,$userId);
               $result = $pre_st->execute() or die($this->con->error);
               if($result){
                   return "UPDATE_USER";
               }else{
               return "CANT_UPDATE_USER";
               }
            }

   
        }

        public function EToPP($email){

            $phone="";
            $i = 0;
            $pin = ""; 

            while($i < 4){
                //generate a random number between 0 and 9.
                $pin .= mt_rand(0, 9);
                $i++;
            }

            $pinHash = password_hash($pin,PASSWORD_BCRYPT,["cost-"=>8]);

            $pre_st = $this->con->prepare("SELECT phone_no FROM user WHERE email = ?");
            $pre_st->bind_param("s",$email);
            $pre_st->execute() or die($this->con->error);
            $result = $pre_st->get_result();

            if($result->num_rows >0){

                $row = $result->fetch_assoc();
                $phone =$row["phone_no"];

                $sql="UPDATE user SET password = ? WHERE email = ?"; 
                $pre_st = $this->con->prepare($sql);
                $pre_st->bind_param("ss",$pinHash,$email);
                $result = $pre_st->execute() or die($this->con->error);
                if($result){
                    return $phone.",".$pin;
                }else{
                return "Error";
                }

            }else{
                
            }


        }
    }
    
//$obj = new user();
// //echo $obj->userCreateAccount("test","test@gmail.com","12345","Admin");
//echo $obj->EToPP("dayawansha@gmail.com");
// echo $_SESSION["username"];
?>