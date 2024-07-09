<?php
    include __DIR__."/Template/db.php";
    $conn = database_connect();
    $error="";
    // Inserting int the patient table
    if ( isset($_POST['add']  ) ){

        $name=$_POST['name'];
        $num=$_POST['number'];
        $age=$_POST['age'];
        $address=$_POST['addrs'];
        $id=$_POST['id'];
        
        if(empty($name)  || empty($id) || empty($age))
        {
            $error="Please Fill all Fields";
        }
        elseif(idexist($id))
        {
            $error= "This National id Already Exists";
        }
        else
        {
            $gender=$_POST['gender'];
            // mysqli_query($conn,"insert into patient (Name , Phone,city,national_id,Gender) VALUES ('$name' , '$num','$address','$id','$gender')");
            $stmt=mysqli_prepare($conn,"INSERT into patient (Name , age,Phone,city,national_id,Gender) VALUES(? ,? ,? ,? ,? ,? )");
            mysqli_stmt_bind_param($stmt,"sissss",$name,$age,$num,$address,$id,$gender);
            mysqli_stmt_execute($stmt);
            $p_id = mysqli_insert_id($conn);    
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("location: MedicalRec.php?pid=$p_id");


        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>

</head>
<body>
    <?php include __Dir__."/Template/Header.php"?>

    <div class="s_cont">

        <h1 style="text-align:center  "> Add Patient </h1>

        <form action="add_patient.php" method="post" autocomplete=off>
            <div class="detail">
                <label for="name"> Full Name</label>
                <input type="text" name="name" id="">
            </div>
        
            <div class="detail">
                <label for="age">Age</label>
                <input type="number" name="age" id="" >
            </div>
            
            <div class="detail">
                <label for="id">National ID</label>
                <input type="text" name="id" id="">
            </div>
            
            
            
            <div class=" detail gender">
                <p>Gender</p>
                <div class="detail">
                    <div class="choice">
                        <label for="male">Male</label>
                        <input type="radio" id="" name="gender" value="Male">
                    </div>
                    <div class="choice">
                        <label for="female">Female</label>
                        <input type="radio" id="" name="gender" value="Female">
                    </div>
                </div>
                
            </div>
            <div class="detail">
                <label for="addrs">Address</label>
                <input type="text" name="addrs" id="" placeholder ="City,Governorate">
            </div>

            <div class="detail">
                <label for="number"> Contact Number</label>
                <input type="text" name="number" id="">
            </div>
            <input class="subtn" name="add" type="submit" value="Add" >
            <br>
            <?php if(strlen($error)>0) : ?>
            <span style="color:red; font-family:pop;font-size:15px;text-align:center;grid-column:1 / span 2"><?=$error ?> </span>
            <?php endif?>
        </form>

    </div>

    <?php include __Dir__."/Template/footer.php"?>
</body>
</html>