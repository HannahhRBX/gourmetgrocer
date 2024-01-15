<?php
// Check if user is member or admin to display management columns
$userRole = RoutingController::verify_session_role();
// Retrieve all equipment data using the supplier controller
$restocks = $controllers->restocks()->get_all_restocks();

function round_to_2dp($num){
  return number_format((float)$num, 2, '.', ''); // Returns a number rounded to 2 decimal places
}
arsort($restocks); //Sort the restock orders to display the latest ones at the top
?>
<style>
table, th, td {
  text-align: center;
}
</style>
<!-- HTML for displaying the restock data table -->

<div class="container" style="max-width: 80%">
    <h2>Restocking Orders</h2> 
    <table class="table table-striped"> 
            <tr>
                
                <th>Restock ID #</th>
                <th>Ordered By</th> 
                <th>Number of Items</th>
                <th>Order Total</th>
                <th>Placed On</th>
                <th>Order Details</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($restocks as $restock): ?> <!-- Loop through each restock item -->
                <tr>
                    <?php
                    $user = $controllers->members()->get_member_by_id($restock['user_id']); // Get User from Restock order ID
                    $getShipments = $controllers->restocks()->get_all_shipments_by_restockid($restock['id']); // Get all shipments from a restock
                    $orderTotal = 0;
                    $orderQuantity = 0;
                    foreach ($getShipments as $shipment){ // Get values to display total cost and quantity of order in 2 columns
                      $orderTotal += ($shipment['price']*$shipment['quantity']);
                      $orderQuantity += $shipment['quantity'];
                    }
                    ?>
                    <td><?= htmlspecialchars_decode($restock['id'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($user['firstname']." ".$user['lastname']."<br>(".$restock['user_id'].")", ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($orderQuantity, ENT_QUOTES) ?></td>
                    <td>£<?= htmlspecialchars_decode(round_to_2dp($orderTotal), ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($restock['placedOn'], ENT_QUOTES) ?></td>
                    <td>
                      <form action="./RestockDetails.php" method="get">
                        <button class="btn btn-info btn-md w-40 mb-4" type="submit" id="editButton">View</button>
                        <input type="hidden" name="orderId" value="<?= $restock['id']; ?>">
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                      </form>
                    </td>                   
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>