<?php 



class RoutingController {

    public static function redirect($page, array $params = [])
    {
        $qs = $params ? '?' . http_build_query($params) : ''; //builds parameters to carry to next URL
        header("Location:$page.php" . $qs);
        return $page;
        exit;
    }
    // Method to retrieve a member record by its ID
    public static function verify_member_is_admin()
    {
        $Result;
        if (!isset($_SESSION['user']))
        {
            $Result = self::redirect('login', ["error" => "You need to be logged in to view this page"]); // Verifies if the user is admin, if not then redirect them back to login page
            
        }elseif ($_SESSION['user']['role_id'] == 2){
            $Result = 'admin';
        }else{
            $Result = self::redirect('login', ["error" => "Please login as administrator"]);
           
        }
        return $Result;
    }
}
?>