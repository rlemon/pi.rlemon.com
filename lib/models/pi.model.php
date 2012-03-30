<?php
/*
 *      pi.model
 *      
 *      Copyright 2012 Robert Lemon <rob.lemon@gmail.com>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 *      
 *      
 */
class Pi_Model extends Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function create_paste($contents) {
		$fileInfo = get_unique_filename('./uploads/pastes');
		$handle = fopen($fileInfo[0], 'w');
		$res = !!fwrite($handle, $contents);
		fclose($handle);
		return $res ? $fileInfo[1] : null;
	}
	
	public function create_image($image) {
		
	}
	
	public function get_paste($hash) {
		$filename = './uploads/pastes/' . $hash;
		if( !file_exists( $filename ) ) {
			throw new Exception('The requested file could not be found on the server.', 404);
		}
		return file_get_contents( $filename );
	}
	
	public function get_image($hash) {
		
	}
	
}
 
