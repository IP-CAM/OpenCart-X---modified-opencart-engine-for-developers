<?php
class Request {
	public $get = array();
	public $post = array();
	public $cookie = array();
	public $files = array();
	public $server = array();

	public function __construct() {
		$this->get = $this->clean($_GET);
		$this->post = $this->clean($_POST);
		$this->request = $this->clean($_REQUEST);
		$this->cookie = $this->clean($_COOKIE);
		$this->files = $this->clean($_FILES);
		$this->server = $this->clean($_SERVER);
	}

	public function clean($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				unset($data[$key]);

				$data[$this->clean($key)] = $this->clean($value);
			}
		} else {
			$data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
		}

		return $data;
	}
	
	public function isAjax() {
		return (isset($this->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}
	
	public function hasPost($keys = array()) {
		return $this->_has($keys, $this->post);
	}
	
	public function hasGet($keys = array()) {
		return $this->_has($keys, $this->get);
	}
	
	private function _has($keys, &$arr) {
		if(is_string($keys)) {
			return array_key_exists($keys, $arr);
		}
		
		foreach($keys as $key) {
			if(!array_key_exists($key, $arr)) return false;
		}
		
		return true;
	}
	
}