<?php
  $pnr_no=$_POST["pnrnumber"];
  $api_url="https://api.railwayapi.com/v2//pnr-status/pnr/".trim($pnrnumber)."/apikey/5on7w9zra0/";
  $json=file_get_contents("$api_url");  //Using the Api
  $json=stripslashes(html_entity_decode($json)); // Stripping the useless shit
  $json_decoded =  json_decode($json,true);
  echo "Train Name :{$json_decoded['train']['name'] }";
  echo "date of Journey : { $json_decoded['doj'] } ";
  echo "Total Passengers :{ $json_decoded['total_passengers']}";
  echo "Chart Prepared  :{ $json_decoded['chart_prepared']} ";
  echo "From Station : { $json_decoded['chart_prepared']['name'] } ({ $json_decoded['chart_prepared']['code'] })";
  echo "To Station : { $json_decoded['to_station']['name'] } ({ $json_decoded['to_station']['code']})";
  echo "Boarding point :{ $json_decoded['boarding_point']['name'] } ( { $json_decoded['boarding_point']['code']}) ";
  echo "Reservation Upto :{ $json_decoded['reservation_upto']['name'] } ({ $json_decoded['reservation_upto']['code']})";
  echo " Train Details : {$json_decoded['train']['name'] } , { $json_decoded['train']['number']} ";
  echo " Journey Class : { $json_decoded['journey_class']['name']} , { $json_decoded['journey_class']['code']}";
   
  foreach ($json_decoded['passengers'] as $passenger) 
    { echo "{ $passenger['no'] }, { $passenger['current_status']}, { $passenger['booking_status']} " ; }
  
  ?>