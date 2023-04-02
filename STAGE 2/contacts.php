<?php include('NavLogin.php');?>
<div>
    <h1>Contact a doctor to book an appointment</h1>
</div>
<form action="" method="GET">
    <div class="input-group mb-3">
        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="form-control" placeholder="Search data">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

<table class="table">
    <tr class="table-dark">
        <td>First Name</td>
        <td>Last Name</td>
        <td>Email</td>
        <td>Contact</td>
    </tr>
    <?php
    include('connection.php');

    if(isset($_GET['search']))
    {
        $filtervalues = $_GET['search'];
        $query = "SELECT * FROM staff WHERE role = 'doctor' AND CONCAT(fname, lname) LIKE '%$filtervalues%' ";
        $query_run = mysqli_query($con, $query);
        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $items)
            {
                ?>
                <tr class="table">
                    <td><?= $items['fname']; ?></td>
                    <td><?= $items['lname']; ?></td>
                    <td><?= $items['email']; ?></td>
                    <td><?= $items['contact']; ?></td>
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
        foreach ($query_run as $items) { ?>
                <tr class="table">
                    <td><?= $items['fname']; ?></td>
                    <td><?= $items['lname']; ?></td>
                    <td><?= $items['email']; ?></td>
                    <td><?= $items['contact']; ?></td>
                </tr><?php
        }
    }?>
</table>
<?php
include('Footer.php');
?>