<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php 
require __DIR__ . "/inc/functions.php";


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
            $objectId = $_POST['userId'];
            $userFirstName = $_POST['userFirstName'];
            $userLastName = $_POST['userLastName'];
            $userEmail = $_POST['userEmail'];
            $userRoleId = $_POST['userRoleId'];

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
}
?>
<div class="container" style="padding-top: 30px;">
    <div class="col-md-12 text-center">
        <div class="col-12 col-md-12">
        <a class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory" href="./Roles.php">Manage Roles</a>
        </div>
    </div>
</div>

<?php
require __DIR__ . "/components/users.php";
require __DIR__ . "/inc/footer.php"; 
?>