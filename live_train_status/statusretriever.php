<form action="?"  method="post">
  Train number:<br>
  <input type="number" name="Tnumber"><br><br>
  Train Start Date :<br>
  <input type= "date" name="startdate"> <br><br>
  <input type="submit" value="Submit" name ="submit">
</form>

<?php
if (isset($_POST['submit'])) {
    $train_no = $_POST["Tnumber"];

    $started_date = $_POST["startdate"];

    $started_date = date("d-m-Y", strtotime($started_date));

    $api_url = "https://api.railwayapi.com/v2/live/train/" . trim($train_no) . "/date/" . trim($started_date) . "/apikey/5on7w9zra0/";

    $json = file_get_contents("$api_url"); //Using the Api

    $json = stripslashes(html_entity_decode($json)); // Stripping the useless shit

    $json_decoded = json_decode($json, true);

    echo "Train Name :{$json_decoded['train']['name']}";

    echo "<br> Last Position : ";
    print_r($json_decoded['position']);

    echo "<br>";

    echo '<table>';
    //Tabel starts here  -you have to put attribute names ( mentioned in echo comments )
    foreach ($json_decoded['route'] as $route) {

        // Output a row
        echo "<tr>";

        echo "<td>{$route['station']['name']}({$route['station']['code']})</td>"; // Station name and code
        echo "<td>{$route['actarr']}</td>"; // actual arrival time
        echo "<td>{$route['actdep']}</td>"; //actual departure time
        echo "<td>{$route['status']}</td>"; // Late/Early

        if ($route['has_departed'] == true) //Current Position
        {
            echo "<td>Departed</td>";
        } else {
            echo "<td>Estimated</td>";
        }

        echo "<td>{$route['scharr']}</td>"; //Scheduled arrival
        echo "<td>{$route['schdep']}</td>"; //scheduled departure
        echo "<td>{$route['day']}</td>"; //Enroute day
        echo "<td>{$route['distance']}</td>"; // Distance (kms)
        echo "</tr>";
    }
    echo '</table>';

}
?>

