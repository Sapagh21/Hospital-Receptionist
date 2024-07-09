<?php
    include __Dir__."/Template/db.php";
    $conn=database_connect();
 
    if(!isset($_GET['pa_id'])){
        header("location: search.php");
        exit();
    }

    $pid=$_GET['pa_id'];

    $getall= mysqli_query($conn, "SELECT * FROM patient JOIN medicalrecord ON patient.patient_id = medicalrecord.patient_id WHERE patient.patient_id = $pid");
    $res = mysqli_fetch_all($getall,MYSQLI_ASSOC);
    //personal info
    if(mysqli_num_rows($getall)>0){
        $col=$res[0]; // cause it returns only 1 record
        $name=$col['name'];
        $n_id=$col['national_id'];
        $city=$col['city'];
        $cntct=$col['phone'];
        $gndr=$col['Gender'];
        $status=$col['status'];
        $bill=$col['bill'];
        $room=$col['room'];
        $age=$col['age'];
        
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
        $doctor=mysqli_fetch_assoc($getdoc)["name"];}
        else{
            $doctor="";
        }
        
    }else{
        echo "Something went wrong try again later<br>","<a href='search.php' > Search Page</a>";
        mysqli_query($conn,"DELETE from patient where patient_id='$pid'");
        exit();
    }

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient <?= strtoupper($name)?> Details </title>
</head>
<body>
    <?php include __DIR__."/Template/header.php" ?>
    <div class="s_cont container">
        <a href="modify.php?q=<?=$pid?>"><button> Update&Modify</button></a>
        <div class="info">
            <h2>Persnal Information</h2>
            <div class="grid">
                <p>Name: <div class="p_info"><?= $name ?></div></p>
                <p>National ID: <div class="p_info"><?= $n_id ?> </div>   </p>
                
                <p>Age: <div class="p_info"><?= $age ?></div>   </p>
                <p>Gender: <div class="p_info"><?= $gndr ?></div>   </p>
                
                <p>City: <div class="p_info"><?= $city ?></div></p>
                <p>Phone number: <div class="p_info"><?= $cntct ?></div>   </p>
                
                
                <p>Room NO: <div class="p_info"><?= $room ?></div>   </p>
                <p>bil: <div class="p_info"><?= $bill ?>$</div>   </p>
            </div>
            <div id="doc"> <p>Supervising Doctor</p>  <div class="p_info" style="text-align:center"><?= $doctor ?></div>         </div>

            </div>
        
            <div class="record">
                <h2>Medical Record</h2>
                <div class="drecord">
                
                <p>Diagnosis:  <div class="p_info"><?= $diagnos ?></div>   </p>
                <p>Treatments: <div class="p_info"><?= $treat ?></div></p>
                <p>Instructions : <div class="p_info"><?= $inst ?></div></p>
                <p>Drugs : <div class="p_info"><?= $drugs ?></div></p>
                <p>Notes : <div class="p_info"><?= $notes ?></div></p>
                
            </div>

            </div>
        </div>
        

    <?php include __DIR__."/Template/footer.php" ?>
</body>
</html>