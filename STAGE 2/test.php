<?php
include('connection.php');

$query = "SELECT * FROM appointment WHERE staffID = 'doctor'";
$busy = mysqli_query($con, $query);
$d = array(); //dates with an appointment
$t = array(); //hours with an appointment
$times = array('10:00:00','10:30:00','11:00:00','11:30:00','13:00:00','13:30:00','14:00:00','14:30:00','15:00:00','15:30:00');
$hours = array();
while($row = mysqli_fetch_array($busy))
{
    $d[] = $row['appDATE'];
    $t[] = $row['appTIME'];
    $hours = array_diff($t, $times);
}
?>