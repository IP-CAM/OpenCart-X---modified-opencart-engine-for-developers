<?php
if (!function_exists('table')) {
	function table($table) {
		return Registry::getInstance()->get('db')->table($table);
	}
}
