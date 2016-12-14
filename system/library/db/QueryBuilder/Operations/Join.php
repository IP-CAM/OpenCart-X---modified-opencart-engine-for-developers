<?php
namespace db\QueryBuilder\Operations;

trait Join {
	
	private $joins = array();
	
	public function join($table, $key1 = null, $key2 = null) {
		$table = $this->addTable($table);
		
		$this->joins[] = $this->createJoinSql("INNER JOIN", $table, $key1, $key2);
		
		return $this;
	}
	
	public function leftJoin() {
		$table = $this->addTable($table);
		
		$this->joins[] = $this->createJoinSql("LEFT OUTER JOIN", $table, $key1, $key2);
		
		return $this;
	}
	
	public function rightJoin() {
		$table = $this->addTable($table);
		
		$this->joins[] = $this->createJoinSql("RIGHT OUTER JOIN", $table, $key1, $key2);
		
		return $this;
	}
	
	public function crossJoin($table) {
		$table = $this->addTable($table);
		
		$this->joins[] = $this->createJoinSql("CROSS JOIN", $table);
		
		return $this;
	}
	
	private function createJoinSql($type, $table, $key1 = null, $key2 = null) {
		return $type." ".$this->_tableAsAlias($table).$this->parseJoinConditions($key1, $key2);
	}
	
	private function parseJoinConditions($key1, $key2) {
		if(is_null($key1)) {
			return "";
		}
		
		return "";
	}
	
	private function _joins() {
		return PHP_EOL.implode(PHP_EOL, $this->joins);
	}
	
}
