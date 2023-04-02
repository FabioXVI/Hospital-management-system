<?php
include('connection.php');
$id1 = rand('1', '9').rand('1', '9').rand('1', '9').rand('1', '9').rand('1', '9');
$id2 = "";
$query = "SELECT * FROM appointment";
$app = mysqli_query($con, $query);
while($row = mysqli_fetch_array($app))
{
    if($row['appID'] == $id1)
    {
        $id2 +=  rand('1', '9').rand('1', '9').rand('1', '9').rand('1', '9').rand('1', '9');
    }
    else
    {

    }
}

header('location: ')

?>