<?php
namespace db\QueryBuilder\Operations;

trait Select {
	
	public function get($fields = null) {
		$fields_sql = "*";
		
		if(is_array($fields)) {
			$tmp = array();
			
			if(is_array_assoc($fields)) {				
				foreach($fields as $field => $alias) {
					$tmp[] = $this->field($field)." AS `".$alias."`";
				}
			} else {
				foreach($fields as $field) {
					$tmp[] = $this->field($field);
				}
			}
			
			$fields_sql = implode(',', $tmp);
		} else if(is_string($fields)) {
			$fields_sql = $this->field($fields);
		}
		
		$sql = "SELECT ".$fields_sql." FROM `".$this->table."`";
		
		$result = $this->execute($sql);
		
		if($this->single) {
			return $result->row;
		} else {
			return $result->rows;
		}
	}
	
	public function value($field) {
		$result = $this->get();
		
		if(isset($result['field'])) {
			return $result['field'];
		} else {
			return null;
		}
	}
	
	public function count() {
		$sql = "SELECT COUNT(*) AS total FROM `".$this->table."`";
		$result = $this->execute($sql);
		return $result->row['total'];
	}
	
}
