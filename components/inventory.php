<?php

// Check if user is member or admin to display management columns
$userRole = RoutingController::verify_session_role();
// Retrieve all equipment data using the equipment controller
$equipment = $controllers->equipment()->get_all_equipments();

function GetItemQuantity($ItemId){

  if (isset($_SESSION['user'])){
      if (isset($_SESSION['user']['cart'])){
        foreach ($_SESSION['user']['cart'] as $index=>$Item){
          if ($Item['id'] == $ItemId){
              return $_SESSION['user']['cart'][$index]['quantity'];
          }
        }
      }
  }
  return 0;
}


?>
<style>
table, th, td {
  text-align: center;
}
</style>
<!-- HTML for displaying the equipment inventory -->
<div class="container" style="max-width: 95%">
    <h2>Store Inventory</h2> 
    <table class="table table-striped"> 
            <tr>
                <th>Image</th> 
                <th>Name</th> 
                <th>Category</th>
                <th>Supplier</th>
                <th>Description</th>
                <th>Stock</th>
                <th>Buy Price</th>
                <th>Sell Price</th>
                <th>Order Quantity</th>
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
            <?php foreach ($equipment as $equip): ?> <!-- Loop through each equipment item -->
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
                    <td><?= htmlspecialchars_decode($equip['stock'], ENT_QUOTES) ?></td>
                    <td>£<?= htmlspecialchars_decode($equip['buy_price'], ENT_QUOTES) ?></td> 
                    <td>£<?= htmlspecialchars_decode($equip['sell_price'], ENT_QUOTES) ?></td> 
                    <td>
                      <?php if ($userRole == "admin"){
                        ?>
                        <form action="./AddToCart.php" method="post">
                        <button class="btn btn-success btn-md w-40 mb-4" type="submit" id="addButton" >Restock</button>
                        <input type="number" value="<?= GetItemQuantity($equip['id']) ?>" min="0" class="form-control" name="ItemQuantity" id="ItemQuantity" style="width: 80px; margin-left: -25px; float: right;">
                        <input type="hidden" name="header" value="Inventory.php">
                        <input type="hidden" name="actionType" value="addCart">
                        <input type="hidden" name="objectId" value="<?= $equip['id']; ?>">
                      </form>
                        <?php
                      }else{
                        ?>
                      <form action="./AddToCart.php" method="post">
                        <button class="btn btn-success btn-md w-40 mb-4" type="submit" id="addButton" >Add to Cart</button>
                        <input type="number" value="<?= GetItemQuantity($equip['id']) ?>" min="0" max="<?= $equip['stock'] ?>" class="form-control" name="ItemQuantity" id="ItemQuantity" style="width: 80px; margin-left: -40px; float: right;">
                        <input type="hidden" name="header" value="Inventory.php">
                        <input type="hidden" name="actionType" value="addCart">
                        <input type="hidden" name="objectId" value="<?= $equip['id']; ?>">
                      </form>
                      <?php
                      }
                      ?>
                    </td>
                    <?php
                    //Check if admin, so that an extra column with edit and delete buttons can appear next to each item
                    if ($userRole == 'admin'){
                        ?>
                        <td style="width: 200px"><div class="container">
                        <form action="./Inventory.php" method="post" style="padding-right: 10px; float: left;">
                        <button class="btn btn-danger btn-md w-40 mb-4" type="submit" id="deleteButton">Delete</button>
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                        <input type="hidden" name="actionType" value="delete">
                        <input type="hidden" name="objectId" value="<?= $equip['id']; ?>">
                        <input type="hidden" name="objectName" value="<?= $equip['name']; ?>">
                        <input type="hidden" name="objectCatagoryId" value="<?= $catagoryId; ?>">
                        <input type="hidden" name="objectSupplierId" value="<?= $supplierId; ?>">
                        <input type="hidden" name="objectStock" value="<?= $equip['stock']; ?>">
                        <input type="hidden" name="objectBuyPrice" value="<?= $equip['buy_price']; ?>">
                        <input type="hidden" name="objectSellPrice" value="<?= $equip['sell_price']; ?>">
                        <input type="hidden" name="objectDescription" value="<?= $equip['description']; ?>">
                        <input type="hidden" name="objectImage" value="<?= $equip['image']; ?>">
                        </form>
                        <form action="./Inventory.php" method="post" style="float: left;">
                        <button class="btn btn-warning btn-md w-40 mb-4" type="submit" id="editButton">Edit</button>
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                        <input type="hidden" name="actionType" value="edit">
                        <input type="hidden" name="objectId" value="<?= $equip['id']; ?>">
                        <input type="hidden" name="objectName" value="<?= $equip['name']; ?>">
                        <input type="hidden" name="objectCatagoryId" value="<?= $catagoryId; ?>">
                        <input type="hidden" name="objectSupplierId" value="<?= $supplierId; ?>">
                        <input type="hidden" name="objectStock" value="<?= $equip['stock']; ?>">
                        <input type="hidden" name="objectBuyPrice" value="<?= $equip['buy_price']; ?>">
                        <input type="hidden" name="objectSellPrice" value="<?= $equip['sell_price']; ?>">
                        <input type="hidden" name="objectDescription" value="<?= $equip['description']; ?>">
                        <input type="hidden" name="objectImage" value="<?= $equip['image']; ?>">
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
        <button type="submit" class="btn btn-danger" id="DeleteItem">Delete</button>
      </div>
      <input type="hidden" name="objectType" value="equipment">
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
        <h5 class="modal-title" id="exampleModalLabel">Edit an Item</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-lg-12" style="padding-top: 15px;">
      <form method="post" action="../updateRecord.php" enctype="multipart/form-data"> <!-- enctype to tell server that mutiple media types are being used -->
        <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">Item Name</label>
            <input type="text" value="<?= $objectName ?>" class="form-control" name="ItemName" id="ItemName">
            <!--small id="emailHelp" class="form-text text-muted">Description must be at least 10 characters.</small-->
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">Item Description</label>
            <textarea class="form-control" name="ItemDescription" id="ItemDescription" rows="3"><?= $objectDescription ?></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">Item Catagory</label><br>
            <select class="select" style="padding: 4px" name="ItemCatagory">
                <?php
                // Create a dropdown list, with all catagories currently in catagories table
                
                $catagories = $controllers->catagories()->get_all_catagories();
                foreach ($catagories as $catagory){
                    ?>
                    <option value=<?=$catagory['id'] ?><?php if ($catagory['id'] == $objectCatagoryId){
                      // Make the current equipment's catagory already selected
                      ?>
                      selected 
                      <?php
                    } ?> 
                    ><?= $catagory['name'] ?></option>
                    <?php
                }
                ?> 
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">Item Supplier</label><br>
            <select class="select" style="padding: 4px" name="ItemSupplier">
                <?php
                // Create a dropdown list, with all suppliers currently in suppliers table
                
                $suppliers = $controllers->suppliers()->get_all_suppliers();
                foreach ($suppliers as $supplier){
                    ?>
                    <option value=<?=$supplier['id'] ?><?php if ($supplier['id'] == $objectSupplierId){
                      // Make the current equipment's supplier already selected
                      ?>
                      selected 
                      <?php
                    } ?> 
                    ><?= $supplier['name'] ?></option>
                    <?php
                }
                ?> 
            </select>
        </div>
        <div class="form-group" style="width: 200px">
            <label for="exampleFormControlInput1" class="form-label">Item Buy Price</label>
            <input type="number" class="form-control" name="ItemBuyPrice" id="ItemBuyPrice" step=".01" value=<?= $objectBuyPrice; ?>>
        </div>
        <div class="form-group" style="width: 200px">
            <label for="exampleFormControlInput1" class="form-label">Item Sell Price</label>
            <input type="number" class="form-control" name="ItemSellPrice" id="ItemSellPrice" step=".01" value=<?= $objectSellPrice; ?>>
        </div>
        <div class="form-group" style="width: 200px">
            <label for="exampleFormControlInput1" class="form-label">Item Stock</label>
            <input type="number" class="form-control" name="ItemStock" id="ItemStock" value=<?= $objectStock; ?>>
        </div>
        <div class="form-group" style="padding-bottom: 15px;">
            <label class="form-label" for="customFile">Item Image</label><br>
            <img src="<?= htmlspecialchars($objectImage) ?>"
                             alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                             style="width: 100px; height: auto;"><br>
            <input type="file" class="form-control-md" name="ItemImage" id="ItemImage"/>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update</button>
            <input type="hidden" name="objectType" value="equipment">
            <input type="hidden" name="objectId" value=<?= $objectId; ?>>
            <input type="hidden" name="previousImage" value=<?= $objectImage; ?>>
        </form>
      </div>
    </div>
  </div>
</div>


