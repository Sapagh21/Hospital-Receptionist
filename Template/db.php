<?php 
    //configuration
    define("HOSTNAME", "localhost");
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'hospital');
    
    //connection
    function database_connect(){
        mysqli_report(MYSQLI_REPORT_ERROR| MYSQLI_REPORT_STRICT);
        $conn=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);       
        return $conn;

    }
//functions:
    //to check if someone already exists:
    function idexist($id){
        $conn=database_connect();
        $stmt = mysqli_prepare($conn,"SELECT * from patient where national_id= ? ");
        mysqli_stmt_bind_param($stmt,"s",$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $nRows=mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        if($nRows>0){ 
            return True;
        }
        return False;
        
    }     
    //get all doctors info
    function getdocs(){
        $conn=database_connect();
        $all=mysqli_query($conn,"SELECT * from doctor");
        $res=mysqli_fetch_all($all , MYSQLI_ASSOC);
        return $res;
    }
    function resetroom($patient_id){
        $conn=database_connect();
        $stmt=mysqli_prepare($conn,"UPDATE patient set room =NULL  where patient_id = ? ");
        mysqli_stmt_bind_param($stmt,"i",$patient_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    
?>
