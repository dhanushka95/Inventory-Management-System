<?php
session_start();
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
    $result = $manage->ManageCategoryPagination($_POST["categoryname"],$_POST["pageno"]);
    
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
                    <?php 
                        if($row["status"] == 1){
                                echo " <a href=\"#\" sid = ".$row["cid"]." class =\"btn btn-success btn-sm  edit_category_status_D \"><i class=\"fa fa-check-square-o\">&nbsp;</i>&nbsp;Active&nbsp;&nbsp;&nbsp;</a>";
                        }else{
                                echo " <a href=\"#\" sid = ".$row["cid"]." class =\"btn btn-danger btn-sm edit_category_status_A \"><i class=\"fa fa-exclamation-circle\">&nbsp;</i>Deactive</a>";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="#"  did ="<?php echo $row["cid"]; ?>" class ="btn btn-danger btn-sm delete_cat"><i class="fa fa-trash-o">&nbsp;</i>Delete</a>
                        <a href="#"  data-toggle="modal" data-target="#form_category_m"  eid ="<?php echo $row["cid"]; ?>"  class ="btn btn-info btn-sm edit_cat"><i class="fa fa-spinner">&nbsp;</i>Update</a>
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

//update category status active
if(isset($_POST["updateCategorystatusActive"]) AND isset($_POST["id"])){
    $mac = new Manage();
    $result = $mac->updateStatusCategory("ACTIVE",$_POST["id"]);

    echo $result;
    
}
//update category status deactive
if(isset($_POST["updateCategorystatusDeactive"]) AND isset($_POST["id"])){
    $mdac = new Manage();
    $result = $mdac->updateStatusCategory("DEACTIVE",$_POST["id"]);

    echo $result;
    
}

//Manage Brand
if(isset($_POST["manageBrand"])){

    $manage = new Manage();
    $result = $manage->ManageBrandPagination($_POST["brandname"],$_POST["pageno"]);
    
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
                    <?php 
                        if($row["status"] == 1){
                                echo " <a href=\"#\" sid = ".$row["bid"]."  class =\"btn btn-success btn-sm  edit_brand_status_D \"><i class=\"fa fa-check-square-o\">&nbsp;</i>&nbsp;Active&nbsp;&nbsp;&nbsp;</a>";
                        }else{
                                echo " <a href=\"#\" sid = ".$row["bid"]."  class =\"btn btn-danger btn-sm  edit_brand_status_A \"><i class=\"fa fa-exclamation-circle\">&nbsp;</i>Deactive</a>";
                        }
                        ?>
                        
                    </td>
                    <td>
                        <a href="#"  did ="<?php echo $row["bid"]; ?>" class ="btn btn-danger btn-sm delete_brand"><i class="fa fa-trash-o">&nbsp;</i>Delete</a>
                        <a href="#"  data-toggle="modal" data-target="#form_brand_m"  eid ="<?php echo $row["bid"]; ?>"  class ="btn btn-info btn-sm edit_brand"><i class="fa fa-spinner">&nbsp;</i>Update</a>
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
//update brand status active
if(isset($_POST["updateBrandstatusActive"]) AND isset($_POST["id"])){
    $mac = new Manage();
    $result = $mac->updateStatusBrand("ACTIVE",$_POST["id"]);

    echo $result;
    
}
//update brand status deactive
if(isset($_POST["updateBrandstatusDeactive"]) AND isset($_POST["id"])){
    $mdac = new Manage();
    $result = $mdac->updateStatusBrand("DEACTIVE",$_POST["id"]);

    echo $result;
    
}

//Manage product
if(isset($_POST["manageProduct"])){

    
    $manage = new Manage();
    $result = $manage->ManageProductPagination($_POST["pname"],$_POST["pageno"]);
    
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
                    <td><?php echo $row["minimum_qty"]; ?></td>
                    <td><?php echo $row["added_date"]; ?></td>
                    <td>
                        <?php 
                        if($row["p_status"] == 1){
                                echo " <a href=\"#\" sid = ".$row["pid"]."  class =\"btn btn-success btn-sm  edit_product_status_D \"><i class=\"fa fa-check-square-o\">&nbsp;</i>&nbsp;Active&nbsp;&nbsp;&nbsp;</a>";
                        }else{
                                echo " <a href=\"#\" sid = ".$row["pid"]."  class =\"btn btn-danger btn-sm  edit_product_status_A \"><i class=\"fa fa-exclamation-circle\">&nbsp;</i>Deactive</a>";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="#"  did ="<?php echo $row["pid"]; ?>" class ="btn btn-danger btn-sm delete_product"><i class="fa fa-trash-o">&nbsp;</i>Delete</a>
                        <a href="#"  data-toggle="modal" data-target="#form_product_m"  eid ="<?php echo $row["pid"]; ?>"  class ="btn btn-info btn-sm edit_product"><i class="fa fa-spinner">&nbsp;</i>Update</a>
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
//update status active
if(isset($_POST["updateProductstatusActive"]) AND isset($_POST["id"])){
    $mac = new Manage();
    $result = $mac->updateStatusProduct("ACTIVE",$_POST["id"]);

    echo $result;
    
}
//update status deactive
if(isset($_POST["updateProductstatusDeactive"]) AND isset($_POST["id"])){
    $mdac = new Manage();
    $result = $mdac->updateStatusProduct("DEACTIVE",$_POST["id"]);

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


   $result = $mngr->updateRecord("products",["pid"=>$id],["cid"=>$cat,"bid"=>$brand,"product_name"=>$name,"product_price"=>$price,"minimum_qty"=>$quantity,"added_date"=>$date,"p_status"=>1]);
   echo $result;
   
}

//Add new row in order item
if(isset($_POST["getOrderRow"])){

    $obj = new DatabaseOperation();
    $rows = $obj->getAllRecord("products");

    ?>
        <tr class="findtr">
            <td><b class="number">1</b></td>

            <td>
            <!-- <select class="form-control pid"  name="pid[]" required>
            <option value="">Choose product</option>
            <?php
                foreach($rows as $row){
                    if($row["p_status"] == 1){
                    ?>
                    
                    <option value="<?php echo $row["pid"]; ?>"> <?php echo $row["product_name"]; ?> </option>
                    
                    
                    <?php
                }
                }
           

            ?>
            </select> -->
            <input type="hidden" class="form-control pid" name="pid[]" required>
            <input type="text" class="form-control p_n" name="p_n[]" readonly>
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
             <td>
             <input type="text" class="form-control brc" name="brc[]" readonly/>
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
    $arryBarcode =$_POST["brc"];
    
    $SubTotal = $_POST["subTotal"];
    $Discount = $_POST["discount"];
    $Toatal = $_POST["netTotal"];
    $paid = $_POST["paid"];
    $Due = $_POST["due"];
    $paymentType = $_POST["paymentType"];

    $manager = new Manage();
    echo $result = $manager->storeCustomerData($orderDate,$customerName,$arryQty,$arryTotalQty,$arryPrice,$arryProductID,$SubTotal,$Discount,$Toatal,$paid,$Due,$paymentType,$arryBarcode);


}
//update user name
if(isset($_POST["u_name"])){
    
    $mngr = new user();
    $result = $mngr->UpdateUser($_POST["u_name"],$_SESSION["uid"]);
    echo $result;
    
    exit();
    
}


//manage bill
if(isset($_POST["manageBill"])){

    $manage = new Manage();
    $result = $manage->getBillDetails($_POST["BillNo"]);
    
    $rows = $result["rows"];

    if(count($rows) > 0 ){
        $n = 1;
       
        foreach($rows as $row){
            ?>

                <tr>
                            <th scope="row"><?php echo $n; ?></th>
                            <td><?php echo $row["product_name"]; ?></td>
                            <td><?php echo $row["category_name"]; ?></td>
                            <td><?php echo $row["brand_name"]; ?></td>
                            <td><?php echo $row["barcode"]; ?></td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td><?php echo ($row["price"]) * ($row["qty"]); ?></td>
                            </tr>

            <?php
            $n++;

        }
    

        exit();

    }

}
if(isset($_POST["manageBillOtherDetails"])){

    $manage = new Manage();
    $result = $manage->getBillOtheDetails($_POST["BillNo"]);
    
    $row = $result;

    
    if(count($row) > 0 ){
        ?>
        <div class="table-responsive">
        <table class="table table-borderedles table-hover">
        <tr>
        <td><b>name : </b><?php echo $row["customer_name"]; ?></td>
        <td><b>Bill no :</b><?php echo $row["invoice_no"]; ?></td>
        <td><b>Bill Date :</b><?php echo $row["order_date"]; ?></td>
        
        </tr>

        <tr>
        <td><b>sub Total : </b><?php echo $row["sub_total"]; ?></td>
        <td><b>Discount :</b><?php echo $row["discount"]; ?></td>
        <td><b>Total :</b><?php echo $row["Total"]; ?><br></td>
        </tr>

        <tr>
        <td><b>Paid :</b><?php echo $row["paid"]; ?></td>
        <td><b>Due :</b><?php echo $row["due"]; ?></td>
        <td><b>Type :</b><?php echo $row["payment_type"]; ?><br></td>
        </tr>

        </table>
        </div>
        <?php
        exit();

    }

}
////

//items add

if(isset($_POST["insertItems"]) AND isset($_POST["barcode"]) AND isset($_POST["stock_date"]) AND isset($_POST["items_select_product_add"]) AND isset($_POST["get_price"]) AND isset($_POST["items_quantity"]) AND isset($_POST["items_grn"]) AND isset($_POST["items_exp_date"]) AND isset($_POST["current_qty"]) ){
    $dbobject = new DatabaseOperation();
    $mngr = new Manage();

   $result = $dbobject->addItems($_POST["barcode"],$_POST["stock_date"],$_POST["items_select_product_add"],$_POST["get_price"],$_POST["items_quantity"],$_POST["items_grn"],$_POST["items_exp_date"]);
    
    $result1 = $mngr->updateRecord("products",["pid"=>$_POST["items_select_product_add"]],["product_stock"=>$_POST["current_qty"]+$_POST["items_quantity"]]);
  
    echo $result." ".$result1;
}
//Get product

if(isset($_POST["getitems"],$_POST["cid"]) AND isset($_POST["bid"])){

    $obj = new DatabaseOperation();
    $rows = $obj->getProductRecord($_POST["cid"],$_POST["bid"]);
    echo "<option value ='0'>NOT Product</option>";
    foreach($rows as $row){
        echo "<option value = '".$row["pid"]."'>".$row["product_name"]."</option>";
    }
    exit();
   

}
if(isset($_POST["getProductQty"]) AND isset($_POST["pid"])){
    $mngr = new Manage();
    $result = $mngr->getOneRow("products","pid",$_POST["pid"]);
    echo json_encode($result);
    exit();
}
//////////items
//Manage items
if(isset($_POST["manageItems"]) AND isset($_POST["barcode"])){

    $manage = new Manage();
    $result = $manage->ManageItemsPagination($_POST["barcode"],$_POST["pageno"]);
    
    $rows = $result["rows"];
    $pagination = $result["pagination"];


    if(count($rows) > 0 ){
        $n = (($_POST["pageno"] - 1) * 5) + 1;
        foreach($rows as $row){
            ?>
                <tr>
                    <th scope="row"><?php echo $n; ?></th>
                    <td><?php echo $row["grn"]; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["category_name"]; ?></td>
                    <td><?php echo $row["brand_name"]; ?></td>
                    <td><?php echo $row["i_qty"]; ?></td>
                    <td><?php echo $row["get_price"]; ?></td>
                    <td><?php echo $row["exp_date"]; ?></td>
                    <td>
                        <?php 
                        if($row["i_status"] == 1){
                                echo " <a href=\"#\" isid = ".$row["barcode"]."  class =\"btn btn-success btn-sm  edit_item_status_D \"><i class=\"fa fa-check-square-o\">&nbsp;</i>&nbsp;Active&nbsp;&nbsp;&nbsp;</a>";
                        }else{
                                echo " <a href=\"#\" isid = ".$row["barcode"]."  class =\"btn btn-danger btn-sm  edit_item_status_A \"><i class=\"fa fa-exclamation-circle\">&nbsp;</i>Deactive</a>";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="#"  idid ="<?php echo $row["barcode"]; ?>" class ="btn btn-danger btn-sm delete_item"><i class="fa fa-trash-o">&nbsp;</i>Delete</a>
                        <a href="#"  data-toggle="modal" data-target="#form_items_m"  ieid ="<?php echo $row["barcode"]; ?>"  class ="btn btn-info btn-sm edit_item"><i class="fa fa-spinner">&nbsp;</i>Update</a>
                    </td>
                </tr>

            <?php
            $n++;

        }
        ?>
        <tr><td colspan="10"><?php echo $pagination; ?></td></tr>
        <?php

        exit();

    }

}

//update item status active
if(isset($_POST["updateItemstatusActive"]) AND isset($_POST["barcode"])){
    $mac = new Manage();
    $result = $mac->updateStatusItem("ACTIVE",$_POST["barcode"]);

    echo $result;
    
}
//update item status deactive
if(isset($_POST["updateItemstatusDeactive"]) AND isset($_POST["barcode"])){
    $mdac = new Manage();
    $result = $mdac->updateStatusItem("DEACTIVE",$_POST["barcode"]);

    echo $result;
    
}
//delete item
if(isset($_POST["deleteItem"]) AND isset($_POST["id"])){
    $m = new Manage();
    $result = $m->deleteRecord("item",$_POST["id"],"barcode");
    echo $result;
    
}

//update items
if(isset($_POST["UpdateItemsInfo"])){
    $mngr = new Manage();
    $result = $mngr->getOneRowItems($_POST["barcode"]);
    echo json_encode($result);
    
    exit();
    
}
if(isset($_POST["updateItems"])){

    $mngr1 = new Manage();
    $mngr2 = new Manage();
    $mngr3 = new Manage();
    $mngr4 = new Manage();


    

    $id = $_POST["barcode"];
    $pr_pid=$_POST["privious_pid"];
    $stockDate = $_POST["stock_date"];
    $pid = $_POST["pid"];
    $getPrice = $_POST["get_price"];
    $quantity = $_POST["quantity"];
    $grn = $_POST["Grn"];
    $expDate = $_POST["Exp_date"];
    $NewQuantity = 0;
    $pr_qty=$_POST["privious_qty"];


    $result1 = $mngr1->updateRecord("products",["pid"=>$pr_pid],["product_stock"=>$pr_qty]);

    $row =$mngr2->getOneRow("products","pid",$pid);
    $NewQuantity = $row["product_stock"]+$quantity;

    $result2 = $mngr3->updateRecord("item",["barcode"=>$id],["pid"=>$pid,"invoice_no"=>$grn,"stock_date"=>$stockDate,"get_price"=>$getPrice,"exp_date"=>$expDate,"i_qty"=>$quantity]);
    $result3 = $mngr4->updateRecord("products",["pid"=>$pid],["product_stock"=>$NewQuantity]);
    
   echo "UPDATE_COMPLETE";
   
}
if(isset($_POST["barcodeToPid"]) AND isset($_POST["bar"])){
    $mngr = new Manage();
    $result = $mngr->bToP($_POST["bar"]);
    echo json_encode($result);
    exit();
}

if(isset($_POST["logOutFunction"])){
    session_destroy();
    echo "True";
}

?>