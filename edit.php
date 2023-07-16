<?php

    require 'config.php';

    session_start();

    if (empty( $_SESSION['user_id']) || empty ( $_SESSION['logged_in']) ){

        echo "<script> window.location.href = 'login.php' </script>";
    }else{
        if($_POST){

            $id = $_POST['id'];
            $title = $_POST['title'];
            $description =$_POST['description'];

            if($_FILES['image']['name'] == ''){

                $stmt = $pdo->prepare("UPDATE `posts` SET title='$title', description='$description' WHERE id='$id'");
                
                if($stmt->execute()){
                    header("location:index.php");
                }

            }else{

                
                $filename = $_FILES['image']['name'];
                $targetFile = 'images/'.$_FILES['image']['name'];
                $fileType = pathinfo($targetFile,PATHINFO_EXTENSION);

                if( $fileType == 'jpg' || $fileType == 'png' || $fileType == 'jpeg'){

                    $move = move_uploaded_file( $_FILES['image']['tmp_name'] , $targetFile);

                    if($move){

                        $stmt = $pdo->prepare("UPDATE `posts` SET title = '$title' ,description = '$description' , image = '$filename'");
                        $stmt->execute();

                        header("location:index.php");
                    }

                }
                
            }

        }else{

            $id = $_GET['id'];
            $stmt = $pdo->prepare("SELECT * FROM `posts` WHERE id='$id'");
            $stmt->execute();

            $postData = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <title>Edit</title>
</head>
<body>
    
    <div class="container mt-3">

        <form action="" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $postData['id'] ?>">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $postData['title'] ?>" required placeholder="Enter Post Title">
                    
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" required id="" cols="30" rows="10">
                        <?php echo $postData['description']; ?>
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="image">Example file input</label>
                    <img src="images/<?php echo $postData['image'] ?>" width="100px;" height="auto;" alt="">
                    <input type="file"   name="image"  class="form-control-file" >
                </div>

                

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="index.php" class="btn btn-outline-success"> Home </a>
            </form>

    </div>

</body>
</html>