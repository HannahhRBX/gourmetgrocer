<?php
// Check if user is member or admin to display management columns
$userRole = RoutingController::verify_session_role();
// Retrieve all equipment data using the supplier controller
$suppliers = $controllers->suppliers()->get_all_suppliers();
?>
<style>
table, th, td {
  text-align: center;
}
</style>
<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
    <h2>Supplier Management</h2> 
    <table class="table table-striped"> 
            <tr>
                
                <th>Name</th>
                <th>Email</th> 
                <th>Phone</th>
                <th>Address</th>
                <th>Shipments</th> 
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
            <?php foreach ($suppliers as $supplier): ?> <!-- Loop through each supplier item -->
                <tr>
                    
                    <td><?= htmlspecialchars_decode($supplier['name'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($supplier['email'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($supplier['phone'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($supplier['address'], ENT_QUOTES) ?></td>
                    <td>
                      <form action="./Shipments.php" method="get">
                        <button class="btn btn-info btn-md w-40 mb-4" type="submit" id="editButton">View</button>
                        <input type="hidden" name="supplierId" value="<?= $supplier['id']; ?>">
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                      </form>
                    </td>
                    <?php
                    //Check if admin, so that an extra column with edit and delete buttons can appear next to each item
                    if ($userRole == 'admin'){
                        ?>
                        <td><div class="container">
                        <form action="./Suppliers.php" method="post" style="padding-right: 10px; float: left;">
                        <button class="btn btn-danger btn-md w-40 mb-4" type="submit" id="deleteButton">Delete</button>
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                        <input type="hidden" name="actionType" value="delete">
                        <input type="hidden" name="objectId" value="<?= $supplier['id']; ?>">
                        <input type="hidden" name="objectName" value="<?= $supplier['name']; ?>">
                        <input type="hidden" name="objectEmail" value="<?= $supplier['email']; ?>">
                        <input type="hidden" name="objectPhone" value="<?= $supplier['phone']; ?>">
                        <input type="hidden" name="objectAddress" value="<?= $supplier['address']; ?>">
                        </form>
                        <form action="./Suppliers.php" method="post" style="float: left;">
                        <button class="btn btn-warning btn-md w-40 mb-4" type="submit" id="editButton">Edit</button>
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                        <input type="hidden" name="actionType" value="edit">
                        <input type="hidden" name="objectId" value="<?= $supplier['id']; ?>">
                        <input type="hidden" name="objectName" value="<?= $supplier['name']; ?>">
                        <input type="hidden" name="objectEmail" value="<?= $supplier['email']; ?>">
                        <input type="hidden" name="objectPhone" value="<?= $supplier['phone']; ?>">
                        <input type="hidden" name="objectAddress" value="<?= $supplier['address']; ?>">
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
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this supplier?</script></h5>
        
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
        <button type="submit" class="btn btn-danger" id="DeleteSupplier">Delete</button>
      </div>
      <input type="hidden" name="objectType" value="supplier">
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
        <h5 class="modal-title" id="exampleModalLabel">Edit a Supplier</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
      <form method="post" action="../updateRecord.php"> <!-- Update record form to send to POST Server Information in updateRecord.php -->

        <div class="form-group">
          <label for="exampleFormControlInput1" class="form-label">Supplier Name</label>
          <input type="text" value="<?= $objectName ?>" class="form-control" name="SupplierName" id="SupplierName">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1" class="form-label">Supplier Email</label>
          <input type="text" value="<?= $objectEmail ?>" class="form-control" name="SupplierEmail" id="SupplierEmail">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1" class="form-label">Supplier Phone</label>
          <input type="text" value="<?= $objectPhone ?>" class="form-control" name="SupplierPhone" id="SupplierPhone">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1" class="form-label">Supplier Address</label>
          <textarea class="form-control" name="SupplierAddress" id="SupplierAddress" rows="3"><?= $objectAddress ?></textarea>
        </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update</button>
            <input type="hidden" name="objectType" value="supplier">
            <input type="hidden" name="objectId" value=<?= $objectId; ?>>
        </form>
      </div>
    </div>
  </div>
</div>


