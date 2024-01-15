
<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php";
$userRole = RoutingController::verify_session_role();



if ($userRole == 'admin'){
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        $objectType = $_POST['objectType'];
        $objectId = $_POST['objectId'];
        // Decide which object type before updating
        if ($objectType == "equipment"){

            // Process the submitted form data
            $ItemName = InputProcessor::processString($_POST['ItemName'])['value'];
            $ItemCatagoryId = InputProcessor::processString($_POST['ItemCatagory'])['value'];
            $ItemSupplierId = InputProcessor::processString($_POST['ItemSupplier'])['value'];
            $ItemStock = (int)InputProcessor::processString($_POST['ItemStock'])['value'];
            $ItemBuyPrice = (float)InputProcessor::processString($_POST['ItemBuyPrice'])['value'];
            $ItemSellPrice = (float)InputProcessor::processString($_POST['ItemSellPrice'])['value'];
            $ItemDescription = InputProcessor::processString($_POST['ItemDescription'])['value'];
            $ItemImage = $_FILES['ItemImage'];
            $previousImage = $_POST['previousImage'];
            
            // If image has changed, process the new image file
            if ($ItemImage['name'] != ""){
                // Download Image File to Root Directory/Images
                $fileResult = $controllers->equipment()->upload_image($ItemImage);
                if ($fileResult["Status"] == "Success"){
                    $equipmentArray = array('id'=>$objectId,'name'=>$ItemName,'description'=>$ItemDescription,'stock'=>$ItemStock,'buy_price'=>$ItemBuyPrice,'sell_price'=>$ItemSellPrice,'image'=>$fileResult["Destination"]);
                }else{
                    // Give error code if upload fails
                    header("Location: Inventory.php?".str_replace("+","%20",urlencode($fileResult["Status"])));
                }
            }else{
                // Update the record without changing the image file
                $equipmentArray = array('id'=>$objectId,'name'=>$ItemName,'description'=>$ItemDescription,'stock'=>$ItemStock,'buy_price'=>$ItemBuyPrice,'sell_price'=>$ItemSellPrice,'image'=>$previousImage);
            }
            // Check if equipment array is set and no errors given, then update record in database
            if (isset($equipmentArray)){
                $item = $controllers->equipment()->update_equipment($equipmentArray);
                // Make sure to update catagory_id for record in equipment_catagories table
                // Check if item has category
                $itemCatagory = $controllers->equipment()->get_catagory_by_equipmentid($objectId);
                if ($itemCatagory != null){
                    $itemCatagory = $controllers->equipment()->update_equipment_catagory(array('equipment_id'=>$objectId,'catagory_id'=>$ItemCatagoryId));
                }else{
                    $itemCatagory = $controllers->equipment()->add_equipment_to_catagory(array('equipment_id'=>$objectId,'catagory_id'=>$ItemCatagoryId));
                }
                $itemSupplier = $controllers->equipment()->get_supplier_by_equipmentid($objectId);
                if ($itemSupplier != null){
                    $itemSupplier = $controllers->equipment()->update_equipment_supplier(array('equipment_id'=>$objectId,'supplier_id'=>$ItemSupplierId));
                }else{
                    $itemSupplier = $controllers->equipment()->add_equipment_to_supplier(array('equipment_id'=>$objectId,'supplier_id'=>$ItemSupplierId));
                }


                $header = "Inventory.php";
            }
            
            
        }elseif ($objectType == "user"){
            $userFirstName = InputProcessor::processString($_POST['userFirstName'])['value'];
            $userLastName = InputProcessor::processString($_POST['userLastName'])['value'];
            $userEmail = $_POST['userEmail'];
            $userRoleId = $_POST['userRole'];

            $userArray = array('id'=>$objectId,'firstname'=>$userFirstName,'lastname'=>$userLastName,'email'=>$userEmail);
            $userUpdate = $controllers->members()->update_member($userArray);
           
            $userRole = $controllers->members()->get_role_by_userid($objectId);
            
            if ($userRole != null){
                $userRole = $controllers->members()->update_member_role(array('user_id'=>$objectId,'role_id'=>$userRoleId));
             }else{
                $userRole = $controllers->members()->add_member_to_roles(array('user_id'=>$objectId,'role_id'=>$userRoleId));
            }
            $header = "Users.php";
            
            
        }elseif ($objectType == "catagory"){
            $catagoryName = InputProcessor::processString($_POST['catagoryName'])['value'];

            $catagoryArray = array('id'=>$objectId,'name'=>$catagoryName);
            $catagoryUpdate = $controllers->catagories()->update_catagory($catagoryArray);
            $header = "Categories.php";
        }elseif ($objectType == "role"){
            $roleName = InputProcessor::processString($_POST['roleName'])['value'];

            $roleArray = array('id'=>$objectId,'name'=>$roleName);
            $roleUpdate = $controllers->roles()->update_role($roleArray);
            $header = "Roles.php";
        }elseif ($objectType == "supplier"){
            $SupplierName = InputProcessor::processString($_POST['SupplierName'])['value'];
            $SupplierEmail = InputProcessor::processString($_POST['SupplierEmail'])['value'];
            $SupplierPhone = InputProcessor::processString($_POST['SupplierPhone'])['value'];
            $SupplierAddress = InputProcessor::processString($_POST['SupplierAddress'])['value'];
            
            $supplierArray = array('id'=>$objectId,'name'=>$SupplierName,'email'=>$SupplierEmail,'phone'=>$SupplierPhone,'address'=>$SupplierAddress);
            $supplierUpdate = $controllers->suppliers()->update_supplier($supplierArray);
            $header = "Suppliers.php";
        }
        header("Location: ".$header."?Update%20Success");
        
        
    }
}
?>