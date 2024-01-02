
<?php 
require __DIR__ . "/inc/functions.php";
$userRole = RoutingController::verify_session_role();
if ($userRole == 'admin'){
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Process the submitted form data
        $addItemName = InputProcessor::processString($_POST['addItemName'])['value'];
        $addItemDescription = InputProcessor::processString($_POST['addItemDescription'])['value'];
        $addItemImage = $_FILES['addItemImage'];
        $fileResult = $controllers->equipment()->upload_image($addItemImage);
        if ($fileResult["Status"] == "Success"){
            $item = $controllers->equipment()->create_equipment(array('name'=>$addItemName,'description'=>$addItemDescription,'image'=>$fileResult["Destination"]));
            header("Location: Inventory.php?Upload%20Success");
        }else{
            header("Location: Inventory.php?".str_replace("+","%20",urlencode($fileResult["Status"])));
        }
        
    }
}
?>