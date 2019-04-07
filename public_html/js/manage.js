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

})