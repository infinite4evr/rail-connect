<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "rail_connect") or die("Unable to connect to the Database.");
?>
<!DOCTYPE html>
<html>
<head>
  <title>BOOK TICKETS</title>
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
            <li><strong><a href="ticket.php" class="selected">TICKET RESERVATION</a></strong></li>
            <li><strong><div class="dropdown"><a class="dropbtn">ENQUIRY</a>
              <div class="dropdown-content">
             <a href="traind/traind.php">Train Details</a>
			<a href="fare/fare.php">Fare Enquiry</a>
              <a href="../Cancelled_trains/Cancelled_trains.php">Cancelled_trains</a>
              <a href="../Train_route/Route_retriever.php">Train Route Information</a></div>
            </div></strong></li>
            <li><strong><a href="../About.php">ABOUT</a></strong></li>
            <li><strong><a href="../Team.php">TEAM</a></strong></li>
            <li><strong><a href="../contact.php">CONTACT</a></strong></li>
          </ul>
        </nav>
  </header>
   <section>
              <div style="padding:100px; width: 80%;">
                <b><h1>TICKET DETAILS</h1></b>
                <?php
echo '<table>';
echo "<tr>";
echo "<th>Train Number</th>";
echo "<th>Train Name</th>";
echo "<th>Number of Tickets</th>";
echo "<th>Fare</th>";
echo "<th>Cancelled</th></tr>";
$q = mysqli_query($conn, "SELECT * FROM trains,ticket WHERE tno=train_number;");
if ($q == true) {
    $n = mysqli_num_rows($q);
    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_array($q);
        echo "<tr><td>{$row['train_number']}</td><td>{$row['train_name']}</td><td>{$row['pnumber']}</td><td>{$row['fare']}</td><td>{$row['Cancelled']}</td></tr>";
    }
}
?>
            </div></section>
<script type="text/javascript" src="js/typed.min.js"></script>
            <script type="text/javascript" src="js/script.js"></script>
