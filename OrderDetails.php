<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php 
require __DIR__ . "/inc/functions.php";


$userRole = RoutingController::verify_session_role();
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $getInfo = urldecode($_SERVER['QUERY_STRING']);
    if ($getInfo != ''){
        // Display green status message if the word 'Success' is in the URL GET request
        $orderId = $_GET['orderId'];
    }
}


?>





<?php



require __DIR__ . "/components/orderDetails.php";
require __DIR__ . "/inc/footer.php"; 
?>