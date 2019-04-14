jQuery(document).ready(function(){


    var DOMAIN = "http://localhost/inventory/public_html";

    //check bill

jQuery("#form_bill_search").on("submit",function(){

    var bill_no = $("#search_bill_no");
   // alert(bill_no.val());

   if(bill_no.val()!=""){
                        $.ajax({
                            url: DOMAIN+ "/include/process.php",
                            type : "POST",
                            data : {manageBill:1,BillNo:bill_no.val()},
                            success : function(data){
                                $("#getBillManage").html(data);
                            
                            }

                            

                        })   
                        }

    if(bill_no.val()!=""){
                        $.ajax({
                            url: DOMAIN+ "/include/process.php",
                            type : "POST",
                            data : {manageBillOtherDetails:1,BillNo:bill_no.val()},
                            success : function(data){
                             $("#getBillOtherDetailsManage").html(data);
                            }
                            
                            })

                     }


})


})