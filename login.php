<?php 
    require_once __DIR__."/Template/db.php";

    session_start(); // Start the session
    $conn=database_connect();
// used because i forgot the login credentials
//    $q = mysqli_query($conn,"SELECT * from receptionist");
//    $recep=mysqli_fetch_all($q,MYSQLI_ASSOC );
//    var_dump($recep);
    $error="";
    if(isset($_POST["Login"])){
        $user=$_POST["user"];
        $pass=$_POST["pass"];
        $check=mysqli_query($conn,"SELECT * from receptionist where r_username = '$user' and r_pass= '$pass'" );
        $row = mysqli_fetch_assoc($check);
        if($row){
            $_SESSION['logged'] = true;
            $_SESSION['receptionist'] = $row['r_name'];

            header("location: Home.php");
        }elseif(empty($user)||empty($pass)){
            $error="Please fill ALL fields";
        }
        else{
            $error= "Invalid login!";
            echo $row;
        }
        
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>

<body>
    <form action="login.php" method="post">
    <h1>Login</h1>
    <label for="user">Username</label>
    <input type="text"   placeholder="Enter Username..."  name="user"  id="">
    <label for="user">Password</label>
    <input type="password" placeholder="Enter Password.."name="pass"  id="">
    
    <p class="error"><?=$error ?></p>

    <input class="log"type="submit" name= "Login" value="Login">
    </form>

</body>
</html>
<style>
    @font-face {
        font-family: 'pop';
        src: url("fonts/Poppins-Regular.ttf");
    }
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image:linear-gradient(320deg, rgb(0 91 111) 40%, transparent);
        background-repeat: no-repeat;
        background-size: cover;
    }
    
    form {
        display: flex;
        flex-direction: column;
        width: 25%;
        gap:10px;
        border:2px solid white;
        padding:150px 100px;
        border-radius:30px;
        min-width:400px;
        color:white;
        backdrop-filter:blur(10px);
        font-family:sans-serif;

    }

    input{
        /* backdrop-filter:blur(10px); */
        background:transparent;
        height:50px;
        padding:0 10px;
        min-width:200px;
        border-radius:10px;
        border:1px solid white;
        color:white;
        font-family:'pop';

    }
    input::placeholder{
        color:white;
    }

    .log{
        width:50%;
        align-self:center;
        min-width:100px;
        background-color:white;
        border: 1px solid transparent;
        border-radius:30px;
        font-weight:bold;
        height:40px;
        color:rgb(1 55 66);
        cursor:pointer;
    }

    .log:hover{
        color:white;
        background-color:rgb(1 55 66);
        transition-duration:.8s;
        
    }


 h1{
    position: relative;
 }
    h1::before{
        content:"";
        position:absolute;
        background-color:white;
        width:100%;
        height:2px;
        bottom:-10px;

    }

    .error{
        color:red;
        font-family:sans-serif;
        text-align:center;
    }

</style>