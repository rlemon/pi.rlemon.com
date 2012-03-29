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
				$this->view->raw("text/plain", "./uploads/pastes/$hash");
			} else {
				$paste_content = $this->model->get_paste($hash);
				$data['paste_content'] = $paste_content;
				$this->view->load('pi/view-paste', $data);
			}
			return;
		} else { // no hash exists, display the upload form.
			if( isset( $_POST['upload-paste'] ) ) {
				$data['filehash'] = $this->model->create_paste( stripslashes($_POST['code']) );
			}
		}
		$this->view->load('pi/upload-paste', $data);
	}
	
	public function image($hash = null) {
		include( 'lib/libraries/upload.class.php' );
		$data = array();
		if( !empty( $hash ) ) { 
			$this->view->raw("image/png", "./uploads/images/$hash");
			return;
		} else { // no hash exists, display the upload form.
			if( isset( $_POST['upload-image'] ) ) {
				if( isset( $_FILES['image'] ) ) {
					$ihandle = new upload($_FILES['image']);
					if( $ihandle->uploaded ) {
						$ihandle->file_new_name_body = md5( $_FILES['image']['name'] );
						$ihandle->file_dst_name_ext = '';
						$ihandle->file_force_extension = true;
						$handle->allowed = array('image/png','image/jpeg','image/gif');
						$ihandle->process('./uploads/images/');
						if( $ihandle->processed ) {
							$data['filehash'] = $ihandle->file_dst_name;
						} else {
							$data['error'] = $ihandle->error;
						}
					}
				}
			}
		}
		$this->view->load('pi/upload-image', $data);
	}
	
}
