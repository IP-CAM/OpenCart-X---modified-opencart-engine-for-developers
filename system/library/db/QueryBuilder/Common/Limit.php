<?php
namespace db\QueryBuilder\Common;

trait Limit {
	
	private $page;
	private $limit;
	
	public function page($page) {
		$page = intval($page);
		$this->page = $page > 0 ? $page : 1;
		
		return $this;
	}
	
	public function limit($limit) {
		$limit = intval($limit);
		$this->limit = $limit > 0 ? $limit : 1;
		
		return $this;
	}
	
	public function _limit() {
		if($this->limit && $this->page) {
			return " LIMIT ".(($this->page - 1) * $this->limit).",".$this->limit;
		}
		
		if($this->limit && !$this->page) {
			return " LIMIT ".$this->limit;
		}
		
		return "";
	}
	
}
