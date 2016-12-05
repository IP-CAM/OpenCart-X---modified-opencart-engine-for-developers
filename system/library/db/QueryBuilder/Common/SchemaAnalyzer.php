<?php
namespace db\QueryBuilder\Common;

trait SchemaAnalyzer {
	
	private $primaryKeys = array();
	private $columns = array();
	
	public function getPrimaryKey($table = null) {		
		$table = $this->table($table);
		
		if(isset($this->primaryKeys[$table])) {
			return $this->primaryKeys[$table];
		}
		
		$result = $this->driver->query("SHOW KEYS FROM ".$table." WHERE Key_name = 'PRIMARY'");
		
		return $result->row['Column_name'];
	}
	
}
