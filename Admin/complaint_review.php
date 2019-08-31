<?php
{

    $dbHost = "localhost"; //Location Of Database usually its localhost
    $dbUser = "root"; //Database User Name
    $dbPass = ""; //Database Password
    $dbDatabase = "rail_connect"; //Database Name
    session_start();

    if ($_SESSION["username"] == 'admin' and $_SESSION["password"] == 'admin') {
        $db = mysqli_connect($dbHost, $dbUser, $dbPass) or die("Error connecting to database.");
        //Connect to the databasse
        mysqli_select_db($db, $dbDatabase) or die("Couldn't select the database.");

        $sql = mysqli_query($db, "SELECT * FROM `complaints`");
        if (($sql) == true) {
            echo "Select complaint : ";

            $option = '';
            while ($row = mysqli_fetch_assoc($sql)) {

                echo " <br><a href=\"complaint_fetch.php\"> {$row['email']}</a> PNR : {$row['pnr_no']}<br> ";

            }

        } else {echo "Fatal Error no complaints";

            exit;
        }

    }

}
