<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php"; ?>

    <div class="container py-1 h-75">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="card-body p-5 text-center">
                <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Inventory.php">Inventory Management</a>
                <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Categories.php" style="margin-right: 15px;">Category Management</a>
                <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Users.php">User Management</a>
                <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Users.php">Role Management</a>
            </div>
        </div>
    </div>

<?php

require __DIR__ . "/inc/functions.php";
require __DIR__ . "/inc/footer.php";

RoutingController::verify_member_is_admin();

?>