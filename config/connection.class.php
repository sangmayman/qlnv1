<?php
class Db{
    protected static $connection;
    
    public function connect(){
        if(!isset(self::$connection)){
            $hostname = "localhost";
            $username = "root";
            $password = "";     
            $database = "qlnv1"; 
            
            self::$connection = new mysqli($hostname, $username, $password, $database);
        }
        
        if(self::$connection->connect_error){
            die("Connection failed: " . self::$connection->connect_error);
        }
        
        return self::$connection;
    }
    
    public function query_execute($queryString){
        $connection = $this->connect();
        $result = $connection->query($queryString);
        if($result === false){
            die("Query execution failed: " . $connection->error);
        }
        return $result;
    }
    
    public function select_to_array($queryString){
        $rows = array();
        $result = $this->query_execute($queryString);
        while($item = $result->fetch_assoc()){
            $rows[] = $item;
        }
        return $rows;
    }
}
?>
