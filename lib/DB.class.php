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

	function insertDB($query, $params = array())
    {
        $sql_statement = $this->conn->prepare($query);
        if (! empty($params)) {
            $this->bindParams($sql_statement, $params);
        }
        $sql_statement->execute();

        $id = mysqli_insert_id ( $this->conn );
        return $id;
    }

    function updateDB($query, $params = array())
    {
		$sql_statement = $this->conn->prepare($query);
        if (! empty($params)) {
            $this->bindParams($sql_statement, $params);
		}
        $sql_statement->execute();
    }

    function bindParams($sql_statement, $params)
    {
        $param_type = "";
        foreach ($params as $query_param) {
            $param_type .= $query_param["param_type"];
        }

        $bind_params[] = & $param_type;
        foreach ($params as $k => $query_param) {
            $bind_params[] = & $params[$k]["param_value"];
        }

        call_user_func_array(array(
            $sql_statement,
            'bind_param'
        ), $bind_params);
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