<?php
session_start();
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
  <div style="padding-top:100px">
    <b><h1>ENTER DETAILS</h1></b>
<form action="?"  method="post">
  Source:<br>
  <input type="text" name="s" required><br><br>
  Destination:<br>
  <input type= "text" name="d" required> <br><br>
  Number of Seats:<br>
  <input type= "number" name="n" required> <br><br>
  Train type:<br>
			  <select name="Ttype" required>
			  	<option value="Pass">Passenger</option>
			  	<option value="Exp">Express</option>
			  	<option value="Drnt">Duronto</option>
			  	<option value="Raj">Rajdhani</option>
			  	<option value="SF">Super-Fast</option>
			  	<option value="JShtb">Jan-Shatabdi</option>
			  	<option value="SKr">Sampark-Kranti</option>
			  	<option value="GR">Garib-Rath</option>
			  	<option value="Other">Other</option>
			  </select><br><br>
  <input type="submit" value="Submit" name ="submit">
</form></div></section>
</body>
</html>
<?php
if (array_key_exists("submit", $_POST)) {
    $db = mysqli_connect("localhost", "root", "", "rail_connect") or die("Unable to Connect to the Database.");
    $src = mysqli_real_escape_string($db, $_POST['s']);
    $dst = mysqli_real_escape_string($db, $_POST['d']);
    $num = mysqli_real_escape_string($db, $_POST['n']);
    $type = mysqli_real_escape_string($db, $_POST['Ttype']);
    echo '<table>';
    echo "<tr>";
    echo "<th>Source</th>";
    echo "<th>Destination</th>";
    echo "<th>Train Name</th>";
    echo "<th>Train Number</th>";
    echo "<th>Fare</th>";
    echo "<th>Book</th></tr>";
    $q = mysqli_query($db, "SELECT * FROM trains WHERE from_station_name LIKE '%" . $src . "%' AND to_station_name LIKE '%" . $dst . "%' AND train_type='$type';");
    if ($q == true) {
        $n = mysqli_num_rows($q);
        for ($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_array($q);
            switch ($type) {
                case 'GR':$v = $num * 1;
                    break;
                case 'Pass':$v = $num * 1.4;
                    break;
                case 'Exp':$v = $num * 1.5;
                    break;
                case 'Drnt':$v = $num * 1.6;
                    break;
                case 'JShtb':$v = $num * 1.7;
                    break;
                case 'Raj':$v = $num * 1.8;
                    break;
                case 'SF':$v = $num * 2;
                    break;
                case 'SKr':$v = $num * 1.6;
                    break;
                default:$v = $num * 1.5;
            }
            $f = $v * $row['distance'];

            echo "<tr><td>{$row['from_station_name']}</td><td>{$row['to_station_name']}</td><td><form action='form.php' method='post'>{$row['train_name']}</td><td>{$row['train_number']}</td><td>{$f}</td><td><input type='hidden' value='{$row['train_number']}' name='tno'><input type='hidden' value='{$f}' name='fare'><input type='hidden' value='{$num}' name='num'><input type='submit' value='BOOK' name='book'></form></td></tr>";
        }
        $_SESSION['tno'] = $row['train_number'];
        $_SESSION['num'] = $num;
        $_SESSION['fare'] = $f;
    }

}

?>