<?php
if (isset($_POST['submit'])) {
    session_start();
    $dbHost = "localhost"; //Location Of Database usually its localhost
    $dbUser = "root"; //Database User Name
    $dbPass = ""; //Database Password
    $dbDatabase = "rail_connect"; //Database Name

    $db = mysqli_connect($dbHost, $dbUser, $dbPass);

    if (!$db) {
        echo "<script type='text/javascript'>alert('Database failed');</script>";
        die('Could not connect: ' . mysqli_connect_error());
        session_destroy();
    }
    //Connect to the databasse
    mysqli_select_db($db, $dbDatabase) or die("Couldn't select the database.");

    $usr = mysqli_real_escape_string($db, $_POST['username']);
    $pas = mysqli_real_escape_string($db, $_POST['password']);

    $sql = mysqli_query($db, "SELECT * FROM users_table WHERE username='$usr' AND  password='$pas' ");
    if (mysqli_num_rows($sql) == 1) {
        $row = mysqli_fetch_array($sql);
        if (!empty($row)) {

            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];

            $message = 'Logged in successfully';
            echo "<script type='text/javascript'>alert('$message');</script>";

            if ($usr = 'admin' && $pas = 'admin') {
                $url = 'http://localhost/rail_connect/admin/admin.php';
                echo '<META HTTP-EQUIV=REFRESH CONTENT="1; ' . $url . '">';

            } else {
                $url = 'http://localhost/rail_connect/index.html';
                echo '<META HTTP-EQUIV=REFRESH CONTENT="1; ' . $url . '">';
            }
        }

    } else { $message = "Error: Username or Password Incorrect Or User does not Exist ";
        sleep(2);
        echo "<script type='text/javascript'>alert('$message');</script>";

        $url = 'http://localhost/rail_connect/user_login/user_login_form.html';
        echo '<META HTTP-EQUIV=REFRESH CONTENT="1; ' . $url . '">';

        session_destroy();
        exit;
    }

}
