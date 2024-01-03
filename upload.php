
<?php 
require __DIR__ . "/inc/functions.php";
$userRole = RoutingController::verify_session_role();
if ($userRole == 'admin'){
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Process the submitted form data
        $ItemName = InputProcessor::processString($_POST['ItemName'])['value'];
        $ItemCatagoryId = InputProcessor::processString($_POST['ItemCatagory'])['value'];
        $ItemDescription = InputProcessor::processString($_POST['ItemDescription'])['value'];
        $ItemStock = InputProcessor::processString($_POST['ItemStock'])['value'];
        $ItemBuyPrice = InputProcessor::processString($_POST['ItemBuyPrice'])['value'];
        $ItemSellPrice = InputProcessor::processString($_POST['ItemSellPrice'])['value'];
        $ItemImage = $_FILES['ItemImage'];
        // Download Image File to Root Directory/Images
        $fileResult = $controllers->equipment()->upload_image($ItemImage);
        
        if ($fileResult["Status"] == "Success"){
            // Create an equipment record with details, then input new equipment Id into equipment_catagory link table
            $NewItemId = $controllers->equipment()->create_equipment(array('name'=>$ItemName,'description'=>$ItemDescription,'image'=>$fileResult["Destination"],'stock'=>$ItemStock,'buy_price'=>$ItemBuyPrice,'sell_price'=>$ItemSellPrice));
            $itemCatagory = $controllers->equipment()->add_equipment_to_catagory(array($NewItemId,$ItemCatagoryId));
            header("Location: Inventory.php?Upload%20Success");
        }else{
            // Give error code if upload fails
            header("Location: Inventory.php?".str_replace("+","%20",urlencode($fileResult["Status"])));
        }
        
    }
}
?>