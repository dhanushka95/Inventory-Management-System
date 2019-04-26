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
    <?php include_once("./templates/header.php"); 
    
    ?>

    <br/><br/>
    <div class="container">
        <div class="card mx-auto" style="width: 30rem;">
            <div class="card-header">Register
            </div>
            <div class="card-body">
            
                <form id="register_form_user" name="register_form_user" onsubmit="return false" autocomplete="off">
                        <div class="form-group">
                            <label for="username">Full name</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter user name">
                            <small id="user_error" class="form-text text-muted"></small>
                      
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"  placeholder="email">
                            <small id="email_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone number</label>
                            <input type="text" class="form-control" id="phone" name="phone"  placeholder="phone number">
                            <small id="phone_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                            <small id="password1_error" class="form-text text-muted"></small>
                      
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Re Enter Password</label>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Password">
                            <small id="password2_error" class="form-text text-muted"></small>
                      
                        </div>
                        <div class="form-group">
                            <label for="usertype">User Type</label>
                            <select name="usertype" class="form-control" id="usertype" name="usertype">
                                <option value="1">Admin</option>
                                <option value="0">other</option>
                            </select>
                            </div>
                        <button type="submit" name="user_register_form" id="user_register_form" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Register</button>
                        <span><a href="index.php">Login</a></span>
            </form>
            
            </div>
            <div class="card-footer text-muted"></div>
        </div>
    </div>

   
</body>
</html>