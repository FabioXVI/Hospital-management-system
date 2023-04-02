<?php
include('NavLogin.php');
?>
<div class="container bg-dark">
    <h1 style="color: white;">Update password</h1>
    <br>
    <form class="form-control bg-secondary" method="post" action="forgotSQL.php">
        <div>
            <label class="form-label">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Insert your username" required>
        </div>
        <br>
        <div>
            <label class="form-label">Email</label>
            <input class="form-control" type="text" name="email" placeholder="Insert your email" required>
        </div>
        <br>
        <div>
            <label class="form-label">New Password</label>
            <input class="form-control" type="password" name="password" placeholder="Insert new password" required>
        </div>
        <br>
        <div>
            <button class="btn btn-dark" type="submit">Update password</button>
        </div>
    </form>
    <br>
    <br>
</div>