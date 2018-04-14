<html>
<body bgcolor="#16EGFA">

<?php 


session_start();
if($_SESSION["username"]=='admin' AND $_SESSION["password"]=='admin' )
{
$_SESSION["admin_login"]=True;
}
if($_SESSION["admin_login"]==True)
{

echo " <br><a href=\"show_users.php\"> Show All Users </a><br> ";
echo " <br><a href=\"../database/add_trains.php\"> Enter New Train </a><br> ";
echo " <br><a href=\"insert_into_classseats_1.php\"> Enter Train Schedule </a><br> ";
echo " <br><a href=\"booked.php\"> View all booked tickets </a><br> ";
echo " <br><a href=\"cancelled.php\"> View all cancelled tickets </a><br> ";
echo " <br><a href=\"complaint_review.php\"> View User Complaints </a><br> ";

}

else 

{
    echo " Sorry ! You don't have access rights to admin ! Please Proceed to home Page ! ";

}
?>

<br><a href="../homepage.html">Go to Home Page!!! </a> (You'll be Logged Out!!!)

</body>
</html>