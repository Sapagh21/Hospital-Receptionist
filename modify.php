<?php
    include __Dir__."/Template/db.php";
    $conn=database_connect();
    
    $error=" ";

    if(!isset($_GET['q'])){
        echo "Something Went Wrong Please Try again later";
        echo "<br><a href='Home.php'>Return  home </a>";
        die();
    }
    
    $pid=$_GET['q'];
  
    //Retrieve all info to Put in the text fields
    $getall= mysqli_query($conn, "SELECT * FROM patient JOIN medicalrecord ON patient.patient_id = medicalrecord.patient_id WHERE patient.patient_id = $pid");
    $res = mysqli_fetch_all($getall,MYSQLI_ASSOC);
    $col=$res[0]; // cause it returns only 1 record
    //personal info
    if(mysqli_num_rows($getall)>0){
        $name=$col['name'];
        $n_id=$col['national_id'];
        $age=$col['age'];
        $gndr=$col['Gender'];
        $city=$col['city'];
        $cntct=$col['phone'];
        $status=$col['status'];
        $bill=$col['bill'];
        $room=$col['room'];
    //medical record
        $diagnos=$col['diag'];
        $treat=$col['treatment'];
        $inst=$col['instructions'];
        $notes=$col['notes'];
        $drugs=$col['medication_history'];

    //Supervising doctor
        $doc=$col['doctor_id'];
        if(!empty($doc)){
        $getdoc=mysqli_query($conn,"SELECT name from doctor where doctor_id ='$doc'");
        $doctor=mysqli_fetch_assoc($getdoc)["name"];
    }
        
    }else{
        echo "Something went wrong ";
    }


    /*****************************  !!UPDATE!! ***********************/
    if(isset($_POST["Discard"]) ){
        header("location: detailed.php?pa_id=$pid");
    }

    if(isset($_POST["modify"])){

        $name=$_POST['name'];
        $age=$_POST['age'];
        $gndr=$_POST['gndr'];
        $city=$_POST['city'];
        $cntct=$_POST['cntct'];
        $room=$_POST['room'];
        $bill=$_POST['bill'];
        $status=$_POST['stat'];
        
        //Supervising doctor
        $doctor=$_POST['doc'];

        //medical record
        $diagnos=$_POST['diagnos'];
        $treat=$_POST['treat'];
        $inst=$_POST['inst'];
        $drugs=$_POST['drugs'];
        $notes=$_POST['notes'];
        echo $diagnos;
        
        $p_query="UPDATE patient
                SET  name= ? , age=? , city =? ,phone=? , Gender= ? ,status= ? ,bill= ? , room = ? , doctor_id = ? 
                WHERE patient_id= ? ";
        $stmt=mysqli_prepare($conn,$p_query);
        
        mysqli_stmt_bind_param($stmt, "sissssisii",$name, $age, $city, $cntct, $gndr,  $status, $bill, $room,   $doctor,$pid);
        mysqli_stmt_execute($stmt);
        // mysqli_stmt_close($stmt);
        
        $record_q="UPDATE medicalrecord
        SET diag= ? , treatment=? , instructions =? ,notes=? , medication_history= ?
        WHERE patient_id= ? ";
        $stmt=mysqli_prepare($conn,$record_q);
        mysqli_stmt_bind_param($stmt, "sssssi", $diagnos, $treat, $inst, $notes, $drugs, $pid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);


        //check room
        $roomsq=mysqli_query($conn,"select name from patient where room='$room'");
        $inroom=mysqli_num_rows($roomsq);
        if($inroom>4){
            resetroom($pid);
            $error="This Room is Full! , Please Choose Another Room.";
        }else{
            mysqli_close($conn);
            header("location: detailed.php?pa_id=$pid");
        }
 

    }






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify <?= strtoupper($name)?> Info </title>
</head>
<body>
    <?php include __DIR__."/Template/header.php" ?>
    <div class="s_cont container">
        <div class="modify">

            <form method="post" action="<?= $_SERVER["PHP_SELF"]."?q=$pid"?>" autocomplete="off">
            <input type="hidden" name="q" value="<?=$pid?>">
                <h2>Persnal Information</h2>
                    <label for="name">Name:</label>
                    <input type="text" id="" name="name" value="<?=$name?>">
                
                    <label for="n_id">National ID:</label>
                    <input type="text" id="" name="n_id" value="<?=$n_id?>" 
                    style="background-color: #f2f2f2;border: 1px solid #ccc;color: #888;pointer-events: none;" 
                    readonly>
                

                   
                    
                    <label for="age">Age:</label>
                    <input type="number" id="" name="age" value="<?=$age?>">

                    
                    <label for="gndr">Gender:</label>
                    <input type="text" id="" name="gndr" value="<?=$gndr ?>">
                
                    
                    <label for="city">City:</label>
                    <input type="text" id="" name="city" value="<?=$city?>">
                
                    
                    <label for="cntct">Phone number:</label>
                    <input type="text" id="" name="cntct" value="<?=$cntct?>">
                
                    <label for="room">Room NO:</label>
                    <div class="room">
                    <p style="color:red;"><?=$error?></p>
                    <select name="room" id="">
                        <option style=" font-weight:bold;" value=<?=$room?>>Room #<?=$room?></option>
                        <?php for($i=1 ; $i<=10;$i++): ?>
                        <?php if($i==$room) continue; ?>
                        <option value="<?=$i?>">Room #<?=$i?></option>
                        <?php endfor?>
                    </select>
                    </div>
                            



                    
                    <label for="bill">Bill:</label>
                    <input type="number" id="" name="bill" value="<?=$bill?>" >
                    
                    <label for="stat">Status:</label>
                    <select name="stat" id="">
                        <option value="<?=$status ?>"> <?=$status ?></option>
                       
                        <?php if($status == "Admitted"): ?>
                        <option value="Discharged"> Discharged</option>
                        <?php else:?>
                        <option value="Admitted"> Admitted</option>
                        <?php endif ?>

                    </select>
                    
                    
                    <label for="doc">Supervising Doctor:</label>
                    <select style="padding:0 10px;" name="doc" id="">
                    <?php if(!empty($doc)): ?>
                    <option value="<?=$col['doctor_id']?>">Dr. <?=$doctor?>  </option>
                    <?php else :?>
                        <option value="">-----</option>
                    <?php endif?>
                    <?php      $doctors=getdocs();
                         foreach($doctors as $doctor):  ?>
                        <?php if ($doctor["doctor_id"]==$doc)continue;  ?>
                        <option value="<?=$doctor['doctor_id']?>">Dr. <?=$doctor['name']?>  </option>
                        <?php endforeach?>
                    </select>

                <h2>Medical Record</h2>
                  
                    <label for="diagnos">Diagnosis:</label>
                    <input type="text" id="" name="diagnos" value="<?=$diagnos?>">
            
                
                    <label for="rteat">Treatments:</label>
                    <input type="text" id="" name="treat" value="<?=$treat?>">
            
                
                    <label for="inst">Instructions:</label>
                    <input type="text" id="" name="inst" value="<?=$inst?>">
            
                
                    <label for="drugs">Drugs:</label>
                    <input type="text" id="" name="drugs" value="<?=$drugs?>">
            
                
                    <label for="notes">Notes:</label>
                    <input type="text" id="" name="notes" value="<?=$notes?>">
        
            
                    <input type="submit" value="Discard Changes" name="Discard"></button>
                <input type="submit" value="Modify" name="modify"></button>
            </form>


        </div>
    </div>
    <?php include __DIR__."/Template/footer.php" ?>
</body>
</html>