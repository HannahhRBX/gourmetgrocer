<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php 


$userRole = RoutingController::verify_session_role();
if ($userRole == 'admin'){
    // Check for any POST or GET data to initiate a form data update or display status
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $getInfo = urldecode($_SERVER['QUERY_STRING']);
        if ($getInfo != ''){
            if (str_contains($getInfo,"Success")){

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
    }elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $actionType = $_POST['actionType'];
        if (isset($actionType)){ //Check if the POST action is a modifying action
            $objectId = $_POST['objectId'];
            $objectName = $_POST['objectName'];
            $objectEmail = $_POST['objectEmail'];
            $objectPhone = $_POST['objectPhone'];
            $objectAddress = $_POST['objectAddress'];

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

<!-- Button for Add Item at top of page only appears if logged in as Admin -->
<div class="container" style="padding-top: 30px;">
<div class="col-md-12 text-center">
    <div class="col-12 col-md-12">
        <button class="btn btn-success btn-lg w-80 mb-4" type="submit" id="AdminInventory" data-toggle="modal" data-target="#AddItemModal">Add Supplier</button>
    </div>
  </div>
</div>

<!-- Add Item Modal Popup Form Element -->
<div class="modal fade" id="AddItemModal" tabindex="-1" role="dialog" aria-labelledby="AddItemModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
        <form method="post" action="./createRecord.php"> <!-- Create record form to send to POST Server Information in createRecord.php -->
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Supplier Name</label>
                <input type="text" class="form-control" name="SupplierName" id="SupplierName">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Supplier Email</label>
                <input type="text" class="form-control" name="SupplierEmail" id="SupplierEmail">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Supplier Phone</label>
                <input type="text" class="form-control" name="SupplierPhone" id="SupplierPhone">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1" class="form-label">Supplier Address</label>
                <textarea class="form-control" name="SupplierAddress" id="SupplierAddress" rows="3"></textarea>
            </div>
        
        </div>
        <div class="modal-footer">
            <input type="hidden" name="objectType" value="supplier">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
}
RoutingController::verify_member_is_admin();
require __DIR__ . "/components/suppliers.php";
require __DIR__ . "/inc/footer.php"; 
?>