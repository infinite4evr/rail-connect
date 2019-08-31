	<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "rail_connect") or die("Unable to Connect to the Database.");
if (array_key_exists("book", $_POST)) {$pn = $_SESSION['passenger_name'];
    $pdob = $_SESSION['passenger_dob'];
    $ppn = $_SESSION['passenger_phnno'];
    $ptn = $_SESSION['train_number'];
    $r1 = mysqli_query($db, "UPDATE ticket SET Cancelled='1' WHERE tno='$ptn';");
    $r2 = mysqli_query($db, "DELETE FROM passenger WHERE passenger_name='$pn' AND passenger_dob='$pdob' AND passenger_phnno='$ppn' AND tno='$ptn' LIMIT 1;");

    echo "<p><script>alert('Ticket Cancelled Successfully.');</script></p>";
    if ($r1 == true and $r2 == true) {
        header("Location:ticket.php");}
} else {
    echo "<p><script>alert('Could not cancel.');</script></p>";
}

?>