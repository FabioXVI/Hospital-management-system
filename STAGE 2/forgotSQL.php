<?php
include('connection.php');
$query = $con->prepare("SELECT * FROM staff WHERE username=? AND email=?");
$query->bind_param('ss',$_POST['username'], $_POST['email']);
$query->execute();
$res = $query->get_result();
$row = $res->fetch_assoc();

if($row['username'] == $_POST['username'] and $row['email'] == $_POST['email'])
{
    $query = $con->prepare("UPDATE staff SET password=? WHERE username=?");
    $query->bind_param('ss', $_POST['password'], $_POST['username']);
    $query->execute();
    header('location: login.php');

}
else
{
    header('location: forgot.php');
}

?>