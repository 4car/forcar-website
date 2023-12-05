<?php
// Database.php
class Database{
	
    private $host = getenv("SERVERIP");
    private $user = "forcar";
    private $password = getenv("FORPASSWD");
    private $database = "forcar"; 

    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>