
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
        // Decide which type of item to delete based on data from item delete form
        if ($objectType == "equipment"){
            $status = $controllers->equipment()->delete_equipment($objectId);
            $header = "Inventory.php";
        }elseif ($objectType == "user"){
            $status = $controllers->members()->delete_member($objectId);
            $header = "Users.php";
        }elseif ($objectType == "catagory"){
            $status = $controllers->catagories()->delete_catagory($objectId);
            $header = "Categories.php";
        }elseif ($objectType == "role"){
            $status = $controllers->roles()->delete_role($objectId);
            $header = "Roles.php";
        }
        header("Location: ".$header."?Deletion%20Success");
        // Process the submitted form data
        
        
    }
}
?>