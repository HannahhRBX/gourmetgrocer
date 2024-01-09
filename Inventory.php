<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php 
require __DIR__ . "/inc/functions.php";


$userRole = RoutingController::verify_session_role();
if ($userRole == 'admin'){
    // Check for any POST or GET data to initiate a form data update or display status
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $actionType = $_POST['actionType'];
        if (isset($actionType)){ //Check if the POST action is a modifying action
            $objectId = $_POST['objectId'];
            $objectName = $_POST['objectName'];
            $objectCatagoryId = $_POST['objectCatagoryId'];
            $objectSupplierId = $_POST['objectSupplierId'];
            $objectDescription = $_POST['objectDescription'];
            $objectStock = $_POST['objectStock'];
            $objectBuyPrice = $_POST['objectBuyPrice'];
            $objectSellPrice = $_POST['objectSellPrice'];
            $objectImage = $_POST['objectImage'];

            if ($actionType == "delete"){
            
                ?>
                <script>
    
                // Instantly display the delete form if the page is loaded with the delete POST Request
                $(document).ready(function(){
                    $("#DeleteModal").modal("show");
                });
                </script>
                <?php
            }elseif ($actionType == "edit"){
                ?>
                <script>
    
                // Instantly display the update form if the page is loaded with the update POST Request
                $(document).ready(function(){
                    $("#EditModal").modal("show");
                });
                </script>
                <?php
            }
        }
        
       
        
        
        
        
    }

?>


<!--
<div class="container" style="padding-top: 30px; width: 500px;">
    <div class="col-md-12 center">
        <div class="col-12 col-md-12">
        <label for="nameSearch" class="form-label">Search by Name:</label><br>
            <form class="form-inline mr-auto">
                
                <input class="form-control mr-sm-2" style="width: 300px" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success btn-rounded btn-sm my-0 " type="submit">Search</button>
            </form>
        </div>
    </div>
</div>
-->
<!-- Add Item Modal Popup Form Element -->
<div class="modal fade" id="AddItemModal" tabindex="-1" role="dialog" aria-labelledby="AddItemModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add an Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
      <form method="post" action="./createRecord.php" enctype="multipart/form-data"> <!-- enctype to tell server that mutiple media types are being used -->
        <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">Item Name</label>
            <input type="text" class="form-control" name="ItemName" id="ItemName">
            <!--small id="emailHelp" class="form-text text-muted">Name must be at least 10 characters.</small-->
        </div>
        
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">Item Description</label>
            <textarea class="form-control" name="ItemDescription" id="ItemDescription" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">Item Catagory</label><br>
            <select class="select" style="padding: 4px" name="ItemCatagory">
                <?php
                // Create a dropdown list, with all catagories currently in catagories table
                $catagories = $controllers->catagories()->get_all_catagories();
                foreach ($catagories as $catagory){
                    ?>
                    <option value=<?=$catagory['id'] ?>><?= $catagory['name'] ?></option>
                    <?php
                }
                ?> 
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">Item Supplier</label><br>
            <select class="select" style="padding: 4px" name="ItemSupplier">
                <?php
                // Create a dropdown list, with all suppliers currently in suppliers table
                $suppliers = $controllers->suppliers()->get_all_suppliers();
                foreach ($suppliers as $supplier){
                    ?>
                    <option value=<?=$supplier['id'] ?>><?= $supplier['name'] ?></option>
                    <?php
                }
                ?> 
            </select>
        </div>
        
        <div class="form-group" style="width: 200px">
            <label for="exampleFormControlInput1" class="form-label">Item Sell Price</label>
            <input type="number" class="form-control" name="ItemSellPrice" id="ItemSellPrice" step=".01">
        </div>
        <div class="form-group" style="width: 200px">
            <label for="exampleFormControlInput1" class="form-label">Item Buy Price</label>
            <input type="number" class="form-control" name="ItemBuyPrice" id="ItemBuyPrice" step=".01">
        </div>
        <div class="form-group" style="width: 200px">
            <label for="exampleFormControlInput1" class="form-label">Item Stock</label>
            <input type="number" class="form-control" name="ItemStock" id="ItemStock">
        </div>
        <div class="form-group" style="padding-bottom: 15px;">
            <label class="form-label" for="customFile">Item Image</label><br>
            <input type="file" class="form-control-md" name="ItemImage" id="ItemImageA"/>
        </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="objectType" value="equipment">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
}

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $getInfo = urldecode($_SERVER['QUERY_STRING']);
    if ($getInfo != ''){
        if (str_contains($getInfo,"Success") || str_contains($getInfo,"Added")){

            // Display green status message if the word 'Success' is in the URL GET request
            ?>
            <div class="text-bg-success p-3">
                <div class="card bg-success text-center">
                    <div class="card-body text-white"><h5><?php echo $getInfo; ?></h5></div>
                </div>
            </div>
        <?php
        }else{
            // Otherwise display a red status message with error information
            ?>
            <div class="text-bg-danger p-3">
                <div class="card bg-danger text-center">
                    <div class="card-body text-white"><h5><?php echo $getInfo; ?></h5></div>
                </div>
            </div>
            <?php
        }
    }
}
?>

<!-- Button for Add Item at top of page only appears if logged in as Admin -->
<div class="container" style="padding-top: 30px;">
<div class="col-md-12 text-center">
    <div class="col-12 col-md-12">
        <button class="btn btn-success btn-lg w-80 mb-4" type="submit" id="AdminInventory" data-toggle="modal" data-target="#AddItemModal">Add Item</button>
    </div>
  </div>
</div>

<?php
require __DIR__ . "/components/inventory.php";
require __DIR__ . "/inc/footer.php"; 
?>