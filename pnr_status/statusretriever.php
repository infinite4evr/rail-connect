<form action="?"  method="post">
  Pnr Number :<br>
  <input type="number" name="pnrnumber"><br><br>
  <input type="submit" value="Submit" name="submit">
</form>


<?php
if (isset($_POST['submit'])) {
    require '../database/database.php';
    $pnr_no = $_POST['pnrnumber'];
    $found = false;

    $query = "SELECT *
          FROM ticket
          WHERE pnr = $pnr_no";

    $results = mysqli_query($conn, $query);
    $ticket = mysqli_fetch_array($results);

    if ($ticket) {
        $found = true;

    }

    /* $query = "SELECT Train_name,doj,total_passengers,chart_prepared,from_station,to_station,boarding_point,reservation_upto,train_number, journey_class ;*/
    if ($found == true) {
        echo "Train Name :{$ticket['train_name']} <br>";
        echo "date of Journey : {$ticket['doj']} <br>";
        echo "Total Passengers :{$ticket['total_passengers']}<br>";
        if ($ticket == date('d-m-y')) {echo "chart_prepared <br>";} else {
            echo "chart not prepared<br>";
        }

        echo "From Station : {$ticket['from_station']} <br>";
        echo "To Station : {$ticket['to_station']} <br> ";
        echo "Boarding point :{$ticket['boarding_point']} <br>";
        echo "Reservation Upto :{$ticket['reservation_upto']}) <br>";
        echo "Train Details : {$ticket['train_name']}<br>";
        echo "Journey Class : {$ticket['journey_class']}<br>";

        foreach ($passengers_details['passengers'] as $passenger) {echo "{$passenger['no']}, {$passenger['current_status']}, {$passenger['booking_status']} ";}

    } else if ($found == true) {

        $api_url = "https://api.railwayapi.com/v2//pnr-status/pnr/" . trim($pnr_no) . "/apikey/5on7w9zra0/";
        $json = file_get_contents("$api_url"); //Using the Api
        $json = stripslashes(html_entity_decode($json)); // Stripping the useless shit
        $json_decoded = json_decode($json, true);

        echo "Train Name :{$json_decoded['train']['name']} <br>";
        echo "date of Journey : {$json_decoded['doj']} <br>";
        echo "Total Passengers :{$json_decoded['total_passengers']}<br>";
        echo "Chart Prepared  :{$json_decoded['chart_prepared']}<br> ";
        echo "From Station : {$json_decoded['chart_prepared']['name']} ({$json_decoded['chart_prepared']['code']})<br>";
        echo "To Station : {$json_decoded['to_station']['name']} ({$json_decoded['to_station']['code']})<br>";
        echo "Boarding point :{$json_decoded['boarding_point']['name']} ( {$json_decoded['boarding_point']['code']}) <br>";
        echo "Reservation Upto :{$json_decoded['reservation_upto']['name']} ({$json_decoded['reservation_upto']['code']})<br>";
        echo " Train Details : {$json_decoded['train']['name']} , {$json_decoded['train']['number']} <br>";
        echo " Journey Class : {$json_decoded['journey_class']['name']} , {$json_decoded['journey_class']['code']}<br>";

        foreach ($json_decoded['passengers'] as $passenger) {
            $found = true;
            echo "{$passenger['no']}, {$passenger['current_status']}, {$passenger['booking_status']} ";
        }

    }

    if ($found == false) {
        echo "Enter a Valid Pnr Please , Thank You !";
    }

}

?>