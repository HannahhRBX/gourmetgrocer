<?php
// Include the functions file for necessary functions and classes

$userRole = RoutingController::verify_session_role();
// Retrieve all equipment data using the equipment controller
$equipment = $controllers->equipment()->get_all_equipments();
?>
<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
    <h2>Equipment Inventory</h2> 
    <table class="table table-striped"> 
            <tr>
                <th>Image</th> 
                <th>Name</th> 
                <th>Description</th> 
                <?php
                //Check if admin, so that an extra column with edit buttons can appear next to each item
                if ($userRole == 'admin'){
                    ?>
                <th>Manage</th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipment as $equip): ?> <!-- Loop through each equipment item -->
                <tr>
                    <td>
                    <img src="<?= htmlspecialchars($equip['image']) ?>"
                             alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                             style="width: 150px; height: auto;">   
                             
                    </td>
                    <td><?= htmlspecialchars_decode($equip['name'], ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($equip['description'], ENT_QUOTES) 
                    ?></td> 
                    <?php
                    //Check if admin, so that an extra column with edit buttons can appear next to each item
                    if ($userRole == 'admin'){
                        ?>
                        <td><div class="container">
                        <form action="./Inventory.php" method="post" style="padding-right: 10px; float: left;">
                        <button class="btn btn-danger btn-lg w-40 mb-4" type="submit" id="deleteButton">Delete</button>
                        <input type="hidden" name="actionType" value="delete">
                        <input type="hidden" name="objectId" value="<?php echo $equip['id']; ?>">
                        <input type="hidden" name="objectName" value="<?php echo $equip['name']; ?>">
                        <input type="hidden" name="objectDescription" value="<?php echo $equip['description']; ?>">
                        <input type="hidden" name="objectImage" value="<?php echo $equip['image']; ?>">
                        </form>
                        <form action="./Inventory.php" method="post" style="float: left;">
                        <button class="btn btn-warning btn-lg w-40 mb-4" type="submit" id="editButton">Edit</button>
                        <input type="hidden" name="actionType" value="edit">
                        <input type="hidden" name="objectId" value="<?php echo $equip['id']; ?>">
                        <input type="hidden" name="objectName" value="<?php echo $equip['name']; ?>">
                        <input type="hidden" name="objectDescription" value="<?php echo $equip['description']; ?>">
                        <input type="hidden" name="objectImage" value="<?php echo $equip['image']; ?>">
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




<!-- Delete Item Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="../deleteRecord.php">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this item?</script></h5>
        
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
        <div class="form-group" style="padding-bottom: 15px;">
            <label class="form-label">Name: <?php echo $objectName; ?></label><br>
            <label class="form-label">Description: <?php echo $objectDescription; ?></label><br>
            <img src="<?= htmlspecialchars($objectImage) ?>"
                             alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                             style="width: 100px; height: auto;">   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
      <input type="hidden" name="objectType" value="equipment">
      <input type="hidden" name="objectId" value=<?php echo $objectId; ?>>
    </form>
    </div>
  </div>
</div>

<!-- Delete Item Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="../deleteRecord.php">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this item?</script></h5>
        
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
        <div class="form-group" style="padding-bottom: 15px;">
            <label class="form-label">Name: <?php echo $objectName; ?></label><br>
            <label class="form-label">Description: <?php echo $objectDescription; ?></label><br>
            <img src="<?= htmlspecialchars($objectImage) ?>"
                             alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                             style="width: 100px; height: auto;">   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
      <input type="hidden" name="objectType" value="equipment">
      <input type="hidden" name="objectId" value=<?php echo $objectId; ?>>
    </form>
    </div>
  </div>
</div>

<!-- Edit Item Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit an Item</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
      <form method="post" action="../updateRecord.php" enctype="multipart/form-data"> <!-- enctype to tell server that mutiple media types are being used -->
        <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">Item Name</label>
            <input type="text" value="<?php echo $objectName ?>" class="form-control" name="editItemName" id="editItemName">
            <!--small id="emailHelp" class="form-text text-muted">Description must be at least 10 characters.</small-->
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">Item Description</label>
            <textarea class="form-control" name="editItemDescription" id="editItemDescription" rows="3"><?php echo $objectDescription ?></textarea>
        </div>
        <div class="form-group" style="padding-bottom: 15px;">
            <label class="form-label" for="customFile">Item Image</label><br>
            <img src="<?= htmlspecialchars($objectImage) ?>"
                             alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                             style="width: 100px; height: auto;"><br>
            <input type="file" class="form-control-md" name="editItemImage" id="editItemImage"/>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update</button>
            <input type="hidden" name="objectType" value="equipment">
            <input type="hidden" name="objectId" value=<?php echo $objectId; ?>>
            <input type="hidden" name="previousImage" value=<?php echo $objectImage; ?>>
        </form>
      </div>
    </div>
  </div>
</div>


