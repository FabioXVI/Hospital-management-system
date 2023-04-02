<?php include("NavLogin.php"); ?>
<div class="text-center">
    <h1>Login</h1>
</div>
<br>
<div class="mx-auto" style="width: 400px;">
    <form class="row g-3 text-center" action="loginSQL.php" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>

        <div class="input-group ">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>

        <div class="col-12">
            <button class="btn btn-dark" type="submit">Login</button>
        </div>
    </form>
    <br>
    <form class="mx-auto g-3 row text-center" action="forgot.php" method="post">
        <div class="col-12">
            <button class="btn btn-dark" type="submit">Forgot Password?</button>
        </div>
    </form>
</div>

<?php include("Footer.php"); ?>