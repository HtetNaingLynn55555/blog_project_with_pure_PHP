<?php

    require 'config.php';

    if(!empty($_POST)){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        
        if( $name == '' || $email =='' || $password == ''){
            echo "<script> alert('Please fill all fields')</script>";
        }else{
           
            $stmt = $pdo->prepare("SELECT COUNT(email) AS num FROM `users` WHERE email='$email'");
             $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
       
        
            if($result['num']>0){
                echo "<script> alert('email is already exist'); window.location.href = 'register.php';</script>";
            }else{
                
                $passwordHush = password_hash($password,PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("INSERT INTO `users` (name,email,password) VALUES (:name,:email,:password) ");
                $result =$stmt->execute(
                    array(
                        ":name"=>$name,
                        ":email"=>$email,
                        ":password"=>$passwordHush,
                    )
                    );
                if($result){
                    echo "<script> alert('successful register'); window.location.href='login.php';</script>";
                }

            }
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
    <title>Register</title>
</head>
<body>
    
    <div class="container mt-5">

        <form action="" method="POST">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control"  name="name" requried placeholder="Enter Your Name">
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email"  requried placeholder="Enter Your email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

</body>
</html>