<?php



class Controllers {

    // Properties to hold database, members, and equipment instances
    protected $db = null;
    protected $members = null;
    protected $equipment = null;
    protected $equipment2 = null;
    protected $routing = null;
    protected $catagories = null;
    protected $roles = null;
    protected $suppliers = null;
    protected $restocks = null;

    // Constructor method for the Controllers class
    public function __construct()
    {
        // Temporary database connection settings
        // TODO: Move these to a configuration file or environment variables for better security and flexibility
        $type ='mysql';
        $server = '127.0.0.1'; // Localhost server
        $db = 'shop2'; // Database name
        $port = '3306'; // Port for MySQL
        $charset = 'latin1'; // Character set

        // Database credentials
        $username = 'root'; // Default MySQL username
        $password = ''; // Empty password (not recommended for production)

        // Data Source Name (DSN) for PDO connection
        $dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";
    
        try {
            // Attempt to create a new DatabaseController instance
            $this->db = new DatabaseController($dsn, $username, $password); 
        }
        catch (PDOException $e) {
            // Throw an exception if database connection fails
            throw new PDOException($e -> getMessage(), $e -> getCode());
        }
    }

    // Method to get or create an equipment controller
    public function equipment() {
        // Check if equipment controller is null, if so, create a new instance
        if ($this->equipment === null) {
            $this->equipment = new equipmentController($this->db);
        }
        return $this->equipment;
    }

    // Method to get or create a member controller
    public function members()
    {
        // Check if members controller is null, if so, create a new instance
        if ($this->members === null) {
            $this->members = new MemberController($this->db);
        }
        return $this->members;
    }

    // Method to get or create a catagory controller
    public function catagories()
    {
        // Check if catagories controller is null, if so, create a new instance
        if ($this->catagories === null) {
            $this->catagories = new catagoryController($this->db);
        }
        return $this->catagories;
    }

    // Method to get or create a role controller
    public function roles()
    {
        // Check if roles controller is null, if so, create a new instance
        if ($this->roles === null) {
            $this->roles = new roleController($this->db);
        }
        return $this->roles;
    }

    public function suppliers()
    {
        // Check if suppliers controller is null, if so, create a new instance
        if ($this->suppliers === null) {
            $this->suppliers = new supplierController($this->db);
        }
        return $this->suppliers;
    }

    public function restocks()
    {
        // Check if restock controller is null, if so, create a new instance
        if ($this->restocks === null) {
            $this->restocks = new restockController($this->db);
        }
        return $this->restocks;
    }
}
