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
            $sql ="SELECT p.pid,p.product_name,c.category_name,b.brand_name,p.product_price,p.product_stock,p.minimum_qty,p.added_date,p.p_status FROM products p, brand b, category c WHERE p.bid=b.bid AND p.cid=c.cid  ".$b["limit"];
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
        $qu ="";
        if($table == "item"){
            $qu = "SELECT COUNT(*) AS rows FROM products p, item i WHERE p.pid = i.pid ";
        }else{
            $qu = "SELECT COUNT(*) AS rows FROM ".$table;
        }
        $query = $con->query($qu);
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

    public function updateStatusProduct($satatus,$pid){
        $sql = "";

        $pre_stmnt = $this->con->prepare("SELECT c.status FROM category c, products p WHERE p.cid=c.cid AND p.pid=?");
        $pre_stmnt->bind_param("i",$pid);
        $pre_stmnt->execute() or die($this->con->error);
        $result = $pre_stmnt->get_result();

        if($result->num_rows == 1){

            $row =$result->fetch_assoc();

        }

        $pre_stmnt1 = $this->con->prepare("SELECT b.status FROM brand b, products p WHERE p.bid=b.bid AND p.pid=?");
        $pre_stmnt1->bind_param("i",$pid);
        $pre_stmnt1->execute() or die($this->con->error);
        $result1 = $pre_stmnt1->get_result();

        if($result1->num_rows == 1){

            $rowBrand =$result1->fetch_assoc();

        }



        if($satatus == "ACTIVE"){

            if($row["status"] == 1){
                    if($rowBrand["status"] == 1){
                        $sql ="UPDATE products SET p_status = '1' WHERE pid =".$pid;
                    }else{
                        return "BRAND_IS_NOT_ACTIVE";
                    }

            }
            else{
                return "CATEGORY_IS_NOT_ACTIVE";
            }

        }else if($satatus == "DEACTIVE"){

            $sql ="UPDATE products p, item i SET p.p_status='0',i.i_status ='0' WHERE p.pid=i.pid AND p.pid=".$pid;
            
        }

        if(mysqli_query($this->con,$sql)){

            return "UPDATE_PRODUCT_STATUS";
        }

    }

    public function updateStatusCategory($satatus,$cid){
        $sqlC = "";
        
        if($satatus == "ACTIVE"){

            $sqlC ="UPDATE category SET status = '1' WHERE cid =".$cid;

            
        }else if($satatus == "DEACTIVE"){

            $sqlC = "UPDATE products p, category c,item i SET p.p_status='0',c.status ='0',i.i_status='0' WHERE c.cid=p.cid AND p.pid = i.pid AND c.cid=".$cid;
           
        }

        if(mysqli_query($this->con,$sqlC)){

            return "UPDATE_CATEGORY_STATUS";
        }


    }
    public function updateStatusBrand($satatus,$bid){
        $sqlB = "";
        

        if($satatus == "ACTIVE"){

            $sqlB ="UPDATE brand SET status = '1' WHERE bid =".$bid;

        
        }else if($satatus == "DEACTIVE"){

            $sqlB ="UPDATE products p, brand b ,item i SET p.p_status='0',b.status ='0',i.i_status='0' WHERE b.bid=p.bid AND p.pid=i.pid AND b.bid=".$bid;
            
            
        }

        if(mysqli_query($this->con,$sqlB)){

            return "UPDATE_BRAND_STATUS";
        }

    }

    public function storeCustomerData($orderDate,$customerName,$arryQty,$arryTotalQty,$arryPrice,$arryProductId,$SubTotal,$Discount,$Toatal,$paid,$Due,$paymentType,$arryBarcode){

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

                     $pre_stmnt_i = $this->con->prepare("SELECT i.i_qty FROM item i WHERE i.barcode= ? ");
                     $pre_stmnt_i->bind_param("s",$arryBarcode[$i]);
                     $pre_stmnt_i->execute() or die($this->con->error);
                     $resulti = $pre_stmnt_i->get_result();

                            if($resulti->num_rows == 1){

                                $rowi =$resulti->fetch_assoc();

                            }else{
                                $rowi = 0;
                            }
        
                    $remaningItemQty = $rowi["i_qty"]- $arryQty[$i];
                    $SQLItem = "UPDATE `item` SET `i_qty`='$remaningItemQty' WHERE barcode= '".$arryBarcode[$i]."'  ";
                    $this->con->query($SQLItem);


                    $SQL = "UPDATE `products` SET `product_stock`='$remainigQuantity' WHERE pid= '".$arryProductId[$i]."'  ";
                    $this->con->query($SQL);
                }

                $inser_invoice_details = $this->con->prepare("INSERT INTO `invoice_details`(`barcode`,`invoice_no`, `product_name`, `price`, `qty`) VALUES (?,?,?,?,?)");
                $inser_invoice_details->bind_param("siddd",$arryBarcode[$i],$invoiceNo,$arryProductId[$i],$arryPrice[$i],$arryQty[$i]);
                $inser_invoice_details->execute() or die($this->con->error);
            }


            return $invoiceNo;
        }


    }


    public function getBillDetails($billNo){

        $sql ="SELECT p.product_name,i.barcode,c.category_name,b.brand_name,i.qty,i.price,u.invoice_no FROM invoice_details i, products p, category c, brand b,item u WHERE i.product_name=p.pid AND p.bid=b.bid AND p.cid= c.cid AND u.barcode = i.barcode AND i.invoice_no=".$billNo;
        $result = $this->con->query($sql);
        $rows = array();
        if($result->num_rows >0){

            while($row = $result->fetch_assoc()){
                $rows[] = $row;

            }

        }
        return ["rows"=>$rows];
    }

    public function getBillOtheDetails($billNo){

        $row=null;
        $sql ="SELECT * FROM `invoice` WHERE invoice_no=".$billNo;
        $result = $this->con->query($sql);
        if($result->num_rows >0){

        $row = $result->fetch_assoc();
   

        }
        return $row;
    }

    public function ManageItemsPagination($Barcode,$pageNumber){
        

        if($Barcode == ""){
            $b = $this->Temppagination($this->con,"SELECT COUNT(*) AS rows FROM products p,category c, brand b,item i WHERE c.cid=p.cid AND b.bid = p.bid AND p.pid = i.pid",$pageNumber,5);
            $sql = "SELECT i.barcode,i.pid,i.invoice_no AS grn,i.get_price AS get_price ,i.exp_date,i.i_status,i.i_qty,c.category_name,b.brand_name,p.product_name As product_name  FROM products p,category c, brand b,item i WHERE c.cid=p.cid AND b.bid = p.bid AND p.pid = i.pid ".$b["limit"];
        }
        else{
            $b = $this->Temppagination($this->con,"SELECT COUNT(*) AS rows FROM products p,category c, brand b,item i WHERE c.cid=p.cid AND b.bid = p.bid AND p.pid = i.pid AND i.barcode ='".$Barcode."' ",$pageNumber,5);
            $sql = "SELECT i.barcode,i.pid,i.invoice_no AS grn,i.get_price AS get_price ,i.exp_date,i.i_status,i.i_qty,c.category_name,b.brand_name,p.product_name As product_name  FROM products p,category c, brand b,item i WHERE c.cid=p.cid AND b.bid = p.bid AND p.pid = i.pid AND i.barcode ='".$Barcode."' ".$b["limit"];
       
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

    public function updateStatusItem($satatus,$barcode){
        $sql = "";

        $pre_stmnt = $this->con->prepare("SELECT p.p_status FROM products p, item i WHERE p.pid=i.pid AND i.barcode=?");
        $pre_stmnt->bind_param("i",$barcode);
        $pre_stmnt->execute() or die($this->con->error);
        $result = $pre_stmnt->get_result();

        if($result->num_rows == 1){

            $row =$result->fetch_assoc();

        }

        if($satatus == "ACTIVE"){

            if($row["p_status"] == 1){

                $sql ="UPDATE item SET i_status = '1' WHERE barcode = '".$barcode."' ";
            }
            else{

            return "PRODUCT_IS_NOT_ACTIVE";
            }

            
            

        }
        else if($satatus == "DEACTIVE"){

            $sql ="UPDATE item SET i_status = '0' WHERE barcode = '".$barcode."' ";
        }

        if(mysqli_query($this->con,$sql)){

           return "UPDATE_ITEM_STATUS";
           
        }

    }
    public function getOneRowItems($barcode){
        $pre_stmnt = $this->con->prepare("SELECT i.invoice_no,i.get_price,i.exp_date,i.i_qty,p.product_name,p.product_stock,i.pid FROM item i,products p WHERE p.pid=i.pid AND i.barcode = ?");
        $pre_stmnt->bind_param("s",$barcode);
        $pre_stmnt->execute() or die($this->con->error);
        $result = $pre_stmnt->get_result();

        if($result->num_rows == 1){

            $row =$result->fetch_assoc();

        }
        return $row;
    }

    public function bToP($barcodeVal){

        $pre_stmnt = $this->con->prepare("SELECT i.pid FROM item i WHERE i.i_status = 1 AND i.barcode= ? ");
        $pre_stmnt->bind_param("s",$barcodeVal);
        $pre_stmnt->execute() or die($this->con->error);
        $result = $pre_stmnt->get_result();

        if($result->num_rows == 1){

            $row =$result->fetch_assoc();

        }else{
            $row = "Item Not Active";
        }
        return $row;
    }

    public function ManageProductPagination($name,$pageNumber){


        if($name == ""){

            $b = $this->Temppagination($this->con,"SELECT COUNT(*) AS rows FROM products p, brand b, category c WHERE p.bid=b.bid AND p.cid=c.cid",$pageNumber,5);
            $sql = "SELECT p.pid,p.product_name,c.category_name,b.brand_name,p.product_price,p.product_stock,p.minimum_qty,p.added_date,p.p_status FROM products p, brand b, category c WHERE p.bid=b.bid AND p.cid=c.cid ".$b["limit"];
        }
        else{
            $b = $this->Temppagination($this->con,"SELECT COUNT(*) AS rows FROM products p, brand b, category c WHERE p.bid=b.bid AND p.cid=c.cid AND p.product_name LIKE '".$name."%' ",$pageNumber,5);
            $sql = "SELECT p.pid,p.product_name,c.category_name,b.brand_name,p.product_price,p.product_stock,p.minimum_qty,p.added_date,p.p_status FROM products p, brand b, category c WHERE p.bid=b.bid AND p.cid=c.cid AND p.product_name LIKE '".$name."%' ".$b["limit"];
       
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

    private function Temppagination($con,$quary,$pno,$n){

        $query = $con->query($quary);
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

    public function ManageBrandPagination($name,$pageNumber){


        if($name == ""){

            $b = $this->Temppagination($this->con,"SELECT COUNT(*) AS rows FROM brand WHERE brand_name ",$pageNumber,5);
            $sql = "SELECT * FROM brand ".$b["limit"];
        }
        else{
            $b = $this->Temppagination($this->con,"SELECT COUNT(*) AS rows FROM brand WHERE brand_name LIKE '".$name."%'  ",$pageNumber,5);
            $sql = "SELECT * FROM brand WHERE brand_name LIKE '".$name."%' ".$b["limit"];
       
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

    public function ManageCategoryPagination($name,$pageNumber){


        if($name == ""){

            $b = $this->Temppagination($this->con,"SELECT COUNT(*) AS rows FROM category WHERE category_name ",$pageNumber,5);
            $sql = "SELECT p.category_name AS category,c.category_name AS parent,p.status ,p.cid FROM category p LEFT JOIN category c ON p.parent_cat=c.cid  ".$b["limit"];
        }
        else{
            $b = $this->Temppagination($this->con,"SELECT COUNT(*) AS rows FROM category WHERE category_name LIKE '".$name."%'  ",$pageNumber,5);
            $sql = "SELECT p.category_name AS category,c.category_name AS parent,p.status ,p.cid FROM category p LEFT JOIN category c ON p.parent_cat=c.cid WHERE p.category_name LIKE '".$name."%' ".$b["limit"];
       
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

}

// $obj = new Manage();
// echo $obj->getOneRowItems("121");
//print_r($obj->bToP("112"));
// // echo $obj->deleteRecord("category",14,"cid");
// print_r($obj->getOneRow("category","cid",7));
//echo $obj->updateRecord("products",["pid"=>7],["cid"=>7,"bid"=>4,"product_name"=>"new1","product_price"=>"5000","product_stock"=>"35","added_date"=>"2019=4-25","p_status"=>1]);
?>