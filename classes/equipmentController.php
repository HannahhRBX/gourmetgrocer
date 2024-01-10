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

    // Function to add an equipment id and catagory id into the equipment_catagories table
    public function add_equipment_to_catagory(array $Ids){
        // SQL query to insert new equipment data into the equipments table
        $sql = "INSERT INTO equipment_catagories(equipment_id, catagory_id)
        VALUES (:equipment_id, :catagory_id);";
        
        // Execute the SQL query with the provided equipment data
        $this->db->runSQL($sql, $Ids);
        
        // Return the ID of the last inserted equipment
        return $this->db->lastInsertId();
    }

    public function add_equipment_to_supplier(array $Ids){
        // SQL query to insert new equipment data into the equipments table
        $sql = "INSERT INTO equipment_suppliers(equipment_id, supplier_id)
        VALUES (:equipment_id, :supplier_id);";
        
        // Execute the SQL query with the provided equipment data
        $this->db->runSQL($sql, $Ids);
        
        // Return the ID of the last inserted equipment
        return $this->db->lastInsertId();
    }

    // Function to create a new equipment entry in the database
    public function create_equipment(array $equipment) 
    {
        
        // SQL query to insert new equipment data into the equipments table
        $sql = "INSERT INTO equipments(name, description, image, stock, buy_price, sell_price)
        VALUES (:name, :description, :image, :stock, :buy_price, :sell_price);";
        
        // Execute the SQL query with the provided equipment data
        $this->db->runSQL($sql, $equipment);
        
        // Return the ID of the last inserted equipment category
        return $this->db->lastInsertId();
    }

    // Method to retrieve a equipment's catagory ID by its user ID
    public function get_catagory_by_equipmentid(int $id)
    {
        // SQL query to get an equipment's category id from the roles table
       
        $sql = "SELECT catagory_id FROM equipment_catagories WHERE equipment_id = :equipment_id";
        $args = ['equipment_id' => $id];
        // Execute the query and return the fetched equipment record
        return $this->db->runSQL($sql, $args)->fetch();

    }

    // Method to retrieve a equipment's supplier ID by its user ID
    public function get_supplier_by_equipmentid(int $id)
    {
        // SQL query to get an equipment's supplier id from the equipment_supplier table
    
        $sql = "SELECT supplier_id FROM equipment_suppliers WHERE equipment_id = :equipment_id";
        $args = ['equipment_id' => $id];
        // Execute the query and return the fetched equipment record
        return $this->db->runSQL($sql, $args)->fetch();

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

     // Method to retrieve a member role ID by its user ID
    public function get_all_equipments_by_supplierid(int $id)
    {
        // SQL query to get a user's role id from the roles table
        
        $sql = "SELECT * FROM equipment_suppliers WHERE supplier_id = :supplier_id";
        $args = ['supplier_id' => $id];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetchAll();
    }
 

    // Function to retrieve all equipment entries from the database
    public function get_all_equipments()
    {
        // SQL query to select all equipment data
        $sql = "SELECT * FROM equipments";
        
        // Execute the query and return all results
        return $this->db->runSQL($sql)->fetchAll();
    }
    public function delete_image(int $id){
        $imagePath = $this->get_equipment_by_id($id)["image"]; //Get image path directly through SQL to prevent attacker from inputting any file path into function parameters
        unlink($imagePath);
    }

    // Function to update an existing equipment_supplier entry in the database
    public function update_equipment_supplier(array $Ids)
    {
        // SQL query to update equipment_supplier data
        $sql = "UPDATE equipment_suppliers SET supplier_id = :supplier_id WHERE equipment_id = :equipment_id";
        
        // Execute the update query with the provided equipment_supplier data
        return $this->db->runSQL($sql, $Ids)->execute();
    }

    // Function to update an existing equipment_catagory entry in the database
    public function update_equipment_catagory(array $Ids)
    {
        // SQL query to update equipment_catagory data
        $sql = "UPDATE equipment_catagories SET catagory_id = :catagory_id WHERE equipment_id = :equipment_id";
        
        // Execute the update query with the provided equipment_catagory data
        return $this->db->runSQL($sql, $Ids)->execute();
    }

    // Function to update equipment stock quantity in the database
    public function update_equipment_stock(array $equipment)
    {
        // SQL query to update equipment data
        $sql = "UPDATE equipments SET stock = :stock WHERE id = :id";
        
        // Execute the update query with the provided equipment data
        return $this->db->runSQL($sql, $equipment)->execute();
    }

    // Function to update an existing equipment entry in the database
    public function update_equipment(array $equipment)
    {
        $getImg = $this->get_equipment_by_id($equipment['id'])["image"];

        if ($equipment['image'] != $getImg){ //Make sure to not delete image if image stays the same
            $this->delete_image($equipment["id"]);
        }
        // SQL query to update equipment data
        $sql = "UPDATE equipments SET name = :name, description = :description, stock = :stock, buy_price = :buy_price, sell_price = :sell_price, image = :image WHERE id = :id";
        
        // Execute the update query with the provided equipment data
        return $this->db->runSQL($sql, $equipment)->execute();
    }

    // Function to delete a specific equipment entry by its ID
    public function delete_equipment(int $id)
    {
        $this->delete_image($id);
        // SQL query to delete equipment data by ID
        $sql = "DELETE FROM equipments WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the delete query
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>
