<?php
if (!function_exists('lang')) {
	function lang($key) {
		$text = Registry::getInstance()->get('language')->get($key);
		
		$arguments = func_get_args();
		
		if(count($arguments > 1)) {
			array_shift($arguments);
			return vsprintf($text, $arguments);
		} else {
			return $text;
		}
	}
}
