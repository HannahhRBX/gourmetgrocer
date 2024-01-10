<?php 
    require_once __DIR__.'/../inc/functions.php';
    $restocks = $controllers->restocks()->get_all_restocks();
    $post_arr = array();
    $post_arr['data'] = array();

    function round_to_2dp($num){
        return number_format((float)$num, 2, '.', ''); // Returns a number rounded to 2 decimal places
    }

    if (count($restocks) > 0)
    {
        http_response_code(200); // Status Code OK
            
        foreach ($restocks as $restock) // Loop through all restocks
        {
            
            $shipments = $controllers->restocks()->get_all_shipments_by_restockid($restock['id']); // Get all shipments from a restock
            $TotalRestockPrice = 0;
            $record = array( // Create restock array with empty shipments array inside
                "Restock #".$restock['id']=>array(
                   
                    'User ID'=>$restock['user_id'],
                    'Placed On'=>$restock['placedOn'],
                    'Total Cost'=>0,
                    "Shipments"=>array(),
                ),
                
            );
           

            foreach ($shipments as $shipment) // Collect all shipments from a restock
            {
                
                $TotalShipmentPrice = round_to_2dp($shipment['price']*$shipment['quantity']); 
                $record["Restock #".$restock['id']]['Total Cost'] += $TotalShipmentPrice; // Set price of shipment to iterate all items in shipment with 2 decimal places
                $equipmentId = $controllers->restocks()->get_equipment_from_shipmentid($shipment['id'])['equipment_id'];
                $equipment = $controllers->equipment()->get_equipment_by_id($equipmentId);
                $record["Restock #".$restock['id']]["Shipments"]["Shipment #".$shipment['id']] = array( // Create shipment array inside restock array
                    "Item ID"=>$equipment['id'],
                    "Item Name"=>$equipment['name'],
                    "Item Price"=>"£".$shipment['price'],
                    "Item Quantity"=>$shipment['quantity'],
                    "Payment Term"=>$shipment['payment_term'],
                    "Total Shipment Cost"=>"£".$TotalShipmentPrice, // List all items in array alongside total shipment cost
                );

                
            }
            $record["Restock #".$restock['id']]['Total Cost'] = "£".$record["Restock #".$restock['id']]['Total Cost']; // Add currency symbol £ at the beginning of cost
            
            
            array_push($post_arr['data'],$record);
        }
        echo json_encode($post_arr); //push to data table by conversion to JSON encode
    }else{
        http_response_code(404);
        echo "Error: No records found.";
    }
?>