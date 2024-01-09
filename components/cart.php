<?php

// Check if user is member or admin to display management columns
$userRole = RoutingController::verify_session_role();
// Retrieve all equipment data using the equipment controller
$equipment = $_SESSION['user']['cart'];
$OrderTotal = 0;

function round_to_2dp($num){
  return number_format((float)$num, 2, '.', ''); // Returns a number rounded to 2 decimal places
}

?>
<!-- HTML for displaying the equipment inventory -->
<div class="container" style="max-width: 95%">
    <h2>Order Details</h2> 
    <table class="table table-striped"> 
            <tr>
                <th>Image</th> 
                <th>Name</th> 
                <th>Category</th>
                <th>Supplier</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipment as $equip):
              $quantity = $equip['quantity'];
              $equip = $controllers->equipment()->get_equipment_by_id($equip['id']); ?> <!-- Loop through each equipment item -->

                <tr>
                    <td>
                    <img src="<?= htmlspecialchars($equip['image']) ?>"
                             alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                             style="width: 150px; height: auto;">   
                             
                    </td>
                    <td><?= htmlspecialchars_decode($equip['name'], ENT_QUOTES) ?></td> 
                    <?php 
                    
                    $catagoryId = $controllers->equipment()->get_catagory_by_equipmentid($equip['id']);
                    if ($catagoryId != null){
                      $catagoryId = $catagoryId["catagory_id"];
                      $catagory = $controllers->catagories()->get_catagory_by_id($catagoryId);
                    }else{
                      $catagoryId = 1;
                      $catagory = array("name"=>"");
                    }

                    $supplierId = $controllers->equipment()->get_supplier_by_equipmentid($equip['id']);
                    if ($supplierId != null){
                      $supplierId = $supplierId["supplier_id"];
                      $supplier = $controllers->suppliers()->get_supplier_by_id($supplierId);
                    }else{
                      $supplierId = 1;
                      $supplier = array("name"=>"");
                    }
                   
                    ?>
                    <td><?= htmlspecialchars_decode($catagory['name'], ENT_QUOTES) ?></td> 
                    <td><?= htmlspecialchars_decode($supplier['name'], ENT_QUOTES) ?></td> 
                    
                    <td><?= htmlspecialchars_decode($equip['description'], ENT_QUOTES) ?></td> 
                    
                    <?php
                    
                    if ($userRole == 'admin'){ 
                      $price = $equip['buy_price'];
                    }else{
                      $price = $equip['sell_price'];
                    }
                    $objectTotal = round_to_2dp($price * $quantity);
                    $OrderTotal += $objectTotal;
                    ?>
                    <td>£<?= htmlspecialchars_decode($price, ENT_QUOTES) ?></td>

                    <td>
                      <form action="./AddToCart.php" method="post" style="padding-right: 10px; float: left;">
                      <button class="btn btn-success btn-md w-40 mb-4" type="submit" id="addButton" style="margin-right: 7px;" >Update</button>
                        <input type="number" value="<?= $quantity ?>" min="0" class="form-control" name="ItemQuantity" id="ItemQuantity" style="width: 80px; float: right;">
                        <input type="hidden" name="header" value="Cart.php">
                        <input type="hidden" name="actionType" value="addCart">
                        <input type="hidden" name="objectId" value="<?= $equip['id']; ?>">
                      </form>
                    </td>
                    <td>£<?= htmlspecialchars_decode($objectTotal, ENT_QUOTES) ?></td>
                   
                    <!-- Add delete item from order column -->
                    <td style="width: 200px"><div class="container">
                      <form action="./AddToCart.php" method="post" style="margin-left: -20px; float: left;">
                        <button class="btn btn-danger btn-md w-40 mb-4" type="submit" id="deleteButton">Delete</button>
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                        <input type="hidden" name="actionType" value="deleteCart">
                        <input type="hidden" name="objectId" value="<?= $equip['id']; ?>">
                        <input type="hidden" name="header" value="Cart.php">
                      </form>
                     </div>
                    </td>

                       
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