<?php
class sms{

public function sendSms($phone,$pass){
                $user = "xxxxxxxx";
                $password = "xxxx";
                $msg = "Inventory Management System \r\n Don't share This code \r\n Yor Password is ".$pass ;
                $text = urlencode($msg);
                $to = $phone;
                
                $baseurl ="http://www.textit.biz/sendmsg";
                $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
                $ret = file($url);
                
                $res= explode(":",$ret[0]);
                
                if (trim($res[0])=="OK")
                {
                echo "SEND";
                }
                else
                {
                echo $pass;
                }

                
    }
}


?>