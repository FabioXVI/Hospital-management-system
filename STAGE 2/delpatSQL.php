<?php
include('connection.php');

$patientID = $_POST['patientID'];
$query = "DELETE from patient WHERE patientID = '".$patientID."'";
mysqli_query($con, $query);

header('location: doctor.php');

?>