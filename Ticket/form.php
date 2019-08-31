<?php
session_start();
$tno = $_SESSION['tno'];
$f = $_SESSION['fare'];
$n = $_SESSION['num'];
$db = mysqli_connect("localhost", "root", "", "rail_connect") or die("Unable to Connect to the Database.");
mysqli_query($db, "INSERT INTO ticket(tno,pnumber,fare) VALUES('$tno','$n','$f');");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Passeneger Details</title>
  <link rel="shortcut icon" type="image/png" href="../images/logo.jpg"/>
   <link rel="stylesheet" href="../css/skel.css" />
      <link rel="stylesheet" href="../css/style.css" />
      <link rel="stylesheet" href="../css/style-xlarge.css" /> </head>
      <body id="top">
      	<div style="padding-top:10px">
    <b><h1>ENTER DETAILS</h1></b>
<form action="?"  method="post">
	<?php for ($i = 1; $i <= $n; $i++) {?>
  Passenger <?php echo $i; ?> Name:<br>
  <input type="text" name="nm[]" required><br><br>
  Passenger <?php echo $i; ?> Age:<br>
  <input type= "date" name="dt[]" required> <br><br>
  Passenger <?php echo $i; ?> Phone Number:<br>
 <input type= "tel" name="ph[]" required> <br><br>
  Passenger <?php echo $i; ?> UID Document:<br>
  <input type= "file" name="doc[]" required> <br><br>
  <?php }?>
  <input type="submit" value="Submit" name ="submit">
</form></div>
</body></html>
<?php
if (array_key_exists("submit", $_POST)) {
    foreach ($_POST['nm'] as $key => $value) {
        $a1[$key] = $value;
    }
    foreach ($_POST['dt'] as $key => $value) {
        $a2[$key] = $value;
    }
    foreach ($_POST['ph'] as $key => $value) {
        $a3[$key] = $value;
    }
    foreach ($_POST['doc'] as $key => $value) {
        $a4[$key] = $value;
    }
    for ($i = 0; $i < $n; $i++) {
        $q = "INSERT INTO passenger(passenger_name,passenger_dob,passenger_phnno,passenger_doc,tno) VALUES('$a1[$i]','$a2[$i]','$a3[$i]','$a4[$i]','$tno');";
        if (mysqli_query($db, $q)) {
            echo "<p><script>alert('Passenger Data Entered Successfully.');</script></p>";
        } else {
            echo "<p><script>alert('Passenger Data Entery Failed.');</script></p>";
        }
    }
}
?>