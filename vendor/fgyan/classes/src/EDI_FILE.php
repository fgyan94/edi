<?php

namespace edi;

class EDI_FILE {
	private $_FILE;
	public function __construct($_FILE) {
		$_TMP_FILE = $_FILE ['tmp_name'];
		$_FILENAME = $_FILE ['name'];
		$_DESTINATION = $GLOBALS ['PATH_DIR_UPLOAD'] . DIRECTORY_SEPARATOR . $_FILENAME;

		move_uploaded_file ( $_TMP_FILE, $_DESTINATION );

		$this->_FILE = $_DESTINATION;
	}
	public function getFile() {
		return $this->_FILE;
	}
}

