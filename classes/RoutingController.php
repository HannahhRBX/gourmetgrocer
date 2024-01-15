<?php 



class RoutingController {

    public static function redirect($page, array $params = [])
    {
        $qs = $params ? '?' . http_build_query($params) : ''; //builds parameters to carry to next URL
        header("Location:$page.php" . $qs);
        return $page;
        exit;
    }

    public static function verify_member_is_admin() // Verifies if the user is admin, if not then redirect them back to login page
    {
        $Result;
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) // If session is not set
        {
            $Result = self::redirect('login', ["error" => "You need to be logged in to view this page"]); // Redirect to login
        }elseif (!isset($_SESSION['user'])){
            $Result = self::redirect('login', ["error" => "You need to be logged in to view this page"]); 
        
        }elseif ($_SESSION['user']['role_id'] == 2){ // If user is admin
            $Result = 'admin';
        }else{
            $Result = self::redirect('login', ["error" => "Please login as administrator"]); // If user is member tell them to login as admin
           
        }
        return $Result;
    }
    
    // Retrieve role as string from session data
    public static function verify_session_role() // Get a user's role from session variables
    {
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE || $_SESSION == null) // If session not set then return blank
        {
            return '';
        }elseif ($_SESSION['user']['role_id'] == 2){ // If user is admin return admin
            return 'admin';
        }else{
            return 'member'; // If user is member return member
        }
    }
}
?>

