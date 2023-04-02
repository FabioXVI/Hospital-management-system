<?php
include('NavDoctor.php');
include('connection.php');

$stmt1 = $con->prepare("SELECT * FROM patient WHERE patientID = ?");
$stmt1->bind_param('s', $_POST['patientID']);
$stmt1->execute();
$result1 = $stmt1->get_result();
$items1 = $result1->fetch_assoc();
$stmt2 = $con->prepare("SELECT * FROM appointment WHERE patientID = ?");
$stmt2->bind_param('s', $_POST['patientID']);
$stmt2->execute();
$result2 = $stmt2->get_result();
$items2 = $result2->fetch_assoc();
$stmt3 = $con->prepare("SELECT * FROM diagnosis WHERE patientID = ?");
$stmt3->bind_param('s', $_POST['patientID']);
$stmt3->execute();
$result3 = $stmt3->get_result();
$items3 = $result3->fetch_assoc();

?>

<div>
    <table class="table">
        <tr>
            <th class="table-light" colspan="2">Patient info</th>
        </tr>
        <tr>
            <th class="table-dark">First Name</th>
            <th><?= $items1['fname']; ?></th>
        </tr>
        <tr>
            <th class="table-dark">Last Name</th>
            <th><?= $items1['lname']; ?></th>
        </tr>
        <tr>
            <th class="table-dark">Birthday</th>
            <th><?= $items1['birth']; ?></th>
        </tr>
        <tr>
            <th class="table-dark">Gender</th>
            <th><?= $items1['gender']; ?></th>
        </tr>
        <tr>
            <th class="table-dark">Address</th>
            <th><?= $items1['address']; ?></th>
        </tr>
        <tr>
            <th class="table-dark">Postcode</th>
            <th><?= $items1['postcode']; ?></th>
        </tr>
        <tr>
            <th class="table-dark">Email</th>
            <th><?= $items1['email']; ?></th>
        </tr>
        <tr>
            <th class="table-dark">Contact</th>
            <th><?= $items1['contact']; ?></th>
        </tr>
        <?php
        if(mysqli_num_rows($result2) > 0)
        {
            ?>
            <tr>
                <th class="table-light" colspan="2">Next appointment</th>
            </tr>
            <tr>
                <th class="table-dark">Number reference</th>
                <th><?= $items2['appID']; ?></th>
            </tr>
            <tr>
                <th class="table-dark">Date</th>
                <th><?= $items2['appDATE']; ?></th>
            </tr>
            <tr>
                <th class="table-dark">Time</th>
                <th><?= $items2['appTIME']; ?></th>
            </tr>
        <?php
        }
        if(mysqli_num_rows($result3) > 0)
        {
            ?>
            <tr>
                <th class="table-light" colspan="2">Diagnosis</th>
            </tr>
            <tr>
                <th class="table-dark">Date</th>
                <th><?= $items3['diagDATE']; ?></th>
            </tr>
            <tr>
                <th class="table-dark">Time</th>
                <th><?= $items3['diagTIME']; ?></th>
            </tr>
            <tr>
                <th class="table-dark">Description</th>
                <th><?= $items3['description']; ?></th>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="btn-group">
        <form action="diagnosis.php" method="post">
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
            <input type="hidden" name="patientID" value="<?php echo $_POST['patientID']; ?>">
            <input type="submit" name="diagnosis" class="btn btn-dark" value="New diagnosis">
        </form>
    </div>
    <div class="btn-group">
        <form action="selectDate.php" method="post">
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
            <input type="hidden" name="patientID" value="<?php echo $_POST['patientID']; ?>">
            <input type="submit" name="diagnosis" class="btn btn-dark" value="New appointment">
        </form>
        <form action="details.php" method="post">
        </form>
    </div>
</div>

<?php include('Footer.php'); ?>