
<?php 
require __DIR__ . "/inc/functions.php";
$userRole = RoutingController::verify_session_role();
if ($userRole == 'admin'){
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $objectType = $_POST['objectType'];
        if ($objectType == "equipment"){
            // Process the submitted form data
            $ItemName = InputProcessor::processString($_POST['ItemName'])['value'];
            $ItemCatagoryId = InputProcessor::processString($_POST['ItemCatagory'])['value'];
            $ItemSupplierId = InputProcessor::processString($_POST['ItemSupplier'])['value'];
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
                $itemSupplier = $controllers->equipment()->add_equipment_to_supplier(array($NewItemId,$ItemSupplierId));
                $header = "Inventory.php";
            }else{
                // Give error code if upload fails
                header("Location: Inventory.php?".str_replace("+","%20",urlencode($fileResult["Status"])));
            }
        }elseif ($objectType == "catagory"){ // Create a category
            $CatagoryName = InputProcessor::processString($_POST['CatagoryName'])['value'];
            $newCatagory = $controllers->catagories()->create_catagory(array('name'=>$CatagoryName));
            $header = "Categories.php";
        }elseif ($objectType == "role"){ // Create a role
            $RoleName = InputProcessor::processString($_POST['RoleName'])['value'];
            $newRole = $controllers->roles()->create_role(array('name'=>$RoleName));
            $header = "Roles.php";
        }
        elseif ($objectType == "supplier"){ // Create a supplier
            $SupplierName = InputProcessor::processString($_POST['SupplierName'])['value'];
            $SupplierEmail = InputProcessor::processString($_POST['SupplierEmail'])['value'];
            $SupplierPhone = InputProcessor::processString($_POST['SupplierPhone'])['value'];
            $SupplierAddress = InputProcessor::processString($_POST['SupplierAddress'])['value'];
            $newSupplier = $controllers->suppliers()->create_supplier(array('name'=>$SupplierName,'email'=>$SupplierEmail,'phone'=>$SupplierPhone,'address'=>$SupplierAddress));
            $header = "Suppliers.php";
        }
        header("Location: ".$header."?Upload%20Success"); //Direct user to chosen header based on created item type
        
    }
}
?>