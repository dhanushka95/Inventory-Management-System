jQuery(document).ready(function(){


    var DOMAIN = "http://localhost/inventory/public_html";

//Manage Category
manageCategory(1);
function manageCategory(pn){

    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {manageCategory:1,pageno:pn},
        success : function(data){
            $("#getCategoryManage").html(data);
           
        }

    })   
}

$("body").delegate(".page-link","click",function(){
 var pn =$(this).attr("pn");
 manageCategory(pn);
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
manageBrand(1);
function manageBrand(pn){

    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {manageBrand:1,pageno:pn},
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
    manageBrand(pn);
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
manageProduct(1);
function manageProduct(pn){

    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {manageProduct:1,pageno:pn},
        success : function(data){
            $("#getProductManage").html(data);
           
        }

    })   
}
$("body").delegate(".page-link","click",function(){
    var pn =$(this).attr("pn");
    manageProduct(pn);
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
            $("#product_quantity").val(data["product_stock"]);
            $("#added_date").val(data["added_date"]);
            
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



})