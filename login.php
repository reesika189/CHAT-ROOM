<?php

include "db.php";
session_start();

if(isset($_POST['name']) && isset($_POST['phone'])){
    
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $q = "SELECT * from `users` WHERE uname='$name' AND phone='$phone'";

    if($rq = mysqli_query($db,$q)){
        if(mysqli_num_rows($rq)==1){
            echo '<script>alert("logged in")</script>';
            $_SESSION["userName"]= $name;
            $_SESSION["phone"] = $phone;
            header("location:index.php");


        }else{
            $q = "SELECT * from `users` WHERE phone='$phone'";
            if($rq = mysqli_query($db,$q)){
                if(mysqli_num_rows($rq)==1){
                    echo '<script>alert("Already Taken By Another Person")</script>';
                }else{
                    $q="INSERT INTO `users`( `uname`, `phone`) VALUES ('$name','$phone')";
                    if($rq = mysqli_query($db,$q)){
                        $q = "SELECT * from `users` WHERE uname='$name' AND phone='$phone'";
                        if($rq = mysqli_query($db,$q)){
                            if(mysqli_num_rows($rq)==1){
                                echo '<script>alert("Login and Registered")</script>';
                                $_SESSION["userName"]= $name;
                                $_SESSION["phone"] = $phone;

                                header("location:index.php");


                            }
    
                        }
                        
                    }
                }

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
    <title>ChatRoom</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <h1>ChatRoom</h1>
    <div class="login">
        <h2>Login</h2>
        <p>This ChatRoom is the best example to demonstrate the concept of Chatbot and it's completely for beginners</p>
        <form action="" method="post">
        <h3>UserName</h3>
        <input type="text" placeholder="Short name" name="name">
        
        <h3>Mobile Number</h3>
        <input type="number" placeholder="With Country Code" min="1111111111" max="1111111111111" name="phone">

        <button>Login/Register</button>


        </form>
    </div>
</body>
</html>