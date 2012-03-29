<?php

function redirect($path) {
	header("Location: http://" . $_SERVER['HTTP_HOST'] . "/$path");
}

function get_unique_filename($folder = '') {
	$hash = md5( microtime() . mt_rand(0,99999) );
	$name = "$folder/$hash";
	if( file_exists( $name ) ) {
		$name = get_unique_filename($folder);
	}
	return array($name, $hash);
}
