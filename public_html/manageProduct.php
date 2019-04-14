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
    <script type ="text/javascript" src="./js/manage.js"></script>
</head>
<body>
       <!--- navigation bar -->
    <?php include_once("./templates/header.php"); ?>

    <br/><br/>

    <!--add table -->

    <div class="container">
                        <nav class="navbar navbar-dark bg-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Search <span class="sr-only">(current)</span></a>
                        </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2 searchProductText" id="searchProductText" name="searchProductText" type="search" placeholder="Type product name" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0 btnProductSearch" name="btnProductSearch" id="btnProductSearch" type="button">Search</button>
                        </form>
                    </div>
                    </nav>
    <div class="table-responsive-sm">
                <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Category</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Quantity</th>
                    <th scope="col">Minimum Quantity</th>
                    <th scope="col">Added Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    
                    </tr>
                </thead>
                <tbody id="getProductManage">
                    <!-- <tr>
                    <th scope="row">1</th>
                    <td>ic</td>
                    <td>Electronic</td>
                    <td>kings</td>
                    <td>1000</td>
                    <td>10</td>
                    <td>2015/5/10</td>
                    <td>
                        <a href="#" class ="btn btn-success btn-sm">Active</a>
                    </td>
                    <td>
                        <a href="#" class ="btn btn-danger btn-sm">Delete</a>
                        <a href="#" class ="btn btn-info btn-sm">Update</a>
                    </td>
                    </tr> -->
                    
                </tbody>
                </table>
    </div>

    </div>
<!-- add model -->
    <?php
        include_once("./templates/updateProduct.php");
    ?>
    
   
</body>
</html>