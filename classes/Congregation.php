<?php

require_once('Database.class.php');

class Congregation
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($ucongre,$ulider,$uadress)
	{
		try
		{	
			$stmt = $this->conn->prepare("INSERT INTO congregation(con_name,con_lider,con_adress) VALUES(:ucongre, :ulider, :uadress)");
												  
			$stmt->bindparam(":ucongre", $ucongre);
			$stmt->bindparam(":ulider", $ulider);
			$stmt->bindparam(":uadress", $uadress);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
}
?>