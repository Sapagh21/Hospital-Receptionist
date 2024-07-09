<link rel="stylesheet" href="Css/style.css">

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

?>

<header>

    <div class="container header">
    <?php include __DIR__."/navbar.php" ?>
    </div>
    <form action="Template/Header.php" method="post">
        <input class="logout"type="submit" value="Log out" name="logout">
    </form> 
</header>
