<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<br>
<div class="text-center">
    <h1>Welcome <?= $_SESSION['user']['firstname'] ?? 'Member' ?>!</h1>
    <h4>Use the navigation bar or click the buttons down below to browse the Admin Panel.</h4>
</div>
<div class="row d-flex justify-content-center" style="width: 100%;">
    <div class="row d-flex justify-content-center " style="width: 60%;">
    <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Orders.php" style="width: 30%; margin-left: 22px;">Orders</a><br>
    <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Inventory.php" style="width: 30%; margin-left: 22px;">Inventory</a><br>
    <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Restocks.php" style="width: 30%; margin-left: 22px;">Restocks</a><br>
    <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Suppliers.php" style="width: 30%; margin-left: 22px;">Suppliers</a>
    <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Users.php" style="width: 30%; margin-left: 22px;">Users</a>
    <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Categories.php" style="width: 30%; margin-left: 22px;">Categories</a>
    <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Roles.php" style="width: 30%; margin-left: 22px;">Roles</a>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php

require __DIR__ . "/inc/footer.php";
RoutingController::verify_member_is_admin();

?>