<?php

class supplierController {

    protected $db; // Property to store the database controller object

    // Constructor to initialize the supplierController with a database controller object
    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }
    
    // Function to create a new supplier entry in the database
    public function create_supplier(array $supplier) 
    {
        
        // SQL query to insert new supplier data into the suppliers table
        $sql = "INSERT INTO suppliers(name, email, phone, address)
        VALUES (:name, :email, :phone, :address);";
        
        // Execute the SQL query with the provided supplier data
        $this->db->runSQL($sql, $supplier);
        
        // Return the ID of the last inserted supplier
        return $this->db->lastInsertId();
    }

    

    // Function to retrieve a specific supplier by its ID
    public function get_supplier_by_id(int $id)
    {
        // SQL query to select supplier data by ID
        $sql = "SELECT * FROM suppliers WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the query and return the result
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Function to retrieve all supplier entries from the database
    public function get_all_suppliers()
    {
        // SQL query to select all supplier data
        $sql = "SELECT * FROM suppliers";
        
        // Execute the query and return all results
        return $this->db->runSQL($sql)->fetchAll();
    }
    
    // Function to update an existing supplier entry in the database
    public function update_supplier(array $supplier)
    {
        // SQL query to update supplier data
        $sql = "UPDATE suppliers SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :id";
        
        // Execute the update query with the provided supplier data
        return $this->db->runSQL($sql, $supplier)->execute();
    }

    // Function to delete a specific supplier entry by its ID
    public function delete_supplier(int $id)
    {
        // SQL query to delete supplier data by ID
        $sql = "DELETE FROM suppliers WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the delete query
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>
