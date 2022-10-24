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
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					
					default:
						$type = PARAM_STR;
						break;
				}
			}
			$this->stmt->bindValue($param , $value, $type);
		}
		public function execute()
		{
			$this->stmt->execute();
		}

		public function all()
		{
			$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function single()
		{
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}
	}
}