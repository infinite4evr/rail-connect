<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Cancellation Status</title>
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
            <?php }?></strong></strong></li>
            <li><strong><a href="../statusretriever.php">LIVE STATUS</a></strong></li>
            <li><strong><a href="../Ticket/ticket.php">TICKET RESERVATION</a></strong></li>
            <li><strong><div class="dropdown"><a class="dropbtn">ENQUIRY</a>
              <div class="dropdown-content">
              <a href="../traind/traind.php">Train Details</a>
              <a href="../fare/fare.php">Fare Enquiry</a>
              <a href="Cancelled_trains.php" class="selected">Cancelled_trains</a>
              <a href="../Train_route/Route_retriever.php">Train Route Information</a></div>
            </div></strong></li>
            <li><strong><a href="../About.php">ABOUT</a></strong></li>
            <li><strong><a href="../Team.php" >TEAM</a></strong></li>
            <li><strong><a href="../contact.php">CONTACT</a></strong></li>
          </ul>
        </nav>
      </header>
       <section>
       <div style="padding-top:100px">
    <b><h1>Cancelled Train Status</h1></b>
<form action="?"  method="post">
   Enter the Date:<br>

  <input type="date" name="date" required><br><br>
  <input type="submit" value="Submit" name="Submit">
</form>
</div>
</section>
</body>
</html>

<?php
if (isset($_POST['Submit'])) {
    $date = $_POST['date'];
    $date = date("d-m-Y", strtotime($date));
    $api_url = 'https://api.railwayapi.com/v2/cancelled/date/' . trim($date) . '/apikey/5on7w9zra0/';
    $json = file_get_contents("$api_url"); //Using the Api
    $json = stripslashes(html_entity_decode($json)); // Stripping the useless shit
    $json_decoded = json_decode($json, true);

    echo "<br>";

    echo "Total Trains Cancelled on {$date} : {$json_decoded["total"]} <br><br>";

    echo '<table>';
    echo "<tr>";
    echo "<th>Station Name And Code</th>";
    echo "<th>Actual Arrival Time</th>";
    echo "<th>Actual Departure Time</th>";
    echo "<th>Late/Early</th>";
    echo "<th>Destination Name And Code</th></tr>";

    //Tabel starts here  -you have to put attribute names ( mentioned in echo comments )
    foreach ($json_decoded['trains'] as $route) {

        // Output a row
        echo "<tr>";

        echo "<td>{$route['source']['name']}({$route['source']['code']})</td>"; // Station name and code
        echo "<td>{$route['name']}</td>"; // actual arrival time
        echo "<td>{$route['type']}</td>"; //actual departure time
        echo "<td>{$route['number']}</td>"; // Late/Early
        echo "<td>{$route['dest']['name']}({$route['dest']['code']})</td>";
        echo "</tr>";
    }
    echo '</table>';

}

?>

