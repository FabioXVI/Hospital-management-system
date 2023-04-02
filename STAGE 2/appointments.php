<?php
require('NavDoctor.php');

?>

<div>
    <h1>Your next appointments</h1>
</div>
<table class="table table-dark">
    <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Patient</th>
    </tr>
    <?php

    include('connection.php');

    $query = "SELECT * FROM appointment WHERE staffID = '".$_SESSION['username']."'";
    $query_run = mysqli_query($con, $query);
    foreach ($query_run as $items)
    {
        ?>
        <tr class="table-light">
            <td><?= $items['appDATE']; ?></td>
            <td><?= $items['appTIME']; ?></td>
            <form action="details.php" method="post">
                <input type="hidden" name="patientID" value="<?php echo $items['patientID']; ?>">
                <td><input class="btn btn-dark btn-sm" type="submit" name="submit" value="Details"></td>
            </form>
        </tr>
        <?php
    }?>
</table>

<?php require('Footer.php');?>