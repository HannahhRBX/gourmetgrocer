<?php 
    require_once __DIR__.'/../inc/functions.php';
    $suppliers = $controllers->suppliers()->get_all_suppliers();
    $post_arr = array();
    $post_arr['data'] = array();

    function round_to_2dp($num){
        return number_format((float)$num, 2, '.', ''); // Returns a number rounded to 2 decimal places
    }

    if (count($suppliers) > 0)
    {
        http_response_code(200); // Status Code OK
            
        foreach ($suppliers as $supplier) // Loop through all suppliers
        {
            
            $equipments = $controllers->equipment()->get_all_equipments_by_supplierid($supplier['id']); // Get all shipments from a supplier
            $TotalRestockPrice = 0;
            $record = array( // Create supplier array with empty shipments array inside
                "Supplier #".$supplier['id']=>array(
                   
                    'Name'=>$supplier['name'],
                    'Email'=>$supplier['email'],
                    'Phone'=>$supplier['phone'],
                    'Address'=>$supplier['address'],
                    'Equipment'=>array(),
                ),
                
            );
           

            foreach ($equipments as $equipment)
            {
                $equipment = $controllers->equipment()->get_equipment_by_id($equipment['equipment_id']);
                $catagoryId = $controllers->equipment()->get_catagory_by_equipmentid($equipment['id']);
                if ($catagoryId != null){
                    $catagory = $controllers->catagories()->get_catagory_by_id($catagoryId["catagory_id"]);
                }else{
                    $catagory = array("id"=>"1");
                    $catagory = array("name"=>"");
                }

               
                $record["Supplier #".$supplier['id']]["Equipment"]["Equipment ID: #".$equipment['id']] = array(
                    'Name'=>$equipment['name'],
                    'Catagory'=>htmlspecialchars_decode($catagory['name'], ENT_QUOTES),
                    'Description'=>htmlspecialchars_decode($equipment['description'], ENT_QUOTES),
                    'Stock'=>$equipment['stock'],
                    'Buy Price'=>$equipment['buy_price'],
                    'Sell Price'=>$equipment['sell_price'],
                );
               
                
            }
            
            
            
            
            array_push($post_arr['data'],$record);
        }
        echo json_encode($post_arr); //push to data table by conversion to JSON encode
    }else{
        http_response_code(404);
        echo "Error: No records found.";
    }
?>