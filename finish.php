<?php 
include __DIR__."/Template/db.php";
$conn=database_connect();

if(isset($_GET["patient"])){
    $pa=$_GET["patient"];
}

// $getdoc=mysqli_query($conn,"SELECT * from doctor");
$doctors = getdocs();

$error="";

if(isset($_POST["finishadd"])){

        //ِ Adding doctor
        $doc=$_POST["doc"];
        // mysqli_query($conn,"UPDATE patient SET doctor_id = '$doc' where patient_id ='$pa'");
        //to prepared
        $stmt=mysqli_prepare($conn,"UPDATE patient set doctor_id = ? where patient_id = ? ");
        mysqli_stmt_bind_param($stmt,"ii",$doc,$pa);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);


        //room
        $room=$_POST["room"];
        mysqli_query($conn,"UPDATE patient SET room = '$room' where patient_id ='$pa'");
        // to prepared
        $stmt=mysqli_prepare($conn,"UPDATE patient SET room = ? where patient_id =?");
        mysqli_stmt_bind_param($stmt,"si",$room,$pa);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);


      //getting peole in the room  
        $patientsinroom=mysqli_query($conn,"SELECT name from patient where room='$room'");
        
        //check wether a room has been chosen or not
        if(empty($room) ){
            $error="Choose a room from the drop list";
        }
        
        //Each room can take up to 4 people 
        elseif(mysqli_num_rows($patientsinroom)>4){  
                resetroom($pa);
                $error="This room is full Please choose another room!";
            }
            
        else{
            header ("Location: Success.php");
            exit();
        }
    }
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>finish!</title>
</head>
<style>

    select{
        height:30px;
        padding:5px;
    }
    .finish{
        border: 1px transparent;
        border-radius: 10px;
        background-color: #4384bc;
        color: white;
        font-weight: bold;
        grid-column-start:1;
        grid-column-end:3;
        width: 50%;
        margin:auto;
    }
    .finish:hover{
        background-color:rgb(0 91 111);
        transition-duration: 0.5s;
    }

</style>
<body>
    <?php include __DIR__."/Template/Header.php" ?>
   <div class="s_cont container"> 
    <h1>Please Choose A Room and The Supervising Doctor</h1>

    <form action="finish.php?patient=<?=$pa?>" method="post">
   
    <select name="room" id="">
        <option value="">----</option>
    <?php for ($i=1;$i<=10;$i++):  ?>
        <option value="<?=$i?>">Room #<?=$i?>  </option>
        <?php endfor?>
    </select>

    <select name="doc" id="">
    <option value="">----</option>
    <?php foreach($doctors as $doctor):  ?>
        <option value="<?=$doctor['doctor_id']?>">Dr. <?=$doctor['name']?>  </option>
        <?php endforeach?>
    </select>

    <input type="submit" class="finish"name="finishadd"value="Finish">
    </form>
    <?php if(!empty($error)) :?>
        <p style="color:red;" class="error"><?= $error?></p>
    <?php endif?>

    </div>
    <?php include __DIR__."/Template/footer.php" ?>
</body>
</html>