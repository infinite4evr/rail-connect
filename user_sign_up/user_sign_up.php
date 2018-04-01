<?php 

    $dbHost = "localhost";        //Location Of Database usually its localhost 
    $dbUser = "root";            //Database User Name 
    $dbPass = "";            //Database Password 
    $dbDatabase = "raildb";    //Database Name 

     
    $db = mysqli_connect($dbHost,$dbUser,$dbPass) or die("Error connecting to database."); 
    //Connect to the databasse 
    mysqli_select_db($db, $dbDatabase)or die("Couldn't select the database."); 

    $usr = mysqli_real_escape_string($db,$_POST['email']); 
    $pas = mysqli_real_escape_string($db,$_POST['password']); 

    $sql = mysqli_query($db ,"INSERT INTO `users_table`(`username`, `password`) VALUES ('$usr','$pas') "); 
    if(mysqli_query($db,$sql) == TRUE){ 
       echo "User Created : Please Login ";
               exit; 
    }
    else { echo "Fatal Error Or User Already Exist:";   sleep(5);
        exit ;
    }




 ?> 


