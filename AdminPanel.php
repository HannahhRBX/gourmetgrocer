<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<div class="container" style="width: 40%;">
    <div style="float: left;">
        <div class="row d-flex justify-content-center align-items-center h-110">
            <div class="card-body p-5 text-center" style="width: 110%;">
                <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Orders.php" style="width: 120%;">Orders</a><br>
                <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Categories.php" style="width: 120%;">Categories</a><br>
                
                
            </div>
        </div>
    </div>
    <div style="float: right;">
        <div class="row d-flex justify-content-center align-items-center h-110">
            <div class="card-body p-5 text-center" style="width: 110%;">
                <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Restocks.php" style="width: 120%;">Restocks</a><br>
                <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Suppliers.php" style="width: 120%;">Suppliers</a><br>
                
                
            </div>
        </div>
    </div>
    <div style="float: center;">
        <div class="row d-flex justify-content-center align-items-center h-110">
            <div class="card-body p-5 text-center" style="width: 50%;">
                <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Inventory.php" style="width: 110%;">Inventory</a><br>
                <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Users.php" style="width: 110%;">Users</a><br>
                <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Roles.php" style="width: 110%;">Roles</a><br>
                
            </div>
        </div>
    </div>
    
</div>




<?php


require __DIR__ . "/inc/footer.php";
require __DIR__ . "/inc/functions.php";
RoutingController::verify_member_is_admin();

?>