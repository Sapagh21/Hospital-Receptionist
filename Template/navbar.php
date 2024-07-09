<?php
$active=basename($_SERVER['SCRIPT_NAME']);
?>
<nav class="navbar">
<ul >
   <li class="<?php if($active === "home.php") echo 'Active'?>"> 
        <a class="<?php if($active != "home.php") echo "not"?>" href= <?= "home.php" ?>        > Home</a>
    </li>

    <li class="<?php if($active === "add_patient.php") echo "Active"?>" >
        <a  class="<?php if($active != "add_patient.php") echo "not"?>" href= <?= "add_patient.php"?>  >  Add Patient</a>
    </li>

    <?php if(isset($_GET['pid'])):?>
    <li class="<?php if($active === "MedicalRec.php") echo "Active" ?>">
        <a class="<?php if($active != "MedicalRec.php") echo "not"?>" href= <?= "MedicalRec.php"?>>Medical Record</a> 
    </li>
    <?php endif?>
    
    <?php if(isset($_GET['patient'])):?>
        <li class="<?php if($active === "finish.php") echo "Active" ?>">
            <a class="<?php if($active != "finish.php") echo "not"?>" href= <?= "finish.php"?>>Room&doctor</a> 
        </li>
    <?php endif?>


    <li class="<?php if($active === "search.php") echo "Active" ?>">
        <a class="<?php if($active != "search.php") echo "not"?>" href= <?= "search.php"?>>Search Patient</a> 
    </li>
        

    <?php if(isset($_GET['pa_id'])):?>
        <li class="<?php if($active === "detailed.php") echo "Active" ?>">
            <a class="<?php if($active != "detailed.php") echo "not"?>" href= <?= "detailed.php"?>><?=$name ?>'s information</a> 
        </li>
    <?php endif?>

   
</ul>
</nav>