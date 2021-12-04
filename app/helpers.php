<?php 

if(! function_exists('class_active')) {
	function class_active(...$url) {
		if(request()->routeIs($url)) {
			return 'active';
		} else {
			return '';
		}
	}
}

if(! function_exists('class_show')) {
	function class_show(...$url) {
		if(request()->routeIs($url)) {
			return 'show';
		} else {
			return '';
		}
	}
}