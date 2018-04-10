<!DOCTYPE html>
<html lang="en">
<head>
<title> Welcome to Rail Connect - Getting Indian railway info now becomes easy </title>
<link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
  <div class="container-fluid" width="100%" height="100%">
    <div class="row">
      <span class="col-xs-2 Connect"></span>
      <strong><span class="col-xs-8 Status"></span></strong>
      <span class="col-xs-2 Login"><button onclick="document.getElementById('id01').style.display='block'" style="width:100%;"><b>Login</b></button>
        <button class="sbutton" onclick="window.location.href='user_sign_up/user_sign_up.html'"><b>Sign Up</b></button>
        <div id="id01" class="modal">
          
          <form class="modal-content animate" action="user_login.php" method="post">
            <div class="imgcontainer">
              <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
              <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="container-fluid">
              <label for="uname"><b>Username</b></label>
              <input type="text" placeholder="Enter Email" name="username" required>

              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required>
                
              <button type="submit">Login</button>
              <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
              </label>
            </div>

            <div class="container-fluid" style="background-color:#f1f1f1">
              <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
              <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
          </form>
        </div>
</span>
    </div>  
    <div class="row">
      <div class="col-xs-2 bar"><ul class="menu">  
                      <a href="index.html"><li>Home</li></a>
                      <a href="pnr.html"><li>PNR Status</li></a>
                      <a href="status.html"><li>Live Status</li></a>
                      <a href="#"><li>Seat Availability</li></a>
                      <a href="#"><li>Station Details</li></a>
                      <a href="#"><li>Train Details</li></a>
                      <a href="#"><li>Fare Enquiry</li></a>
                      <a href="#"><li>PlatForm Location</li></a>
                      <a href="#"><li>Ticket Reservation</li></a>
                      <a href="traininfo.html"><li>Train Route Information</li></a>
                    </ul>
      </div>
  <?php 

include("navigation.php");
  ?>
<div class="col-xs-8 box2">
<strong><h2>Train Routes</h2></strong>
<form action="directions.php" method="get">


<?php 
$train_no=$_POST['trainid'];
echo "Details for Train with no: ".$train_no;
echo "<br><br>";
//$train_no= 12046;
//$url= "http://api.railwayapi.com/between/source/".$from."/dest/".$to."/date/".$date."/apikey/dlbld2375/";
$url = "http://api.railwayapi.com/v2/route/train/".$train_no."/apikey/5on7w9zra0/";
$content = file_get_contents($url);
$json = json_decode($content, true);
$routeno= sizeof($json['route']);
?>
<?php 

 echo '<table>'; 
for($i=0; $i<$routeno; $i++)
{
	
	if($i==$routeno-1)
	{
		continue;
	}
	
// Output a row
      echo "<tr>";

      echo "<td>{$json["route"][$i]["station"]['name']}({$json["route"][$i]["station"]['code']})</td>"; 
      echo "<td>{$json["route"][$i]["distance"]}</td>"; 
      echo "<td>{$json['route'][$i]['scharr']}</td>"; //Scheduled arrival
      echo "<td>{$json['route'][$i]['schdep']}</td>"; //scheduled departure 
      echo "<td>{$json['route'][$i]['day']}</td>";    //Enroute day
      echo "<td>{$json['route'][$i]['distance']}</td>"; // Distance (kms)
      echo "</tr>";
}
echo "</table>";
?></form>
</div>

      <div class="col-xs-2 An">Announcements</div>
    </div>
  </div>
  <script type="text/javascript" src="js/typed.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>

</body>
</html>
