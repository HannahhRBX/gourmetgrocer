
<?php 
require __DIR__ . "/inc/functions.php";
$userRole = RoutingController::verify_session_role();
// Check if the user is admin before deleting
if ($userRole == 'admin'){
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Check the object type before sending to correct controller
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