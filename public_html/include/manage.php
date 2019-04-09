<?php

class Manage{

    private $con;
function __construct(){

    include_once("../database/db.php");

    $db = new Database();
    $this->con =  $db->connect();

}
    public function ManagePagination($table,$pageNumber){
        $b = $this->pagination($this->con,$table,$pageNumber,5);
        if($table == "category"){
            $sql = "SELECT p.category_name AS category,c.category_name AS parent,p.status ,p.cid FROM category p LEFT JOIN category c ON p.parent_cat=c.cid ".$b["limit"];
        }else if($table == "products"){
            $sql ="SELECT p.pid,p.product_name,c.category_name,b.brand_name,p.product_price,p.product_stock,p.added_date,p.p_status FROM products p, brand b, category c WHERE p.bid=b.bid AND p.cid=c.cid  ".$b["limit"];
        }
        else{
            $sql ="SELECT * FROM ".$table. " ".$b["limit"];
        }

        $result = $this->con->query($sql);
        $rows = array();
        if($result->num_rows >0){

            while($row = $result->fetch_assoc()){
                $rows[] = $row;

            }

        }

        return ["rows"=>$rows,"pagination"=>$b["pagination"]];

    }

    private function pagination($con,$table,$pno,$n){

        $query = $con->query("SELECT COUNT(*) AS rows FROM ".$table);
        $row = mysqli_fetch_assoc($query);
    // $totaRecord = 100000;
        $pageno =$pno;
        $numberOfRecordsperPage =$n;
        

        $last = ceil($row["rows"]/$numberOfRecordsperPage);
        
            $pagination="<ul class='pagination'>";
        if($last != 1){
            if($pageno>1){
                $privious="";
                $privious =$pageno -1;
                $pagination .="<li class='page-item'><a class='page-link' pn='".$privious."' href='#' style='color : #333;'> previous </a></li>";
            }
            
            for($i=$pageno -5 ;$i<$pageno;$i++){
                if($i>0){
                $pagination .="<li class='page-item'><a class='page-link' pn='".$i."'  href='#'> ".$i." </a></li>";
                }
            }

            $pagination .="<li class='page-item'><a class='page-link' pn='".$pageno."'  href='#' style='color : #333;'> $pageno</a></li>";

            for($i=$pageno+1;$i<=$last;$i++){
                $pagination .="<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
                if($i>$pageno+4){
                    break;
                }
            }

            if($last>$pageno){
                $nexxt =$pageno+1;
                $pagination .="<li class='page-item'><a class='page-link' pn='".$nexxt."'  href='#' style='color:#333;'>next</a></li></ul>"; 
            }
        }
    $limit ="LIMIT ".($pageno-1)*$numberOfRecordsperPage.",".$numberOfRecordsperPage;
    return ["pagination"=>$pagination,"limit"=>$limit];
    }

    
    public function deleteRecord($table,$id,$primaryKey){
        if($table =="category"){
            $pre_stmnt = $this->con->prepare("SELECT cid FROM category WHERE parent_cat=?");
            $pre_stmnt->bind_param("i",$id);
            $pre_stmnt->execute();
            $result = $pre_stmnt->get_result() or die($this->con->error);

            if($result->num_rows >0){
                    return "DEPENDENT CATEGORY";
            }else{
                    $pr_st = $this->con->prepare("DELETE FROM ".$table."  WHERE ".$primaryKey." = ? ");
                    $pr_st->bind_param("i",$id);
                    $result = $pr_st->execute() or die($this->con->error);

                    if($result){
                            return "CATEGORY_DELETED";
                    }

            }

        }else{
            $pr_st = $this->con->prepare("DELETE FROM ".$table."  WHERE ".$primaryKey." = ? ");
            $pr_st->bind_param("i",$id);
            $result = $pr_st->execute() or die($this->con->error);

            if($result){
                    return "DELETED";
            }
        }
        
    }

    public function getOneRow($table,$primaryKey,$id){
        $pre_stmnt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$primaryKey." = ? ");
        $pre_stmnt->bind_param("i",$id);
        $pre_stmnt->execute() or die($this->con->error);
        $result = $pre_stmnt->get_result();

        if($result->num_rows == 1){

            $row =$result->fetch_assoc();

        }
        return $row;
    }

    public function updateRecord($table,$where,$fields){

        $sql = "";
        $condition = "";

        foreach($where as $key => $value){
            $condition .= $key ."='".$value. "' AND ";


        }
        $condition = substr($condition,0,-5);
        foreach($fields as $key => $value){
            $sql .= $key ."='".$value. "', ";

        }
        $sql = substr($sql,0,-2);
        $sql ="UPDATE ".$table." SET ".$sql." WHERE ".$condition;

        if(mysqli_query($this->con,$sql)){

            return "UPDATE_COMPLETE";
        }



    }

    public function storeCustomerData($orderDate,$customerName,$arryQty,$arryTotalQty,$arryPrice,$arryProductId,$SubTotal,$Discount,$Toatal,$paid,$Due,$paymentType){

        $pre_stmnt = $this->con->prepare("INSERT INTO `invoice`( `customer_name`, `order_date`, `sub_total`, `discount`, `Total`, `paid`, `due`, `payment_type`) VALUES (?,?,?,?,?,?,?,?)");
        $pre_stmnt->bind_param("ssddddds",$customerName,$orderDate,$SubTotal,$Discount,$Toatal,$paid,$Due,$paymentType);
        $pre_stmnt->execute() or die($this->con->error);

        $invoiceNo = $pre_stmnt->insert_id;

        if($invoiceNo!= null){

            for($i = 0; $i < count($arryQty); $i++){

                $remainigQuantity = $arryTotalQty[$i] - $arryQty[$i];
                if($remainigQuantity < 0){

                    return "ORDER_FAIL_COMPLETE";
                }else{

                    $SQL = "UPDATE `products` SET `product_stock`='$remainigQuantity' WHERE pid= '".$arryProductId[$i]."'  ";
                    $this->con->query($SQL);
                }

                $inser_invoice_details = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`) VALUES (?,?,?,?)");
                $inser_invoice_details->bind_param("iddd",$invoiceNo,$arryProductId[$i],$arryPrice[$i],$arryQty[$i]);
                $inser_invoice_details->execute() or die($this->con->error);
            }


            return $invoiceNo;
        }


    }




}
//$obj = new Manage();
// // echo "<pre>";
// // //print_r($obj->ManagePagination("category",1));
// // echo $obj->deleteRecord("category",14,"cid");
// print_r($obj->getOneRow("category","cid",7));
//echo $obj->updateRecord("products",["pid"=>7],["cid"=>7,"bid"=>4,"product_name"=>"new1","product_price"=>"5000","product_stock"=>"35","added_date"=>"2019=4-25","p_status"=>1]);
?>