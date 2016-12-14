<?php
namespace db\QueryBuilder\Operations;

trait Select {
	
	use Join;
	
	public function get($fields = null) {
		$fields_sql = $this->prepareFieldsToSelect($fields);
		
		$sql = "SELECT".PHP_EOL."   ".$fields_sql.PHP_EOL."FROM ".$this->_tableAsAlias().$this->_joins().$this->_where().$this->_order().$this->_limit();
		
		$result = $this->execute($sql);
		
		if($this->single()) {
			return $result->row;
		} else {
			return $result->rows;
		}
	}
	
	public function all($fields = null) {
		$this->limit(0);
		
		return $this->get($fields);
	}
	
	public function value($field) {
		$rows = $this->get($field);
		
		if($this->single()) {
			if(isset($rows[$field])) {
				return $rows[$field];
			} else {
				return null;
			}
		} else {
			$results = array();
			
			foreach($rows as $row) {
				$results[] = $row[$field];
			}
			
			return $results;
		}
	}
	
	public function count() {
		$sql = "SELECT".PHP_EOL."   COUNT(*) AS total".PHP_EOL."FROM ".$this->_tableAsAlias().$this->_joins().$this->_where();
		$result = $this->execute($sql);
		return $result->row['total'];
	}
	
	private function single() {
		return $this->limitCount == 1;
	}
	
	private function prepareFieldsToSelect($fields) {
		$fields_sql = "*";
		
		if(is_array($fields)) {
			$tmp = array();
			
			foreach($fields as $field => $alias) {
				if(is_int($field)) {
					$tmp[] = $this->_field($alias);
				} else {
					$tmp[] = $this->_field($field)." AS `".$alias."`";
				}
			}
			
			$fields_sql = implode(",".PHP_EOL."   ", $tmp);
		} else if(is_string($fields)) {
			$fields_sql = $this->_field($fields);
		}
		
		return $fields_sql;
	}
	
}
