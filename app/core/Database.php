<?php 

class Database
{

	private $dbh;
	private $stmt;
	private $hostname;
	private $dbname;
	private $user;
	private $pass;

	public function __construct()
	{
		$dsn = "mysql:host = $this->hostname;dbname = $this->dbname";

		$option = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDF::ERRMODE_EXCEPTION
		];

		try {
			$dbh = new PDO($dsn, $this->user, $this->pass, $option);
		} catch (Exception $e) {
			die($e->getMessage());
		}

		public function query($query)
		{
			$this->stmt = $dbh->prepare($query);
		}

		public function bind($param, $value, $type = null)
		{
			
		}
	}
}