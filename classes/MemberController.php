<?php



// Class for handling member-related operations
class MemberController {

    // Protected property to store the database controller instance
    protected $db;

    // Constructor to initialize the MemberController with a DatabaseController instance
    public function __construct(DatabaseController $db)
    {
        // Assign the provided DatabaseController instance to the db property
        $this->db = $db;
    }

    // Method to retrieve a member record by its ID
    public function get_member_by_id(int $id)
    {
        // SQL query to select a member by its ID
        $sql = "SELECT * FROM users WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetch();
    }
    
    // Method to retrieve a member role ID by its user ID
    public function get_role_by_userid(int $id)
    {
        // SQL query to get a user's role id from the roles table
       
        $sql = "SELECT role_id FROM user_roles WHERE user_id = :user_id";
        $args = ['user_id' => $id];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetch();

    }

   
    // Method to retrieve a member record by email
    public function get_member_by_email(string $email)
    {
        // SQL query to select a member by email
        $sql = "SELECT * FROM users WHERE email = :email";
        $args = ['email' => $email];
        
        // Execute the query and return the fetched member record
        $getUserData = $this->db->runSQL($sql, $args)->fetch();
        $role = $this->get_role_by_userid($getUserData['ID'])["role_id"];
        $getUserData['role_id'] = $role;
        return $getUserData;
    }

    // Method to retrieve all member records
    public function get_all_members()
    {
        // SQL query to select all members
        $sql = "SELECT * FROM users";
        // Execute the query and return all fetched records
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Function to update an existing user_role entry in the database
    public function update_member_role(array $Ids)
    {
        // SQL query to update user_roles data
        $sql = "UPDATE user_roles SET role_id = :role_id WHERE user_id = :user_id";
        
        // Execute the update query with the provided user_role data
        return $this->db->runSQL($sql, $Ids)->execute();
    }
    // Method to update an existing member record
    public function update_member(array $member)
    {
        // SQL query to update a member's information
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id";
        // Execute the query with the provided updated data
        return $this->db->runSQL($sql, $member)->execute();
    }

    // Method to delete a member record by its ID
    public function delete_member(int $id)
    {
        // SQL query to delete a member by its ID
        $sql = "DELETE FROM users WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query
        return $this->db->runSQL($sql, $args)->execute();
    }

    // Function to add a member id and member id into the member_roles table
    public function add_member_to_roles(array $Ids){
        // SQL query to insert new user data into the roles table
        $sql = "INSERT INTO user_roles(user_id, role_id)
        VALUES (:user_id, :role_id);";
        
        // Execute the SQL query with the provided user data
        $this->db->runSQL($sql, $Ids);
        
        // Return the ID of the last inserted member role
        return $this->db->lastInsertId();
    }

    // Method to register a new member
    public function register_member(array $member)
    {
        try {
            // SQL query to insert a new member record
            $sql = "INSERT INTO users(firstname, lastname, email, password) 
                    VALUES (:firstname, :lastname, :email, :password)"; 

            // Execute the query with the provided member data
            $this->db->runSQL($sql, $member);

            // Initialise role as 'User' on signup
            $sql2 = "INSERT INTO user_roles (user_id, role_id)
                    VALUES (LAST_INSERT_ID(), (SELECT id FROM roles WHERE name = 'User'));";
           $this->db->runSQL($sql2);
           return true;

        } catch (PDOException $e) {
            // Handle specific error codes (like duplicate entry)
            if ($e->getCode() == 23000) { // Possible duplicate entry
                return false;
            }
            throw $e;
        }
    }   

    // Method to validate member login
    public function login_member(string $email, string $password)
    {
        // Retrieve the member by email
        $member = $this->get_member_by_email($email);

        // If member exists, verify the password
        if ($member) {
            $auth = password_verify($password,  $member['password']);
            // Return member data if authentication is successful, otherwise return false
            
            return $auth ? $member : false;
        }
        return false;
    }


}

?>
