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
						<li><strong><a href="edittrain.php">ADD/REMOVE TRAIN</a></strong></li>
						<li><strong><a href="#" class="selected">ADD/REMOVE USER</a></strong></li>
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
			    <b><h1>ADD\REMOVE USER</h1>Fill only username and Admin to remove.</b>
			<form action="?"  method="post">
			 Username:<br>
			  <input type="text" name="uname" required><br><br>
			  Password:<br>
			  <input type="password" name="psw"><br><br>
			  Confirm Password:<br>
			  <input type="password" name="pswa"><br><br>
			  Admin:<br>
			  <select name="ad" required>
			  	<option value="0">No</option>
			  	<option value="1">Yes</option>
			  </select><br><br>
			  <input type="submit" value="Add" name ="submit">
			  <input type="submit" value="Remove" name ="submit">
			</form></div></section>
<script type="text/javascript" src="js/typed.min.js"></script>
			<script type="text/javascript" src="js/script.js"></script>
			<?php
if (array_key_exists('submit', $_POST)) {
    $conn = mysqli_connect("localhost", "root", "", "rail_connect") or die("Unable to connect to the Database.");
    $name = mysqli_real_escape_string($conn, $_POST['uname']);
    if (isset($_POST['psw'])) {
        $p = mysqli_real_escape_string($conn, $_POST['psw']);
    }

    if (isset($_POST['pswa'])) {
        $cp = mysqli_real_escape_string($conn, $_POST['pswa']);
    }

    $adm = mysqli_real_escape_string($conn, $_POST['ad']);
    $query = "SELECT username FROM users WHERE uid='" . mysqli_real_escape_string($conn, $_SESSION['uid']) . "' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $un = $row['username'];
    if ($name == $un) {
        echo "<div><p><strong>Cannot Add/Delete Current user.</strong></p></div>";
    }

    if ($_POST['psw'] != $_POST['pswa']) {
        echo "<div><p><strong>Password Mismatch.</strong></p></div>";
    }
    if ($_POST['submit'] == 'Add') {
        $query = "SELECT `uid` FROM `users` WHERE `username` ='$name'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo '<div><p><strong>User Id Already Exists.!</strong></p></div>';
        } else {
            if ($adm == '0') {echo "Not an Admin.";}
            if (mysqli_query($conn, "INSERT INTO `users`(`username`, `password`,`Admin`) VALUES ('$name','$p','$adm') ") == true) {
                echo "<p><script>alert('User Created : Please Login');</script></p>";
                exit;
            } else {echo "<p><script>alert('Could not currently Create User.Please try again later.');</script></p>";
                sleep(5);
                exit;
            }}
    }

    if ($_POST['submit'] == 'Remove') {
        $q = mysqli_query($conn, "DELETE FROM `users` WHERE `username`='$name' AND `Admin`= '$adm' LIMIT 1;");
        if ($q == true) {
            echo "<p><script>alert('User Deleted from the Database');</script></p>";
        } else {
            echo "<p><script>alert('User Could not be deleted from the Database');</script></p>";
        }}
}

?>