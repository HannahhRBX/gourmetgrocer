<?php







class RoutingTest extends \PHPUnit\Framework\TestCase
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
            'role_id'=>1,
        );

        require_once __DIR__.'/../../inc/functions.php';
        $this->routing = new RoutingController();
        $result = $this->routing->verify_member_is_admin();
 /*    $RoutingMock = $this->createMock(RoutingController::class);
        $RoutingMock
        ->expects($this->once())
        ->method('redirect')
        ->with([])
        $result = $RoutingMock->route_to_admin_panel();
        $result = $_SESSION['user']['role_id'];
        echo var_dump($result);*/
        $this->assertEquals('admin',$result);
    }
}



?>