
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>
</head>
<body>

<h3>Contact Form</h3>

<div class="container">
  <form action="?" method="POST">
    <label for="fname">Name</label>
    <input type="text" id="fname" name="name" placeholder="Your name..">

    <label for="lname">Email</label>
    <input type="text" id="lname" name="Email" placeholder="Email">

     <label for="pnr_no">Pnr Number</label>
    <input type="text" id="lname" name="pnr_no" placeholder="Pnr Number..">
    

    <label for="subject">Subject</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit" name="submit">
  </form>
</div>

</body>
</html>


<?php 
session_start();
// Primary Key Missing in Dtabase fix Please ty !
if(isset($_POST['submit']))
{


if(isset($_SESSION['username']))


{ echo "{$_SESSION['username']}";

    $dbHost = "localhost";        //Location Of Database usually its localhost 
    $dbUser = "root";            //Database User Name 
    $dbPass = "";            //Database Password 
    $dbDatabase = "rail_connect";    //Database Name 

     
    $db = mysqli_connect($dbHost,$dbUser,$dbPass) or die("Error connecting to database."); 
    //Connect to the databasse 
    mysqli_select_db($db, $dbDatabase)or die("Couldn't select the database."); 

    $name = mysqli_real_escape_string($db,$_POST['name']); 
    $email = mysqli_real_escape_string($db,$_POST['Email']); 
    $pnr_no = mysqli_real_escape_string($db,$_POST['pnr_no']); 
    $subject = mysqli_real_escape_string($db,$_POST['subject']); 

    $sql = mysqli_query($db ,"INSERT INTO `complaints`(`name`, `email`, `pnr_no`, `Subject`) VALUES ('$name','$email',$pnr_no,'$subject')"); 
    if($sql == true){ 
       
       //echo "<script>alert('Complaint Submitted Successfully'); window.location='../index.html'</script>";
    }


else{  echo mysqli_error($db);
      echo "<script>alert('Unepected Error occured '); window.location='complaint_form.php'</script>";
        exit; 
    }

}


else 

{  

 echo "<script>alert('Please Login and Retry Again'); window.location='../user_login/user_login_form.html'</script>";

}
}

 ?> 



