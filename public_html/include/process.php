<?php

include_once("../database/constant.php");
include_once("user.php");
include_once("dbOperation.php");
include_once("manage.php");

// user register
if(isset($_POST["username"]) AND isset($_POST["email"])){
    $user = new user();
    $result = $user->userCreateAccount($_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);

    echo $result;
}

//user login
if(isset($_POST["log_email"]) AND isset($_POST["log_password"])){
    $user = new user();
    $result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);

    echo $result;
}

//Get category

if(isset($_POST["getCategory"])){

    $obj = new DatabaseOperation();
    $rows = $obj->getAllRecord("category");
    echo "<option value ='0'>NOT CATEGORY</option>";
    foreach($rows as $row){
        echo "<option value = '".$row["cid"]."'>".$row["category_name"]."</option>";
    }
    exit();
   

}

if(isset($_POST["category_name"]) AND isset($_POST["parent_cat"])){
    $dbobject = new DatabaseOperation();
    $result = $dbobject->addCategory($_POST["parent_cat"],$_POST["category_name"]);

    echo $result;
}

//brand
if(isset($_POST["brand_name"])){
    $dbobject = new DatabaseOperation();
    $result = $dbobject->addBrand($_POST["brand_name"]);

    echo $result;
}
//Get brand

if(isset($_POST["getbrands"])){

    $obj = new DatabaseOperation();
    $rows = $obj->getAllRecord("brand");
    echo "<option value ='0'>NOT BRAND</option>";
    foreach($rows as $row){
        echo "<option value = '".$row["bid"]."'>".$row["brand_name"]."</option>";
    }
    exit();
   

}

//product
if(isset($_POST["added_date"]) AND isset($_POST["product_name_add"]) AND isset($_POST["select_category_add"]) AND isset($_POST["select_brand"]) AND isset($_POST["product_price"]) AND isset($_POST["product_quantity"]) ){
    $dbobject = new DatabaseOperation();
    $result = $dbobject->addProduct($_POST["select_category_add"],$_POST["select_brand"],$_POST["product_name_add"],$_POST["product_price"],$_POST["product_quantity"],$_POST["added_date"]);

    echo $result;
}

//Manage category
if(isset($_POST["manageCategory"])){

    $manage = new Manage();
    $result = $manage->ManagePagination("category",$_POST["pageno"]);
    
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if(count($rows) > 0 ){
        $n = (($_POST["pageno"] - 1) * 5) + 1;
        foreach($rows as $row){
            ?>
                <tr>
                    <th scope="row"><?php echo $n; ?></th>
                    <td><?php echo $row["category"]; ?></td>
                    <td><?php echo $row["parent"]; ?></td>
                    <td>
                        <a href="#" class ="btn btn-success btn-sm">Active</a>
                    </td>
                    <td>
                        <a href="#" class ="btn btn-danger btn-sm">Delete</a>
                        <a href="#" class ="btn btn-info btn-sm">Update</a>
                    </td>
                </tr>

            <?php
            $n++;

        }
        ?>
        <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php

        exit();

    }

}




?>