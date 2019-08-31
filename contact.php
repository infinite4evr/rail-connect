<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Contact Us</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
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
						<li><strong><a href="statusretriever.php">LIVE STATUS</a></strong></li>
						<li><strong><a href="Ticket/ticket.php">TICKET RESERVATION</a></strong></li>
						<li><strong><div class="dropdown"><a class="dropbtn">ENQUIRY</a>
							<div class="dropdown-content">
							<a href="traind/traind.php">Train Details</a>
							<a href="fare/fare.php">Fare Enquiry</a>
							<a href="Cancelled_trains/Cancelled_trains.php">Cancelled_trains</a>
							<a href="Train_route/Route_retriever.php">Train Route Information</a></div>
						</div></strong></li>
						<li><strong><a href="About.php">ABOUT</a></strong></li>
						<li><strong><a href="Team.php" >TEAM</a></strong></li>
						<li><strong><a href="contact.php" class="selected">CONTACT</a></strong></li>
					</ul>
				</nav>
			</header>
		<!-- Main -->
			<section id="main" class="wrapper style1">
				<header class="major">
					<h2>Contact US</h2>
					<p>Rail_Connect-The Railway Management Sysytem</p>
				</header>
				<div class="container">
					<section>
						<h3>Please Review our Website:<span class="rating">
						<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
						</span></h3><br>
						<h3>If you have any <strong>Complaints/Requests</strong> Please Login and Click here:</h3><a target="_blank" href="User/complaint_form.php" class="button special">Complaint/Request</a>
						<br><br>
						<h3>You can also Contact us at <strong>ishleen892@gmail.com</strong> Or Call us at <strong>9811166349</strong>.</h3>
					</section>
						</div>
						<hr>
						<div align="center">&copyRail_Connect.All Rights Reserved.</div>
			</section>

			<script type="text/javascript" src="js/script.js"></script>

	</body>
</html>
