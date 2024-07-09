<?php 
    session_start(); // resume the session
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
        // not logged in, redirect to the login page
        header("Location: login.php");
        exit();
    }
    $receptionist_name=$_SESSION['receptionist'];
    
    if(isset($_POST["logout"])){
        session_destroy();
        header("location: ../login.php");
    }
    header("refresh:1;url=Home.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <img src="css/success.webp" alt="">
    <h1>Patient Added Successfully!!</h1>
    <p>you will be redirected to home page after 2 seconds...</p>
    </div>
</body>
<style>
    div{
        text-align: center;
        position: absolute;
        top: 60%;
        left: 50%;
        transform: translate(-50%,-50%);
        font-family:sans-serif;

    }

    img {
        height: 460px;
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        z-index: -99999999;
    }
    body{
        pointer-events:none;
}
</style>