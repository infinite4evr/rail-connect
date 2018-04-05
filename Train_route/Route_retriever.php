<!DOCTYPE html>
<html lang="en">
<head>
<title> Welcome to Rail Connect - Getting Indian railway info now becomes easy </title>
</head>
<body>
  <?php 

include("navigation.php");
  ?>
<div class="container">

</h4>
<div id="start" class="well well-lg">
<h4> </h4>

<form action="directions.php" method="get">


<?php 
$train_no=$_POST['trainid'];
echo "Details for Train with no: ".$train_no;
echo "<br><br>";
//$train_no= 12046;
//$url= "http://api.railwayapi.com/between/source/".$from."/dest/".$to."/date/".$date."/apikey/dlbld2375/";
$url = "http://api.railwayapi.com/v2/route/train/".$train_no."/apikey/5on7w9zra0/";
$content = file_get_contents($url);
$json = json_decode($content, true);
$routeno= sizeof($json['route']);
?>
<?php 

 echo '<table>'; 
for($i=0; $i<$routeno; $i++)
{
	
	if($i==$routeno-1)
	{
		continue;
	}
	
// Output a row
      echo "<tr>";

      echo "<td>{$json["route"][$i]["station"]['name']}({$json["route"][$i]["station"]['code']})</td>"; 
      echo "<td>{$json["route"][$i]["distance"]}</td>"; 
      echo "<td>{$json['route'][$i]['scharr']}</td>"; //Scheduled arrival
      echo "<td>{$json['route'][$i]['schdep']}</td>"; //scheduled departure 
      echo "<td>{$json['route'][$i]['day']}</td>";    //Enroute day
      echo "<td>{$json['route'][$i]['distance']}</td>"; // Distance (kms)
      echo "</tr>";
}
?>


</body>
</html>
