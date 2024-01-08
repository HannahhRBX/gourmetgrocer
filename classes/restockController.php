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
        $sql = "INSERT INTO shipments(restock_id, equipment_id, price, quantity)
        VALUES (:restock_id, :equipment_id, :price, :quantity);";
        
        // Execute the SQL query with the provided shipment data
        $this->db->runSQL($sql, $shipment);
        
        // Return the ID of the last inserted shipment
        return $this->db->lastInsertId();
    }

    // Function to create a new restock entry in the database
    public function create_restock(array $restock) 
    {
        
        // SQL query to insert new restock data into the restocks table
        $sql = "INSERT INTO restocks(user_id, payment_term)
        VALUES (:user_id, :payment_term);";
        
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

    // Method to retrieve a member role ID by its user ID
    public function get_all_shipments_by_equipmentid(int $id)
    {
        // SQL query to get a user's role id from the roles table
        
        $sql = "SELECT * FROM shipments WHERE equipment_id = :equipment_id";
        $args = ['equipment_id' => $id];
        // Execute the query and return the fetched member record
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
