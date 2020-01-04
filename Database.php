<?php

class Database
{
	protected $connection;
	protected $query;

	var $DB_HOST = DB_HOST;
	var $DB_NAME = DB_NAME;
	var $DB_USER = DB_USER;
	var $DB_PASS = DB_PASS;
	var $DB_CHAR = DB_CHAR;

	function __construct()
	{
		$this->connection = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
		if ($this->connection->connect_error) {
			die('Error connection : ' . $this->connection->connect_error);
		}
		$this->connection->set_charset($this->DB_CHAR);
	}

	function executeQuery($query)
	{
		if ($this->query = $this->connection->prepare($query)) {
			$this->query->execute();
			if ($this->query->errno) {
				die('Error execution : ' . $this->query->error);
			}
		} else {
			die('Error execution : ' . $this->query->error);
		}
	}

	function getList($query)
	{
		if ($this->query = $this->connection->prepare($query)) {
			$this->query->execute();
			$result = $this->query->get_result();
			if ($this->query->errno) {
				die('Error execution : ' . $this->query->error);
			} else {
				$parameters = array();
				while ($row = $result->fetch_array()) {
					$parameters[] = $row;
				}
				return $parameters;
			}
		} else {
			die('Error execution: ' . $this->query->error);
		}
	}

	function close()
	{
		return $this->connection->close();
	}
}
