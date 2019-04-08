jQuery(document).ready(function(){


    var DOMAIN = "http://localhost/inventory/public_html";


    $("#add").click(function(){

        AddNewRow();

    })

    $("#remove").click(function(){

       $("#invoiceItems").children("tr:last").remove();
       calculate(0,0);

    })

    $("#invoiceItems").delegate(".pid","change",function(){

        var pid = $(this).val();
        var tr = $(this).parent().parent();
        $(".overlay").show();
        $.ajax({
            url: DOMAIN+ "/include/process.php",
            method : "POST",
            dataType : "json",
            data : {getPriceAndQty:1,id:pid},
            success : function(data){
               
                tr.find(".tqty").val(data["product_stock"]);
                tr.find(".pro_name").val(data["product_name"]);
                tr.find(".qty").val(1);
                tr.find(".price").val(data["product_price"]);
                tr.find(".amount").html(tr.find(".qty").val() * tr.find(".price").val());
                
                calculate(0,0);
            }
        })
    })
 
    function AddNewRow(){
        
        $.ajax({
            url: DOMAIN+ "/include/process.php",
            type : "POST",
            data : {getOrderRow:1},
            success : function(data){
               $("#invoiceItems").append(data);
              
               var n =0;
               $(".number").each(function(){
                   $(this).html(++n);
               })
            }
    
        })
    
    }

    $("#invoiceItems").delegate(".qty","keyup",function(){
        var qty =$(this);
        var tr =$(this).parent().parent();
        if(isNaN(qty.val())){
            alert("please enter valied quantity");
            qty.val(1);
        }else{

            if((qty.val() - 0) > (tr.find(".tqty").val() - 0)){
                alert("Sory ! this much of quantity is not availble");
                qty.val(1);
            }else {
                tr.find(".amount").html(qty.val() * tr.find(".price").val());
                calculate(0,0);
            }

        }
       
    })

    function calculate(discount,paidAmount){

        var subTotal = 0;
        // var GST = 0;
        var NetTotal = 0;
        var Discount = discount;
        var paid = paidAmount;
        var due = 0;

        $(".amount").each(function(){

            subTotal =subTotal + ($(this).html() * 1);

        })

         $("#subTotal").val(subTotal);

        // GST = 0.18 * subTotal;

        // NetTotal = GST + subTotal;
        NetTotal = subTotal - Discount;
        due = NetTotal - paid;

        // $("#gst").val(GST);

        
        $("#discount").val(Discount);
        $("#netTotal").val(NetTotal);
        // $("#paid")
        $("#due").val(due);
        

    }
    $("#discount").keyup(function(){

        var discount =  $(this).val();
        calculate(discount,0);
    })

    $("#paid").keyup(function(){

        var pid = $(this).val();
        var discount =  $("#discount").val();
        calculate(discount,pid);
        

    })

    jQuery("#orderForm").click(function(){


        var invoiceData = $("#orderForm_getData").serialize();

        if($("#orderCustomer").val() === ""){

            alert("Please enter Customer name");

        }else if($("#paid").val() === "" || $("#paid").val() <= 0){

            alert("please enter valied paid ammount");

        }else{
                   
            $.ajax({
    
                url : DOMAIN+ "/include/process.php",
                type : "POST",
                data : $("#orderForm_getData").serialize(),
                success : function(data){
                    
                    if(data === "ORDER_INSERT"){

                        $("#orderForm_getData").trigger("reset");

                        if(confirm("Do you want to Print Invoice")){

                         window.location.href = DOMAIN+"/include/invoice.php?"+invoiceData;

                        }
                    }else {
                        alert("ERROR");
                    }
    
                }
           
        })

       

        
    }
    
    
      
    
    
    })


})