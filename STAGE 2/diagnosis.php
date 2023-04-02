<?php
include('NavDoctor.php');
include('connection.php');
date_default_timezone_set('Europe/London');

$stmt = $con->prepare("SELECT * FROM patient WHERE patientID = ?");
$stmt->bind_param('s', $_POST['patientID']);
$stmt->execute();
$result = $stmt->get_result();
$items = $result->fetch_assoc();

$query = "SELECT * FROM diagnosis WHERE patientID = '".$_POST['patientID']."'";

?>

<div>
    <h1>Update <?php echo $items['fname']." ".$items['lname']; ?> diagnosis</h1>
    <form action="post" class="container">
        <input type="hidden" name="patientID" value="<?php $_POST['patientID'] ?>">
        <input type="hidden" value="<?php ?>">
        <table class="table table-dark">
            <tr>
                <th>Date</th>
            </tr>
            <tr>
                <input type="hidden" name="diagDATE" value="<?php echo date('Y-m-d'); ?>" disabled>
                <td>
                    <p class="table-light form-control"> <?php echo date('d/m/Y'); ?> </p>
                </td>
            </tr>
            <tr>
                <th>Time</th>
            </tr>
            <tr>
                <input type="hidden" name="diagTIME" value="<?php echo date('H:i:s'); ?>" disabled>
                <td>
                    <p class="table-light form-control"><?php echo date('H:i'); ?></p>
                </td>
            </tr>
            <tr>
                <th>Diagnosis</th>
            </tr>
            <tr>
                <td><textarea class="form-control" type="text" name="description" placeholder="desctiption"></textarea></td>
            </tr>
            <tr>
                <td><input class="btn btn-light" type="submit" value="Update"></td>
            </tr>
        </table>
    </form>
</div>

<?php include('Footer.php'); ?>