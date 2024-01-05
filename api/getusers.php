<?php 
    require_once __DIR__.'/../inc/functions.php';
    $member = $controllers->members()->get_all_members();
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
                $record[$index] = $value;
            }
            $roleId = $controllers->members()->get_role_by_userid($record['ID'])["role_id"];
            $role = $controllers->roles()->get_role_by_id($roleId);
            $record['role'] = htmlspecialchars_decode($role['name'], ENT_QUOTES);;
            array_push($post_arr['data'],$record);
        }
        echo json_encode($post_arr); //push to data table by conversion to JSON encode
    }else{
        http_response_code(404);
        echo "Error: No records found.";
    }
?>