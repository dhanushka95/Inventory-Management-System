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
                        <a href="#"  did ="<?php echo $row["cid"]; ?>" class ="btn btn-danger btn-sm delete_cat">Delete</a>
                        <a href="#"  data-toggle="modal" data-target="#form_category_m"  eid ="<?php echo $row["cid"]; ?>"  class ="btn btn-info btn-sm edit_cat">Update</a>
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
//delete category
if(isset($_POST["deleteCategory"]) AND isset($_POST["id"])){
    $m = new Manage();
    $result = $m->deleteRecord("category",$_POST["id"],"cid");
    echo $result;
    
}

//update category
if(isset($_POST["UpdateCategoryInfo"])){
    $mngr = new Manage();
    $result = $mngr->getOneRow("category","cid",$_POST["id"]);
    echo json_encode($result);
    
    exit();
    
}
//update category Record
if(isset($_POST["update_category_name"])){

    $mngr = new Manage();
    $id= $_POST["cid"];
    $name = $_POST["update_category_name"];
    $parent = $_POST["parent_cat"];
    $result = $mngr->updateRecord("category",["cid"=>$id],["parent_cat"=>$parent,"category_name"=>$name,"status"=>1]);
    echo $result;
}

//Manage Brand
if(isset($_POST["manageBrand"])){

    $manage = new Manage();
    $result = $manage->ManagePagination("brand",$_POST["pageno"]);
    
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if(count($rows) > 0 ){
        $n = (($_POST["pageno"] - 1) * 5) + 1;
        foreach($rows as $row){
            ?>
                <tr>
                    <th scope="row"><?php echo $n; ?></th>
                    <td><?php echo $row["brand_name"]; ?></td>
                    <td>
                        <a href="#" class ="btn btn-success btn-sm">Active</a>
                    </td>
                    <td>
                        <a href="#"  did ="<?php echo $row["bid"]; ?>" class ="btn btn-danger btn-sm delete_brand">Delete</a>
                        <a href="#"  data-toggle="modal" data-target="#form_brand_m"  eid ="<?php echo $row["bid"]; ?>"  class ="btn btn-info btn-sm edit_brand">Update</a>
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
//update brand
if(isset($_POST["UpdateBrandInfo"])){
    $mngr = new Manage();
    $result = $mngr->getOneRow("brand","bid",$_POST["id"]);
    echo json_encode($result);
    
    exit();
    
}

//update brand Record
if(isset($_POST["update_brand_name"])){

    $mngr = new Manage();
    $id = $_POST["bid"];
    $name = $_POST["update_brand_name"];
    $result = $mngr->updateRecord("brand",["bid"=>$id],["brand_name"=>$name,"status"=>1]);
    echo $result;
}
//delete brand
if(isset($_POST["deleteBrand"]) AND isset($_POST["id"])){
    $m = new Manage();
    $result = $m->deleteRecord("brand",$_POST["id"],"bid");
    echo $result;
    
}


//Manage product
if(isset($_POST["manageProduct"])){

    $manage = new Manage();
    $result = $manage->ManagePagination("products",$_POST["pageno"]);
    
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if(count($rows) > 0 ){
        $n = (($_POST["pageno"] - 1) * 5) + 1;
        foreach($rows as $row){
            ?>
                <tr>
                    <th scope="row"><?php echo $n; ?></th>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["category_name"]; ?></td>
                    <td><?php echo $row["brand_name"]; ?></td>
                    <td><?php echo $row["product_price"]; ?></td>
                    <td><?php echo $row["product_stock"]; ?></td>
                    <td><?php echo $row["added_date"]; ?></td>
                    <td>
                        <a href="#" class ="btn btn-success btn-sm">Active</a>
                    </td>
                    <td>
                        <a href="#"  did ="<?php echo $row["pid"]; ?>" class ="btn btn-danger btn-sm delete_product">Delete</a>
                        <a href="#"  data-toggle="modal" data-target="#form_product_m"  eid ="<?php echo $row["pid"]; ?>"  class ="btn btn-info btn-sm edit_product">Update</a>
                    </td>
                </tr>

            <?php
            $n++;

        }
        ?>
        <tr><td colspan="9"><?php echo $pagination; ?></td></tr>
        <?php

        exit();

    }

}
//delete product
if(isset($_POST["deleteProduct"]) AND isset($_POST["id"])){
    $m = new Manage();
    $result = $m->deleteRecord("products",$_POST["id"],"pid");
    echo $result;
    
}
//update product
if(isset($_POST["UpdateProductInfo"])){
    $mngr = new Manage();
    $result = $mngr->getOneRow("products","pid",$_POST["id"]);
    echo json_encode($result);
    
    exit();
    
}
//update product Record
if(isset($_POST["product_name_update"])){

    $mngr = new Manage();

    $id = $_POST["pid"];
    $name = $_POST["product_name_update"];
    $cat = $_POST["select_category_Update"];
    $brand = $_POST["select_brand"];
    $price = $_POST["product_price"];
    $quantity = $_POST["product_quantity"];
    $date = $_POST["added_date"];


   $result = $mngr->updateRecord("products",["pid"=>$id],["cid"=>$cat,"bid"=>$brand,"product_name"=>$name,"product_price"=>$price,"product_stock"=>$quantity,"added_date"=>$date,"p_status"=>1]);
   echo $result;
   
}

//Add new row in order item
if(isset($_POST["getOrderRow"])){

    $obj = new DatabaseOperation();
    $rows = $obj->getAllRecord("products");

    ?>
        <tr>
            <td><b class="number">1</b></td>
            <td>
            <select class="form-control pid"  name="pid[]" required>
            <option value="">Choose product</option>
            <?php
                foreach($rows as $row){
                    ?><option value="<?php echo $row["pid"]; ?>"> <?php echo $row["product_name"]; ?> </option><?php
                }
           

            ?>
            </select>
            </td>
            <td>
            <input type="text" class="form-control tqty" readonly name="tqty[]" >
            </td>
            <td>
            <input type="text" class="form-control qty" name="qty[]" required>
            </td>
            <td>
            <input type="text" class="form-control price" name="price[]" readonly/>
            </td>
            
            <td>
            <input type="text" style="display:none;" class="form-control form-control-sm pro_name" name="pro_name[]">
             Rs:<span class="amount">0</span>
             </td>
            
        </tr>

    <?php
    exit();

}

if(isset($_POST["getPriceAndQty"])){
    $mngr = new Manage();
    $result = $mngr->getOneRow("products","pid",$_POST["id"]);
    echo json_encode($result);
    exit();
}

if(isset($_POST["orderDate"]) AND isset($_POST["orderCustomer"])){

    $orderDate = $_POST["orderDate"];
    $customerName = $_POST["orderCustomer"];

    $arryQty = $_POST["qty"];
    $arryTotalQty = $_POST["tqty"];
    $arryPrice = $_POST["price"];
    $arryProductID= $_POST["pid"];
    
    $SubTotal = $_POST["subTotal"];
    $Discount = $_POST["discount"];
    $Toatal = $_POST["netTotal"];
    $paid = $_POST["paid"];
    $Due = $_POST["due"];
    $paymentType = $_POST["paymentType"];

    $manager = new Manage();
    echo $result = $manager->storeCustomerData($orderDate,$customerName,$arryQty,$arryTotalQty,$arryPrice,$arryProductID,$SubTotal,$Discount,$Toatal,$paid,$Due,$paymentType);


}


?>