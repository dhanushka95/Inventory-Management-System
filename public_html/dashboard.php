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
    <script type ="text/javascript" src="./js/main.js"></script>
</head>
<body>
       <!--- navigation bar -->
    <?php include_once("./templates/header.php"); ?>

    <br/><br/>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mx-auto">
                        <img src="./image/user.png" class="card-img-top mx-auto" alt="..." style="width: 60%;">
                        <div class="card-body">
                            <h5 class="card-title">Profile Info</h5>
                            <p class="card-text"><i class="fa fa-user">&nbsp;</i>Dhanushka dayawansha</p>
                            <p class="card-text"><i class="fa fa-user">&nbsp;</i>Admin</p>
                            <p class="card-text">Last Login :xxxx-xx-xx</p>
                            <a href="#" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
                        </div>
                </div>

            </div>
            
            <div class="col-md-8">
                <div class="jumbotron" style="width: 100%; height: 100%;">  
                <h1>Welcom addmin</h1>
                    <div class="row">
                        <div class="col-sm-6">
                          <iframe src="http://free.timeanddate.com/clock/i6p1hbkq/n5364/szw160/szh160/hbw0/hfc000/cf100/hgr0/fav0/fiv0/mqcfff/mql15/mqw4/mqd94/mhcfff/mhl15/mhw4/mhd94/mmv0/hhcbbb/hmcddd/hsceee" frameborder="0" width="160" height="160"></iframe>
                        </div>
                        <div class="col-sm-6">
                        
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">New order</h5>
                                    <p class="card-text">here u can make invoice and new order</p>
                                    <a href="#" class="btn btn-primary">new oders</a>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
          

        </div>
       
    </div>
    <p></p>
    <p></p>

    <div class="container">
        <div class="row">
             <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                                <h5 class="card-title">categories</h5>
                                <p class="card-text">here u can make manage category and add new category</p>
                                <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary">Add</a>
                                <a href="manageCategory.php" class="btn btn-primary">Manage</a>
                        </div>
                    </div>
             </div>
             <div class="col-md-4">
                    <div class="card">
                                <div class="card-body">
                                        <h5 class="card-title">brands</h5>
                                        <p class="card-text">here u can make manage brands and add new brands</p>
                                        <a href="#" data-toggle="modal" data-target="#form_brand"  class="btn btn-primary">Add</a>
                                        <a href="#" class="btn btn-primary">Manage</a>
                                </div>
                    </div>
             </div>
             <div class="col-md-4">
                    <div class="card">
                                <div class="card-body">
                                        <h5 class="card-title">product</h5>
                                        <p class="card-text">here u can make manage product and add new product</p>
                                        <a href="#" data-toggle="modal" data-target="#form_product"  class="btn btn-primary">Add</a>
                                        <a href="#" class="btn btn-primary">Manage</a>
                                </div>
                    </div>
             </div>
        </div>
    </div>

<!-- add modal -->
<?php
include_once("./templates/category.php");
?>
<?php
include_once("./templates/brand.php");
?>
<?php
include_once("./templates/product.php");
?>
    
   
</body>
</html>