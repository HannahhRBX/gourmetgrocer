<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php 
require __DIR__ . "/inc/functions.php";


$userRole = RoutingController::verify_session_role();
if ($userRole == 'admin'){
    

?>

<br>

<?php
require __DIR__ . "/components/orders.php";
}


require __DIR__ . "/inc/footer.php"; 
?>