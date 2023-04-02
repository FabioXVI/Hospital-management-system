<?php

include('connection.php');

$username = $_POST['username'];
$query = "DELETE FROM staff WHERE username = '".$username."'";
mysqli_query($con, $query);

header('location: director.php');

?>