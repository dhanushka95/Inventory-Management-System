<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Inventory Management System</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type ="text/javascript" src="./js/order.js"></script>
</head>
<body>
        <div class="overlay"><div class="loader"></div></div>
       <!--- navigation bar -->
    <?php include_once("./templates/header.php"); ?>

    <br/><br/>

    <div class="container">

        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">

                <div class="card-header">
                 <h4>New Order</h4>
                </div>

                    <div class="card-body">
                    
                    <form id="orderForm_getData" name="orderForm_getData" onsubmit="return false">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-lable" align="right">Order Date</label>
                                <div class="col-sm-6">
                                <input type="text" id="orderDate" name="orderDate" class="form-control form-control-sm " readonly value="<?php echo date("Y-d-m"); ?>">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-lable" align="right">Customer Name</label>
                                <div class="col-sm-6">
                                <input type="text" id="orderCustomer" name="orderCustomer" class="form-control form-control-sm " placeholder="Enter customer name" required/>
                                </div>

                            </div>
                        <div class="container">
                        <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
                        <div class="card-body">
                            <h3>Make Order List</h3>
                                        <div class="table-responsive ">
                                        <table class="table table-hover table borderless" align="center" style="width:800px;">
                                        <thead class="thead-dark">
                                            <tr>
                                            <th>#</th>
                                            <th scope="col" style="text-align : center;">Item Name</th>
                                            <th scope="col" style="text-align : center;">Total Quantity</th>
                                            <th scope="col" style="text-align : center;">Quantity</th>
                                            <th scope="col" style="text-align : center;">Price</th>
                                            <th scope="col" style="text-align : center;">Total</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody id="invoiceItems">
                                            <!-- <tr>
                                            <td><b id="number">1</b></td>
                                            <td>
                                            <select class="form-control" id="pname[]" name="pname[]" required>
                                            <option> washin </option>
                    
                                            </select>
                                            </td>
                                            <td>
                                            <input type="text" class="form-control" readonly name="tqty[]" id="tqty[]" >
                                            </td>
                                            <td>
                                            <input type="text" class="form-control" name="qty[]" id="qty[]" required>
                                            </td>
                                            <td>
                                            <input type="text" class="form-control" name="price[]" id="price">
                                            </td>
                                            <td>1540</td>
                                            
                                            </tr> -->
                                            
                                        </tbody>
                                        </table>
                                        </div>

                            <center style="padding:15px;">
                            <button style="width:150px;" id="add" type="submit" class="btn btn-success">Add</button>
                            <button style="width:150px;" id="remove" type="submit" class="btn btn-danger">Remove</button>
                            </center>

                        </div>

                        </div>
                        </div>



                        <p></p>

                        <div class="form-group row">

                            <label for="subTotal" class="col-sm-3 col-form-lable" align="right">Sub Total</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="subTotal" id="subTotal" aria-describedby="emailHelp" readonly required/>
                            </div>

                        </div>

                       
                        <div class="form-group row">

                            <label for="discount" class="col-sm-3 col-form-lable" align="right">discount</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="discount" id="discount" aria-describedby="emailHelp" required/>
                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="netTotal" class="col-sm-3 col-form-lable" align="right">Total</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="netTotal" id="netTotal" aria-describedby="emailHelp" readonly required/>
                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="paid" class="col-sm-3 col-form-lable" align="right">paid</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="paid" id="paid" aria-describedby="emailHelp" required/>
                            </div>

                        </div>
                        <div class="form-group row">

                            <label for="due" class="col-sm-3 col-form-lable" align="right">Due</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="due" id="due" aria-describedby="emailHelp" readonly required/>
                            </div>

                        </div>
                        <div class="form-group row">

                            <label for="paymentType" class="col-sm-3 col-form-lable" align="right">Payment Type</label>
                            <div class="col-sm-6">
                            <select class="form-control" id="paymentType" name="paymentType" required>
                                <option>Cash</option>
                                <option>Card</option>
                                <option>Draft</option>
                                <option>Cheque</option>
                            </select>

                            </div>

                        </div>

                        <center style="padding:10px;">
                            <button style="width:150px;" id="orderForm" type="submit" class="btn btn-info">Order</button>
                            <button style="width:150px;" id="printInvoice" type="submit" class="btn btn-success d-none">Print</button>
                        </center>

                    </form>



                    </div>
                </div>
            </div>

        </div>
    
    </div>
    
   
</body>
</html>