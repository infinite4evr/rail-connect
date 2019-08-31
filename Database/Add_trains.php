<form action="?"  method="post">
  Train number:<br>

  <input type="number" name="train_no"><br><br>
  Train name :<br>
  <input type= "text" name="train_name"> <br><br>
  Station from :<br>
  <input type= "text" name="station_from"> <br><br>
  Station to :<br>
  <input type= "text" name="station_to"> <br><br>
  Departure time(24 hours) :<br>
  <input type= "time" name="departure_time"> <br><br>
  Arrival time (24 hours):<br>
  <input type= "time" name="arrival_time"> <br><br>

  <input type="submit" value="Submit" name="Submit">
</form>

<?php
if (isset($_POST['Submit'])) {
    require '../database/database.php';

    //Getting train info

    $train_no = $_POST['train_no'];
    $train_name = $_POST['train_name'];
    $station_from = $_POST['station_from'];
    $station_to = $_POST['station_to'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];

    //Inserting them !

    $query = "INSERT INTO `train_info`(`train_no`, `train_name`, `station_from`, `station_to`, `departure_time`, `arrival_time`) VALUES ('$train_no','$train_name',
    '$station_from','$station_to','$departure_time','$arrival_time')";

    $results = mysqli_query($conn, $query);

    if ($results == true) {

        echo " Adding Train Successfull :";
        echo "Want to Add more trains Admin ?"; // Put a Herf here Gursimran :")
    } else {
        echo "Please Try again : Adding unsuccessfull <br>  " . mysqli_error($conn);
    }

}

?>