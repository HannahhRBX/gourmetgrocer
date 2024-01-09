<?php

class restockController {

    protected $db; // Property to store the database controller object

    // Constructor to initialize the restockController with a database controller object
    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }
    
    // Function to create a new shipment entry in the database using the Restock Id
    public function create_shipment(array $shipment) 
    {
        
        // SQL query to insert new restock shipment data into the shipments table
        $sql = "INSERT INTO shipments(restock_id, equipment_id, price, quantity, payment_term)
        VALUES (:restock_id, :equipment_id, :price, :quantity, :payment_term);";
        
        // Execute the SQL query with the provided shipment data
        $this->db->runSQL($sql, $shipment);
        
        // Return the ID of the last inserted shipment
        return $this->db->lastInsertId();
    }

    // Function to create a new restock entry in the database
    public function create_restock(array $restock) 
    {
        
        // SQL query to insert new restock data into the restocks table
        $sql = "INSERT INTO restocks(user_id)
        VALUES (:user_id);";
        
        // Execute the SQL query with the provided restock data
        $this->db->runSQL($sql, $restock);
        
        // Return the ID of the last inserted restock
        return $this->db->lastInsertId();
    }

    

    // Function to retrieve a specific restock by its ID
    public function get_restock_by_id(int $id)
    {
        // SQL query to select restock data by ID
        $sql = "SELECT * FROM restocks WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the query and return the result
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Function to retrieve all restock entries from the database
    public function get_all_restocks()
    {
        // SQL query to select all restock data
        $sql = "SELECT * FROM restocks";
        
        // Execute the query and return all results
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Function to retrieve user_id from restock_id
    public function get_userid_from_restockid($id)
    {
        // SQL query to select restock data by user_id
        $sql = "SELECT user_id FROM restocks WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query and return the fetched user_id record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Function to retrieve equipment_id from shipment_id
    public function get_equipment_from_shipmentid($id)
    {
        // SQL query to select equipment data by shipment_id
        $sql = "SELECT equipment_id FROM shipments WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query and return the fetched equipment_id record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve all shipments by equipment ID
    public function get_all_shipments_by_equipmentid(int $id)
    {
        // SQL query to get all shipments by equipment ID from shipments table
        
        $sql = "SELECT * FROM shipments WHERE equipment_id = :equipment_id";
        $args = ['equipment_id' => $id];
        // Execute the query and return the fetched shipment records
        return $this->db->runSQL($sql, $args)->fetchAll();
    }

    // Method to retrieve all shipments by restock ID
    public function get_all_shipments_by_restockid(int $id)
    {
        // SQL query to get all shipments by restock ID from shipments table
        
        $sql = "SELECT * FROM shipments WHERE restock_id = :restock_id";
        $args = ['restock_id' => $id];
        // Execute the query and return the fetched shipment records
        return $this->db->runSQL($sql, $args)->fetchAll();
    }

    
    // Function to update an existing restock entry in the database
    public function update_restock(array $restock)
    {
        // SQL query to update restock data
        $sql = "UPDATE restocks SET name = :name WHERE id = :id";
        
        // Execute the update query with the provided restock data
        return $this->db->runSQL($sql, $restock)->execute();
    }

    // Function to delete a specific restock entry by its ID
    public function delete_restock(int $id)
    {
        // SQL query to delete restock data by ID
        $sql = "DELETE FROM restocks WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the delete query
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>
