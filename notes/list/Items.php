<?php

class Items
{
	private $tablename;
  private $conn;
  function __construct($con) {
     $this->conn = $con;
     $this->tablename = 'items';
     }

  function getItems()
  {
  	$query = "SELECT * FROM " .$this->tablename ;
  	$result = $this->conn->query($query);
  	return $result;
  }
  function getItemById($id)
  {
    $query = "SELECT * FROM items where id = ? ";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i",$id);
    return $stmt->execute();
  }
   function getItemByUserName($name)
  {
    $query = "SELECT * FROM items where username = '$name' ";
    //$stmt = $this->conn->prepare($query);
    //$stmt->bind_param("s",$name)q;
    return $this->conn->query($query);
  }
  function create($username,$description)
  {
    $query = "INSERT INTO $this->tablename (username,description) VALUES (?,?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ss",$username,$description);
     
    return $stmt->execute();
   //return $this->conn->query($query);
 }

 function update($id,$description)
 {
  $query = "UPDATE $this->tablename SET description = ? where id = ?";
  $stmt = $this->conn->prepare($query);
  $stmt->bind_param("si",$description,$id);
  return $stmt->execute();
 }
 function delete($id)
 {
  $query = "DELETE FROM $this->tablename where id = ?";
  $stmt = $this->conn->prepare($query);
  $stmt->bind_param("i",$id);
  return $stmt->execute();
 }
}

?>