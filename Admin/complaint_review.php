<?php 
{

    $dbHost = "localhost";        //Location Of Database usually its localhost 
    $dbUser = "root";            //Database User Name 
    $dbPass = "";            //Database Password 
    $dbDatabase = "rail_connect";    //Database Name 

     
    $db = mysqli_connect($dbHost,$dbUser,$dbPass) or die("Error connecting to database."); 
    //Connect to the databasse 
    mysqli_select_db($db, $dbDatabase)or die("Couldn't select the database."); 


    $sql = mysqli_query($db ,"SELECT * FROM `complaints`"); 
    if(($sql) == TRUE){ 
       

       $option = '';
 while($row = mysqli_fetch_assoc($sql))
{
  $option .= '<option value = "'.$row['name'].'">'.$row['pnr_no'].'</option>';
}
            
    }
    else { echo "Fatal Error no complaints";  

        exit ;
    }

}

?>
