<?php
class DB {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "blog_samples";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}

	function runStatement($query) {
		$result = mysqli_query($this->conn,$query);
		if(!$result){
			var_dump($query);
			echo "</br>".mysqli_error($this->conn) ."</br > something went wrong. </ br>";
		}
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}

	function escapeString($toEscape){
		return mysqli_real_escape_string($this->conn, $toEscape);
	} 
}