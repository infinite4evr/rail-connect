<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "rail_connect") or die("Unable to connect to the Database.");
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
                        <li><strong><a href="edittrain.php" >ADD/REMOVE TRAIN</a></strong></li>
                        <li><strong><a href="edituser.php">ADD/REMOVE USER</a></strong></li>
                        <li><strong><div class="dropdown"><a class="dropbtn">VIEW</a>
                            <div class="dropdown-content">
                            <a href="users.php">ALL USERS</a>
                            <a href="booked.php" class="selected">BOOKED TICKETS</a>
                            <a href="cancel.php">CANCELLED TICKETS</a>
                            </div>
                        </div></strong></li>
                        <li><strong><a href="#">Complaint-Review</a></strong></li>
                    </ul>
                </nav>
            </header>
            <section>
              <div style="padding:100px; width: 80%;">
                <b><h1>ALL BOOKED TICKETS</h1></b>
                <?php
echo '<table>';
echo "<tr>";
echo "<th>Train Number</th>";
echo "<th>Train Name</th>";
echo "<th>Number of Tickets</th>";
echo "<th>Fare</th></tr>";
$q = mysqli_query($conn, "SELECT * FROM trains,ticket WHERE tno=train_number;");
if ($q == true) {
    $n = mysqli_num_rows($q);
    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_array($q);
        if ($row['Cancelled'] == false) {
            echo "<tr><td>{$row['train_number']}</td><td>{$row['train_name']}</td><td>{$row['pnumber']}</td><td>{$row['fare']}</td></tr>";
        }

    }
}
?>
            </div></section>
<script type="text/javascript" src="js/typed.min.js"></script>
            <script type="text/javascript" src="js/script.js"></script>
