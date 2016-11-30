<?php
namespace db\QueryBuilder\Common;

trait Order {
	
	private $sortField;
	private $sortOrder;
	
	public function sortBy($field, $order = 'ASC') {
		$this->order_sql = "ORDER BY ".$this->field($field)." ".$order;
		
		return $this;
	}
	
	private function _order() {
		if($this->sortField) {
			return "ORDER BY ".$this->field($this->sortField)." ".$this->sortOrder;
		}
		
		return '';
	}
	
}
