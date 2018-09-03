<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Live Status</title>
  <link rel="shortcut icon" type="image/png" href="images/logo.jpg"/>
   <link rel="stylesheet" href="css/skel.css" />
      <link rel="stylesheet" href="css/style.css" />
      <link rel="stylesheet" href="css/style-xlarge.css" /> </head>
<body id="top">
  <header id="header" class="skel-layers-fixed">
        <nav class="nav">
        <div class="container">
      <div class="navbar-header">
        <a href="#" class="pull-left ">
      <div id="logo" alt="TheAppleTalks Logo"></div>
      </a>
      <div class="navbar-brand">
      </div></div></div></nav>
        <nav id="nav" class="">
          <ul>
            <li><strong><?php if($_SESSION['Admin']=='1'){ ?>
              <a href="../Admin/admin.php">DASHBOARD</a>
              <?php } elseif($_SESSION['Admin']=='0'){ ?>
              <a href="../dashboard/dashboard.php">DASHBOARD</a>
            <?php } else { ?><a href="../index.php">HOME</a>
            <?php } ?></strong></li>
            <li><strong><a href="statusretriever.php" class="selected">LIVE STATUS</a></strong></li>
            <li><strong><a href="Ticket/ticket.php">TICKET RESERVATION</a></strong></li>
            <li><strong><div class="dropdown"><a class="dropbtn">ENQUIRY</a>
              <div class="dropdown-content">
              <a href="traind/traind.php">Train Details</a>
              <a href="fare/fare.php">Fare Enquiry</a>
              <a href="Cancelled_trains/Cancelled_trains.php">Cancelled_trains</a>
              <a href="Train_route/Route_retriever.php">Train Route Information</a></div>
            </div></strong></li>
            <li><strong><a href="About.php">ABOUT</a></strong></li>
            <li><strong><a href="Team.php">TEAM</a></strong></li>
            <li><strong><a href="contact.php">CONTACT</a></strong></li>          
          </ul>
        </nav>
  </header>
  <section>
  <div style="padding-top:100px">
    <b><h1>Live Train Status</h1></b>
<form action="?"  method="post">
  Train number:<br>
  <input type="number" name="Tnumber" required><br><br>
  Train Start Date :<br>
  <input type= "date" name="startdate" required> <br><br>
  <input type="submit" value="Submit" name ="submit">
</form></div></section>  
</body>
</html>
<?php
 if(isset($_POST['submit']))
 {
  $train_no=$_POST["Tnumber"];

  $started_date=$_POST["startdate"];

  $started_date = date("d-m-Y", strtotime($started_date));

  $api_url="https://api.railwayapi.com/v2/live/train/".trim($train_no)."/date/".trim($started_date)."/apikey/5on7w9zra0/";

  $json=file_get_contents("$api_url");  //Using the Api

  $json=stripslashes(html_entity_decode($json)); // Stripping the useless shit

  $json_decoded =  json_decode($json,true);

  echo "<strong>Train Name :</strong>{$json_decoded['train']['name'] }";


  echo "<br><strong> Last Position :</strong> ";
  print_r($json_decoded['position']);

  echo "<br>";

  echo '<table>'; 
  echo '<tr>';
      echo "<th>Station Name And Code</th>";
      echo "<th>Actual Arrival Time</th>";
      echo "<th>Actual Departure Time</th>";
      echo "<th>Late/Early</th>";
      echo "<th>Current Position</th>";
      echo "<th>Scheduled Arrival</th>";
      echo "<th>Scheduled Departure</th>";
      echo "<th>Enroute Day</th>";
      echo "<th>Distance(kms)</th></tr>";
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


}
  ?>

