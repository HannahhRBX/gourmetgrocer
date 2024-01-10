<?php 
    require_once __DIR__.'/../inc/functions.php';
    $orders = $controllers->orders()->get_all_orders();
    $post_arr = array();
    $post_arr['data'] = array();

    function round_to_2dp($num){
        return number_format((float)$num, 2, '.', ''); // Returns a number rounded to 2 decimal places
    }

    if (count($orders) > 0)
    {
        http_response_code(200); // Status Code OK
            
        foreach ($orders as $order) // Loop through all orders
        {
            
            $OrderCarts = $controllers->orders()->get_all_order_carts_by_orderid($order['id']); // Get all order_carts from a order
            $TotalOrderPrice = 0;
            $record = array( // Create order array with empty order_carts array inside
                "Order #".$order['id']=>array(
                   
                    'User ID'=>$order['user_id'],
                    'Placed On'=>$order['placedOn'],
                    'Total Cost'=>0,
                    "Cart Items"=>array(),
                ),
                
            );
           

            foreach ($OrderCarts as $OrderCart) // Collect all OrderCarts from an order
            {
                
                $TotalOrderCartPrice = round_to_2dp($OrderCart['price']*$OrderCart['quantity']); 
                $record["Order #".$order['id']]['Total Cost'] += $TotalOrderCartPrice; // Set price of OrderCart to iterate all items in OrderCart with 2 decimal places
                $equipmentId = $controllers->orders()->get_equipment_from_order_cartid($OrderCart['id'])['equipment_id'];
                $equipment = $controllers->equipment()->get_equipment_by_id($equipmentId);
                $record["Order #".$order['id']]["Cart Items"]["Cart #".$OrderCart['id']] = array( // Create OrderCart array inside order array
                    "Item ID"=>$equipment['id'],
                    "Item Name"=>$equipment['name'],
                    "Item Price"=>"£".$OrderCart['price'],
                    "Item Quantity"=>$OrderCart['quantity'],
                    "Total Cart Cost"=>"£".$TotalOrderCartPrice, // List all items in array alongside total OrderCart cost
                );

                
            }
            $record["Order #".$order['id']]['Total Cost'] = "£".$record["Order #".$order['id']]['Total Cost']; // Add currency symbol £ at the beginning of cost
            
            
            array_push($post_arr['data'],$record);
        }
        echo json_encode($post_arr); //push to data table by conversion to JSON encode
    }else{
        http_response_code(404);
        echo "Error: No records found.";
    }
?>



