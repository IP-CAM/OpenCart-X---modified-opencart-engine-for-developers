<?php
namespace db\QueryBuilder;

class Query {
	
	use Common\SchemaAnalyzer;
	use Common\Conditions;
	use Common\Order;
	use Common\Limit;
	
	use Operations\Select;
	use Operations\Insert;
	use Operations\Update;
	use Operations\Delete;
	
	private $driver;
	private $table;
	
	public function __construct($table = null) {
		$this->driver = \Registry::getInstance()->get('db');
		$this->setTable($table);
	}
	
	public function setTable($table) {
		$this->table = DB_PREFIX.$this->escape($table);
	}
	
	public function execute($sql) {
		return $this->driver->query($sql);
	}
	
	private function field($field) {
		if(strpos($field, '.') !== false) {
			$tmp = explode('.', $field);
			return $this->_table($tmp[0]).".`".$tmp[1]."`";
		}
		
		return $this->_table().".`".$this->escape($field)."`";
	}
	
	private function _table($table = null) {
		if(is_null($table)) {
			$table = $this->table;
		}
		
		return "`".$this->tableAlias($table)."`";
	}
	
	private function tableAlias($table) {
		return $table;
	}
	
	private function escape($value) {
		return $this->driver->escape($value);
	}
	
}
