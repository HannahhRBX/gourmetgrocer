<?php

class RoutingTest extends \PHPUnit\Framework\TestCase // Use PHPUnit Test Class
{
    
    public function TestIfUserIsAnAdmin()
    {
        $_SESSION['user'] = array( // Set mock user information
            'ID'=>59,
            'firstname'=>'John',
            'lastname'=>'Doe',
            'password'=>password_hash('Password123!', PASSWORD_DEFAULT),
            'email'=>'member@gmail.com',
            'createdOn'=>'2023-12-18 17:22:15',
            'modifiedOn'=>'2023-12-18 17:22:15',
            'role_id'=>2,
        );

        require_once __DIR__.'/../../classes/RoutingController.php';
        
        $result = RoutingController::verify_member_is_admin(); //Route User depending on role_id

        $this->assertEquals('admin',$result); // Return Unit Testing Result if Routing result is Equal to Expected Result
    }

    public function testIfUserIsNotLoggedIn()
    {
        require_once __DIR__.'/../../classes/RoutingController.php';
        
        $result = RoutingController::verify_member_is_admin(); //Route User depending on role_id

        $this->assertEquals('login',$result); // Return Unit Testing Result if Routing result is Equal to Expected Result
    }
}


?>
