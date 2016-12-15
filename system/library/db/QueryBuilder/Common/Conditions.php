<?php
namespace db\QueryBuilder\Common;

trait Conditions {
	
	private $conditions_sql = '';
	
	public function where($field, $operator = '=', $value = null) {
		$sql = $this->parseInputConditions($field, $operator, $value);
		
		$this->appendCondition($sql);
		
		return $this;
	}
	
	public function orWhere($field, $operator = '=', $value = null) {
		$sql = $this->parseInputConditions($field, $operator, $value);
		
		$this->appendCondition($sql, " OR ");
		
		return $this;
	}
	
	public function whereRaw($sql) {
		$this->appendCondition($sql);
		
		return $this;
	}
	
	public function orWhereRaw($sql) {
		$this->appendCondition($sql, " OR ");
		
		return $this;
	}
	
	public function whereNull($field) {
		return $this->whereRaw($this->_field($field)." IS NULL");
	}
	
	public function whereNotNull($field) {
		return $this->whereRaw($this->_field($field)." IS NOT NULL");
	}
	
	public function whereIn($field, $keys) {
		return $this->whereRaw($this->_field($field)." IN (".$this->implodeValues($keys).")");
	}
	
	public function whereNotIn($keys) {
		return $this->whereRaw($this->_field($field)." NOT IN (".$this->implodeValues($keys).")");
	}
	
	public function find($keys) {
		if(is_int($keys) or is_string($keys)) {
			$this->where($this->getPrimaryKey(), $keys);
		} else {
			$this->whereIn($this->getPrimaryKey(), $keys);
		}
		
		return $this;
	}
	
	public function first($limit = 1) {
		$this->limit($limit);
		
		return $this;
	}
	
	public function last($limit = 1) {
		$this->limit($limit);
		
		$this->sortOrder = $this->sortOrder == "DESC" ? "ASC" : "DESC";
		
		return $this;
	}
	
	public function random($limit = 1) {
		$this->limit($limit);
		
		$this->sortField = "RAND()";
		
		return $this;
	}
	
	private function parseInputConditions($field, $operator, $value) {
		$sql = '';
		
		if(is_array($field)) {
			$tmp = array();
			
			foreach($field as $cond) {				
				if(count($cond) == 2) {
					$tmp[] = $this->fieldToValue($cond[0], '=', $cond[1]);
				} else {
					$tmp[] = $this->fieldToValue($cond[0], $cond[1], $cond[2]);
				}
			}
			
			$sql = implode(" AND ", $tmp);
		} else {
			if(is_null($value)) {
				$value = $operator;
				$operator = '=';
			}
			
			$sql = $this->fieldToValue($field, $operator, $value);
		}
		
		return $sql;
	}
	
	private function appendCondition($condition, $operator = 'AND') {
		if(!$this->conditions_sql and $condition) {
			$this->conditions_sql = PHP_EOL."WHERE (".$condition.")";
		} else {
			$this->conditions_sql .= " ".$operator." (".$condition.")";
		}
	}
	
	private function _where() {
		return $this->conditions_sql;
	}
	
	private function implodeValues($values) {
		for($i=0; $i<count($values); $i++) {
			$values[$i] = is_int($values[$i]) ? $values[$i] : "'".$this->escape($values[$i])."'";
		}
		
		return implode(',', $values);
	}
	
}
