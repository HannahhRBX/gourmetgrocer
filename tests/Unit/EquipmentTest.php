<?php

class EquipmentTest extends \PHPUnit\Framework\TestCase // Use PHPUnit Test Class
{
    public function TestUploadImageJPG() // Test for uploading JPG images to equipment controller
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

    public function TestUploadImageGIF() // Test for uploading GIF images to equipment controller
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


    public function TestUploadImageMoreThan10MB() // Test for uploading images larger than 10MB to equipment controller
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
}

?>