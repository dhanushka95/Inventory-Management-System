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
            $sql = "SELECT p.category_name AS category,c.category_name AS parent,p.status FROM category p LEFT JOIN category c ON p.parent_cat=c.cid ".$b["limit"];
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



}
// $obj = new Manage();
// echo "<pre>";
// print_r($obj->ManagePagination("category",1));

?>