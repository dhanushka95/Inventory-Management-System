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

                <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="getBrandManage">
                    <!-- <tr>
                    <th scope="row">1</th>
                    <td>Electronic</td>
                   
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
<!-- add model -->
    <?php
        include_once("./templates/updateBrand.php");
    ?>
    
   
</body>
</html>