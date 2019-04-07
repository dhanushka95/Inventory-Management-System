jQuery(document).ready(function(){


    var DOMAIN = "http://localhost/inventory/public_html";
  
    //register page
jQuery("#register_form_user").on("submit",function(){


   
    var name = $("#username");
    var email = $("#email");
    var password1 = $("#password1");
    var password2 = $("#password2");
    var usertype = $("#usertype");
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
    
                }else{
                 window.location.href=encodeURI(DOMAIN+"/dashboard.php");
                  
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



})

