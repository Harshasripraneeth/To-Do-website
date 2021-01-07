<?php

class Database
{
	//Database Parameters

	private $host = 'localhost';
	private $userName = 'root';
	private $passoword = 'test';
	private $dbName = 'notes';
	private $conn ;

	public function getConnection()
	{
       $this->conn = null;
       try
       {
          $dsn = 'mysql:host='. $this->host .';dbname= '. $this->dbName;
          $this->conn = new PDO($dsn,$this->userName,$this->passoword);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       }
       catch(PDOException $exception)
       {
         echo "error message: " . $exception->getMessage();
       }

       return $this->conn;
    }

    public function getMYSQLI()
    {
    	$this->conn = null;
    	$this->conn = mysqli_connect($this->host,$this->userName,$this->passoword,$this->dbName);
    	return $this->conn;
    }
}
?>