<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php 
require __DIR__ . "/inc/functions.php";


$userRole = RoutingController::verify_session_role();
if ($userRole == 'admin'){
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $getInfo = urldecode($_SERVER['QUERY_STRING']);
        if ($getInfo != ''){
        ?>
        <div class="text-bg-success p-3">
            <div class="card bg-success text-center">
                <div class="card-body text-white"><h5><?php echo $getInfo; ?></h5></div>
            </div>
        </div>
        <?php
        }
    }elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $actionType = $_POST['actionType'];
        if (isset($actionType)){ //Check if the POST action is a modifying action
            $objectId = $_POST['objectId'];
            $objectName = $_POST['objectName'];
            $objectDescription = $_POST['objectDescription'];
            $objectImage = $_POST['objectImage'];

            if ($actionType == "delete"){
            
                ?>
                <script>
    
                //triggered when modal is about to be shown
                var equipmentId = "";
                $(document).ready(function(){
                    $("#DeleteModal").modal("show");
                });
                </script>
                <?php
            }elseif ($actionType == "edit"){
                ?>
                <script>
    
                //triggered when modal is about to be shown
                var equipmentId = "";
                $(document).ready(function(){
                    $("#EditModal").modal("show");
                });
                </script>
                <?php
            }
        }
        
       
        
        
        
        
    }

?>
<div class="container" style="padding-top: 30px;">
<div class="col-md-12 text-center">
    <div class="col-12 col-md-12">
        <button class="btn btn-success btn-lg w-80 mb-4" type="submit" id="AdminInventory" data-toggle="modal" data-target="#AddItemModal">Add Item</button>
    </div>
  </div>
</div>

<!-- Add Item Modal -->
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
      <form method="post" action="./upload.php" enctype="multipart/form-data"> <!-- enctype to tell server that mutiple media types are being used -->
        <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">Item Name</label>
            <input type="text" class="form-control" name="addItemName" id="addItemName">
            <!--small id="emailHelp" class="form-text text-muted">Description must be at least 10 characters.</small-->
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">Item Description</label>
            <textarea class="form-control" name="addItemDescription" id="addItemDescription" rows="3"></textarea>
        </div>
        <div class="form-group" style="padding-bottom: 15px;">
            <label class="form-label" for="customFile">Item Image</label><br>
            <input type="file" class="form-control-md" name="addItemImage" id="addItemImage"/>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
}


require __DIR__ . "/components/inventory.php";
require __DIR__ . "/inc/footer.php"; ?>
