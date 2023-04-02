<?php
include('NavDoctor.php');
?>

<div class="text-center">
    <h1>List of patients</h1>
</div>

<form method="GET">
    <div class="input-group mb-3">
        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="form-control" placeholder="Search data">
        <button class="btn btn-dark btn-sm" type="submit" class="btn btn-primary">Search</button>
    </div>
</form>
    <table class="table">
        <tr class="table-dark">
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birthday</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Postcode</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Info</th>
            <th>Action</th>
        </tr>
        <?php

            include('connection.php');

            if(isset($_GET['search']))
            {
                $filtervalues = $_GET['search'];
                $query = "SELECT * FROM patient WHERE CONCAT(fname, lname) LIKE '%$filtervalues%' ";
                $query_run = mysqli_query($con, $query);
                if(mysqli_num_rows($query_run) > 0)
                {
                    foreach($query_run as $items)
                    {
                        ?>
                        <tr class="table">
                            <td><?= $items['fname']; ?></td>
                            <td><?= $items['lname']; ?></td>
                            <td><?= $items['birth']; ?></td>
                            <td><?= $items['gender']; ?></td>
                            <td><?= $items['address']; ?></td>
                            <td><?= $items['postcode']; ?></td>
                            <td><?= $items['email']; ?></td>
                            <td><?= $items['contact']; ?></td>
                            <form action="details.php" method="post">
                                <input type="hidden" name="username" value="<?php session_start(); echo $_SESSION['username']; ?>">
                                <input type="hidden" name="patientID" value="<?php echo $items['patientID']; ?>">
                                <td><input type="submit" name="delete" class="btn btn-dark btn-sm" value="See more details..."></td>
                            </form>
                            <form action="delpatSQL.php" method="post">
                                <input type="hidden" name="patientID" value="<?php echo $items['patientID']; ?>">
                                <td><input type="submit" name="delete" class="btn btn-dark btn-sm" value="Delete"></td>
                            </form>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="10">No Record Found</td>
                    </tr>
                    <?php
                }
            } else {
            $query = "SELECT * FROM patient";
            $query_run = mysqli_query($con, $query);
            foreach ($query_run as $items)
            {;?>
                <tr class="table">
                    <td><?= $items['fname']; ?></td>
                    <td><?= $items['lname']; ?></td>
                    <td><?= $items['birth']; ?></td>
                    <td><?= $items['gender']; ?></td>
                    <td><?= $items['address']; ?></td>
                    <td><?= $items['postcode']; ?></td>
                    <td><?= $items['email']; ?></td>
                    <td><?= $items['contact']; ?></td>
                    <form action="details.php" method="post">
                        <input type="hidden" name="username" value="<?php session_start(); echo $_SESSION['username']; ?>">
                        <input type="hidden" name="patientID" value="<?php echo $items['patientID']; ?>">
                        <td><input type="submit" name="delete" class="btn btn-dark btn-sm" value="See more details..."></td>
                    </form>
                    <form action="delpatSQL.php" method="post">
                        <input type="hidden" name="patientID" value="<?php echo $items['patientID']; ?>">
                        <td><input type="submit" name="delete" class="btn btn-dark btn-sm" value="Delete"></td>
                    </form>
                </tr><?php
            }
        }?>
    </table>
<?php

include('Footer.php');

?>