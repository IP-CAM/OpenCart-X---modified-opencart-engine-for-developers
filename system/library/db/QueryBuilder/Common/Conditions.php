<?php
namespace db\QueryBuilder\Common;

trait Conditions {
	
	private $single = false;
	private $conditions_sql = '';
	
	public function where($field, $operator = '=', $value = null) {
		$sql = $this->parseInputConditions($field, $operator, $value);
		
		$this->appendCondition($sql);
		
		return $this;
	}
	
	public function whereRaw($sql) {
		$this->appendCondition($sql);
		
		return $this;
	}
	
	public function orWhere($field, $operator = '=', $value = null) {
		$sql = $this->parseInputConditions($field, $operator, $value);
		
		$this->appendCondition($sql, " OR ");
		
		return $this;
	}
	
	public function andWhere($field, $operator = '=', $value = null) {
		return $this->where($field, $operator, $value);
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
	
	public function random($limit = 0) {
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
	
	private function parseInputConditions($field, $operator, $value) {
		$sql = '';
		
		if(is_array($field)) {
			$tmp = array();
			
			foreach($field as $cond) {				
				if(count($cond) == 2) {
					$tmp[] = $this->createCondition($cond[0], '=', $cond[1]);
				} else {
					$tmp[] = $this->createCondition($cond[0], $cond[1], $cond[2]);
				}
			}
			
			$sql = implode(" AND ", $tmp);
		} else {
			if(is_null($value)) {
				$value = $operator;
				$operator = '=';
			}
			
			$sql = $this->createCondition($field, $operator, $value);
		}
		
		return $sql;
	}
	
	private function createCondition($field, $operator, $value) {
		return $this->field($field).$operator."'".$this->escape($value)."'";
	}
	
	private function appendCondition($condition, $operator = 'AND') {
		if(!$this->conditions_sql and $condition) {
			$this->conditions_sql = " WHERE (".$condition.")";
		} else {
			$this->conditions_sql .= " ".$operator." (".$condition.")";
		}
	}
	
}
