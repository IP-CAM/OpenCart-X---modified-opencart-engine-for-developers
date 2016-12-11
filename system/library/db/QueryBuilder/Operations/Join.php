<?php
namespace db\QueryBuilder\Operations;

trait Join {
	
	public function join() {
		
		return $this;
	}
	
	public function leftJoin() {
		
		return $this;
	}
	
	public function crossJoin() {
		
		return $this;
	}
	
	public function on($data) {
		
		return $this;
	}
	
	private function _joins() {
		return "";
	}
	
}
