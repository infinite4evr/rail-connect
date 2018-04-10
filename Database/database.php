<link rel="stylesheet" href="style.css" />
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rail_connect";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) 
{
 die("Connection failed: " . $conn->connect_error);
} 

else{
	//$query="INSERT INTO users(username,password) VALUES('guest@gmail.com','1234')";
	$query="UPDATE users SET uid='2' WHERE Admin='False' LIMIT 1";
	if(mysqli_query($conn,$query))
		echo "Query Occured";
	else
		echo"Query Failed";
	$query="SELECT * FROM users";
	if($result=mysqli_query($conn,$query)){
		$row=mysqli_fetch_array($result);
		echo "Your Username is ".$row[1]." and your password is ".$row[2].".";
	}
	
?>