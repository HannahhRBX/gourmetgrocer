<?php

class orderController {

    protected $db; // Property to store the database controller object

    // Constructor to initialize the orderController with a database controller object
    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }
    
    // Function to create a new order_cart entry in the database using the Order Id
    public function create_order_cart(array $orderCart) 
    {
        
        // SQL query to insert new order order_cart data into the order_cart table
        $sql = "INSERT INTO order_cart(order_id, equipment_id, price, quantity)
        VALUES (:order_id, :equipment_id, :price, :quantity);";
        
        // Execute the SQL query with the provided order_cart data
        $this->db->runSQL($sql, $orderCart);
        
        // Return the ID of the last inserted order_cart
        return $this->db->lastInsertId();
    }

    // Function to create a new order entry in the database
    public function create_order(array $order) 
    {
        
        // SQL query to insert new order data into the orders table
        $sql = "INSERT INTO orders(user_id)
        VALUES (:user_id);";
        
        // Execute the SQL query with the provided order data
        $this->db->runSQL($sql, $order);
        
        // Return the ID of the last inserted order
        return $this->db->lastInsertId();
    }

    

    // Function to retrieve a specific order by its ID
    public function get_order_by_id(int $id)
    {
        // SQL query to select order data by ID
        $sql = "SELECT * FROM orders WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the query and return the result
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Function to retrieve all order entries from the database
    public function get_all_orders()
    {
        // SQL query to select all order data
        $sql = "SELECT * FROM orders";
        
        // Execute the query and return all results
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Function to retrieve user_id from order_id
    public function get_userid_from_orderid($id)
    {
        // SQL query to select order data by user_id
        $sql = "SELECT user_id FROM orders WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query and return the fetched user_id record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Function to retrieve equipment_id from order_cart_id
    public function get_equipment_from_order_cartid($id)
    {
        // SQL query to select equipment data by order_cart_id
        $sql = "SELECT equipment_id FROM order_cart WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query and return the fetched equipment_id record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve all order_carts by equipment ID
    public function get_all_order_carts_by_equipmentid(int $id)
    {
        // SQL query to get all order_carts by equipment ID from order_carts table
        
        $sql = "SELECT * FROM order_cart WHERE equipment_id = :equipment_id";
        $args = ['equipment_id' => $id];
        // Execute the query and return the fetched order_cart records
        return $this->db->runSQL($sql, $args)->fetchAll();
    }

    // Method to retrieve all order_carts by order ID
    public function get_all_order_carts_by_orderid(int $id)
    {
        // SQL query to get all order_carts by order ID from order_carts table
        
        $sql = "SELECT * FROM order_cart WHERE order_id = :order_id";
        $args = ['order_id' => $id];
        // Execute the query and return the fetched order_cart records
        return $this->db->runSQL($sql, $args)->fetchAll();
    }

    
    // Function to update an existing order entry in the database
    public function update_order(array $order)
    {
        // SQL query to update order data
        $sql = "UPDATE orders SET name = :name WHERE id = :id";
        
        // Execute the update query with the provided order data
        return $this->db->runSQL($sql, $order)->execute();
    }

    // Function to delete a specific order entry by its ID
    public function delete_order(int $id)
    {
        // SQL query to delete order data by ID
        $sql = "DELETE FROM orders WHERE id = :id";
        $args = ['id' => $id];
        
        // Execute the delete query
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>
