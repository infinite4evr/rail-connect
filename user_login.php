<?php 

    $dbHost = "localhost";        //Location Of Database usually its localhost 
    $dbUser = "root";            //Database User Name 
    $dbPass = "";            //Database Password 
    $dbDatabase = "rail_connect";    //Database Name 

     
    $db = mysqli_connect($dbHost,$dbUser,$dbPass) or die("Error connecting to database."); 
    //Connect to the databasse 
    mysqli_select_db($db, $dbDatabase) or die("Couldn't select the database."); 

    $usr = mysqli_real_escape_string($db,$_POST['email']); 
    $pas = mysqli_real_escape_string($db,$_POST['password']); 
    echo $usr;
    echo $pas;
    $sql = mysqli_query($db ,"SELECT * FROM users WHERE username='$usr' AND  password='$pas' "); 
    if(mysqli_num_rows($sql) == 1){ 
        $row = mysqli_fetch_array($sql); 
        session_start(); 
        $_SESSION['username'] = $row['username']; 
        $_SESSION['logged'] = TRUE; 
        header("Location: pnr.html"); // Modify to go to the page you would like  
        exit; 
    }


else{   echo "Error: Username or Password Incorrect Or User does not Exist " ; sleep(5);
        header("Location: index.html"); 
        exit; 
    }

 ?> 


