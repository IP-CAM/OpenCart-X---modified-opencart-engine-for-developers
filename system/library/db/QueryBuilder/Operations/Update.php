<?php
namespace db\QueryBuilder\Operations;

trait Update {
	
	public function update($data) {
		$fields = array();
		
		foreach($data as $field => $value) {
			$fields[] = $this->fieldToValue($field, $value);
		}
		
		$fields = implode(',', $fields);
		
		$sql = "UPDATE ".$this->_table()." SET ".$fields.$this->_where();
		
		$this->execute($sql);
	}
	
	public function increment($field) {
		
	}
	
	public function decrement($field) {
		
	}
	
	public function toggle($field) {
		if(!is_array($fields)) {
			$fields_sql = "`".$this->field($fields)."` = NOT `".$this->field($fields)."`";
		}
		else {
			$tmp = array();
			
			foreach($fields as $field) {
				$tmp[] = "`".$this->field($field)."` = NOT `".$this->field($field)."`";
			}
			
			$fields_sql = implode(',', $tmp);
		}
		
		$sql = "UPDATE ".$this->_table()." SET ".$fields.$this->_where();
		
		$this->execute($sql);
	}
	
}
