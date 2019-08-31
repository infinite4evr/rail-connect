<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Train Route Information</title>
  <link rel="shortcut icon" type="image/png" href="../images/logo.jpg"/>
   <link rel="stylesheet" href="../css/skel.css" />
    <link rel="stylesheet" href="../css/style.css" />
      <link rel="stylesheet" href="../css/style-xlarge.css" /> </head>
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
            <li><strong><?php if ($_SESSION['Admin'] == '1') {?>
              <a href="../Admin/admin.php">DASHBOARD</a>
              <?php } elseif ($_SESSION['Admin'] == '0') {?>
              <a href="../dashboard/dashboard.php">DASHBOARD</a>
            <?php } else {?><a href="../index.php">HOME</a>
            <?php }?></strong></li>
            <li><strong><a href="../statusretriever.php">LIVE STATUS</a></strong></li>
            <li><strong><a href="../Ticket/ticket.php">TICKET RESERVATION</a></strong></li>
            <li><strong><div class="dropdown"><a class="dropbtn">ENQUIRY</a>
              <div class="dropdown-content">
             <a href="../traind/traind.php">Train Details</a>
              <a href="../fare/fare.php">Fare Enquiry</a>
              <a href="../Cancelled_trains/Cancelled_trains.php">Cancelled_trains</a>
              <a href="#" class="selected">Train Route Information</a></div>
            </div></strong></li>
            <li><strong><a href="../About.php">ABOUT</a></strong></li>
            <li><strong><a href="../Team.php" >TEAM</a></strong></li>
            <li><strong><a href="../contact.php">CONTACT</a></strong></li>
          </ul>
        </nav>
      </header>
       <section>
       <div style="padding:100px; width: 80%;">
    <b><h1>Train Route Information</h1></b>
<form action ="?" method="post">
Train Number : <br>
<input type="text"  name="trainid" required>
<input type ="submit" value ="Submit" name ="submit">
</form>
</div>
</section>
</body>
</html>


  <?php

if (isset($_POST['submit'])) {

    ?>
<div class="container">

</h4>
<div id="start" class="well well-lg">
<h4> </h4>

<form action="directions.php" method="get">


<?php
$train_no = $_POST['trainid'];
    echo "Details for Train with no: " . $train_no;
    echo "<br><br>";
//$train_no= 12046;
    //$url= "http://api.railwayapi.com/between/source/".$from."/dest/".$to."/date/".$date."/apikey/dlbld2375/";
    $url = "http://api.railwayapi.com/v2/route/train/" . $train_no . "/apikey/5on7w9zra0/";
    $content = file_get_contents($url);
    $json = json_decode($content, true);
    $routeno = sizeof($json['route']);
    ?>
<?php

    echo '<table>';
    echo "<tr>";
    echo "<th>Station Name And Code</th>";
    echo "<th>Scheduled Arrival Time</th>";
    echo "<th>Scheduled Departure Time</th>";
    echo "<th>Enroute day</th>";
    echo "<th>Distance(in km)</th></tr>";

    for ($i = 0; $i < $routeno; $i++) {

        if ($i == $routeno - 1) {
            continue;
        }

// Output a row
        echo "<tr>";

        echo "<td>{$json["route"][$i]["station"]['name']}({$json["route"][$i]["station"]['code']})</td>";
        echo "<td>{$json['route'][$i]['scharr']}</td>"; //Scheduled arrival
        echo "<td>{$json['route'][$i]['schdep']}</td>"; //scheduled departure
        echo "<td>{$json['route'][$i]['day']}</td>"; //Enroute day
        echo "<td>{$json['route'][$i]['distance']}</td>"; // Distance (kms)
        echo "</tr>";
    }

}

?>


</body>
</html>
