<?php
namespace db\QueryBuilder\Common;

trait Limit {
	
	private $limitOffset;
	private $limitCount = 15;
	
	public function limit($count) {
		$count = intval($count);
		$this->limitCount = $count > 0 ? $count : 1;
		
		return $this;
	}
	
	public function skip($count) {
		$this->limitOffset = intval($count);
		
		return $this;
	}
	
	public function page($page) {
		$page = intval($page);
		$page = $page > 0 ? $page : 1;
		
		$this->limitOffset = ($page - 1) * $this->limitCount;
		
		return $this;
	}
	
	public function _limit() {
		if($this->limitCount && $this->limitOffset) {
			return " LIMIT ".$this->limitOffset.",".$this->limitCount;
		}
		
		if($this->limitCount && !$this->limitOffset) {
			return " LIMIT ".$this->limitCount;
		}
		
		return "";
	}
	
}
