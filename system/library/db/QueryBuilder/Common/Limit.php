<?php
namespace db\QueryBuilder\Common;

trait Limit {
	
	private $page;
	private $count;
	
	public function page($page) {
		$page = intval($page);
		$this->page = $page > 0 ? $page : 1;
		
		return $this;
	}
	
	public function limit($count) {
		$count = intval($count);
		$this->count = $count > 0 ? $count : 1;
		
		return $this;
	}
	
	public function _limit() {
		if($this->count && $this->page) {
			return "LIMIT ".(($this->page - 1) * $this->count).",".$this->count;
		}
		
		if($this->count && !$this->page) {
			return "LIMIT ".$this->count;
		}
		
		return "";
	}
	
}
