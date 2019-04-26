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
    <script Type="text/javascript" src="./js/main.js"></script>
    
</head>
<body>
       <!--- navigation bar -->
     <?php include_once("./templates/tempheader.php"); 
    
    ?> 

    <br/><br/>
    <div class="container">
    <?php
    if(isset($_GET["msg"]) AND !empty($_GET["msg"])){
        ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_GET["msg"]; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

        <?php
    }

    ?>


        <div class="card mx-auto" style="width: 18rem;">
        <img src="./image/login.png" class="card-img-top mx-auto" style="width:60%;" alt="Login Icon">
        <div class="card-body">
         
            <form id="login_form_user" name="login_form_user" onsubmit="return false" autocomplete="off">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="log_email" id="log_email" placeholder="Enter email">
                        <small id="log_email_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="log_password" id="log_password" placeholder="Password">
                        <small id="log_password_error" class="form-text text-muted"></small>
                    
                    </div>
                    <button type="submit" name="login_user_button" id="login_user_button" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Login</button>
                    <span><a href="register.php">Register</a></span>
        </form>
        
        </div>
        <div class="card-footer"><a class="send_sms" href="#">Forget password ?</a></div>
        </div>
    </div>

   
</body>
</html>