<?php
require_once("config/connection.class.php");

class User {
    protected $db;

    public function __construct() {
        $this->db = new Db(); // Create a Db instance
    }

    public function login($username, $password) {
        $username = $this->db->connect()->real_escape_string($username); // Escape username to prevent SQL injection
        $password = $this->db->connect()->real_escape_string($password); // Escape password to prevent SQL injection

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $this->db->select_to_array($query);

        if (!empty($result)) {
            // User exists
            return $result[0]; // Return user data
        } else {
            // User not found
            return false;
        }
    }

    public function redirectToDashboard($role) {
        if ($role == 'admin') {
            header("Location: admin_page.php");
        } else {
            header("Location: index.php");
        }
        exit(); // Stop further execution
    }
}
?>
