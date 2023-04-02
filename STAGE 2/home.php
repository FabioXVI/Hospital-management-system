<?php include('NavLogin.php'); ?>

<h1>Welcome to SHUspital website</h1>
<br>
<div class="row align-items-start">
    <div class="col card">
        <img src="img/logo.jpg" class="card-img-top" alt="Logo">
        <div class="card-body">
            <h5 class="card-title">Are you a staff member?</h5>
            <a href="login.php" class="btn btn-primary">Login</a>
        </div>
    </div>
    <div class="col card" style="width: 18rem;">
        <img src="img/logo.jpg" class="card-img-top" alt="Logo">
        <div class="card-body">
            <h5 class="card-title">Are you a patient?</h5>
            <a href="contacts.php" class="btn btn-primary">Contacts</a>
        </div>
    </div>
</div>
<?php include('Footer.php'); ?>