<?php
include('NavDir.php');
include('connection.php');
?>

<div class="text-center">
    <h1>List of staff members</h1>
</div>

<form method="GET">
    <div class="input-group mb-3">
        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="form-control" placeholder="Search data">
        <button type="submit" class="btn btn-dark">Search</button>
    </div>
</form>

<table class="table">
    <tr class="table-dark">
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Birthday</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    <?php
        if(isset($_GET['search']))
        {?>
            <?php
            $filtervalues = $_GET['search'];
            $query = "SELECT * FROM staff WHERE CONCAT(username, fname, lname) LIKE '%$filtervalues%' ";
            $query_run = mysqli_query($con, $query);
            if(mysqli_num_rows($query_run) > 0)
            {
                foreach($query_run as $items)
                {
                    ?>
                    <tr class="table">
                        <td><?= $items['username']; ?></td>
                        <td><?= $items['fname']; ?></td>
                        <td><?= $items['lname']; ?></td>
                        <td><?= date_format(date_create($items['birth']), 'd/m/Y'); ?></td>
                        <td><?= $items['email']; ?></td>
                        <td><?= $items['contact']; ?></td>
                        <td><?= $items['role']; ?></td>
                        <form action="deldocSQL.php" method="post">
                            <input type="hidden" name="username" value="<?php echo $items['username'] ?>">
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
            </table>
                <?php
            }
        } else {
        $query = "SELECT * FROM staff";
        $query_run = mysqli_query($con, $query);
        foreach ($query_run as $items)
        {
            ?>
            <tr class="table">
                <td><?= $items['username']; ?></td>
                <td><?= $items['fname']; ?></td>
                <td><?= $items['lname']; ?></td>
                <td><?= date_format(date_create($items['birth']), 'd/m/Y'); ?></td>
                <td><?= $items['email']; ?></td>
                <td><?= $items['contact']; ?></td>
                <td><?= $items['role']; ?></td>
                <form action="deldocSQL.php" method="post">
                    <input type="hidden" name="username" value="<?php echo $items['username'] ?>">
                    <td><input type="submit" name="delete" class="btn btn-dark btn-sm" value="Delete"></td>
                </form>
            </tr><?php
        }
    }?>
</table>

<?php include('Footer.php');?>