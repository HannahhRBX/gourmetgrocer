<?php

class equipmentController {

    protected $db; // Property to store the database controller object

    // Constructor to initialize the equipmentController with a database controller object
    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }
    public function upload_image(array $addItemImage)
    {
        $fileName = $addItemImage['name'];
        $fileTmpName = $addItemImage['tmp_name'];
        $fileSize = $addItemImage['size'];
        $fileError = $addItemImage['error'];

        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg','png');
        $fileResult = array("Status"=>"","Destination"=>"");
        if (in_array($fileActualExt, $allowed)){
            if ($fileError === 0){
               
                if ($fileSize < 10000000){ // If file is less than 10MB
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);
                    
                    $fileResult = array("Status"=>"Success","Destination"=>$fileDestination);

                }else{
                    $fileResult["Status"] = "Your image is too large. Please upload a smaller image.";
                }
            }else{
                $fileResult["Status"] = "There was an error uploading the image.";
            }

        }else{
            $fileResult["Status"] = "You cannot upload files of this type.";
        }
        return $fileResult;
    }

    // Function to create a new equipment entry in the database
    public function create_equipment(array $equipment) 
    {
        
        // SQL query to insert new equipment data into the equipments table
        $sql = "INSERT INTO equipments(name, description, image)
        VALUES (:name, :description, :image);";
        
        // Execute the SQL query with the provided equipment data
        $this->db->runSQL($sql, $equipment);
        
        // Return the ID of the last inserted equipment
        return $this->db->lastInsertId();
    }

    // Function to retrieve a specific equipment by its ID
    public function get_equipment_by_id(int $id)
    {
        // SQL query to select equipment data by ID
        $sql = "SELECT * FROM equipments WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the query and return the result
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Function to retrieve all equipment entries from the database
    public function get_all_equipments()
    {
        // SQL query to select all equipment data
        $sql = "SELECT * FROM equipments";
        
        // Execute the query and return all results
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Function to update an existing equipment entry in the database
    public function update_equipment(array $equipment)
    {
        // SQL query to update equipment data
        $sql = "UPDATE equipments SET name = :name, description = :description, image = :image WHERE id = :id";
        
        // Execute the update query with the provided equipment data
        return $this->db->runSQL($sql, $equipment)->execute();
    }

    // Function to delete a specific equipment entry by its ID
    public function delete_equipment(int $id)
    {
        $imagePath = $this->get_equipment_by_id($id)["image"]; //Get image path directly through SQL to prevent attacker from inputting any file path into function parameters
        unlink($imagePath);
        // SQL query to delete equipment data by ID
        $sql = "DELETE FROM equipments WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the delete query
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>
