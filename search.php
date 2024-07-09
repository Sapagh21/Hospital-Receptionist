<?php
    include __DIR__."/Template/db.php";
    $conn=database_connect();
    $obtained=FALSE;
    $found = true;

    if(isset($_GET['getpatient']) & isset($_GET['get_patient']) || isset($_GET["homesrch"]) ){
        // isset($_GET["homesrch"]){
        //     $key=name;
        // }
        $key=$_GET["choice"];
        $wanted=$_GET["get_patient"];
        if (strlen($wanted)>0 || $key=="ALL"){
            if($key=="ALL"){
                $patient=mysqli_query($conn,"SELECT * from patient where patient_id > 0 ");
            }else{
                $patient=mysqli_query($conn,"SELECT * from patient where $key ='$wanted' ");
            }
        

            if( mysqli_num_rows($patient )>0){
                $rows = mysqli_fetch_all($patient,MYSQLI_ASSOC);
                $obtained=True;
            }else{
                $found=False;
            }
            
        }
        
    }
    $choices = array(
        'ALL' => 'Show all Patients',
        'name' => 'Name',
        'national_id' => 'National id',
        'patient_id' => 'Patient ID',
        'room' => 'Room number'
    );
    $keys=array_keys($choices);
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <?php include __DIR__."/Template/Header.php"?>
  <div class="s_cont">
    <form id="searchres"action="search.php" method="get">
        <select name="choice" id="">
            <?php if(isset($_GET["choice"])):?>
                <option value= "<?=$key?>" ><?=$choices[$key]?></option>
            <?php endif ?>

            <?php foreach ($keys as $k):?>
                <?php if($key == $k){continue;}?>
                <option value= "<?=$k?>" ><?=$choices[$k]?></option>
            <?php endforeach ?>

        </select>


        <input type="text" name="get_patient" id="searchtxt" placeholder="Search for a patient" value="<?php if(isset($_GET["get_patient"])): ?><?=htmlspecialchars($_GET["get_patient"])?><?php endif?>" >
        <input type="submit" name="getpatient" class="search " value="Search">
    </form>

    <?php if ($obtained):?>

        <table calss="patient_table">

        <tr>
            <th>Name</th>
            <th>National ID</th>
            <th>Room</th>
            <th>Contact phone</th>
            <th>Address</th>
            <th>More Details</th>

        </tr>
        <?php foreach($rows as $row):?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['national_id'] ?></td>
            <td><?= $row['room'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['city'] ?></td>

            <td><a href=<?php echo "detailed.php?pa_id=".$row['patient_id'] ?>> View more</a></td>


        </tr>
        <?php endforeach?>
    </table>
        <?php elseif(!$found): ?>
        <h1 class="error"> The Patient You are tying to search for is not found</h1>
        <?php endif?>
    </div>
    <?php include __DIR__."/Template/footer.php"?>
</body>
</html>