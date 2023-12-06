
<?php 
require __DIR__ . "/inc/functions.php";
$userRole = RoutingController::verify_session_role();
if ($userRole == 'admin'){
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $objectType = $_POST['objectType'];
        $objectId = $_POST['objectId'];
        if ($objectType == "equipment"){
            $status = $controllers->equipment()->delete_equipment($objectId);
        }
        header("Location: Inventory.php?Deletion%20Success");
        // Process the submitted form data
        
        
    }
}
?>