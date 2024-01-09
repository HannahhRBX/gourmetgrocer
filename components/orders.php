<?php
// Check if user is member or admin to display management columns
$userRole = RoutingController::verify_session_role();
// Retrieve all equipment data using the supplier controller
$orders = $controllers->orders()->get_all_orders();
function round_to_2dp($num){
  return number_format((float)$num, 2, '.', ''); // Returns a number rounded to 2 decimal places
}
arsort($orders); //Sort the orders to display the latest ones at the top
?>
<style>
table, th, td {
  text-align: center;
}
</style>
<!-- HTML for displaying the order data table -->

<div class="container" style="max-width: 80%">
    <h2>Customer Orders</h2> 
    <table class="table table-striped"> 
            <tr>
                
                <th>Order ID #</th>
                <th>Ordered By</th> 
                <th>Number of Items</th>
                <th>Order Total</th>
                <th>Placed On</th>
                <th>Order Details</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?> <!-- Loop through each supplier item -->
                <tr>
                    <?php
                    $user = $controllers->members()->get_member_by_id($order['user_id']);
                    $getOrder_carts = $controllers->orders()->get_all_order_carts_by_orderid($order['id']);
                    $orderTotal = 0;
                    $orderQuantity = 0;
                    foreach ($getOrder_carts as $orderCart){
                      $orderTotal += ($orderCart['price']*$orderCart['quantity']);
                      $orderQuantity += $orderCart['quantity'];
                    }
                    ?>
                    <td><?= htmlspecialchars_decode($order['id'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($user['firstname']." ".$user['lastname']."<br>(".$order['user_id'].")", ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($orderQuantity, ENT_QUOTES) ?></td>
                    <td>£<?= htmlspecialchars_decode(round_to_2dp($orderTotal), ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars_decode($order['placedOn'], ENT_QUOTES) ?></td>
                    <td>
                      <form action="./OrderDetails.php" method="get">
                        <button class="btn btn-info btn-md w-40 mb-4" type="submit" id="editButton">View</button>
                        <input type="hidden" name="orderId" value="<?= $order['id']; ?>">
                        <!-- Create hidden HTML variables to pass into the database processing form when submitted -->
                      </form>
                    </td>                   
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>