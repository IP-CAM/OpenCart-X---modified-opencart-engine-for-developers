<?php
if (!function_exists('is_array_assoc')) {
	function is_array_assoc($arr) {
		if (array() === $arr) return false;
		return array_keys($arr) !== range(0, count($arr) - 1);
	}
}
