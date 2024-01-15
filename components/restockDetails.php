<?php
// Check if user is member or admin to display management columns
$userRole = RoutingController::verify_session_role();
// Retrieve all role data using the role controller

// Retrieve user data and all shipments linked to a restock order
$shipments = $controllers->restocks()->get_all_shipments_by_restockid($orderId);
$userId = $controllers->restocks()->get_userid_from_restockid($orderId);
$userDetails = $controllers->members()->get_member_by_id($userId['user_id']);
arsort($shipments); //Sort the shipments to display the latest ones at the top
$OrderTotal = 0;

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
    <h2>Order #<?= $orderId?></h2>
    <h4>Placed By: <?= htmlspecialchars_decode($userDetails['firstname']." ".$userDetails['lastname'], ENT_QUOTES)." (ID: ".$userDetails['ID'].")"?></h4>
    <table class="table table-striped"> 
            <tr>
                <th>Image</th>
                <th>Name</th> 
                <th>Category</th> 
                <th>Price</th> 
                <th>Quantity</th>
                <th>Total</th>
               
                <th>Shipment ID</th>
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
                    $equipmentId = $controllers->restocks()->get_equipment_from_shipmentid($shipment['id'])['equipment_id'];
                    $equipment = $controllers->equipment()->get_equipment_by_id($equipmentId);
                    $total = $shipment['price']*$shipment['quantity'];
                    $OrderTotal += $total;
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
                    
                    <td>
                    <img src="<?= htmlspecialchars($equipment['image']) ?>"
                             alt="Image of <?= htmlspecialchars($equipment['description']) ?>" 
                             style="width: 100px; height: auto;">   
                             
                    </td>
                    <td><?= htmlspecialchars_decode($equipment['name'], ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($catagory['name'], ENT_QUOTES) ?></td> 
                    <td>£<?= htmlspecialchars_decode(round_to_2dp($shipment['price']), ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($shipment['quantity'], ENT_QUOTES) ?></td> 
                    <td>£<?= htmlspecialchars_decode(round_to_2dp($total), ENT_QUOTES) ?></td> 
                    
                    <td><?= htmlspecialchars_decode($shipment['id'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($shipment['payment_term'], ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($restock['placedOn'], ENT_QUOTES) ?></td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
      <div class="ml-auto">
        <h4 class="text-end">Order Total: £<?= round_to_2dp($OrderTotal) ?></h4>
      </div>
    </div>
</div>