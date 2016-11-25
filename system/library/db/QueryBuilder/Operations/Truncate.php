<?php
namespace db\QueryBuilder\Operations;

trait Truncate {
	
	public function truncate() {
		$sql = "SELECT COUNT(*) AS total FROM `".DB_PREFIX.$this->table."`";
		$result = $this->execute($sql);
		return $result->row['total'];
	}
	
}
