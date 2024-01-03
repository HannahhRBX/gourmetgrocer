<?php 
    require_once __DIR__.'/../inc/functions.php';
    $member = $controllers->equipment()->get_all_equipments();
    $post_arr = array();
    $post_arr['data'] = array();
    if (count($member) > 0)
    {
        http_response_code(200);
            
        foreach ($member as $field)
        {
        $newArray = array();
            $record = array();
            
            foreach ($field as $index=>$value)
            {
                $record[$index] = htmlspecialchars_decode($value, ENT_QUOTES);
            }
            $catagoryId = $controllers->equipment()->get_catagory_by_equipmentid($record['id']);
            $catagory = $controllers->catagories()->get_catagory_by_id($catagoryId);
            $record['catagory'] = htmlspecialchars_decode($catagory['name'], ENT_QUOTES);;
            array_push($post_arr['data'],$record);
        }
        echo json_encode($post_arr); //push to data table by conversion to JSON encode
    }else{
        http_response_code(404);
        echo "Error: No records found.";
    }
?>