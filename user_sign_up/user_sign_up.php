<!DOCTYPE html>
<html>
<head><title>User SignUp</title>
  <link rel="shortcut icon" type="image/png" href="../images/logo.jpg"/>
      <link rel="stylesheet" href="css/bootstrap.min.css" /></head>
<style>
body {font-family: Arial, Helvetica, sans-serif;
background-color: #222;}
* {box-sizing: border-box;}

/* Full-width input fields */
input[type=email], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}
input[type="submit"].special,
        input[type="reset"].special,
        input[type="button"].special,
        .button.special {
            width:33%;
            background-color:#222;
            border:1px solid white;
            border-radius:1px;
            color: #ffffff !important;
        }

            input[type="submit"].special:hover,
            input[type="reset"].special:hover,
            input[type="button"].special:hover,
            .button.special:hover {
                background-color: #629DD1;
            }

            input[type="submit"].special:active,
            input[type="reset"].special:active,
            input[type="button"].special:active,
            .button.special:active {
                background-color: #629DD1;
            }


input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 33%;
  border-radius: 1;
}

/* Add padding to container elements */
.container {
    padding: 16px;
    background-color: #222;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>

<form action="?" style="border:1px solid #ccc" method ="post">
  <div class="container">
    <h1 style="color:#f0f0f0">Sign Up</h1>
    <p style="color:#f0f0f0">Please fill in this form to create an account.</p>
    <hr>

    <label for="email" style="color:#f0f0f0"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="psw" style="color:#f0f0f0"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <label for="psw-repeat" style="color:#f0f0f0"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
    
    <p style="color:#f0f0f0">By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <a href="../index.php"><button type="button" class="cancelbtn">Cancel</button></a>
      <button type="submit" class="signupbtn">Sign Up</button>
      <a href="../login.php"><button type="button" class="button special">Login</button></a>
    </div>
  </div>
</form>

</body>
</html>
<?php 

if(array_key_exists('email', $_POST) AND array_key_exists('password', $_POST)){
    $dbHost = "localhost";        //Location Of Database usually its localhost 
    $dbUser = "root";            //Database User Name 
    $dbPass = "";            //Database Password 
    $dbDatabase = "rail_connect";    //Database Name 
    if($_POST['password']!=$_POST['psw-repeat']){
        echo "<div style=\"color:white\"><p><strong>Password Mismatch.</strong></p></div>";
    }
    else{ 
    $db = mysqli_connect($dbHost,$dbUser,$dbPass) or die("Error connecting to database."); 
    //Connect to the databasse 
    mysqli_select_db($db, $dbDatabase)or die("Couldn't select the database."); 

    $usr = mysqli_real_escape_string($db,$_POST['email']); 
    $pas = mysqli_real_escape_string($db,$_POST['password']);
    $query = "SELECT `uid` FROM `users` WHERE `username` = '".mysqli_real_escape_string($db,$_POST['email'])."'"; 
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result) > 0){
        echo '<div style="color:white"><p><strong>Email Id Already Exists.!</strong></p></div>';
    }
    else{
        if(mysqli_query($db ,"INSERT INTO `users`(`username`, `password`) VALUES ('$usr','$pas') ") == TRUE){ 
           echo "<p><script>alert('User Created : Please Login'); window.location='../index.php'</script></p>";
                   exit; 
        }
        else { echo "<p><script>alert('Could not currently Signup.Please try again later.'); window.location='../index.php'</script></p>";   sleep(5);
            exit ;
        }
    }}
}
 ?> 




