<!Doctype html>
<head>
	<title>DRMS</title>
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
			<div class="col-xs-8 box2">
				<strong><h2>Live Train Status</h2></strong>
				<?php
  $train_no=$_POST["Tnumber"];
  $started_date=$_POST["startdate"];
  $started_date = date("d-m-Y", strtotime($started_date));
  $api_url="https://api.railwayapi.com/v2/live/train/".trim($train_no)."/date/".trim($started_date)."/apikey/5on7w9zra0/";
  $json=file_get_contents("$api_url");  //Using the Api
  $json=stripslashes(html_entity_decode($json)); // Stripping the useless shit
  $json_decoded =  json_decode($json,true);
  echo "Train Name :{$json_decoded['train']['name'] }";
  echo "<br> Last Position : ";
  print_r($json_decoded['position']);
  echo "<br>";
  echo '<table>'; 
   //Tabel starts here  -you have to put attribute names ( mentioned in echo comments ) 
  foreach ($json_decoded['route'] as $route)
  {
      // Output a row
      echo "<tr>";
      echo "<td>{$route['station']['name']}({$route['station']['code']})</td>"; // Station name and code
      echo "<td>{$route['actarr']}</td>"; // actual arrival time
      echo "<td>{$route['actdep']}</td>"; //actual departure time 
      echo "<td>{$route['status']}</td>"; // Late/Early
      if($route['has_departed']==true)    //Current Position
          echo "<td>Departed</td>";
      else   
          echo "<td>Estimated</td>";
        
      echo "<td>{$route['scharr']}</td>"; //Scheduled arrival
      echo "<td>{$route['schdep']}</td>"; //scheduled departure 
      echo "<td>{$route['day']}</td>";    //Enroute day
      echo "<td>{$route['distance']}</td>"; // Distance (kms)
      echo "</tr>";
  }
  echo '</table>';
  ?>

			</div>
			<div class="col-xs-2 An">Announcements</div>
		</div>
	</div>
	<script type="text/javascript" src="js/typed.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>