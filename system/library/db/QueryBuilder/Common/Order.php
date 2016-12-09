<?php
namespace db\QueryBuilder\Common;

trait Order {
	
	private $sortField;
	private $sortOrder;
	
	public function sortBy($field, $order = 'ASC') {
		$this->sortField = $field;
		$this->sortOrder = $order;
		
		return $this;
	}
	
	private function _order() {
		if($this->sortField) {
			return " ORDER BY ".$this->field($this->sortField)." ".$this->sortOrder;
		} else {
			return " ORDER BY ".$this->getPrimaryKey()." ".$this->sortOrder;
		}
	}
	
}
