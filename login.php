<?php
    require 'config.php';
    session_start();

    if(!empty($_POST)){
        
        $stmt = $pdo->prepare("SELECT * FROM `users` WHERE email=:email");
        $stmt->execute(
            array(
                ":email"=>$_POST['email']
            )
            );
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($result){
            $ValidatePassword = password_verify($_POST['password'],$result['password']);

            if($ValidatePassword){

                $_SESSION['user_id'] = $result['id'];
                $_SESSION['logged_in'] = time();

                header('location:index.php');
            }else{
                echo "<script> alert ('Password is wrong')<script>";
            }
        //  print "<pre>";
        // print_r($ValidatePassword);
        // exit();
            
        }else{
            echo "<script> alert('Your Email is Wrong') <script>";
        }


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>

    <div class="container mt-5">

        <form action="" method="POST">

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email"  requried placeholder="Enter Your email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="register.php" class="btn btn-primary">Register</a>
        </form>

    </div>
    
</body>
</html>