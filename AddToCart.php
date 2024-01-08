
<?php 
require __DIR__ . "/inc/functions.php";
$userRole = RoutingController::verify_session_role();


// Add items from add to cart button to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $actionType = $_POST['actionType'];
    $header = $_POST['header'];
    if ($actionType == "addCart"){
        $objectId = $_POST['objectId'];
        $objectQuantity = $_POST['ItemQuantity'];
        if (isset($_SESSION['user'])){
            if (!isset($_SESSION['user']['cart'])){ //Check if user already has a cart, if not create one
                $_SESSION['user']['cart'] = array();
            }
            $foundItem = false;
            foreach ($_SESSION['user']['cart'] as $index=>$Item){ // For loop to check if item is already in order
               
                if ($Item['id'] == $objectId){
                    $foundItem = true;
                    $_SESSION['user']['cart'][$index]['quantity'] = $objectQuantity; // If Item is found in order, add additional quantity to it
                    if ($userRole == 'admin'){
                        $message = "Order%20Updated%20Successfully";
                    }else{
                        $message = "Cart%20Updated%20Successfully";
                    }
                }
            }
            if ($foundItem == false){
                if ($userRole == 'admin'){
                    $message = "Added%20to%20Order";
                }else{
                    $message = "Added%20to%20Cart";
                }
                array_push($_SESSION['user']['cart'],array('id'=>$objectId,'quantity'=>$objectQuantity)); //Add item to cart
            }
            
        }
    }elseif ($actionType == "deleteCart"){
        $objectId = $_POST['objectId'];
        if (isset($_SESSION['user'])){
            if (!isset($_SESSION['user']['cart'])){ //Check if user already has a cart, if not create one
                $_SESSION['user']['cart'] = array();
            }
            
            foreach ($_SESSION['user']['cart'] as $index=>$Item){ // For loop to check if item is already in order
               
                if ($Item['id'] == $objectId){
                    unset($_SESSION['user']['cart'][$index]);
                    $message = "Item%20Removed%20Successfully";
                }
            }
        }
    }
    header("Location: ".$header."?".$message); //Direct user to chosen header based on created item type   
}
?>