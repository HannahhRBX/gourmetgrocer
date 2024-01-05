<?php
// Check if user is member or admin to display management columns
$userRole = RoutingController::verify_session_role();
// Retrieve all equipment data using the catagory controller
$catagories = $controllers->catagories()->get_all_catagories();
?>
<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
    <h2>Category Management</h2> 
    <table class="table table-striped"> 
            <tr>
                
                <th>Name</th> 
                <?php
                //Check if admin, so that an extra Management column can appear next to each item
                if ($userRole == 'admin'){
                    ?>
                <th>Manage</th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($catagories as $catagory): ?> <!-- Loop through each category item -->
                <tr>
                    
                    <td><?= htmlspecialchars_decode($catagory['name'], ENT_QUOTES) ?></td> 
                   
                    <?php
                    //Check if admin, so that an extra column with edit and delete buttons can appear next to each item
                    if ($userRole == 'admin'){
                        ?>
                        <td><div class="container">
                        <form action="./Categories.php" method="post" style="padding-right: 10px; float: left;">
                        <button class="btn btn-danger btn-md w-40 mb-4" type="submit" id="deleteButton">Delete</button>
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                        <input type="hidden" name="actionType" value="delete">
                        <input type="hidden" name="objectId" value="<?= $catagory['id']; ?>">
                        <input type="hidden" name="objectName" value="<?= $catagory['name']; ?>">
                        </form>
                        <form action="./Categories.php" method="post" style="float: left;">
                        <button class="btn btn-warning btn-md w-40 mb-4" type="submit" id="editButton">Edit</button>
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                        <input type="hidden" name="actionType" value="edit">
                        <input type="hidden" name="objectId" value="<?= $catagory['id']; ?>">
                        <input type="hidden" name="objectName" value="<?= $catagory['name']; ?>">
                        </form>
                            
                        
                        </div>
                        </td> 
                        <?php
                    }
                    ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>




<!-- Delete Item Modal Popup Form Element -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="../deleteRecord.php">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this category?</script></h5>
        
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
        <div class="form-group" style="padding-bottom: 15px;">
            <label class="form-label">Name: <?php echo $objectName; ?></label><br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger" id="DeleteCatagory">Delete</button>
      </div>
      <input type="hidden" name="objectType" value="catagory">
      <input type="hidden" name="objectId" value=<?php echo $objectId; ?>>
    </form>
    </div>
  </div>
</div>

<!-- Edit Item Modal Popup Form Element -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit a Category</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
      <form method="post" action="../updateRecord.php"> <!-- enctype to tell server that mutiple media types are being used -->
        <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">Category Name</label>
            <input type="text" value="<?= $objectName ?>" class="form-control" name="catagoryName" id="catagoryName" required>
        </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update</button>
            <input type="hidden" name="objectType" value="catagory">
            <input type="hidden" name="objectId" value=<?= $objectId; ?>>
        </form>
      </div>
    </div>
  </div>
</div>


