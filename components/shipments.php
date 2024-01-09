<?php
// Check if user is member or admin to display management columns
$userRole = RoutingController::verify_session_role();
// Retrieve all role data using the role controller

$equipmentIds = $controllers->equipment()->get_all_equipments_by_supplierid($supplierId);
$shipments = array();
//echo var_dump($equipmentIds);
foreach ($equipmentIds as $index=>$equipmentId){
  $getShipments = $controllers->restocks()->get_all_shipments_by_equipmentid($equipmentId['equipment_id']);
  if ($getShipments != null){
    foreach ($getShipments as $shipment){
      array_push($shipments,$shipment);
    }
  }
}
arsort($shipments); //Sort the shipments to display the latest ones at the top

function round_to_2dp($num){
  return number_format((float)$num, 2, '.', ''); // Returns a number rounded to 2 decimal places
}

?>
<br>
<br>
<style>
table, th, td {
  text-align: center;
}
</style>
<!-- HTML for displaying the equipment inventory -->
<div class="container" style="max-width: 80%">
    <h2>Shipments from <?= $controllers->suppliers()->get_supplier_by_id($supplierId)['name'] ?></h2> 
    <table class="table table-striped"> 
            <tr>
                <th>Shipment ID</th>
                <th>Image</th>
                <th>Name</th> 
                <th>Category</th> 
                <th>Price</th> 
                <th>Quantity</th>
                <th>Shipment Total</th>
                <th>Ordered By</th>
                <th>Order ID</th>
                <th>Payment Term</th>
                <th>Placed On</th>
                <?php
                //Check if admin, so that an extra Management column can appear next to each item
                if ($userRole == 'admin'){
                    ?>
                
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shipments as $shipment): ?> <!-- Loop through each category item -->
                <tr>
                    <?php 
                    $equipmentId = $shipment['equipment_id'];
                    $equipment = $controllers->equipment()->get_equipment_by_id($equipmentId);

                    $catagoryId = $controllers->equipment()->get_catagory_by_equipmentid($equipmentId);
                    if ($catagoryId != null){
                      $catagoryId = $catagoryId["catagory_id"];
                      $catagory = $controllers->catagories()->get_catagory_by_id($catagoryId);
                    }else{
                      $catagoryId = 1;
                      $catagory = array("name"=>"");
                    }
                    $restock = $controllers->restocks()->get_restock_by_id($shipment['restock_id']);
                    $restockUser = $controllers->members()->get_member_by_id($restock['user_id']);

                    ?>
                    <td><?= htmlspecialchars_decode($shipment['id'], ENT_QUOTES) ?></td> 
                    <td>
                    <img src="<?= htmlspecialchars($equipment['image']) ?>"
                             alt="Image of <?= htmlspecialchars($equipment['description']) ?>" 
                             style="width: 100px; height: auto;">   
                             
                    </td>
                    <td><?= htmlspecialchars_decode($equipment['name'], ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($catagory['name'], ENT_QUOTES) ?></td> 
                    <td>£<?= htmlspecialchars_decode($shipment['price'], ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($shipment['quantity'], ENT_QUOTES) ?></td> 
                    <td>£<?= htmlspecialchars_decode(round_to_2dp($shipment['price']*$shipment['quantity']), ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($restockUser['firstname']." ".$restockUser['lastname'], ENT_QUOTES)."<br>(".$restockUser['ID'].")"?></td> 
                    <td><?= htmlspecialchars_decode($shipment['restock_id'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($shipment['payment_term'], ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($restock['placedOn'], ENT_QUOTES) ?></td> 
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
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this role?</script></h5>
        
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
        <button type="submit" class="btn btn-danger" id="DeleteRole">Delete</button>
      </div>
      <input type="hidden" name="objectType" value="role">
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
        <h5 class="modal-title" id="exampleModalLabel">Edit a Role</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
      <form method="post" action="../updateRecord.php"> <!-- enctype to tell server that mutiple media types are being used -->
        <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">Role Name</label>
            <input type="text" value="<?= $objectName ?>" class="form-control" name="roleName" id="roleName" required>
        </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update</button>
            <input type="hidden" name="objectType" value="role">
            <input type="hidden" name="objectId" value=<?= $objectId; ?>>
        </form>
      </div>
    </div>
  </div>
</div>


