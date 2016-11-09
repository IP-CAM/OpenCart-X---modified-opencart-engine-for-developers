<?php
if (!function_exists('lang')) {
	function lang($key) {
		return Registry::getInstance()->get('language')->get($key);
	}
}
