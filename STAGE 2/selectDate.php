<?php
include('NavDoctor.php');
include('connection.php');

date_default_timezone_set('Europe/London');

$query = "SELECT * FROM staff WHERE username = '".$_POST['username']."'";
$doctor = mysqli_query($con, $query);
$df = array();
$dl = array();
while($row = mysqli_fetch_array($doctor))
{
    $df = $row['fname'];
    $dl = $row['lname'];
}

$query = "SELECT * FROM patient WHERE patientID = '".$_POST['patientID']."'";
$patient = mysqli_query($con, $query);
$pf = array();
$pl = array();
while($row = mysqli_fetch_array($patient))
{
    $pf = $row['fname'];
    $pl = $row['lname'];
}

$query = "SELECT * FROM appointment WHERE staffID = '".$_POST['username']."'";
$busy = mysqli_query($con, $query);
$b = array();
$d = array();
while($row = mysqli_fetch_array($busy))
{
    $d[] = $row['appDATE'];
}

$t = array();
while ($row = mysqli_fetch_array($busy))
{
    $t[] = $row['appTIME'];
}

$dates = [];
for($i = 1; $i <= 12; $i++)
{
    for($y = 1; $y <= 31; $y++)
    {
        array_push($dates,date("Y-m-d",mktime(0,0,0,$i,$y,23)));
    }
}

$times = [];
for($i = 0; $i < 21; $i++)
{
    if($i > 8 && $i < 19)
    {
        $times[] = date("H:i:s", mktime($i,0,0));
        $times[] = date("H:i:s", mktime($i,30,0));
    }
}

?>
<form action="selectTime.php" method="post" class="container">
    <table class="table table-dark table-striped">
        <tr>
            <th>Patient</th>
            <input type="hidden" name="patientID" value="<?php echo $_POST['patientID'] ?>">
            <td class="table-light"><?php echo $pf." ".$pl; ?></td>
        </tr>
        <tr>
            <th>Doctor</th>
            <input type="hidden" name="username" value="<?php echo $_POST['username'] ?>">
            <td class="table-light"><?php echo $df." ".$dl; ?></td>
        </tr>
        <tr>
            <th>Date</th>
            <td class="table-light">
                    <select name="date" class="form-select">
                        <option disabled selected>Choose date</option>
                        <?php
                            //for the size of the days
                            for($i = 0; $i < sizeof($dates); $i++)
                            {
                                //if selected day is beyond today and it's not a Saturday or Sunday
                                if($dates[$i] > date('Y-m-d') && date('w', strtotime($dates[$i])) != 6 && date('w', strtotime($dates[$i])) != 0)
                                {
                                    ?>
                                    <option value="<?php echo $dates[$i]; ?>">
                                        <?php echo date('d/m/Y', strtotime($dates[$i]));
                                }
                            }
                        ?>
                </option>
            </td>
        </tr>
    </table>
    <div>
        <input class="btn btn-dark" type="submit" value="Select time">
    </div>
</form>

<?php include('Footer.php');?>