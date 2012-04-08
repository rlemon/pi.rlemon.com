<?php
/*
 *      pi.controller
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
class Pi extends Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	/* 
	 * Display Main page, and option for image or paste
	 */
	public function index() {
		$this->view->load('pi/index');
	}
	
	/* pastes */
	public function paste($hash = null, $raw = false) {
		$data = array();
		if( !empty( $hash ) ) { 
			if( strtolower($raw) === 'raw' ) {
				$this->view->raw('text/plain', './uploads/pastes/' . $hash );
			} else {
				$paste_content = $this->model->get_paste($hash);
				$data['paste_content'] = $paste_content;
				$data['styles'] = array('/assets/google-code-prettify/prettify.css');
				$data['scripts'] = array('/assets/google-code-prettify/prettify.js', '/assets/js/util.js', '/assets/js/paste.js');
				$this->view->load('pi/view-paste', $data);
			}
			return;
		} else { // no hash exists, display the upload form.
			if( isset( $_POST['upload-paste'] ) ) {
				redirect('paste/' . $this->model->create_paste( stripslashes($_POST['code']) ) );
			}
		}
		$this->view->load('pi/upload-paste', $data);
	}
	
	public function image($hash = null) {
		$data = array();
		if( !empty( $hash ) ) { 
			$mimes = array('png' => 'png', 'jpg' => 'jpeg', 'gif' => 'gif');
			$ext = pathinfo($hash, PATHINFO_EXTENSION);
			$mime = '';
			foreach( $mimes as $k => $v ) {
				if( $ext == $k || $ext == $v ) {
					$mime = 'image/' . $v;
				}
			}
			if( empty( $mime ) ) {
				throw new Exception('Unexpected error, unsupported MIME type', 500);
			}
			$this->view->raw($mime, './uploads/images/' . $hash );
			return;
		}
		if( isset( $_POST['upload-image'] ) ) {
			if( isset( $_FILES['image'] ) ) {
				$accepted_types = array('image/jpeg' => 'jpeg','image/gif' => 'gif','image/png' => 'png');
				if( $_FILES['image']['size'] > 2048*1024 ) {
					die( json_encode( array('error' => 'requested file is too large ' . $_FILES['image']['size']) ) );
				}
				if( !array_key_exists( $_FILES['image']['type'], $accepted_types ) ) {
					die( json_encode( array('error' => 'invalid mime type') ) );
				}
				$target = 'uploads/images/' . md5( $_FILES['image']['name'] ) . '.' . $accepted_types[$_FILES['image']['type']];
				if( file_exists( $target ) ) {
					die( json_encode( array('error' => 'stupid server error I didnt handle properly') ) );
				}
				if(!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
					echo json_encode(array('error' => 'could not save the image to the server'));
				} else {
					echo json_encode(array('imgsrc' => $target));
				}
			} else {
				
			}
			return;
		}
		$data['scripts'] = array('/assets/js/util.js', '/assets/js/iupload.js');
		$this->view->load('pi/upload-image', $data);
	}
	
}
