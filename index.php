<?php

    require 'config.php';

    session_start();

    if(empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){

        echo "<script> window.location.href='login.php' </script>";
    }else{
        
        $stmt = $pdo->prepare("SELECT * FROM `posts` ORDER BY id DESC");
        $stmt->execute();

        $postsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Home</title>
</head>
<body>
    
    <div class="container mt-5">
        <table class="table">

            <a href="create.php" class="btn btn-primary mb-3"> Create New Post</a>
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($postsData){
                        
                        $i = 1;
                        foreach($postsData as $postData ){
                ?>
                <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $postData['title'] ;?></td>
                <td><?php  echo $postData['description'] ?></td>
                <td> 
                    <a href="edit.php?id=<?php echo $postData['id'] ?>" class="btn btn-warning"> Edit</a>
                    <a href="details.php?id=<?php echo $postData['id'];?>" class="btn btn-success">Details</a>
                    <a href="delete.php?id=<?php echo $postData['id']?>" class="btn btn-danger">Delete</a>
                </td>
                </tr>
                <?php $i++; }} ?>
            </tbody>
        </table>
        <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </div>

</body>
</html>