<?php
// Check if user is member or admin to display management columns
$userRole = RoutingController::verify_session_role();
// Retrieve all role data using the role controller

$orderCarts = $controllers->orders()->get_all_order_carts_by_orderid($orderId);
$userId = $controllers->orders()->get_userid_from_orderid($orderId);
$userDetails = $controllers->members()->get_member_by_id($userId['user_id']);
arsort($orderCarts); //Sort the order_carts to display the latest ones at the top
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
            <?php foreach ($orderCarts as $orderCart): ?> <!-- Loop through each category item -->
                <tr>
                    <?php 
                    $equipmentId = $controllers->orders()->get_equipment_from_order_cartid($orderCart['id'])['equipment_id'];
                    $equipment = $controllers->equipment()->get_equipment_by_id($equipmentId);
                    $total = $orderCart['price']*$orderCart['quantity'];
                    $OrderTotal += $total;
                    $catagoryId = $controllers->equipment()->get_catagory_by_equipmentid($equipmentId);
                    if ($catagoryId != null){
                      $catagoryId = $catagoryId["catagory_id"];
                      $catagory = $controllers->catagories()->get_catagory_by_id($catagoryId);
                    }else{
                      $catagoryId = 1;
                      $catagory = array("name"=>"");
                    }
                    $order = $controllers->orders()->get_order_by_id($orderCart['order_id']);
                    $orderUser = $controllers->members()->get_member_by_id($order['user_id']);
                    
                    ?>
                    
                    <td>
                    <img src="<?= htmlspecialchars($equipment['image']) ?>"
                             alt="Image of <?= htmlspecialchars($equipment['description']) ?>" 
                             style="width: 100px; height: auto;">   
                             
                    </td>
                    <td><?= htmlspecialchars_decode($equipment['name'], ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($catagory['name'], ENT_QUOTES) ?></td> 
                    <td>£<?= htmlspecialchars_decode(round_to_2dp($orderCart['price']), ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($orderCart['quantity'], ENT_QUOTES) ?></td> 
                    <td>£<?= htmlspecialchars_decode(round_to_2dp($total), ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($order['placedOn'], ENT_QUOTES) ?></td> 
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