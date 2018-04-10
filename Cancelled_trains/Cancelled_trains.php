<form action="?"  method="post">
   Enter the Datec:<br>
  
  <input type="date" name="date"><br><br>
  <input type="submit" value="Submit" name="Submit">
</form>

<?php
  if(isset($_POST['Submit']))
{
  $date=$_POST['date'];
  $date = date("d-m-Y", strtotime($date));
  $api_url='https://api.railwayapi.com/v2/cancelled/date/'.trim($date).'/apikey/5on7w9zra0/';
  $json=file_get_contents("$api_url");  //Using the Api
  $json=stripslashes(html_entity_decode($json)); // Stripping the useless shit
  $json_decoded =  json_decode($json,true);

   echo "<br>";

   echo "Total Trains Cancelled on {$date } : {$json_decoded["total"]} <br><br>"; 

  echo '<table>'; 

 
   //Tabel starts here  -you have to put attribute names ( mentioned in echo comments ) 
  foreach ($json_decoded['trains'] as $route)
  {

      // Output a row
      echo "<tr>";

      echo "<td>{$route['source']['name']}({$route['source']['code']})</td>"; // Station name and code
      echo "<td>{$route['name']}</td>"; // actual arrival time
      echo "<td>{$route['type']}</td>"; //actual departure time 
      echo "<td>{$route['number']}</td>"; // Late/Early
      echo "<td>{$route['dest']['name']}({$route['dest']['code']})</td>";
      echo "</tr>";
  }
  echo '</table>';

}

  ?>

