<?php
include('NavDoctor.php');
include('connection.php');
date_default_timezone_set('Europe/London');

$dates = []; //dates of office-work
for($i = 1; $i <= 12; $i++)
{
    for($y = 1; $y <= 31; $y++)
    {
        array_push($dates,date("Y-m-d",mktime(0,0,0,$i,$y,23)));
    }
}

$times = []; //hours of office-work
for($i = 0; $i < 21; $i++)
{
    if($i > 8 && $i < 19)
    {
        $times[] = date("H:i:s", mktime($i,0,0));
        $times[] = date("H:i:s", mktime($i,30,0));
    }
}

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
$d = array(); //dates with an appointment
$t = array();//times of appointments
$check = false;
$ava = [];
while($row = mysqli_fetch_array($busy))
{
    $d[] = $row['appDATE'];
    $t[] = $row['appTIME'];
    if($_POST['date'] == $row['appDATE'])
    {
        $check = true;
    }
}
//if the selected day is equal to at least one of the days with an appointment
if($check == true)
{
    //get every appointment info of the day
    $query = "SELECT * FROM appointment WHERE staffID = '".$_POST['username']."' AND appDATE = '".$_POST['date']."'";
    $hours = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($hours))
    {
        if(in_array($row['appTIME'], $times))
        {
            if (($key = array_search($row['appTIME'], $times)) !== false) {
                unset($times[$key]);
            }
        }
    }
    $ava[] = array_values($times);
    ?>
    <form action="bookingSQL.php" method="post" class="container">
        <table class="table table-dark table-striped">
            <tr>
                <th>Patient</th>
                <input type="hidden" value="<?php echo $_POST['patientID']; ?>" required>
                <td class="table-light"><?php echo $pf." ".$pl; ?></td>
            </tr>
            <tr>
                <th>Doctor</th>
                <input type="hidden" value="<?php echo $_POST['username']; ?>" required>
                <td class="table-light"><?php echo $df." ".$dl; ?></td>
            </tr>
            <tr>
                <th>Date</th>
                <input type="hidden" value="<?php echo $_POST['date']; ?>" required>
                <td class="table-light"><?php echo date('d/m/Y', strtotime($_POST['date'])); ?></td>
            </tr>
            <tr>
                <th>Time</th>
                <td class="table-light">
                    <select name="time" class="form-select">
                        <option disabled selected>Choose time</option>
                        <?php
                        for($i = 0; $i < sizeof($ava[0]); $i++)
                        {
                            ?>
                            <option value="<?php echo $ava[0][$i]; ?>">
                            <?php
                                echo date('H:i', strtotime($ava[0][$i]));
                        }
                        ?>
                        </option>
                    </select>
                </td>
            </tr>
        </table>
        <div>
            <input class="btn btn-dark" type="submit" value="Select time">
        </div>
    </form>
<?php
}
else
{
    ?>
    <form action="bookingSQL.php" method="post" class="container">
        <table class="table table-dark table-striped">
            <tr>
                <th>Patient</th>
                <input type="hidden" value="<?php echo $_POST['patientID']; ?>" required>
                <td class="table-light"><?php echo $pf." ".$pl; ?></td>
            </tr>
            <tr>
                <th>Doctor</th>
                <input type="hidden" value="<?php echo $_POST['username']; ?>" required>
                <td class="table-light"><?php echo $df." ".$dl; ?></td>
            </tr>
            <tr>
                <th>Date</th>
                <input type="hidden" value="<?php echo $_POST['date']; ?>" required>
                <td class="table-light"><?php echo date('d/m/Y', strtotime($_POST['date'])); ?></td>
            </tr>
            <tr>
                <th>Time</th>
                <td class="table-light">
                    <select name="time" class="form-select">
                        <option disabled selected>Choose time</option>
                        <?php
                        for($i = 0; $i < sizeof($times); $i++)
                        {
                            ?>
                            <option value="<?php echo $times[$i]; ?>">
                            <?php
                                echo date('H:i', strtotime($times[$i]));
                        }
                        ?>
                        </option>
                    </select>
                </td>
            </tr>
        </table>
        <div>
            <input class="btn btn-dark" type="submit" value="Select time">
        </div>
    </form>
    <?php
}

include('Footer.php');?>