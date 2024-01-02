
<?php 
require __DIR__ . "/inc/functions.php";
$userRole = RoutingController::verify_session_role();



if ($userRole == 'admin'){
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        $objectType = $_POST['objectType'];
        $objectId = $_POST['objectId'];
        if ($objectType == "equipment"){

            // Process the submitted form data
            $editItemName = InputProcessor::processString($_POST['editItemName'])['value'];
            $editItemDescription = InputProcessor::processString($_POST['editItemDescription'])['value'];
            $editItemImage = $_FILES['editItemImage'];
            $previousImage = $_POST['previousImage'];
            echo $previousImage;
            
            if ($editItemImage['name'] != ""){
                $fileResult = $controllers->equipment()->upload_image($editItemImage);
                if ($fileResult["Status"] == "Success"){
                    
                    $equipmentArray = array('id'=>$objectId,'name'=>$editItemName,'description'=>$editItemDescription,'image'=>$fileResult["Destination"]);
                }else{
                    
                   

                    header("Location: Inventory.php?".str_replace("+","%20",urlencode($fileResult["Status"])));
                }
            }else{
                $equipmentArray = array('id'=>$objectId,'name'=>$editItemName,'description'=>$editItemDescription,'image'=>$previousImage);
                
            }
            if (isset($equipmentArray)){
                $item = $controllers->equipment()->update_equipment($equipmentArray);
                header("Location: Inventory.php?Update%20Success");
            }
            
            
        }
        
        
        
        
    }
}
?>