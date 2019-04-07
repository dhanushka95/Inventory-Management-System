<?php

    $con = mysqli_connect("localhost","root","","inventory");

    function pagination($con,$table,$pno,$n){

        $query = $con->query("SELECT COUNT(*) AS rows FROM ".$table);
        $row = mysqli_fetch_assoc($query);
       // $totaRecord = 100000;
        $pageno =$pno;
        $numberOfRecordsperPage =$n;
        

        $last = ceil($row["rows"]/$numberOfRecordsperPage);
        echo "Total page ".$last."<br/>";
            $pagination="";
        if($last != 1){
            if($pageno>1){
                $privious="";
                $privious =$pageno -1;
                $pagination .="<a href='pagination.php?pageno=".$privious."' style='color : #333;'> previous </a>";
            }
            
            for($i=$pageno -5 ;$i<$pageno;$i++){
                if($i>0){
                $pagination .="<a href='pagination.php?pageno=".$i."'> ".$i." </a>";
                }
            }

            $pagination .="<a href='pagination.php?pageno=".$pageno."' style='color : #333;'> $pageno</a>";

            for($i=$pageno+1;$i<=$last;$i++){
                $pagination .="<a href='pagination.php?pageno=".$i."'> ".$i." </a>";
                if($i>$pageno+4){
                    break;
                }
            }

            if($last>$pageno){
                $nexxt =$pageno+1;
                $pagination .="<a href='pagination.php?pageno=".$nexxt."' style='color:#333;'>next</a>"; 
            }
        }
    $limit ="LIMIT ".($pageno-1)*$numberOfRecordsperPage.",".$numberOfRecordsperPage;
    return ["pagination"=>$pagination,"limit"=>$limit];
    }

    
    if(isset($_GET["pageno"])){
        $pageno=$_GET["pageno"];

        $table ="test";

   $array = pagination($con,$table,$pageno,1);

   $sql ="SELECT * FROM ".$table." ".$array["limit"];
   $result = $con->query($sql);

   while($row = mysqli_fetch_assoc($result)){

        echo "<div style='margin: 0 auto; font-size:20px'><b>".$row["pid"]."<b/>".$row["description"]."</div>";


   }

   echo "<div style='font-size:22px;'>".$array["pagination"]."</div>";

    }

?>