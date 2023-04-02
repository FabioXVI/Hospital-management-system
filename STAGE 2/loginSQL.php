<?php
include('connection.php');

$stmt = $con->prepare("SELECT * FROM staff WHERE username = ? AND password = ?");
$stmt->bind_param('ss', $_POST['username'], $_POST['password']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($row['username'] === $_POST['username'] and $row['password'] === $_POST['password'])
{

    session_start();
    $_SESSION['username'] = $_POST['username'];
    if($row['role'] === 'director')
    {
        header('location: director.php');
    }
    else
    {
        header('location: doctor.php');
    }
}
else
{
    echo 'Wrong username or password';
    header('location: login.php');
}

mysqli_close($con);
?>