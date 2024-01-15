<?php

class EquipmentTest extends \PHPUnit\Framework\TestCase // Use PHPUnit Test Class
{
    public function testUploadImageJPG() // Test for uploading JPG images to equipment controller
    {
        require_once __DIR__.'/../../classes/DatabaseController.php';
        require_once __DIR__.'/../../classes/equipmentController.php';

        $MockDBController = $this->getMockBuilder(DatabaseController::class) // Create DatabaseController without PDO constructor
            ->disableOriginalConstructor()
            ->getMock();
        $EquipmentController = new equipmentController($MockDBController);
        $DummyFileArray = array( // Create a mock file using same array structure as original
            'name'=> 'TestFile.jpg',
            'tmp_name'=>'tempName',
            'size'=>1000,
            'error'=>0,
        );

        $result = $EquipmentController->upload_image($DummyFileArray); // Simulate upload image function using dummy array

        $this->assertEquals("Success",$result["Status"]); // Assert two status values, if same then test is OK
    }

    public function testUploadImageGIF() // Test for uploading GIF images to equipment controller
    {
        require_once __DIR__.'/../../classes/DatabaseController.php';
        require_once __DIR__.'/../../classes/equipmentController.php';

        $MockDBController = $this->getMockBuilder(DatabaseController::class) // Create DatabaseController without PDO constructor
            ->disableOriginalConstructor()
            ->getMock();
        $EquipmentController = new equipmentController($MockDBController);
        $DummyFileArray = array( // Create a mock file using same array structure as original
            'name'=> 'TestFile.gif',
            'tmp_name'=>'tempName',
            'size'=>1000,
            'error'=>0,
        );

        $result = $EquipmentController->upload_image($DummyFileArray); // Simulate upload image function using dummy array

        $this->assertEquals("Success",$result["Status"]); // Assert two status values, if same then test is OK
    }


    public function testUploadImageMoreThan10MB() // Test for uploading images larger than 10MB to equipment controller
    {
        require_once __DIR__.'/../../classes/DatabaseController.php';
        require_once __DIR__.'/../../classes/equipmentController.php';

        $MockDBController = $this->getMockBuilder(DatabaseController::class) // Create DatabaseController without PDO constructor
            ->disableOriginalConstructor()
            ->getMock();
        $EquipmentController = new equipmentController($MockDBController);
        $DummyFileArray = array( // Create a mock file using same array structure as original
            'name'=> 'TestFile.jpg',
            'tmp_name'=>'tempName',
            'size'=>100000000, //Size is now 100MB
            'error'=>0,
        );

        $result = $EquipmentController->upload_image($DummyFileArray); // Simulate upload image function using dummy array

        $this->assertEquals("Success",$result["Status"]); // Assert two status values, if same then test is OK
    }

    public function testUploadImageError() // Test for uploading images with error trigger
    {
        require_once __DIR__.'/../../classes/DatabaseController.php';
        require_once __DIR__.'/../../classes/equipmentController.php';

        $MockDBController = $this->getMockBuilder(DatabaseController::class) // Create DatabaseController without PDO constructor
            ->disableOriginalConstructor()
            ->getMock();
        $EquipmentController = new equipmentController($MockDBController);
        $DummyFileArray = array( // Create a mock file using same array structure as original
            'name'=> 'TestFile.jpg',
            'tmp_name'=>'tempName',
            'size'=>1000,
            'error'=>1, // Set error to 1
        );

        $result = $EquipmentController->upload_image($DummyFileArray); // Simulate upload image function using dummy array

        $this->assertEquals("Success",$result["Status"]); // Assert two status values, if same then test is OK
    }

    public function testAddItemToCart() // Test for adding an item to cart
    {
        require_once __DIR__.'/../../classes/DatabaseController.php';
        require_once __DIR__.'/../../classes/equipmentController.php';

        $MockDBController = $this->getMockBuilder(DatabaseController::class) // Create DatabaseController without PDO constructor
            ->disableOriginalConstructor()
            ->getMock();
        $EquipmentController = new equipmentController($MockDBController);

        $_SESSION['user'] = array( // Set mock user information
            'ID'=>59,
            'firstname'=>'John',
            'lastname'=>'Doe',
            'password'=>password_hash('Password123!', PASSWORD_DEFAULT),
            'email'=>'member@gmail.com',
            'createdOn'=>'2023-12-18 17:22:15',
            'modifiedOn'=>'2023-12-18 17:22:15',
            'role_id'=>1,
            'cart'=>array(),
        );

        $result = $EquipmentController->AddToCart(1,1); // Simulate object ID
        
        $this->assertEquals("Added to Cart",urldecode($result)); // Assert two status values, if same then test is OK
    }

    public function testUpdateItemInCart() // Test for updating the quantity of an item from cart
    {
        require_once __DIR__.'/../../classes/DatabaseController.php';
        require_once __DIR__.'/../../classes/equipmentController.php';

        $MockDBController = $this->getMockBuilder(DatabaseController::class) // Create DatabaseController without PDO constructor
            ->disableOriginalConstructor()
            ->getMock();
        $EquipmentController = new equipmentController($MockDBController);

        $_SESSION['user'] = array( // Set mock user information
            'ID'=>59,
            'firstname'=>'John',
            'lastname'=>'Doe',
            'password'=>password_hash('Password123!', PASSWORD_DEFAULT),
            'email'=>'member@gmail.com',
            'createdOn'=>'2023-12-18 17:22:15',
            'modifiedOn'=>'2023-12-18 17:22:15',
            'role_id'=>1,
            'cart'=>array( // Simulate item in cart
                array(
                    'id'=>1,
                    'quantity'=>2,
                ),
            ),
        );

        $result = $EquipmentController->AddToCart(1,6); // Update with same ID and different quantity
        
        $this->assertEquals("Cart Updated Successfully",urldecode($result)); // Assert two status values, if same then test is OK
    }

    public function testAddInvalidIdToCart() // Test for adding an item with negative ID to cart
    {
        require_once __DIR__.'/../../classes/DatabaseController.php';
        require_once __DIR__.'/../../classes/equipmentController.php';

        $MockDBController = $this->getMockBuilder(DatabaseController::class) // Create DatabaseController without PDO constructor
            ->disableOriginalConstructor()
            ->getMock();
        $EquipmentController = new equipmentController($MockDBController);

        $_SESSION['user'] = array( // Set mock user information
            'ID'=>59,
            'firstname'=>'John',
            'lastname'=>'Doe',
            'password'=>password_hash('Password123!', PASSWORD_DEFAULT),
            'email'=>'member@gmail.com',
            'createdOn'=>'2023-12-18 17:22:15',
            'modifiedOn'=>'2023-12-18 17:22:15',
            'role_id'=>1,
            'cart'=>array(),
        );

        $result = $EquipmentController->AddToCart(-1,1); // Simulate negative object ID
        
        $this->assertEquals("Added to Cart",urldecode($result)); // Assert two status values, if same then test is OK
    }
    

    public function testDeleteItemFromCart() // Test for removing an item from cart
    {
        require_once __DIR__.'/../../classes/DatabaseController.php';
        require_once __DIR__.'/../../classes/equipmentController.php';

        $MockDBController = $this->getMockBuilder(DatabaseController::class) // Create DatabaseController without PDO constructor
            ->disableOriginalConstructor()
            ->getMock();
        $EquipmentController = new equipmentController($MockDBController);

        $_SESSION['user'] = array( // Set mock user information
            'ID'=>59,
            'firstname'=>'John',
            'lastname'=>'Doe',
            'password'=>password_hash('Password123!', PASSWORD_DEFAULT),
            'email'=>'member@gmail.com',
            'createdOn'=>'2023-12-18 17:22:15',
            'modifiedOn'=>'2023-12-18 17:22:15',
            'role_id'=>1,
            'cart'=>array( // Simulate item in cart
                array(
                    'id'=>1,
                    'quantity'=>2,
                ),
            ),
        );

        $result = $EquipmentController->DeleteFromCart(1); // Simulate object ID
        
        $this->assertEquals("Item Removed Successfully",urldecode($result)); // Assert two status values, if same then test is OK
    }
    

    public function testDeleteFromCartWhenCartIsEmpty() // Test for removing an item from cart when it is empty
    {
        require_once __DIR__.'/../../classes/DatabaseController.php';
        require_once __DIR__.'/../../classes/equipmentController.php';

        $MockDBController = $this->getMockBuilder(DatabaseController::class) // Create DatabaseController without PDO constructor
            ->disableOriginalConstructor()
            ->getMock();
        $EquipmentController = new equipmentController($MockDBController);

        $_SESSION['user'] = array( // Set mock user information
            'ID'=>59,
            'firstname'=>'John',
            'lastname'=>'Doe',
            'password'=>password_hash('Password123!', PASSWORD_DEFAULT),
            'email'=>'member@gmail.com',
            'createdOn'=>'2023-12-18 17:22:15',
            'modifiedOn'=>'2023-12-18 17:22:15',
            'role_id'=>1,
            'cart'=>array(),
        );

        $result = $EquipmentController->DeleteFromCart(1); // Simulate object ID
        
        $this->assertEquals("Item Removed Successfully",urldecode($result)); // Assert two status values, if same then test is OK
    }

    public function testDeleteWrongItemFromCart() // Test for removing the wrong item ID from the cart
    {
        require_once __DIR__.'/../../classes/DatabaseController.php';
        require_once __DIR__.'/../../classes/equipmentController.php';

        $MockDBController = $this->getMockBuilder(DatabaseController::class) // Create DatabaseController without PDO constructor
            ->disableOriginalConstructor()
            ->getMock();
        $EquipmentController = new equipmentController($MockDBController);

        $_SESSION['user'] = array( // Set mock user information
            'ID'=>59,
            'firstname'=>'John',
            'lastname'=>'Doe',
            'password'=>password_hash('Password123!', PASSWORD_DEFAULT),
            'email'=>'member@gmail.com',
            'createdOn'=>'2023-12-18 17:22:15',
            'modifiedOn'=>'2023-12-18 17:22:15',
            'role_id'=>1,
            'cart'=>array( // Simulate item in cart
                array(
                    'id'=>1,
                    'quantity'=>2,
                ),
            ),
        );

        $result = $EquipmentController->DeleteFromCart(5); // Simulate a random object ID
        
        $this->assertEquals("Item not found.",urldecode($result)); // Assert two status values, if same then test is OK
    }

    

}

?>