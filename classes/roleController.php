<?php

class roleController {

    protected $db; // Property to store the database controller object

    // Constructor to initialize the roleController with a database controller object
    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }
    
    // Function to create a new role entry in the database
    public function create_role(array $role) 
    {
        
        // SQL query to insert new role data into the roles table
        $sql = "INSERT INTO roles(name)
        VALUES (:name);";
        
        // Execute the SQL query with the provided role data
        $this->db->runSQL($sql, $role);
        
        // Return the ID of the last inserted role
        return $this->db->lastInsertId();
    }

    

    // Function to retrieve a specific role by its ID
    public function get_role_by_id(int $id)
    {
        // SQL query to select role data by ID
        $sql = "SELECT * FROM roles WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the query and return the result
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Function to retrieve all role entries from the database
    public function get_all_roles()
    {
        // SQL query to select all role data
        $sql = "SELECT * FROM roles";
        
        // Execute the query and return all results
        return $this->db->runSQL($sql)->fetchAll();
    }
    
    // Function to update an existing role entry in the database
    public function update_role(array $role)
    {
        // SQL query to update role data
        $sql = "UPDATE roles SET name = :name WHERE id = :id";
        
        // Execute the update query with the provided role data
        return $this->db->runSQL($sql, $role)->execute();
    }

    // Function to delete a specific role entry by its ID
    public function delete_role(int $id)
    {
        // SQL query to delete role data by ID
        $sql = "DELETE FROM roles WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the delete query
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>
