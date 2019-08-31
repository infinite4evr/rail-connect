<?php
session_start();
?>
<head>
	<title>ADMIN</title>
	<link rel="shortcut icon" type="image/png" href="../images/logo.jpg"/>
	<link rel="stylesheet" href="../css/style.css" />
	 <link rel="stylesheet" href="../css/skel.css" />
</head>
		<!-- Header -->
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
						<li><strong><a href="admin.php">DASHBOARD</a></strong></li>
						<li><strong><a href="#" class="selected">ADD/REMOVE TRAIN</a></strong></li>
						<li><strong><a href="edituser.php">ADD/REMOVE USER</a></strong></li>
						<li><strong><div class="dropdown"><a class="dropbtn">VIEW</a>
							<div class="dropdown-content">
							<a href="users.php">ALL USERS</a>
							<a href="booked.php">BOOKED TICKETS</a>
							<a href="cancel.php">CANCELLED TICKETS</a>
							</div>
						</div></strong></li>
						<li><strong><a href="review.php">Complaint-Review</a></strong></li>
					</ul>
				</nav>
			</header>
			<section>
			  <div style="padding:100px; width: 80%;">
			    <b><h1>ADD\REMOVE TRAIN</h1></b>
			<form action="?"  method="post">
			Train source:<br>
			  <input type="text" name="source" required><br><br>
			 Train destination:<br>
			  <input type="text" name="destination" required><br><br>
			  Train name:<br>
			  <input type="text" name="Tname" required><br><br>
			  Train number:<br>
			  <input type="number" name="Tnumber" required><br><br>
			  Train type:<br>
			  <select name="Ttype" required>
			  	<option value="Pass">Passenger</option>
			  	<option value="Exp">Express</option>
			  	<option value="Drnt">Duronto</option>
			  	<option value="Raj">Rajdhani</option>
			  	<option value="Mail">Mail</option>
			  	<option value="SF">Super-Fast</option>
			  	<option value="JShtb">Jan-Shatabdi</option>
			  	<option value="SKr">Sampark-Kranti</option>
			  	<option value="GR">Garib-Rath</option>
			  	<option value="Other">Other</option>
			  </select><br><br>
			  <input type="submit" value="Add" name ="submit">
			  <input type="submit" value="Remove" name ="submit">
			</form></div></section>
<script type="text/javascript" src="js/typed.min.js"></script>
			<script type="text/javascript" src="js/script.js"></script>
			<?php
if (array_key_exists('submit', $_POST)) {
    $conn = mysqli_connect("localhost", "root", "", "rail_connect") or die("Unable to connect to the Database.");
    $sname = mysqli_real_escape_string($conn, $_POST['source']);
    $dname = mysqli_real_escape_string($conn, $_POST['destination']);
    $tname = mysqli_real_escape_string($conn, $_POST['Tname']);
    $tnumber = mysqli_real_escape_string($conn, $_POST['Tnumber']);
    $ttype = mysqli_real_escape_string($conn, $_POST['Ttype']);
    if ($_POST['submit'] == 'Add') {
        $q = mysqli_query($conn, "INSERT INTO `trains`(from_station_name,to_station_name,train_name,train_number,train_type) VALUES('$sname','$dname','$tname','$tnumber','$ttype');");
        if ($q == true) {
            echo "<p><script>alert('Train Inserted into the Database');</script></p>";
        } else {
            echo "<p><script>alert('Train Could not be inserted into the Database');</script></p>";
        }}

    if ($_POST['submit'] == 'Remove') {
        $q = mysqli_query($conn, "DELETE FROM `trains` WHERE (from_station_name='$sname' AND to_station_name='$dname' AND train_name='$tname' AND train_number='$tnumber' AND train_type='$ttype') LIMIT 1;");
        if ($q == true) {
            echo "<p><script>alert('Train Deleted from the Database');</script></p>";
        } else {
            echo "<p><script>alert('Train Could not be deleted from the Database');</script></p>";
        }}
}

?>