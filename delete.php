<?php

    require 'config.php';

    session_start();

    if( empty( $_SESSION['user_id'] ) || empty( $_SESSION['logged_in'] )){
        echo "<script> window.location.href='login.php'; </script>";
    }else{
        if( !empty($_GET) ){

            $id = $_GET['id'];

            $stmt = $pdo->prepare("DELETE FROM `posts` WHERE id='$id'");
           
            if( $stmt->execute()){
                header("location:index.php");
            }

        }

    }

?>