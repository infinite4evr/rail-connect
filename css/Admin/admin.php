<?php
session_start();
if(array_key_exists("uid",$_COOKIE)){
	$_SESSION['uid']=$_COOKIE['uid'];
}
if(array_key_exists("uid",$_SESSION)){
   echo "Logged in!";
	}
	else{
		header("Location:../login.php");
	}
	$db=mysqli_connect("localhost","root","","rail_connect");
if(mysqli_connect_error()){
   die("Database Connection Error.");
}
$query="SELECT username FROM users WHERE uid='".mysqli_real_escape_string($db,$_SESSION['uid'])."' LIMIT 1";
$result=mysqli_query($db,$query);
$row=mysqli_fetch_assoc($result);
	$un=$row['username'];
	$u=explode("@",$row['username']);
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
						<li><strong><a href="#" class="selected">DASHBOARD</a></strong></li>
						<li><strong><a href="#">ADD/REMOVE TRAIN</a></strong></li>
						<li><strong><a href="#">ADD/REMOVE USER</a></strong></li>
						<li><strong><div class="dropdown"><a class="dropbtn">VIEW</a>
							<div class="dropdown-content">
							<a href="#">ALL USERS</a>
							<a href="#">BOOKED TICKETS</a>
							<a href="#">CANCELLED TICKETS</a>
							</div>
						</div></strong></li>
						<li><strong><a href="../review.php">Complaint-Review</a></strong></li>					
					</ul>
				</nav>
			</header>
			<section id="banner">
				<div class="inner">
					<h2>WELCOME <?php echo $u[0];?></h2>
					<strong><span class="role"></span></strong>
					<ul class="actions">
						<li><a target="_blank" href="../index.php?logout=1" class="button big special">Logout</a></li>
					</ul>
				</div>
			</section>
<script type="text/javascript" src="js/typed.min.js"></script>
			<script type="text/javascript" src="js/script.js"></script>