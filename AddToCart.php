
<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php";

$userRole = RoutingController::verify_session_role();


// Add items from add to cart button to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $actionType = $_POST['actionType'];
    $objectId = $_POST['objectId'];
    $header = $_POST['header'];

    if ($actionType == "addCart"){
        $objectQuantity = $_POST['ItemQuantity'];
        $message = $controllers->equipment()->AddToCart($objectId,$objectQuantity);
    }elseif ($actionType == "deleteCart"){
        $message = $controllers->equipment()->DeleteFromCart($objectId);
       
    }
   header("Location: ".$header."?".$message); //Direct user to chosen header based on created item type   
}
?>