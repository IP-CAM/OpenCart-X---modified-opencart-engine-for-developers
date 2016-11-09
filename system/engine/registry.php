<?php
final class Registry {
	
	public static $instance = null;
	
	private $data = array();
	
	public function __construct() {
		self::$instance = $this;
	}
	
	public static function getInstance() {
		return self::$instance;
	}

	public function get($key) {
		if($this->has($key)) {
			return $this->data[$key];
		} else if(substr($key, 0, 5)=='model') {
			// models autoload
			$temp = explode('_', $key);
			$this->get('load')->model($temp[1].'/'.$temp[2]);
			return $this->data[$key];
		} else {
			return null;
		}
	}

	public function set($key, $value) {
		$this->data[$key] = $value;
	}

	public function has($key) {
		return isset($this->data[$key]);
	}
	
}