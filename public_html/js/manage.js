jQuery(document).ready(function(){


    var DOMAIN = "http://localhost/inventory/public_html";

//Manage Category
manageCategory(1,"");
function manageCategory(pn,name){

    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {manageCategory:1,pageno:pn,categoryname:name},
        success : function(data){
            $("#getCategoryManage").html(data);
           
        }

    })   
}

$("body").delegate(".page-link","click",function(){
 var pn =$(this).attr("pn");
 manageCategory(pn,"");
})

$("body").delegate(".delete_cat","click",function(){

    var did =$(this).attr("did");
    if(confirm("Are you sure ? delete this Item ")){
       
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {deleteCategory:1,id:did},
        success : function(data){
            if(data=="DEPENDENT CATEGORY"){

                alert("Sorry you canot delete this category it depend on other sub category");  
         
            }else if(data =="CATEGORY_DELETED") {  

                alert("Category Deleted successfuly..");

            }else if(data =="DELETED") {

                alert("Deleted Successfuly..");
            }else {
                alert("Opps...operation fail");
            }
            
           
        }

    })  
    }
    else {
        
    }

})

//fetch category

fetch_category();
function fetch_category(){
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {getCategory:1},
        success : function(data){
            $("#parent_cat").html(data);
            $("#select_category_Update").html(data);
            $("#items_select_category_update").html(data);
        }

    })

}
//get brand
fetch_brand();
function fetch_brand(){
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {getbrands:1},
        success : function(data){
            $("#select_brand").html(data);
            $("#items_select_brand_update").html(data);           
        }

    })

}
//update category

$("body").delegate(".edit_cat","click",function(){
    
    var eid =$(this).attr("eid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        dataType : "json",
        data : {UpdateCategoryInfo:1,id:eid},
        success : function(data){
            console.log(data);
            $("#cid").val(data["cid"]);
            $("#update_category_name").val(data["category_name"]);
            $("#parent_cat").val(data["parent_cat"]);
        }

    })   
})

//update category

jQuery("#form_category_update").on("submit",function(){

    var categoryname = $("#update_category_name");
    

    if(categoryname.val() ==""){
        categoryname.addClass("border-danger");
        $("#cat_error").html("<span class ='text-danger'>please enter new category name </span>");
       
    }else{
        categoryname.removeClass("border-danger");
        $("#cat_error").html("");

        $.ajax({

            url : DOMAIN+ "/include/process.php",
            type : "POST",
            data : $("#form_category_update").serialize(),
            success : function(data){
                
            if(data == "UPDATE_COMPLETE"){
                categoryname.removeClass("border-danger");
            
                fetch_category();
                alert("Update complete");
                window.location.href = "";

            }else{

                alert("Opps... can't update");
            }

            }
       
    })
}

  


})

//Manage brand
manageBrand(1,"");
function manageBrand(pn,name){

    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {manageBrand:1,pageno:pn,brandname:name},
        success : function(data){
            $("#getBrandManage").html(data);
           
        }

    })   
}

//update brand -->get current Brand name

$("body").delegate(".edit_brand","click",function(){
    
    var eid =$(this).attr("eid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        dataType : "json",
        data : {UpdateBrandInfo:1,id:eid},
        success : function(data){
            console.log(data);
            $("#bid").val(data["bid"]);
            $("#update_brand_name").val(data["brand_name"]);
            
        }

    })   
})


$("body").delegate(".page-link","click",function(){
    var pn =$(this).attr("pn");
    manageBrand(pn,"");
   })
//delete brand
   $("body").delegate(".delete_brand","click",function(){

    var did =$(this).attr("did");
   
    if(confirm("Are you sure ? delete this Item ")){
       
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {deleteBrand:1,id:did},
        success : function(data){
            if(data=="DELETED"){

                alert("Brand is deleted");  
                manageBrand(1);
            }else {
                alert("Opps... operation fail");
            }
            
           
        }

    })  
    }
    else {
        
    }

})

//update brand

jQuery("#form_brand_update").on("submit",function(){

    var brandName = $("#update_brand_name");
   

    if(brandName.val() ==""){
        brandName.addClass("border-danger");
        $("#brand_error").html("<span class ='text-danger'>please enter new Brand name </span>");
       
    }else{
        brandName.removeClass("border-danger");
        $("#brand_error").html("");

        $.ajax({

            url : DOMAIN+ "/include/process.php",
            type : "POST",
            data : $("#form_brand_update").serialize(),
            success : function(data){
            if(data == "UPDATE_COMPLETE"){
                brandName.removeClass("border-danger");
            
                alert("Update complete");
                window.location.href = "";

            }else{

                alert("Opps... operation fail");
            }

            }
       
    })
}

  


})

//Manage product
manageProduct(1,"");
function manageProduct(pn,name){

    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {manageProduct:1,pageno:pn,pname:name},
        success : function(data){
            $("#getProductManage").html(data);
           
        }

    })   
}
$("body").delegate(".page-link","click",function(){
    var pn =$(this).attr("pn");
    manageProduct(pn,"");
   })
//delete product
$("body").delegate(".delete_product","click",function(){

    var did =$(this).attr("did");
   
    if(confirm("Are you sure ? delete this Item ")){
       
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {deleteProduct:1,id:did},
        success : function(data){
            if(data=="DELETED"){

                alert("Product is deleted");  
                manageProduct(1);
            }else {
                alert("Opps... operation fail");
            }
            
           
        }

    })  
    }
    else {
        
    }

})

//update product -->get current product details into model

$("body").delegate(".edit_product","click",function(){
    
    var eid =$(this).attr("eid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        dataType : "json",
        data : {UpdateProductInfo:1,id:eid},
        success : function(data){
            console.log(data);
            $("#pid").val(data["pid"]);
            $("#product_name_update").val(data["product_name"]);
            $("#product_price").val(data["product_price"]);
            $("#product_quantity").val(data["minimum_qty"]);
            $("#added_date").val(data["added_date"]);
            
        }

    })   
})
//update product status active
$("body").delegate(".edit_product_status_A","click",function(){
    
    var sid =$(this).attr("sid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        data : {updateProductstatusActive:1,id:sid},
        success : function(data){
            if(data =="UPDATE_PRODUCT_STATUS"){
                alert("Activeted");
                window.location.href=encodeURI(DOMAIN+"/manageProduct.php");
            }else if(data =="CATEGORY_IS_NOT_ACTIVE"){
                alert("Category is not active!");
            }else if(data =="BRAND_IS_NOT_ACTIVE") {
                alert("Brand is not active!");
            }
            
        }

    })   
})
//update product status deactive
$("body").delegate(".edit_product_status_D","click",function(){
    
    var sid =$(this).attr("sid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        data : {updateProductstatusDeactive:1,id:sid},
        success : function(data){
            if(data =="UPDATE_PRODUCT_STATUS"){
                alert("Deactiveted");
                window.location.href=encodeURI(DOMAIN+"/manageProduct.php");
            }
        }

    })   
})

//update category status active
$("body").delegate(".edit_category_status_A","click",function(){
    
    var sid =$(this).attr("sid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        data : {updateCategorystatusActive:1,id:sid},
        success : function(data){
            if(data =="UPDATE_CATEGORY_STATUS"){
                alert("Activeted");
                window.location.href=encodeURI(DOMAIN+"/manageCategory.php");
            }
            
        }

    })   
})
//update category status deactive
$("body").delegate(".edit_category_status_D","click",function(){
    
    var sid =$(this).attr("sid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        data : {updateCategorystatusDeactive:1,id:sid},
        success : function(data){
            if(data =="UPDATE_CATEGORY_STATUS"){
                alert("Deactiveted");
                window.location.href=encodeURI(DOMAIN+"/manageCategory.php");
            }
        }

    })   
})


//update brand status acive

$("body").delegate(".edit_brand_status_A","click",function(){
    
    var sid =$(this).attr("sid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        data : {updateBrandstatusActive:1,id:sid},
        success : function(data){
           
            if(data =="UPDATE_BRAND_STATUS"){
                alert("Activeted");
                window.location.href=encodeURI(DOMAIN+"/manageBrand.php");
            }
            
        }

    })   
})
//update brand status deactive
$("body").delegate(".edit_brand_status_D","click",function(){
    
    var sid =$(this).attr("sid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        data : {updateBrandstatusDeactive:1,id:sid},
        success : function(data){
            if(data =="UPDATE_BRAND_STATUS"){
                alert("Deactiveted");
                window.location.href=encodeURI(DOMAIN+"/manageBrand.php");
            }
        }

    })   
})

jQuery("#form_product_update").on("submit",function(){

    var added_date = $("#added_date");
    var product_name_up =$("#product_name_update");
    var select_category_up = $("#select_category_Update");
    var select_brand = $("#select_brand");
    var product_price = $("#product_price");
    var product_quantity = $("#product_quantity");

    var status = true;

 
   
    if(added_date.val() ==""){
        added_date.addClass("border-danger");
        $("#date_error").html("<span class ='text-danger'>please enter date </span>");
        var status = false;
    }else{
        added_date.removeClass("border-danger");
        $("#date_error").html("");
        var status = true;  
    }

    if(product_name_up.val() ==""){
        product_name_up.addClass("border-danger");
        $("#p_name_error").html("<span class ='text-danger'>please enter product name </span>");
        var status = false;
    }else{
        product_name_up.removeClass("border-danger");
        $("#p_name_error").html(""); 
        var status = true; 
    }

    if(select_category_up.val() =="" || select_category_up.val() =="0"){
        select_category_up.addClass("border-danger");
        $("#p_cat_error").html("<span class ='text-danger'>please select category name </span>");
        var status = false;
    }else{
        select_category_up.removeClass("border-danger");
        $("#p_cat_error").html("");  
        var status = true;
    }

    if(select_brand.val() =="" || select_brand.val() =="0"){
        select_brand.addClass("border-danger");
        $("#p_brand_error").html("<span class ='text-danger'>please select brand name </span>");
        var status = false;
    }else{
        select_brand.removeClass("border-danger");
        $("#p_brand_error").html("");  
        var status = true;
    }

    if(product_price.val() ==""){
        product_price.addClass("border-danger");
        $("#p_price_error").html("<span class ='text-danger'>please enter product price </span>");
        var status = false;
    }else{
        product_price.removeClass("border-danger");
        $("#p_price_error").html(""); 
        var status = true; 
    }

    if(product_quantity.val() ==""){
        product_quantity.addClass("border-danger");
        $("#p_quntity_error").html("<span class ='text-danger'>please enter product quantity </span>");
        var status = false;
    }else{
        product_quantity.removeClass("border-danger");
        $("#p_quntity_error").html(""); 
        var status = true; 
    }
    
    
    if(status)
    {
    
        $.ajax({

            url : DOMAIN+ "/include/process.php",
            type : "POST",
            data : $("#form_product_update").serialize(),
            success : function(data){
            if(data == "UPDATE_COMPLETE"){
              
                alert("Update complete");
                window.location.href = "";

            }else{

                alert("Opps... operation fail");
            }

            }
       
    })
}

  


})

//Manage items
manageItems(1,"");
function manageItems(pn,barcode){

    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {manageItems:1,pageno:pn,barcode:barcode},
        success : function(data){
            $("#getItemManage").html(data);
           
        }

    })   
}
$("body").delegate(".page-link","click",function(){
    var pn =$(this).attr("pn");
    manageItems(pn,"");
   })
//search items using barcode
$("body").delegate(".barcodeScan","click",function(){

    var barcodeValue = prompt("Scan Barcode","");
    manageItems(1,barcodeValue);
    

})

//update item status acive

$("body").delegate(".edit_item_status_A","click",function(){
    
    var barcode =$(this).attr("isid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        data : {updateItemstatusActive:1,barcode:barcode},
        success : function(data){
           
            if(data =="UPDATE_ITEM_STATUS"){

                alert("Activeted");
                window.location.href=encodeURI(DOMAIN+"/manageItem.php");
            }else{
                alert("Product is Currently Not Active"); 
            }
        }

    })   
})

//update item status deactive
$("body").delegate(".edit_item_status_D","click",function(){
    
    var barcode =$(this).attr("isid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        data : {updateItemstatusDeactive:1,barcode:barcode},
        success : function(data){
            if(data =="UPDATE_ITEM_STATUS"){
                alert("Deactiveted");
                window.location.href=encodeURI(DOMAIN+"/manageItem.php");
            }
            
        }

    })   
})

//delete item
$("body").delegate(".delete_item","click",function(){

    var did =$(this).attr("idid");
   
    if(confirm("Are you sure ? delete this Item ")){
       
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {deleteItem:1,id:did},
        success : function(data){
            if(data=="DELETED"){

                alert("Item is deleted");  
                manageItems(1,"");
            }else {
                alert("Opps... operation fail");
            }
            
           
        }

    })  
    }
    else {
        
    }

})

//update item -->get current item details

$("body").delegate(".edit_item","click",function(){
    
    var eid =$(this).attr("ieid");
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        dataType : "json",
        data : {UpdateItemsInfo:1,barcode:eid},
        success : function(data){
            console.log(data);

            $("#items_grn_update").val(data["invoice_no"]);
           // $("#c_qty_u").val(data["product_stock"] - data["i_qty"]);
            $("#get_price_update").val(data["get_price"]);
            $("#items_quantity_update").val(data["i_qty"]);
            $("#items_exp_date_update").val(data["exp_date"]);
            $("#iu_barcode").val(eid);
            $("#iu_pid").val(data["pid"]);
            $("#iu_qtyi").val(data["product_stock"] - data["i_qty"]);
        }
       

    })   
    
})

//update items

jQuery("#form_items_update").on("submit",function(){

    var stock_date = $("#stock_date_update");
    var product_name =$("#items_select_product_update");
    var select_category = $("#items_select_category_update");
    var select_brand = $("#items_select_brand_update");
    var get_price = $("#get_price_update");
    var item_quantity = $("#items_quantity_update");
    var Grn = $("#items_grn_update");
    var Exp_date = $("#items_exp_date_update");
    var currentQty =$("#c_qty_u");
    var barcode = $("#iu_barcode");
    var privious_pid=$("#iu_pid");
    var privious_qty=$("#iu_qtyi");
    var status = false;

    
    if(stock_date.val() ==""){
        stock_date.addClass("border-danger");
        $("#iu_date_error").html("<span class ='text-danger'>please enter stock date </span>");
        var status = false;
    }else{
        stock_date.removeClass("border-danger");
        $("#iu_date_error").html("");
        var status = true; 
    }

    if(product_name.val() =="" || product_name.val() ==null){
        product_name.addClass("border-danger");
        $("#iu_prduct_error").html("<span class ='text-danger'>please select product name </span>");
        var status = false;
    }else{
        product_name.removeClass("border-danger");
        $("#iu_prduct_error").html("");
        var status = true; 
    }

    if(select_category.val() ==""){
        select_category.addClass("border-danger");
        $("#iu_cat_error").html("<span class ='text-danger'>please select category </span>");
        var status = false;
    }else{
        select_category.removeClass("border-danger");
        $("#iu_cat_error").html("");
        var status = true; 
    }

    if(select_brand.val() ==""){
        select_brand.addClass("border-danger");
        $("#iu_brand_error").html("<span class ='text-danger'>please select brand </span>");
        var status = false;
    }else{
        select_brand.removeClass("border-danger");
        $("#iu_brand_error").html("");
        var status = true; 
    }

    if(get_price.val() ==""){
        get_price.addClass("border-danger");
        $("#iu_price_error").html("<span class ='text-danger'>please enter Get price </span>");
        var status = false;
    }else{
        get_price.removeClass("border-danger");
        $("#iu_price_error").html("");
        var status = true; 
    }

    if(item_quantity.val() ==""){
        item_quantity.addClass("border-danger");
        $("#iu_quntity_error").html("<span class ='text-danger'>please enter quantity </span>");
        var status = false;
    }else{
        item_quantity.removeClass("border-danger");
        $("#iu_quntity_error").html("");
        var status = true; 
    }

    if(Grn.val() ==""){
        Grn.addClass("border-danger");
        $("#iu_grn_error").html("<span class ='text-danger'>please enter GRN </span>");
        var status = false;
    }else{
        Grn.removeClass("border-danger");
        $("#iu_grn_error").html("");
        var status = true; 
    }

    if(Exp_date.val() ==""){
        Exp_date.addClass("border-danger");
        $("#iu_exp_date_error").html("<span class ='text-danger'>please enter Expire date </span>");
        var status = false;
    }else{
        Exp_date.removeClass("border-danger");
        $("#iu_exp_date_error").html("");
        var status = true; 
    }
if(exp_date.val() =="" || Grn.val() =="" || item_quantity.val() == "" || get_price.val() == "" || product_name.val() =="" || stock_date.val() ==""){

       var status =false;
    }else{
       var status = true;
    }

    if(status){

        $.ajax({

            url : DOMAIN+ "/include/process.php",
            type : "POST",
            data :{updateItems:1,barcode:barcode.val(),stock_date:stock_date.val(),pid:product_name.val(),get_price:get_price.val(),quantity:item_quantity.val(),Grn:Grn.val(),Exp_date:Exp_date.val(),currentQty:currentQty.val(),privious_pid:privious_pid.val(),privious_qty:privious_qty.val()},
            success : function(data){
            if(data == "UPDATE_COMPLETE"){
               
                alert("Update complete");
                window.location.href = "";

            }else{

                alert("Opps some error");
            }

            }
       
    })
}

  


})

$("#items_select_category_update").change(function(){

    var cid = $(this).val();
    var bid =  $("#items_select_brand_update").val();
    getItems(cid,bid);
    

})
$("#items_select_brand_update").change(function(){

    var bid = $(this).val();
    var cid =  $("#items_select_category_update").val();
    getItems(cid,bid);
    

})
$("#items_select_product_update").change(function(){

    var pid =$(this).val();
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        method : "POST",
        dataType : "json",
        data : {getProductQty:1,pid:pid},
        success : function(data){
            console.log(data);

            $("#c_qty_u").val(data["product_stock"]);
           
        }

    })   
    

})


function getItems(c_id,b_id){

    if(c_id !="" && b_id !=""){
        $.ajax({
            url: DOMAIN+ "/include/process.php",
            type : "POST",
            data : {getitems:1,cid:c_id,bid:b_id},
            success : function(data){
                $("#items_select_product_update").html(data);
                           
            }

        })
    }
}

//search product using product name
$("body").delegate(".btnProductSearch","click",function(){

    
    var val = $("#searchProductText").val();
    manageProduct(1,val);
    $("#searchProductText").val("");

})
//search brand using product name
$("body").delegate(".btnBrandSearch","click",function(){

    
    var val = $("#searchBrandText").val();
    manageBrand(1,val);
    $("#searchBrandText").val("");

})
//search category using product name
$("body").delegate(".btnCategorySearch","click",function(){

    
    var val = $("#searchCategoryText").val();
    manageCategory(1,val);
    $("#searchCategoryText").val("");

})

})