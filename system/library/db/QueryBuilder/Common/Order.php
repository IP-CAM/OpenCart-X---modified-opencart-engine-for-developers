<?php
namespace db\QueryBuilder\Common;

trait Order {
	
	private $sortField;
	private $sortOrder = "ASC";
	
	public function sortBy($field, $order = "ASC") {
		$this->sortField = $field;
		$this->sortOrder = strtoupper($order);
		
		return $this;
	}
	
	private function _order() {
		if(!$this->sortField) {
			$this->sortField = $this->_field($this->getPrimaryKey());
		}
		
		return PHP_EOL."ORDER BY ".$this->sortField." ".$this->sortOrder;
	}
	
}
