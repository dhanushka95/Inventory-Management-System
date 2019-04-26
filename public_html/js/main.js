jQuery(document).ready(function(){


    var DOMAIN = "http://localhost/inventory/public_html";
  
    //register page
jQuery("#register_form_user").on("submit",function(){


   
    var name = $("#username");
    var email = $("#email");
    var password1 = $("#password1");
    var password2 = $("#password2");
    var usertype = $("#usertype");
    var phone = $("#phone");
    var status = false;

    if(name.val() ==""){
        name.addClass("border-danger");
        $("#user_error").html("<span class ='text-danger'>please enter name </span>");
        status = false;
    }else{
        name.removeClass("border-danger");
        $("#user_error").html("");
        status = true;
    }

    if(email.val() ==""){
        email.addClass("border-danger");
        $("#email_error").html("<span class ='text-danger'>please enter Email </span>");
        status = false;
    }else{
        email.removeClass("border-danger");
        $("#email_error").html("");
        status = true;
    }

    if(phone.val() ==""){
        phone.addClass("border-danger");
        $("#phone_error").html("<span class ='text-danger'>please enter phone number </span>");
        status = false;
    }else{
        phone.removeClass("border-danger");
        $("#phone_error").html("");
        status = true;
    }

    
    if(password1.val() =="" || password1.val().length<8){
        password1.addClass("border-danger");
        $("#password1_error").html("<span class ='text-danger'>please enter password and it should be 8 characters </span>");
        status = false;
    }else{
        password1.removeClass("border-danger");
        $("#password1_error").html("");
        status = true;
    }

    if(password2.val() =="" || password2.val().length<8){
        password2.addClass("border-danger");
        $("#password2_error").html("<span class ='text-danger'>please enter password and it should be 8 characters </span>");
        status = false;
    }else{
        password2.removeClass("border-danger");
        $("#password2_error").html("");
        status = true;
    }

    if((password1.val() == password2.val()) && status == true){
        
        $.ajax({

            url : DOMAIN+ "/include/process.php",
            type : "POST",
            data : $("#register_form_user").serialize(),
            success : function(data){
                
                if(data == "ALREADY EXISTS"){
                        alert("your email already exist");

                }else if(data == "ERROR") {
                    alert("error occur in user.php");
    
                }else{
                 window.location.href=encodeURI(DOMAIN+"/index.php?msg=Hellow "+name.val());
                  
                }
            }
           

        })
        

    }else{
        password2.removeClass("border-danger");
        $("#password2_error").html("<span class ='text-danger'>please enter correct password</span>");
        status = false;
    }

    // if(!e_patt.test(email.val())){
    //     email.addClass("border-danger");
    //     $("#email_error").html("<span class ='text-danger'>please enter valied Email </span>");
    //     status = false;
    // }else{
    //     email.removeClass("border-danger");
    //     $("#email_error").html("");
    //     status = true;
    // }

    

})

// login page

jQuery("#login_form_user").on("submit",function(){


    var email = $("#log_email");
    var password = $("#log_password");
    var status = false;

    if(email.val() ==""){
        email.addClass("border-danger");
        $("#log_email_error").html("<span class ='text-danger'>please enter Email address </span>");
        status = false;
    }else{
        email.removeClass("border-danger");
        $("#log_email_error").html("");
        status = true;
    }

    if(password.val() ==""){
        password.addClass("border-danger");
        $("#log_password_error").html("<span class ='text-danger'>please enter password </span>");
        status = false;
    }else{
        password.removeClass("border-danger");
        $("#log_password_error").html("");
        status = true;
    }

    if(status){

        $.ajax({

            url : DOMAIN+ "/include/process.php",
            type : "POST",
            data : $("#login_form_user").serialize(),
            success : function(data){
               
                if(data == "CONNECTION ERROR"){
                        alert("connection error");

                }else if(data == "PASSWORD_NOT_MATCH") {
                    alert("password is incorect");
    
                }else if(data == "LOGIN_COMPLETE"){
                 window.location.href=encodeURI(DOMAIN+"/dashboard.php");
                  
                }else {
                    alert(data);
                }
            }
           

        })

    }



})
//get category
fetch_category();
function fetch_category(){
    
    $.ajax({
        url: DOMAIN+ "/include/process.php",
        type : "POST",
        data : {getCategory:1},
        success : function(data){
            $("#parent_cat").html(data);
            $("#select_category_add").html(data);
            $("#items_select_category_add").html(data);
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
            $("#items_select_brand").html(data);           
        }

    })

}

//add category

jQuery("#form_category_add").on("submit",function(){

    var categoryname = $("#category_name");
    

    if(categoryname.val() ==""){
        categoryname.addClass("border-danger");
        $("#cat_error").html("<span class ='text-danger'>please enter category name </span>");
       
    }else{
        categoryname.removeClass("border-danger");
        $("#cat_error").html("");

        $.ajax({

            url : DOMAIN+ "/include/process.php",
            type : "POST",
            data : $("#form_category_add").serialize(),
            success : function(data){
                
            if(data == "CATEGORY_IS_ADD"){
                categoryname.removeClass("border-danger");
                $("#cat_error").html("<span class ='text-success'>Category is Add complete </span>");
                $("#category_name").val("");
                fetch_category();

            }else{

                alert(data);
            }

            }
       
    })
}

  


})

//add brand

jQuery("#form_brand_add").on("submit",function(){

    var brandname = $("#brand_name");
    

    if(brandname.val() ==""){
        brandname.addClass("border-danger");
        $("#brand_error").html("<span class ='text-danger'>please enter brand name </span>");
       
    }else{
        brandname.removeClass("border-danger");
        $("#brand_error").html("");

        $.ajax({

            url : DOMAIN+ "/include/process.php",
            type : "POST",
            data : $("#form_brand_add").serialize(),
            success : function(data){
                
            if(data == "BRAND_IS_ADD"){
                brandname.removeClass("border-danger");
                $("#brand_error").html("<span class ='text-success'>Brand is Add complete </span>");
                $("#brand_name").val("");
                fetch_brand();
            }else{

                alert(data);
            }

            }
       
    })
}

  


})

//add product

jQuery("#form_product_add").on("submit",function(){

    var added_date = $("#added_date");
    var product_name_add =$("#product_name_add");
    var select_category_add = $("#select_category_add");
    var select_brand = $("#select_brand");
    var product_price = $("#product_price");
    var product_quantity = $("#product_quantity");

    var status = false;

   
    if(added_date.val() ==""){
        added_date.addClass("border-danger");
        $("#date_error").html("<span class ='text-danger'>please enter date </span>");
        var status = false;
    }else{
        added_date.removeClass("border-danger");
        $("#date_error").html("");
        var status = true;  
    }

    if(product_name_add.val() ==""){
        product_name_add.addClass("border-danger");
        $("#p_name_error").html("<span class ='text-danger'>please enter product name </span>");
        var status = false;
    }else{
        product_name_add.removeClass("border-danger");
        $("#p_name_error").html(""); 
        var status = true; 
    }

    if(select_category_add.val() =="" || select_category_add.val() =="0"){
        select_category_add.addClass("border-danger");
        $("#p_cat_error").html("<span class ='text-danger'>please select category name </span>");
        var status = false;
    }else{
        select_category_add.removeClass("border-danger");
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
    
    
    
    if(status){
       
        $.ajax({

            url : DOMAIN+ "/include/process.php",
            type : "POST",
            data : $("#form_product_add").serialize(),
            success : function(data){
                
            if(data == "PRODUCT_IS_ADD"){
                alert("product Add is completed");
                $("#brand_name").val("");
                $("#product_name_add").val("");
                $("#product_price").val("");
                $("#product_quantity").val("");
                
            }else{

                alert(data);
            }

            }
       
    })
}

  


})

jQuery("#form_user_update").on("submit",function(){

    userUpdate();

})

/////items
$("#items_select_category_add").change(function(){

    var cid = $(this).val();
    var bid =  $("#items_select_brand").val();
    getItems(cid,bid);
    

})
$("#items_select_brand").change(function(){

    var bid = $(this).val();
    var cid =  $("#items_select_category_add").val();
    getItems(cid,bid);
    

})

function getItems(c_id,b_id){

    if(c_id !="" && b_id !=""){
        $.ajax({
            url: DOMAIN+ "/include/process.php",
            type : "POST",
            data : {getitems:1,cid:c_id,bid:b_id},
            success : function(data){
                $("#items_select_product_add").html(data);
                           
            }

        })
    }
}

$("#items_select_product_add").change(function(){

    var tr = $(this).parent().parent();
    var p_id = $(this).val();
    
    if(p_id !=""){
        $.ajax({
            url: DOMAIN+ "/include/process.php",
            type : "POST",
            dataType : "json",
            data : {getProductQty:1,pid:p_id},
            success : function(data){
               tr.find(".c_qty").val(data["product_stock"]);
            }

        })
    }

    

})

jQuery("#form_items_add").on("submit",function(){

    var items_added_date = $("#stock_date");
    var product_name =$("#items_select_product_add");
    var select_category = $("#items_select_category_add");
    var select_brand = $("#items_select_brand");
    var get_price = $("#get_price");
    var item_quantity = $("#items_quantity");
    var Grn = $("#items_grn");
    var Exp_date = $("#items_exp_date");
    var currentQty =$("#c_qty");
    var status = false;

    if(items_added_date.val() ==""){
        items_added_date.addClass("border-danger");
        $("#i_date_error").html("<span class ='text-danger'>please enter stock date </span>");
        var status = false;
    }else{
        items_added_date.removeClass("border-danger");
        $("#i_date_error").html("");
        var status = true; 
    }

    if(product_name.val() == null){
        product_name.addClass("border-danger");
        $("#i_prduct_error").html("<span class ='text-danger'>please select product name </span>");
        var status = false;
    }else{
        product_name.removeClass("border-danger");
        $("#i_prduct_error").html("");
        var status = true; 
    }

    if(select_category.val() ==""){
        select_category.addClass("border-danger");
        $("#i_cat_error").html("<span class ='text-danger'>please select category </span>");
        var status = false;
    }else{
        select_category.removeClass("border-danger");
        $("#i_cat_error").html("");
        var status = true; 
    }

    if(select_brand.val() ==""){
        select_brand.addClass("border-danger");
        $("#i_brand_error").html("<span class ='text-danger'>please select brand </span>");
        var status = false;
    }else{
        select_brand.removeClass("border-danger");
        $("#i_brand_error").html("");
        var status = true; 
    }

    if(get_price.val() ==""){
        get_price.addClass("border-danger");
        $("#i_price_error").html("<span class ='text-danger'>please enter Get price </span>");
        var status = false;
    }else{
        get_price.removeClass("border-danger");
        $("#i_price_error").html("");
        var status = true; 
    }

    if(item_quantity.val() ==""){
        item_quantity.addClass("border-danger");
        $("#i_quntity_error").html("<span class ='text-danger'>please enter quantity </span>");
        var status = false;
    }else{
        item_quantity.removeClass("border-danger");
        $("#i_quntity_error").html("");
        var status = true; 
    }

    if(Grn.val() ==""){
        Grn.addClass("border-danger");
        $("#i_grn_error").html("<span class ='text-danger'>please enter GRN </span>");
        var status = false;
    }else{
        Grn.removeClass("border-danger");
        $("#i_grn_error").html("");
        var status = true; 
    }

    if(Exp_date.val() ==""){
        Exp_date.addClass("border-danger");
        $("#i_exp_date_error").html("<span class ='text-danger'>please enter Expire date </span>");
        var status = false;
    }else{
        Exp_date.removeClass("border-danger");
        $("#i_exp_date_error").html("");
        var status = true; 
    }

    if(status){
       var barcode = prompt("Scan barcode","");
       if(barcode !=null || barcode !=""){
        $.ajax({

            url : DOMAIN+ "/include/process.php",
            type : "POST",
            data : {insertItems:1,barcode:barcode,stock_date:items_added_date.val(),items_select_product_add:product_name.val(),get_price:get_price.val(),items_quantity:item_quantity.val(),items_grn:Grn.val(),items_exp_date:Exp_date.val(),current_qty:currentQty.val()},
            success : function(data){
              
            if(data == "ITEMS_IS_ADD UPDATE_COMPLETE"){
                alert("Items Add is completed");
                $("#items_select_product_add").val("");
                $("#get_price").val("");
                $("#items_quantity").val("");
                $("#items_grn").val("");
                $("#items_exp_date").val("");
                
            }else{

                alert(data);
            }

            }
       
    })
  
    }

    }

})

$(".logOut").click(function(){

    
    $.ajax({

        url : DOMAIN+ "/include/process.php",
        type : "POST",
        data : {logOutFunction:1},
        success : function(data){
            if(data == "True"){
                
                window.location.href=encodeURI(DOMAIN+"/index.php");

            }else{
                alert("Opps... some error");
            }
        

        }
   
})
})

// $(".checkChangeP").click(function(){

//     if($(this).prop("checked")== true){

        
//     }else{

//     }

// })
function userUpdate(){

    if($(".checkChangeP").prop("checked") == false){
        
            var userNAme = $("#u_name");
            var phone = $("#ph");
            var status = true;
            if(userNAme.val() =="" ){
                userNAme.addClass("border-danger");
                $("#u_error").html("<span class ='text-danger'>please enter user name </span>");
                var status = false;
            }


            if(phone.val() =="" ){
                phone.addClass("border-danger");
                $("#ph_error").html("<span class ='text-danger'>please enter phone number </span>");
                var status = false;
            }


            if(status){
            
                $.ajax({

                    url : DOMAIN+ "/include/process.php",
                    type : "POST",
                    data : $("#form_user_update").serialize(),
                    success : function(data){
                        if(data == "UPDATE_USER"){
                            alert("Updated");
                            userNAme.val("");
                            window.location.href=encodeURI(DOMAIN+"/index.php");
                        }else{
                            alert("Opps... some error");
                        }
                    

                    }
            
            })
            }
    }else{
        
    var userNAme = $("#u_name");
    var newP=$("#u_new_password");
    var cP=$("#u_password");
    var vp=$("#u_verfy_password");
    var phone = $("#ph");
    var status = true;
    

    if(phone.val() =="" ){
        phone.addClass("border-danger");
        $("#ph_error").html("<span class ='text-danger'>please enter phone number </span>");
        var status = false;
    }

    if(userNAme.val() ==""){
        userNAme.addClass("border-danger");
        $("#u_error").html("<span class ='text-danger'>please enter user name </span>");
        var status = false;
        }
         if(cP.val() ==""){

             cP.addClass("border-danger");
             $("#u_c_p_error").html("<span class ='text-danger'>please enter password</span>");
             var status = false;
        }
         if(newP.val() ==""){
            newP.addClass("border-danger");
            $("#u_n_p_error").html("<span class ='text-danger'>please enter new password</span>");
            var status = false;
         }
         
         if(vp.val() ==""){
             vp.addClass("border-danger");
             $("#u_v_p_error").html("<span class ='text-danger'>please enter verify password</span>");
            var status = false;
        } 
        if(vp.val() != newP.val()){
            vp.addClass("border-danger");
            $("#u_v_p_error").html("<span class ='text-danger'> verify password fail</span>");
            var status = false;
        }

        if(status){
        
            $.ajax({

                url : DOMAIN+ "/include/process.php",
                type : "POST",
                data : $("#form_user_update").serialize(),
                success : function(data){
                    if(data == "UPDATE_USER"){
                        alert("Updated");
                        userNAme.val("");
                        cP.val("");
                        vp.val("");
                        newP.val("");

                        window.location.href=encodeURI(DOMAIN+"/index.php");
                    }else{
                        alert("Opps... some error");
                    }
                

                }
        
        })
        }
}

}

$(".send_sms").click(function(){

var email =prompt("Enter Email ","");

if(email !="" && email != null){
    
            $.ajax({

                url : DOMAIN+ "/include/process.php",
                type : "POST",
                data : {getPasswordPhone:1,emailP:email},
                success : function(data){

                    if(data != null){


                                $.ajax({

                                    url : DOMAIN+ "/include/process.php",
                                    type : "POST",
                                    data : {sendSms:1,dataset:data},
                                    success : function(data){
                                            if(data ="SEND"){

                                                alert("we send sms. Please check your mobile phone");
                                            }else {
                                                alert("we can't send sms");
                                           
                                            }
                                    }
                    
                            })

                    }else {
                        alert("Email is not correct");
                    }

                }

        })
}

})


})

