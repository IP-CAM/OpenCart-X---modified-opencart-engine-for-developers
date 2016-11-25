<?php
namespace db\QueryBuilder;

class Query {
	
	use Operations\Select;
	use Operations\Insert;
	use Operations\Update;
	use Operations\Delete;
	use Operations\Truncate;
	
	private $driver;
	private $table;
	
	public function __construct($table = null) {
		$this->driver = \Registry::getInstance()->get('db');
		$this->setTable($table);
	}
	
	public function setTable($table) {
		$this->table = DB_PREFIX.$table;
	}
	
	public function execute($sql) {
		return $this->driver->query($sql);
	}
	
	private function field($field) {
		return "`".$this->table.".".$field."`";
	}
	
	
	/* Conditions */
	private $single = false;
	
	public function where() {
		return $this;
	}
	
	public function orWhere() {
		return $this;
	}
	
	public function andWhere() {
		return $this;
	}
	
	public function find($keys) {
		if(is_int($keys) or is_string($keys)) {
			$this->single = true;
		}
		
		return $this;
	}
	
	public function first() {
		$this->single = true;
		
		return $this;
	}
	
	public function last() {
		$this->single = true;
		
		return $this;
	}
	
	public function random($limit = 1) {
		if($limit == 1) {
			$this->single = true;
		}
		
		return $this;
	}
	
	/* Limit */
	public function limit() {
		return $this;
	}
	
	public function page() {
		return $this;
	}
	
}
