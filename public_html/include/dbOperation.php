<?php

class DatabaseOperation 
{
    private $con;
    function __construct(){

            include_once("../database/db.php");

            $db = new Database();
            $this->con =  $db->connect();
 

    }

    public function addCategory($parent,$cat){
        $status =1;
        $pre_st = $this->con->prepare("INSERT INTO `category`(`parent_cat`, `category_name`, `status`) VALUES (?,?,?)");
        $pre_st->bind_param("isi",$parent,$cat,$status);
        $result = $pre_st->execute() or die($this->con->error);

        if($result){
            return "CATEGORY_IS_ADD";
        }else{
            return 0;
        }

    }

    public function getAllRecord($table){

        $pre_st = $this->con->prepare("SELECT * FROM ".$table);
        $result = $pre_st->execute() or die($this->con->error);
        $result = $pre_st->get_result();
        $rows = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                    $rows[] = $row;

            }
            return $rows;
        }
        return "NO_DATA";

    }

    //add brand

    public function addBrand($brand_name){
        $status =1;
        $pre_st = $this->con->prepare("INSERT INTO `brand`(`brand_name`, `status`) VALUES (?,?)");
        $pre_st->bind_param("ss",$brand_name,$status);
        $result = $pre_st->execute() or die($this->con->error);

        if($result){
            return "BRAND_IS_ADD";
        }else{
            return 0;
        }

    }

      //add product

      public function addProduct($cid,$bid,$product_name,$price,$stock,$date){
        $status =1;
        $pre_st = $this->con->prepare("INSERT INTO `products`(`cid`, `bid`, `product_name`, `product_price`, `product_stock`,`minimum_qty`, `added_date`, `p_status`) VALUES (?,?,?,?,0,?,?,?)");
        $pre_st->bind_param("iisdisi",$cid,$bid,$product_name,$price,$stock,$date,$status);
        $result = $pre_st->execute() or die($this->con->error);

        if($result){
            return "PRODUCT_IS_ADD";
        }else{
            return 0;
        }

    }

    public function getProductRecord($cid,$bid){
        $pre_st = $this->con->prepare("SELECT * FROM products WHERE cid = ".$cid." AND bid = ".$bid);
        $result = $pre_st->execute() or die($this->con->error);
        $result = $pre_st->get_result();
        $rows = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                    $rows[] = $row;

            }
            return $rows;
        }
        return "NO_DATA";

    }

     //add Items

     public function addItems($barcode,$sdate,$pid,$getPrice,$itemsQuantity,$itemsGrn,$expDate){
        $status =1;
        $pre_st = $this->con->prepare("INSERT INTO `item`(`barcode`, `pid`, `invoice_no`,`stock_date` ,`get_price`, `exp_date`,`i_status`, `i_qty`) VALUES (?,?,?,?,?,?,1,?)");
        $pre_st->bind_param("sissdsi",$barcode,$pid,$itemsGrn,$sdate,$getPrice,$expDate,$itemsQuantity);
        $result = $pre_st->execute() or die($this->con->error);

        if($result){
            return "ITEMS_IS_ADD";
        }else{
            return 0;
        }

    }

    
}

// $opr = new DatabaseOperation();
// echo $opr->addItems("21222","2015-10-10",8,10000.00,100,"fefe1213","2019-12-10");
// echo "<pre>";
// print_r($opr->getProductRecord(21,8));
?>