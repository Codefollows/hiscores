<?php
class Database {

	private $conn;
	private $host;
	private $user;
	private $pass;
	private $data;

	private $table;

	public function __construct($host, $user, $pass, $data) {
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->data = $data;
	}

	public function connect() {
		try {
			$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->data.';charset=utf8', $this->user, $this->pass);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
			$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function setTable($table) {
		$this->table = $table;
	}

	public function countUsers() {
		$stmt = $this->conn->prepare("SELECT * FROM $this->table LIMIT 500");
		$stmt->execute();
		return count($stmt->fetchAll(PDO::FETCH_ASSOC));
	}

	public function getUser($name) {
		$stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE username=:name");
		$stmt->bindParam(":name", $name);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getAllUsers($skill, $min, $mode = null) {
		if ($mode != null) {
			$stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE mode=:mode ORDER BY $skill DESC LIMIT $min, 25");
			$stmt->bindParam(":mode", $mode);
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM $this->table ORDER BY $skill DESC LIMIT $min, 25");
		}
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getRank($user, $skill, $mode) {
		$skill = strtolower($skill)."_xp";
		$stmt = $this->conn->prepare("SELECT (SELECT COUNT(*) FROM hs_users WHERE mode = :mode AND ($skill) >= (u.$skill)) AS rank FROM hs_users u WHERE username = :user AND mode = :mode2 LIMIT 1");
        $stmt->bindParam(":user", $user);
		$stmt->bindParam(":mode", $mode);
		$stmt->bindParam(":mode2", $mode);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

}
?>
