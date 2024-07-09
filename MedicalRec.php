<?php

    include __DIR__."/Template/db.php";
    $conn = database_connect();
    // Inserting int the patient table
    
    if (isset($_GET['pid'])) {
        $pid=$_GET['pid'];
    }
    
    if ( isset($_POST['makerec'] ) ){
        
        $notes=$_POST['note'];
        $diag=$_POST['Diagnosis'];
        $drug=$_POST['drug'];
        $instr=$_POST['instr'];
        $treatment=$_POST['treat'];
                //to prepared     
        $stmt=mysqli_prepare($conn,
                            "insert into medicalrecord (diag , treatment,instructions,notes,medication_history,patient_id)
                             VALUES (? , ? , ? , ? , ? , ?) ");

        mysqli_stmt_bind_param($stmt,"sssssi",$diag,$drug,$instr,$treatment,$notes,$pid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("location: finish.php?patient=$pid");
        exit();

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Record</title>

</head>

<style> 
form label{
    font-family:pop;
    font-weignt:300;
    
}
form{
    width:400px;
}
</style>
<body>
    <?php include __DIR__."/Template/Header.php"?>
    <div class="container body">
        <h1 style="text-align:center  "> Medical Record </h1>


        <form class="medrec" action=<?php if (isset($_GET['pid']))echo "MedicalRec.php?pid=$pid" ?> method="post" autocomplete=off>
        
            <div class="detail">
                <label for="Diagnosis">Diagnosis</label>
                <textarea name="Diagnosis" id="" cols=" 30" rows="4" required></textarea>
            </div>  
            
            <div class="detail">
                <label for="drug"> Medication History</label>
                <textarea name="drug" id="" cols=" 30" rows=" 4"></textarea>
            </div>  
            <div class="detail">
                <label for="instr">  Instructions</label>
                <textarea name="instr" id="" cols=" 30" rows=" 4"></textarea>
            </div>  

            

            <div class="detail">
                <label for="treat"> Treatment</label>
                <textarea name="treat" id="txtar" cols=" 30" rows=" 4"></textarea>
            </div>  
            <div class="detail">
                <label style="position:relative;left:245px; font-size:1.2em" for="note">  Notes</label>
                <textarea style="width:268%;left:6px; position:relative;"name="note" id="" cols=" 35" rows="6"></textarea>
            </div>  
            <br> <br>
            
            <input class="subtn" name="makerec" type="submit" value="Submit Medical Record" >

        </form>
    
    
    </div>
    <?php include __DIR__."/Template/footer.php"?>
</body>
</html>