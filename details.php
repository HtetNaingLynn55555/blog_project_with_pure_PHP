<?php
    require 'config.php';
    session_start();

    if( empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
        echo "<script> window.location.href='login.php' </script>";
    }else{
        $id = $_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM `posts` WHERE id='$id'");
        $stmt->execute();

        $postData = $stmt->fetch(PDO::FETCH_ASSOC);


        // print "<pre>";
        // print_r($postData);
        // exit();
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Post Details</title>
</head>
<body>


        <div class="container">
            <div class="row mt-5">
                <div class="col-4"></div>
                    <div class="col-4">

                        <div class="card" style="width: 18rem;">
                        
                        <?php 
                            if($postData['image'] != ""){
                        ?>

                            <img class="card-img-top" src="images/<?php echo $postData['image'] ?>" alt="Card image cap">

                        <?php } ?>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $postData['title'] ?></h5>
                            <p class="card-text"> <?php echo $postData['description'] ?> </p>
                        </div>

                        </div>
                        <a href="index.php" class="btn btn-primary mt-2"> Home</a>
                    </div>
            </div>
            
            
        </div>


</body>
</html>